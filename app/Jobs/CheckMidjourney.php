<?php

namespace App\Jobs;

use App\Mail\SendMidjourneyError;
use App\Models\Midjourney;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class CheckMidjourney implements ShouldQueue
{
    use Queueable;

    public $timeout = 600;

    public function handle(): void
    {

        $task = Midjourney::withoutGlobalScopes()->where('status', '=', 'pending')->with('user')->first();



//        Log::channel('midjourney')->info('Generated SQL', ['query' => $task]);

//        if ($task) {
//            Log::channel('midjourney')->info('Task found');
//        } else {
//            Log::channel('midjourney')->info('No pending task found');
//        }

        if ($task) {

            $response = Http::withHeaders([
                'x-api-key'  => config('apikeys.piapi'),
                'User-Agent' => 'Apidog/1.0.0 (https://apidog.com)',
            ])->get('https://api.piapi.ai/api/v1/task/'.$task->task_id);

            if ($response->successful()) {
//                Log::channel('midjourney')->info('api call is successful');

                if ($response->json()['data']['status'] === 'completed') {



                    $created_at = Carbon::parse($response->json()['data']['meta']['created_at']);
                    $ended_at = Carbon::parse($response->json()['data']['meta']['ended_at']);
                    $duration = $created_at->diffInSeconds($ended_at);

//                    Log::channel('midjourney')->info('status completed');

                        $imageContents = Http::get($response->json()['data']['output']['image_url'])->body();

//                    Log::channel('midjourney')->info('imagecontent received');



                    $manager = new ImageManager(new Driver());
                    $image   = $manager->read($imageContents);

//                    Log::channel('midjourney')->info('imagecontent red by intervention');

                    // Get the image dimensions
                    $width  = $image->width();   // Width of the image
                    $height = $image->height(); // Height of the image

                    // Calculate the dimensions of each part (quadrant)
                    $partWidth  = $width / 2;
                    $partHeight = $height / 2;

                    $random = random_int(10000, 99999);

                    // Part 1 (top-left)
                    $part1 = clone $image;  // Clone the original image
                    $part1->crop($partWidth, $partHeight, 0, 0);
                    $part1->save(public_path($task->user->id.'_'.'midjourney1_'.$random.'.jpg'));
                    $task->addMedia(public_path($task->user->id.'_'.'midjourney1_'.$random.'.jpg'))->toMediaCollection('midjourney1');
                    File::delete(public_path($task->user->id.'_midjourney1_'.$random.'.jpg'));

//                    Log::channel('midjourney')->info('saved first image');

                    // Part 2 (top-right)
                    $part2 = clone $image;  // Clone the original image
                    $part2->crop($partWidth, $partHeight, $partWidth, 0);
                    $part2->save(public_path($task->user->id.'_'.'midjourney2_'.$random.'.jpg'));
                    $task->addMedia(public_path($task->user->id.'_'.'midjourney2_'.$random.'.jpg'))->toMediaCollection('midjourney2');
                    File::delete(public_path($task->user->id.'_midjourney2_'.$random.'.jpg'));


                    // Part 3 (bottom-left)
                    $part3 = clone $image;  // Clone the original image
                    $part3->crop($partWidth, $partHeight, 0, $partHeight);
                    $part3->save(public_path($task->user->id.'_'.'midjourney3_'.$random.'.jpg'));
                    $task->addMedia(public_path($task->user->id.'_'.'midjourney3_'.$random.'.jpg'))->toMediaCollection('midjourney3');
                    File::delete(public_path($task->user->id.'_midjourney3_'.$random.'.jpg'));

                    // Part 4 (bottom-right)
                    $part4 = clone $image;  // Clone the original image
                    $part4->crop($partWidth, $partHeight, $partWidth, $partHeight);
                    $part4->save(public_path($task->user->id.'_'.'midjourney4_'.$random.'.jpg'));
                    $task->addMedia(public_path($task->user->id.'_'.'midjourney4_'.$random.'.jpg'))->toMediaCollection('midjourney4');
                    File::delete(public_path($task->user->id.'_midjourney4_'.$random.'.jpg'));


                    $task->update([
                        'midjourney_url' => $response->json()['data']['output']['image_url'],
                        'status'         => $response->json()['data']['status'],
                        'duration'       => $duration,
                    ]);

                    // SEND SMS NOTIFICATION

                    $text1 = 'გამარჯობა';
                    $text2 = 'Midjourney -მ დაასრულა თქვენი მოთხოვნა, გთხოვთ იხილოთ ფოტოები ლინკზე';
                    $text3 = 'https://imageai.test/midjourney';

                    $sendsms = $text1."\n\n".$text2."\n\n".$text3;

                    $url = 'https://api.ubill.dev/v1/sms/send';

                    $params = [
                        'key'      => config('apikeys.ubill'),
                        'brandID'  => 2,
                        'numbers'  => '995'.$task->user->mobile,
                        'text'     => $sendsms,
                        'stopList' => false,
                    ];

                    $response2 = Http::get($url, $params);
                }

            }else {
                Log::channel('midjourney')->info('midjourney error'.' '.$task->task_id, [
                    'response' => $response->json(),
                ]);

                Mail::to('gmta.constantine@gmail.com')->send(new SendMidjourneyError($task->user->first(),$task,$response->json()));
            }
        }
    }
}

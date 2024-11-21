<?php

namespace App\Jobs;

use App\Mail\RunwayErrorMail;
use App\Mail\SendMidjourneyError;
use App\Models\Runway;
use App\Services\AppBalanceService;
use App\Services\UserBalanceService;
use Carbon\Carbon;
use Exception;
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

class FetchRunwayJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $runway = Runway::withoutGlobalScopes()
            ->where('status', '=', 'pending')
            ->whereNotNull('task_id')
            ->with('user')->first();


        if ($runway) {

            $response=Http::withHeaders([
                'Authorization'    => 'Bearer '.config('apikeys.runway'),
                'X-Runway-Version' => "2024-11-06"
            ])->get('https://api.dev.runwayml.com/v1/tasks/'.$runway->task_id);

            if ($response->successful()) {
//                Log::channel('midjourney')->info('api call is successful');

                if ($response->json()['status'] === 'SUCCEEDED') {

                    Log::channel('runway')->info('Runway Job success-  '.$runway->task_id, [
                        'response' => $response->json(),
                    ]);


                    $user = $runway->user->first();

                    // Fetch the video content
                    $videoUrl = $response->json()['output'][0]; // Video URL
                    $videoContent = Http::get($videoUrl)->body(); // Get binary content
                    $random = random_int(10000, 99999); // Generate a random number for filename
                    $fileName = $user->id . '_' . $response->json()['id'] . '_runway.mp4'; // Local file name
                    $filePath = public_path($fileName); // Full path to save the file

                    // Save the video content locally
                    file_put_contents($filePath, $videoContent);

                    // Add to media collection if the file exists
                    if (File::exists($filePath)) {
                        $runway->addMedia($filePath)->toMediaCollection('runway_videos');
                        // Clean up the local file
                        File::delete($filePath);
                    } else {
                        throw new Exception("Failed to save video file.");
                    }


                    $runway->video_url = $runway->getMedia('runway_videos')->first()->getUrl();
                    $runway->status = 'completed';
                    $runway->save();

                    // SEND SMS NOTIFICATION

                    $text1 = 'გამარჯობა';
                    $text2 = 'Runway -მ დაასრულა თქვენი მოთხოვნა, გთხოვთ იხილოთ ფოტოები ლინკზე';
                    $text3 = 'https://imageai.test/runway';

                    $sendsms = $text1."\n\n".$text2."\n\n".$text3;

                    $url = 'https://api.ubill.dev/v1/sms/send';

                    $params = [
                        'key'      => config('apikeys.ubill'),
                        'brandID'  => 2,
                        'numbers'  => '995'.$runway->user->mobile,
                        'text'     => $sendsms,
                        'stopList' => false,
                    ];

                    $response2 = Http::get($url, $params);

                    // Deduct Balance from App
                    (new AppBalanceService())->appBalance('runway', 'runway'.$runway->duration.'-cost');


                    Log::channel('runway')->info('Runway user id in job-  ', [
                        'response' => $user->id,
                    ]);
                    // Deduct Balance from User
                    (new UserBalanceService)->deductBalance('runway', $runway->id, config('variables.runway'.$runway->duration.'-price'),$user->id);

                }
                else{
                    Log::channel('runway')->info('Runway status not succeeded-  '.$runway->task_id, [
                        'response' => $response->json(),
                    ]);
                }


            }else {

                Log::channel('runway')->info('Runway  success-  '.$runway->task_id, [
                    'response' => $response->json(),
                ]);

                Mail::to('gmta.constantine@gmail.com')->send(new RunwayErrorMail($runway->task_id,$runway->user->first(),$response->json()));
            }
        }
    }
}

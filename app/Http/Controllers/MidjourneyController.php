<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\ImageGeneration;
use App\Models\Midjourney;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class MidjourneyController extends Controller
{

    public function index(Request $request)
    {
        $images = Midjourney::where('status', '=', 'completed')
            ->whereDate('created_at', Carbon::today())
            ->with('media')
            ->get();


        $midjourneys = Midjourney::where('status', '=', 'completed')
            ->with('media')
            ->take(30)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.pages.image-midjourney', compact('images', 'midjourneys'));
    }

    public function imagine(Request $request)
    {

        if ($request->prompt == null) {
            sleep(5); // Wait for 5 seconds
            return back();
        }

        $response = Http::withHeaders([
            'x-api-key'    => config('apikeys.piapi'),
            'User-Agent'   => 'Apidog/1.0.0 (https://apidog.com)',
            'Content-Type' => 'application/json',
        ])->post('https://api.piapi.ai/api/v1/task', [
            'model'     => 'midjourney',
            'task_type' => 'imagine',
            'input'     => [
                'prompt'            => $request->prompt,
                'aspect_ratio'      => '4:3',
                'process_mode'      => 'relax',
                'skip_prompt_check' => false,
                'bot_id'            => 0,
            ],
            'config'    => [
                'service_mode' => 'public',
            ],
        ]);

        if ($response->successful()) {
            Midjourney::create([
                'task_id'        => $response->json()['data']['task_id'],
                'model'          => $response->json()['data']['model'],
                'status'         => $response->json()['data']['status'],
                'user_prompt_en' => $request->prompt,
            ]);

            $rate=Balance::where('provider', 'MIDJOURNEY')
                ->whereNotNull('rate')
                ->orderby('created_at', 'desc')
                ->first();

            $cost=0.04*$rate->rate;

            $balance=new Balance;
            $balance->user_id=auth()->id();
            $balance->provider='MIDJOURNEY';
            $balance->balance=-0.04;
            $balance->cost_gel=$cost;
            $balance->sell=0.25;
            $balance->profit=0.25-$cost;
            $balance->save();

        } else {
            dd($response->json());
        }

        return back();
    }

    public function delete(Request $request)
    {
        $midjourney = Midjourney::where('id', $request->id)->first();
        $index      = $request->index;

        $i = 0;
        foreach ($midjourney->media as $media) {
            if ($i == $index) {
                $media->delete();
            }
            $i++;
        }

// Refresh the relationship to get the updated media collection
        $midjourney->refresh();

        if ($midjourney->media->count() == 0) {
            $midjourney->delete();
        }

        return back();
    }

    public function fetch(Request $request)
    {



//        try {
//
//            // Check response status or log response if needed
//            if ($response->successful()) {
//                // Process successful response
//                echo 'Message sent successfully!';
//            } else {
//                // Handle the failed request
//                echo 'Failed to send the message: ' . $response->body();
//            }
//
//        } catch (\Exception $e) {
//            // Handle any exceptions, e.g., connection issues or server problems
//            echo 'Error: ' . $e->getMessage();
//        }








        $task = Midjourney::where('status', '=', 'pending')->first();

        if ($task) {
            $response = Http::withHeaders([
                'x-api-key'  => config('apikeys.piapi'),
                'User-Agent' => 'Apidog/1.0.0 (https://apidog.com)',
            ])->get('https://api.piapi.ai/api/v1/task/'.$task->task_id);
            if ($response->successful()) {
                if ($response->json()['data']['status'] === 'completed') {
                    $task->update([
                        'midjourney_url' => $response->json()['data']['output']['image_url'],
                        'status'         => $response->json()['data']['status'],
                    ]);

                    $imageContents = Http::get($response->json()['data']['output']['image_url'])->body();


                    $manager = new ImageManager(new Driver());
                    $image   = $manager->read($imageContents);

                    // Get the image dimensions
                    $width  = $image->width();   // Width of the image
                    $height = $image->height(); // Height of the image

                    // Calculate the dimensions of each part (quadrant)
                    $partWidth  = $width / 2;
                    $partHeight = $height / 2;


                    // Part 1 (top-left)
                    $part1 = clone $image;  // Clone the original image
                    $part1->crop($partWidth, $partHeight, 0, 0);
                    $part1->save(public_path(auth()->user()->id.'_'.'midjourney1.jpg'));
                    $task->addMedia(public_path(auth()->user()->id.'_'.'midjourney1.jpg'))->toMediaCollection('midjourney');
                    File::delete(public_path(auth()->user()->id.'_midjourney1.jpg'));


                    // Part 2 (top-right)
                    $part2 = clone $image;  // Clone the original image
                    $part2->crop($partWidth, $partHeight, $partWidth, 0);
                    $part2->save(public_path(auth()->user()->id.'_'.'midjourney2.jpg'));
                    $task->addMedia(public_path(auth()->user()->id.'_'.'midjourney2.jpg'))->toMediaCollection('midjourney');
                    File::delete(public_path(auth()->user()->id.'_midjourney2.jpg'));


                    // Part 3 (bottom-left)
                    $part3 = clone $image;  // Clone the original image
                    $part3->crop($partWidth, $partHeight, 0, $partHeight);
                    $part3->save(public_path(auth()->user()->id.'_'.'midjourney3.jpg'));
                    $task->addMedia(public_path(auth()->user()->id.'_'.'midjourney3.jpg'))->toMediaCollection('midjourney');
                    File::delete(public_path(auth()->user()->id.'_midjourney3.jpg'));

                    // Part 4 (bottom-right)
                    $part4 = clone $image;  // Clone the original image
                    $part4->crop($partWidth, $partHeight, $partWidth, $partHeight);
                    $part4->save(public_path(auth()->user()->id.'_'.'midjourney4.jpg'));
                    $task->addMedia(public_path(auth()->user()->id.'_'.'midjourney4.jpg'))->toMediaCollection('midjourney');
                    File::delete(public_path(auth()->user()->id.'_midjourney4.jpg'));




                    // SEND SMS NOTIFICATION

                    $text1 = 'გამარჯობა';
                    $text2='AI-მ დაასრულა თქვენი მოთხოვნა, გთხოვთ იხილოთ ფოტოები ლინკზე';
                    $text3 = 'https://imageai.test/midjourney';

                    $sendsms = $text1 . "\n\n" . $text2 . "\n\n" . $text3;

                    $url = 'https://api.ubill.dev/v1/sms/send';

                    $params = [
                        'key'      => config('apikeys.ubill'),
                        'brandID'  => 2,
                        'numbers'  => '995551507697',
                        'text'     => $sendsms,
                        'stopList' => false,
                    ];

                    $response2 = Http::get($url, $params);


                } else {
                    return $response->json()['data']['status'];
                }
            }
        }
    }

    public function webhook(Request $request)
    {
        $secret = '1|BsSD6oVb8wPqXjdApw4rjjbaAyFUr5aNnos7oiMG76a5d164';

        Log::channel('webhooks')->info('Webhook received', [
            'headers'    => $request->headers->all(),
            'payload'    => $request->all(),
            'ip_address' => $request->ip(),
        ]);


        if ($request->header('x-webhook-secret') !== $secret) {
            abort(403, 'Unauthorized webhook request.');
        }


        return response('Webhook logged', 200);
    }

    public function download(Request $request){

        $midjourney=Midjourney::where('id',$request->id)->with('media')->first();
        $media = $midjourney->media[$request->index];
        $filePath = $media->getPath();
        return response()->download($filePath, $media->file_name);
    }

}

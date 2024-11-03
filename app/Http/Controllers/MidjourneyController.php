<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Midjourney;
use App\Services\AppBalanceService;
use App\Services\UserBalanceService;
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


        if(!(new UserBalanceService())->checkBalance('midjourney')){
            return back()->with('alert_error','არასაკმარისი ბალანსი');
        }



        if ($request->prompt == null) {
            sleep(5);

            return back()->with('alert_error', 'გთხოვთ მიუთითეთ ფოტოს აღწერა');
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
           $midjourney = Midjourney::create([
                'task_id'        => $response->json()['data']['task_id'],
                'model'          => 'midjourney',
                'status'         => $response->json()['data']['status'],
                'user_prompt_en' => $request->prompt,
            ]);

            // Deduct Balance from App
            (new AppBalanceService())->appBalance('piapi', 'midjourney');

            // Deduct Balance from User
            (new UserBalanceService)->deductBalance('midjourney', $midjourney->id, config('variables.midjourney-price'));

            return back()->with('alert_success', 'დავალება მიღებულია! დასრულებისას მიიღებთ სმს შეტყობინებას ');
        } else {
            dd($response->json());
        }

        return back();
    }

    public function variation(Request $request)
    {
        $task_id = Midjourney::where('id', $request->id)->first();
        $media   = $task_id?->getMedia($request->index);

        // Convert the timestamp to a Carbon instance
        $time = Carbon::parse($task_id->created_at);

        // Check if the time is more than one hour ago
        if ($time->addHour()->isPast()) {
            return back()->with('alert_error', 'ფოტოს შექმნიდან გასულია 1 საათი და აღნიშნულ ფუნქციას ვერ გამოიყენებთ');
        }

        if ($media !==null && !$media->isEmpty()) {

            $index = substr($request->index, -1);

            $response = Http::withHeaders([
                'x-api-key'    => config('apikeys.piapi'),
                'User-Agent'   => 'Apidog/1.0.0 (https://apidog.com)',
                'Content-Type' => 'application/json',
            ])->post('https://api.piapi.ai/api/v1/task', [
                'model'     => 'midjourney',
                'task_type' => 'variation',
                'input'     => [

                    'origin_task_id'    => $task_id->task_id,
                    'index'             => $index,
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
                $midjourney = Midjourney::create([
                    'task_id'        => $response->json()['data']['task_id'],
                    'model'          => 'midjourney',
                    'status'         => $response->json()['data']['status'],
                    'user_prompt_en' => $task_id->user_prompt_en,
                ]);

                // Deduct Balance from App
                (new AppBalanceService())->appBalance('piapi', 'midjourney');

                // Deduct Balance from User
                (new UserBalanceService)->deductBalance('midjourney', $midjourney->id, config('variables.midjourney-price'));


                return back()->with('alert_success', 'დავალება მიღებულია! დასრულებისას მიიღებთ სმს შეტყობინებას ');
            } else {
                // Error log and email

                dd($response->json());
            }


        } else {
            return back()->with('alert_error', 'ფოტო არ მოიძებნა');
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


        $task = Midjourney::where('status', '=', 'pending')->first();

        if ($task) {
            $response = Http::withHeaders([
                'x-api-key'  => config('apikeys.piapi'),
                'User-Agent' => 'Apidog/1.0.0 (https://apidog.com)',
            ])->get('https://api.piapi.ai/api/v1/task/'.$task->task_id);
            if ($response->successful()) {

                if ($response->json()['data']['status'] === 'completed') {

                    $created_at = Carbon::parse($response->json()['data']['meta']['created_at']);
                    $ended_at = Carbon::parse($response->json()['data']['meta']['ended_at']);
                    $duration = $created_at->diffInSeconds($ended_at);

                    $task->update([
                        'midjourney_url' => $response->json()['data']['output']['image_url'],
                        'status'         => $response->json()['data']['status'],
                        'duration'       => $duration,
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
                    $task->addMedia(public_path(auth()->user()->id.'_'.'midjourney1.jpg'))->toMediaCollection('midjourney1');
                    File::delete(public_path(auth()->user()->id.'_midjourney1.jpg'));


                    // Part 2 (top-right)
                    $part2 = clone $image;  // Clone the original image
                    $part2->crop($partWidth, $partHeight, $partWidth, 0);
                    $part2->save(public_path(auth()->user()->id.'_'.'midjourney2.jpg'));
                    $task->addMedia(public_path(auth()->user()->id.'_'.'midjourney2.jpg'))->toMediaCollection('midjourney2');
                    File::delete(public_path(auth()->user()->id.'_midjourney2.jpg'));


                    // Part 3 (bottom-left)
                    $part3 = clone $image;  // Clone the original image
                    $part3->crop($partWidth, $partHeight, 0, $partHeight);
                    $part3->save(public_path(auth()->user()->id.'_'.'midjourney3.jpg'));
                    $task->addMedia(public_path(auth()->user()->id.'_'.'midjourney3.jpg'))->toMediaCollection('midjourney3');
                    File::delete(public_path(auth()->user()->id.'_midjourney3.jpg'));

                    // Part 4 (bottom-right)
                    $part4 = clone $image;  // Clone the original image
                    $part4->crop($partWidth, $partHeight, $partWidth, $partHeight);
                    $part4->save(public_path(auth()->user()->id.'_'.'midjourney4.jpg'));
                    $task->addMedia(public_path(auth()->user()->id.'_'.'midjourney4.jpg'))->toMediaCollection('midjourney4');
                    File::delete(public_path(auth()->user()->id.'_midjourney4.jpg'));


                    // SEND SMS NOTIFICATION

                    $text1 = 'გამარჯობა';
                    $text2 = 'AI-მ დაასრულა თქვენი მოთხოვნა, გთხოვთ იხილოთ ფოტოები ლინკზე';
                    $text3 = 'https://imageai.test/midjourney';

                    $sendsms = $text1."\n\n".$text2."\n\n".$text3;

                    $url = 'https://api.ubill.dev/v1/sms/send';

                    $params = [
                        'key'      => config('apikeys.ubill'),
                        'brandID'  => 2,
                        'numbers'  => '995551507697',
                        'text'     => $sendsms,
                        'stopList' => false,
                    ];

                    $response2 = Http::get($url, $params);

                    dd($response->json());
                } else {
                    return $response->json()['data']['status'];
                }
            }
        }
    }

    public function download(Request $request)
    {
        $midjourney = Midjourney::where('id', $request->id)->with('media')->first();
        $media      = $midjourney->media[$request->index];
        $filePath   = $media->getPath();

        return response()->download($filePath, $media->file_name);
    }

}

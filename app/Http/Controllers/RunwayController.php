<?php

namespace App\Http\Controllers;


use App\Models\Flux;
use App\Models\Midjourney;
use App\Models\Removebg;
use App\Models\Runway;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RunwayController extends Controller
{
    public function index()
    {
        $runway = Runway::whereDate('created_at', Carbon::today())
            ->with('media')
            ->get();

        $runway2 = Runway::with('media')
            ->take(30)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('user.pages.runway', compact('runway', 'runway2'));
    }

    public function manualrunway()
    {
        return view('runwaytest');
    }

    public function create(Request $request)
    {

//        dd($request->all());

        $key = config('apikeys.falAI');



        $runway           = new Runway();
        $runway->user_id  = 1;
        $runway->prompt   = $request->prompt;
        $runway->duration = $request->duration;
        $runway->ratio    = $request->ratio;
        $runway->save();

        if($request->hasFile('runwayUpload')){
            $runway->addMediaFromRequest('runwayUpload')->toMediaCollection('runway_image');
            $media = $runway->media()->first();
            $url   = $media->getUrl();
        }

        if($request->has('imageUrl')){
            $url = $request->imageUrl;
        }



        if ($url !== null) {
//            dd($url);

            $payload = [
                'image_url' => $url,
                'prompt'    => $runway->prompt,
                'duration'  => $runway->duration,
                'ratio'     => $runway->ratio,
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Key '.$key,
                'Content-Type'  => 'application/json',
            ])->post('https://queue.fal.run/fal-ai/runway-gen3/turbo/image-to-video?fal_webhook=https://local.ews.ge/api/runway/webhook',
                $payload);

            if ($response->successful()) {

                $runway->task_id = $response->json()['request_id'];
                $runway->save();

                return back()->with('alert_success', 'დავალება მიღებულია! დასრულებისას მიიღებთ სმს შეტყობინებას ');

            }

            //  if error send email and log

        }
    }

    public function webhook(Request $request)

    {

        Log::channel('webhook')->info('Webhook received', [
            'response' => $request->all(),
        ]);



        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        if ($data['status'] === 'OK') {

            $runway            = Runway::where('task_id', $data['request_id'])->first();
            $runway->video_url = $data['payload']['video']['url'];
            $runway->save();
            // delete Photo if provided by upload
            $runway->media->first()->delete();




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


            // IF errpor send email and log




        } else {
            $runway         = Runway::where('task_id', $data['request_id'])->first();
            $runway->status = $data['status'];
            $runway->error  = $data['error'];
            $runway->save();
            // Send email error too
        }


        return response('webhook received', 200);
    }


    public function galleryHtmx(Request $request)
    {


        if($request->model === 'midjourney'){

            $midjourneys = Midjourney::where('status', '=', 'completed')
                ->with('media')
                ->take(30)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('user.htmx.gallery-for-runway', compact('midjourneys'));
        }

        if($request->model === 'flux'){

            $fluxes =Flux::where('model', 'flux-schnell')
                ->where('image_url', '!=', null)
                ->with('media')
                ->take(30)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('user.htmx.gallery-for-runway', compact('fluxes'));
        }

    }
}

<?php

namespace App\Http\Controllers;


use App\Http\Requests\RunwayRequest;
use App\Mail\RunwayErrorMail;
use App\Models\Flux;
use App\Models\Midjourney;
use App\Models\Removebg;
use App\Models\Runway;
use App\Models\User;
use App\Models\UserBalance;
use App\Services\AppBalanceService;
use App\Services\TranslationService;
use App\Services\UserBalanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RunwayController extends Controller
{
    public function index()
    {
        $runway = Runway::whereDate('created_at', Carbon::today())
            ->with('media')
            ->get();

        $runway2 = Runway::with('media')
            ->take(20)
            ->orderBy('created_at', 'desc')
            ->get();

        $pending = Runway::whereNull('video_url')->first();

        return view('user.pages.runway', compact('runway', 'runway2', 'pending'));
    }

    public function create(Request $request,RunwayRequest $runwayRequest)
    {

        if($request->hasFile('runwayUpload') && $request->imageUrl!==null){
            return back()->with('alert_error','გთხოვთ აირჩოთ ერთ-ერთი, ატვირთეთ ფოტო ან აირჩიეთ არსებული გალერეიდან');
        }

        $data = $runwayRequest->validated();


        if (!(new UserBalanceService())->checkBalance('runway'.$data['duration'])) {
            return back()->with('alert_error', 'არასაკმარისი ბალანსი');
        }

        $service=new TranslationService();
        $result=$service->detectAndTranslate($data);
        $language = $result['language'];
        $translated= $result['translation'];

        $runwaydata=[
            'prompt_en'=>$translated,
            'duration'=>$data['duration'],
            'ratio'=>$data['ratio'],
            'status'=>'started',
            'provider'=>'runway',
        ];

        if ($language !== 'en') {
            $runwaydata['prompt_ka'] = $data['prompt'];
        }


//        dd($translated,$data['duration']+0,$data['ratio']);

        $runway=Runway::create($runwaydata);

//        if image was uploaded or uploaded
        if ($request->hasFile('runwayUpload')) {
            $runway->addMediaFromRequest('runwayUpload')->toMediaCollection('runway_image');

            $media = $runway->media()->first();
            $url   = $media->getUrl();
        }
        elseif ($data['imageUrl'] !== null){
            $url = $request->imageUrl;


            // Add cover photo for video
            $runway->addMediaFromUrl($url)->toMediaCollection('runway_image');
//
//            $checkurl = HTTP::timeout(60)->withoutVerifying()->get($data['imageUrl']);
//
//            if ($checkurl->successful()) {
//                $url = $data['imageUrl'];
//                $runway->addMediaFromUrl($url)->toMediaCollection('runway_image');
//            } else {
//                return back()->with('alert_error', 'ფოტო არ მოიძებნა');
//            }
        }




        if($url){
          $contentLength = strlen($url);
            $response=Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization'    => 'Bearer '.config('apikeys.runway'),
                'X-Runway-Version' => "2024-11-06"
            ])->post('https://api.dev.runwayml.com/v1/image_to_video',[
                'promptImage' =>  (string) $url,
                'model'=>'gen3a_turbo',
                'promptText'=>$translated,
                'watermark'=>false,
                'duration'=>$data['duration']+0,
                'ratio'=>$data['ratio'],
            ]);

            if ($response->successful()) {
              // upgrade status if response is successful because scheduler checks for pending and not to cause error
                $runway->status='pending';
                $runway->save();

                Log::channel('runway')->info('Runway queue request', [
                    'user ID'=>auth()->id(),
                    'response' => $response->json(),
                ]);
                $runway->update([
                    'task_id'=>$response->json()['id'],
                ]);

                return back()->with('alert_success', 'დავალება მიღებულია! დასრულებისას მიიღებთ სმს შეტყობინებას ');
            }

            if ($response->status()==429) {
                return back()->with('alert_error','დღეს Runway გადატვირთულია, შეგიძლიათ სცადოთ მომდევნო დღეს');
            } else{

                $random=random_int(10000,99999);
                Log::channel('runway')->info('Runway api failed on create error '.$random, [
                    'user ID'=>auth()->id(),
                    'response' => $response->json(),
                ]);

                 // Delete initial runway if api failed
                if ($runway->media) {
                    foreach ($runway->media as $media) {
                        $media->delete();
                    }
                }
                $runway->delete();
                Mail::to(config('devmail.devmail'))->send(new RunwayErrorMail($random,$runway->user->first(), $response->json()));

                return back()->with('alert_error', 'ბოდიშს გიხდით, დაფიქსირდა ტექნიკური შეცდომა');
            }
        }
    }

    public function delete(Request $request)
    {


        $runway = Runway::find($request->id);

        if ($runway) {
            $userBalance = UserBalance::where('runway_id', $runway->id)->first();

            if ($userBalance) {
                $userBalance->runway_id = null;
                $userBalance->save();
            }

            if ($runway->media) {
                foreach ($runway->media as $media) {
                    $media->delete();
                }
            }
            $runway->delete();

            return back()->with('alert_success', 'ვიდეო წარმატებით წაიშალა');
        }

        return back()->with('alert_error', 'ვიდეო არ მოიძებნა');
    }

    public function download(Request $request) {

        $runway = Runway::find($request->id);

        if ($runway && $runway->video_url) {
            $random = random_int(100000, 900000);
            $url = $runway->video_url;
            $fileName = 'runway'.'_'.$random.'.mp4';

            return response()->streamDownload(function () use ($url) {
                echo Http::get($url)->body();
            }, $fileName);
        }

        return back()->with('alert_error', 'ვიდეო არ მოიძებნა');
    }

    public function webhook(Request $request)
    {


        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        if ($data['status'] === 'OK') {
            $runway            = Runway::withoutGlobalScopes()->where('task_id', $data['request_id'])->first();
            $runway->video_url = $data['payload']['video']['url'];
            $runway->save();

            Log::channel('runway')->info('Runway webhook success-  '.$data['request_id'], [
                'response' => $request->all(),
            ]);

            // Deduct Balance from App
            (new AppBalanceService())->appBalance('falai', 'runway'.$runway->duration);

            // Deduct Balance from User
            (new UserBalanceService)->deductBalance('runway', $runway->id, config('variables.runway'.$runway->duration.'-price'));

            // SEND SMS NOTIFICATION
            $text1 = 'გამარჯობა';
            $text2 = 'AI-მ დაასრულა თქვენი მოთხოვნა, გთხოვთ იხილოთ ფოტოები ლინკზე';
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

        } else {

            $runway            = Runway::withoutGlobalScopes()->where('task_id', $data['request_id'])->first();

            Log::channel('runway')->info('Runway webhook error-  '.$data['request_id'], [
                'response' => $request->all(),
            ]);

            Mail::to(config('devmail.devmail'))->send(new RunwayErrorMail($data['request_id'],$runway->user->first(),$request->json()));

            // SEND SMS NOTIFICATION to user
            $text1 = 'სამწუხაროდ Runway-მ ვერ დაამუშავა თქვენი მოთხოვნა';
            $text2 = 'ბალანსიდან საფასური არ ჩამოგეჭრებათ';
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

            if ($runway->media) {
                foreach ($runway->media as $media) {
                    $media->delete();
                }
            }
            $runway->delete();
        }

        return response('webhook received', 200);
    }

    public function galleryHtmx(Request $request, $perpage = 10)
    {


//        dd($request->model === 'flux');
        $validated = $request->validate([
            'page' => 'numeric',
        ]);



        $page     = $request->page;
        $data     = '';


        if ($request->model === 'midjourney') {
            $midjourneys = Midjourney::where('status', '=', 'completed')
                ->with('media')
                ->orderBy('created_at', 'desc')
                ->paginate(10)->appends($request->query());

            $data=$midjourneys;


            return view('user.htmx.gallery-for-runway', compact('midjourneys','data'));
        }

        if ($request->model === 'flux') {
            $fluxes = Flux::where('model', 'flux-schnell')
                ->where('image_url', '!=', null)
                ->with('media')
                ->orderBy('created_at', 'desc')
                ->paginate(10)->appends($request->query());

            $data=$fluxes;

            return view('user.htmx.gallery-for-runway', compact('fluxes','data'));
        }

        $error='გალერეა არ მოიძებნა';
        return view('user.htmx.error-htmx',compact('error'));

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Flux;
use App\Models\Language;
use App\Models\UserBalance;
use App\Services\AppBalanceService;
use App\Services\UserBalanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class FluxController extends Controller
{

    public function index(Request $request)
    {
        $flux = Flux::where('model', 'flux-schnell')
            ->whereDate('created_at', Carbon::today())
            ->with('media')
            ->get();


        $flux2 = Flux::where('model', 'flux-schnell')
            ->with('media')
            ->select('id','public')
            ->take(30)
            ->orderBy('created_at', 'desc')
            ->get();

        $languages=Language::all();

//        dd($flux[0]);

        return view('user.pages.image-fluxShnell', compact('flux', 'flux2'));
    }

    public function schnellGenerate(Request $request)
    {

        if (!(new UserBalanceService())->checkBalance('flux-schnell')) {

            return back()->with('alert_error', 'არასაკმარისი ბალანსი');
        }


        $prompt = $request->prompt;
        $ratio  = $request->input('ratio', '4:3');

        switch ($ratio) {
            case '16:9':
                $width  = 1024; // or any preferred width
                $height = 576; // calculates height based on width and ratio
                break;

            case '9:16':
                $height = 1024; // or any preferred height
                $width  = 576; // calculates width based on height and ratio
                break;

            case '4:3':
                $width  = 1024; // or any preferred width
                $height = 768; // calculates height based on width and ratio
                break;

            case '3:4':
                $height = 1024; // or any preferred height
                $width  = 768; // calculates width based on height and ratio
                break;

            case 'HD':
                $height = 1024; // or any preferred height
                $width  = 1024; // calculates width based on height and ratio
                break;

            default:
                // Optional: handle unknown ratio cases
                $width  = 1024; // default width
                $height = 768; // default to '16:9' ratio if unknown ratio is provided
                break;
        }


        $payload = [
            'prompt'     => $prompt,
            'ratio'      => $ratio,
            'image_size' => [
                'width'  => $width,
                'height' => $height,
            ],
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Key '.config('apikeys.falAI'),
            'Content-Type'  => 'application/json',
        ])->post('https://fal.run/fal-ai/flux/schnell',
            $payload);

        if ($response->successful()) {
            $data=$response->json();

            $flux            = new Flux();
            $flux->model     = 'flux-schnell';
            $flux->prompt_en = $prompt;

            $flux->save();

            $flux->image_url = $data['images'][0]['url'];
            $flux->save();

            $imageContents = Http::get($data['images'][0]['url'])->body();
            Storage::disk('public')->put('test.png', $imageContents);
            $fullPath = storage_path('app/public/test.png');

            $manager = new ImageManager(new Driver());
            $image   = $manager->read($fullPath);
            $encoded = $image->toJpeg();
            Storage::disk('public')->delete('test.png');
            $random = random_int(10000, 99999);
            Storage::disk('public')->put(auth()->id().'_'.'flux-schnell'.$random.'.jpeg', $encoded);
            $flux->addMedia(storage_path('app/public/'.auth()->id().'_'.'flux-schnell'.$random.'.jpeg'))->toMediaCollection('flux-schnell');
            Storage::disk('public')->delete(auth()->id().'_'.'flux-schnell'.$random.'.jpeg');



            // Deduct Balance from App
            (new AppBalanceService())->appBalance('falai', 'flux-schnell');

            // Deduct Balance from User
            (new UserBalanceService)->deductBalance('flux', $flux->id, config('variables.flux-schnell-price'));


            return back();
        }

          // Error log

        Log::channel('ai_errors')->info('flux-shcnell', [
            'response' => $request->all(),
        ]);

        return back()->with('alert_error', 'ბოდიშს გიხდით, დაფიქსირდა ტექნიკური ხარვეზი');


    }

    public function schnellsave(Request $request)
    {
        $flux = Flux::where('prompt_en', $request->prompt)
            ->where('image_url', null)
            ->first();

        $flux->image_url = $request->url;
        $flux->save();

        $imageContents = Http::get($request->url)->body();
        Storage::disk('public')->put('test.png', $imageContents);
        $fullPath = storage_path('app/public/test.png');

        $manager = new ImageManager(new Driver());
        $image   = $manager->read($fullPath);
        $encoded = $image->toJpeg();
        Storage::disk('public')->delete('test.png');

        Storage::disk('public')->put(auth()->id().'_'.'flux-schnell'.'.jpeg', $encoded);
        $flux->addMedia(storage_path('app/public/'.auth()->id().'_'.'flux-schnell'.'.jpeg'))->toMediaCollection('flux-schnell');
        Storage::disk('public')->delete(auth()->id().'_'.'flux-schnell'.'.jpeg');


        return back();
    }

    public function schnelldelete(Request $request, Flux $flux)
    {
        if ($request->has('id')) {
            $flux1 = Flux::where('id', $request->id)->first();
            if ($flux1->media) {
                $flux1->media->each(function ($media) {
                    $media->delete();
                });
            }
            $userBalance = UserBalance::where('flux_id', $flux1->id)->first();
            if ($userBalance) {
                $userBalance->flux_id = null;
                $userBalance->save();
            }
            $flux1->delete();
            return back()->with('alert_success', 'ფოტო წარმატებით წაიშალა');
        }

        if ($flux) {
            if ($flux->media) {
                $flux->media->each(function ($media) {
                    $media->delete();
                });
            }
            $userBalance = UserBalance::where('flux_id', $flux->id)->first();
            if ($userBalance) {
                $userBalance->flux_id = null;
                $userBalance->save();
            }
            $flux->delete();
            return back()->with('alert_success', 'ფოტო წარმატებით წაიშალა');
        }

        return back()->with('alert_error', 'ფოტო არ მოიძებნდა');
    }

    public function download(Request $request)
    {
        $flux = Flux::where('id', $request->id)->with('media')->first();

        if ($flux) {
            $media    = $flux->media[0];
            $filePath = $media->getPath();

            return response()->download($filePath, $media->file_name);
        }
    }

}

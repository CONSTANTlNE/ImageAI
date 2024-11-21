<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\BogController;
use App\Http\Controllers\FluxController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MidjourneyController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MobileVerificationController;
use App\Http\Controllers\RunwayController;
use App\Http\Controllers\SocialiteController;
use App\Jobs\NewUserNotifyAdminJob;
use App\Mail\FluxErrorMail;
use App\Mail\RunwayErrorMail;
use App\Models\Balance;
use App\Models\Midjourney;
use App\Models\Runway;
use App\Models\User;
use App\Models\UserBalance;
use App\Services\AppBalanceService;
use App\Services\UserBalanceService;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\WebM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


Route:: get('/{locale?}', function () {
    return view('index');
})->middleware('localization')
    ->name('index');


//ADMIN ROUTES
Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware(['localization','auth'])
    ->group(function () {

        Route::get('/admin/main',[LocalizationController::class, 'adminMain'])->name('admin.main');
        Route::get('/admin/languages', [LocalizationController::class, 'languages'])->name('languages');
        Route::post('/admin/languages/position/change', [LocalizationController::class, 'changePosition'])->name('changePosition');
//        Start JSON CRUD
        Route::get('/admin/static/translation/add',
            [LocalizationController::class, 'addTranslation'])->name('addStaticTranslation');
        Route::post('/admin/static/translation/store',
            [LocalizationController::class, 'storeStaticTranslations'])->name('storeStaticTranslations');
        Route::post('/admin/static/translation/update',
            [LocalizationController::class, 'updateStaticTranslation'])->name('updateStaticTranslation');

//        End JSON CRUD
        Route::get('/admin/testpage', [LocalizationController::class, 'testPage'])->name('testPage');
        Route::post('/admin/language/store', [LocalizationController::class, 'createLanguage'])->name('createLanguage');
        Route::post('/admin/language/status/update',
            [LocalizationController::class, 'updateLangStatus'])->name('updateLangStatus');
        Route::post('/admin/language/delete', [LocalizationController::class, 'deleteLanguage'])->name('deleteLanguage');
        Route::post('/admin/language/main/update', [LocalizationController::class, 'setMainLang'])->name('setMainLang');


    });



//Mobile Verification ROUTES
Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware(['localization', 'auth'])
    ->group(callback: function () {
        Route::get('/mobile', [MobileVerificationController::class, 'index'])->name('verify.mobile.index');
        Route::post('/mobile/save', [MobileVerificationController::class, 'storeMobile'])->name('verify.mobile.store');
        Route::post('/mobile/resend/code', [MobileVerificationController::class, 'codeResend'])->name('verify.mobile.resend');
        Route::post('/mobile/verify', [MobileVerificationController::class, 'verify'])->name('verify.mobile');
        Route::post('/mobile/change', [MobileVerificationController::class, 'changeMobile'])->name('verify.mobile.change');

    });

//USER ROUTES
Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware(['localization', 'auth','verified'])
    ->group(function () {

        //  Midjourney Routes
        Route::get('/midjourney', [MidjourneyController::class, 'index'])->name('midjourney');
        Route::post('/midjourney/create', [MidjourneyController::class, 'imagine'])->name('midjourney.create');
        Route::post('/midjourney/variation', [MidjourneyController::class, 'variation'])->name('midjourney.variation');
        Route::get('/midjourney/fetch', [MidjourneyController::class, 'fetch'])->name('midjourney.fetch');
        Route::post('/midjourney/delete}',
            [MidjourneyController::class, 'delete'])->name('midjourney.delete');
        Route::post('/image/create/htmx', [MidjourneyController::class, 'createHtmx'])->name('midjourney.create.htmx');
        Route::get('/midjourney/download', [MidjourneyController::class, 'download'])->name('midjourney.download');

        // Remove background routes
        Route::get('/remove-bg', [AiController::class, 'removeBGindex'])->name('bg.remove');
        Route::post('/remove-bg/create', [AiController::class, 'removeBG'])->name('remove');
        Route::get('/remove-bg/download/{id?}', [AiController::class, 'downloadBG'])->name('bg.download');
        Route::post('/remove-bg/delete/{removebg?}', [AiController::class, 'delete'])->name('bg.delete');
        Route::get('/remove-bg/gallery', [AiController::class, 'galleryBG'])->name('bg.gallery');

        // Add background image
        Route::get('/add-bg', [AiController::class, 'addBGindex'])->name('bg.add');
        Route::post('/add-bg/save', [AiController::class, 'addBGstore'])->name('bg.save');
        Route::post('/add-bg/delete/{addbg}', [AiController::class, 'addBGdelete'])->name('bg.delete2');
        Route::get('/add-bg/download/{id}', [AiController::class, 'addBGdownload'])->name('bg.download2');

        // add background color
        Route::get('/add-bg/color/{removebg}', [AiController::class, 'addBGcolorindex'])->name('bg.add.color');
        Route::get('/add-bg/color/', [AiController::class, 'addBGcolorindex'])->name('bg.add.color2');

        // Flux Routes
        Route::get('/flux-schnell', [FluxController::class, 'index'])->name('flux-schnell');
        Route::post('/flux-schnell/prompt', [FluxController::class, 'schnellGenerate'])->name('flux-schnell.prompt');
        Route::post('/flux-schnell/delete/{flux?}',
            [FluxController::class, 'schnelldelete'])->name('flux-schnell.delete');
        Route::get('/flux-schnell/download', [FluxController::class, 'download'])->name('flux.download');

        // Runway Routes
        Route::get('/runway', [RunwayController::class, 'index'])->name('runway');
        Route::post('runway/queue', [RunwayController::class, 'create'])->name('runway.queue');
        Route::post('runway/delete', [RunwayController::class, 'delete'])->name('runway.delete');
        Route::get('runway/download', [RunwayController::class, 'download'])->name('runway.download');
        Route::get('/runway/htmx', [RunwayController::class, 'galleryHtmx'])->name('runway.gallery.htmx');

        // Resize images
        Route::get('resize', [AiController::class, 'resizeIndex'])->name('resize.index');

        // Gallery
        Route::get('/gallery/{model}', [MainController::class, 'gallery'])->name('gallery');

        // User Balance
        Route::post('/balance/check/htmx', [MainController::class, 'checkUserBalance'])->name('userbalance.check');
        Route::get('/balance/history', [MainController::class, 'checkUserBalanceHistory'])->name('userbalance.history');

        // Bog-Purchase
        Route::get('/bog/auth',[BogController::class,'bogAuth'])->name('bog.auth.htmx');
        Route::post('/bog/payment/request',[BogController::class,'sendPaymentRequest'])->name('bog.payment.request');


        // ==================== some random tests and playground ====================

        // Intervention - webp conversion
        Route::get('encode', function () {
            $imagePath = storage_path('app/public/tmp_image_1728062379.png');


            if (!file_exists($imagePath)) {
                return "File not found: ".$imagePath;
            }
            $manager = new ImageManager(new Driver());

            $image = $manager->read(storage_path('app/public/tmp_image_1728062379.png'));

            $encoded = $image->toWebp(60);

            Storage::disk('public')->put('test.webp', $encoded);
        });

        // test
        Route::get('/taskid', function () {
            $runway = Runway::where('task_id', '6043f181-54be-4071-a96c-ff0b8cc87970')->first();

            return $runway;
        });


        Route::get('userbalanceman', function () {
            $balance          = new \App\Models\UserBalance();
            $balance->balance = 1;
            $balance->save();

//
//    $rate=Balance::where('provider', 'FALAI')
//        ->whereNotNull('rate')
//        ->orderby('created_at', 'desc')
//        ->first();
//    return $rate->rate;

        });
    });


// Socialite GOOGLE

Route::get('auth/google/redirect', [SocialiteController::class, 'googleredirect'])->name('google.login');
Route::get('auth/google/callback', [SocialiteController::class, 'googlecallback']);
Route::get('auth/facebook/redirect', [SocialiteController::class, 'facebookedirect'])->name('facebook.login');
Route::get('auth/facebook/callback', [SocialiteController::class, 'facebookcallback']);




// ==================TESTING ROUTES=========================



Route::get('/{locale}/bogtest',function(){
// Save the balance without applying the global scopes
    UserBalance::withoutGlobalScopes()->create([
        'user_id' => 1,
        'balance' => 1,
        'model'=>'fill'
    ]);
});


Route::get('/{locale}/temp',function(){
    $tmp_dir = ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir();
    die($tmp_dir);
});

Route::get('token', function () {
    $user = auth()->user();
//    1|BsSD6oVb8wPqXjdApw4rjjbaAyFUr5aNnos7oiMG76a5d164
//    return $user->createToken('token')->plainTextToken;

    return auth()->user()->tokens;
});


Route::get('/manual', function () {
    auth()->logout();
});

Route::get('manualbalance', function () {
//    $balance           = new Balance;
//    $balance->balance  = 7.38;
//    $balance->provider = 'falai';
//    $balance->rate     = 2.805;
//    $balance->save();

//    $balance           = new Balance;
//    $balance->balance  = 5.89;
//    $balance->provider = 'midjourney';
//    $balance->rate     = 2.805;
//    $balance->save();

    $balance           = new Balance;
    $balance->balance  = 13.53;
    $balance->provider = 'edenai';
    $balance->rate     = 2.805;
    $balance->save();

//
//    $rate=Balance::where('provider', 'FALAI')
//        ->whereNotNull('rate')
//        ->orderby('created_at', 'desc')
//        ->first();
//    return $rate->rate;

});


//  ffmpeg

Route::get('convert', function () {
    $videoPath = public_path('videos/2.mp4');
    WebmConversion::dispatch($videoPath);  // Pass the path, not the video object

    return 'Job dispatched';
});

route::get('video', function () {
    $video = asset('export-webm.webm');

    return view('video', compact('video'));
});

Route::post('queue', function () {
    // JUST QUEUE

//    $key      = config('apikeys.falAI');
//    $response=Http::withHeaders(['Authorization'=> 'Key '. $key  ])->post('https://queue.fal.run/fal-ai/flux/schnell', [
//
//        'prompt' => 'A bunny eating a carrot in the field.',
//    ]);


//        $key      = config('apikeys.falAI');
//    $response=Http::withHeaders(['Authorization'=> 'Key '. $key  ])->post('https://queue.fal.run/fal-ai/flux/schnell?fal_webhook=https://local.ews.ge/api/runway/webhook', [
//        'prompt' => 'dog wearing a sunglasses chillin on the sandy beach',
//    ]);


    $key      = config('apikeys.falAI');
    $response = Http::withHeaders(['Authorization' => 'Key '.$key])->post('https://queue.fal.run/fal-ai/runway-gen3/turbo/image-to-video?fal_webhook=https://local.ews.ge/api/runway/webhook',
        [
            'prompt' => 'dog wearing a sunglasses chillin on the sandy beach',
        ]);


    return $response->json();
})->name('queue');

Route::get('manualfetch', function () {
    $key      = config('apikeys.falAI');
    $response = Http::withHeaders(['Authorization' => 'Key '.$key])->get('https://queue.fal.run/fal-ai/runway-gen3/turbo/image-to-video/requests/bf92505f-a7dc-42f4-93fd-edb06079cff4');

//    bf92505f-a7dc-42f4-93fd-edb06079cff4
    return $response->json();
})->name('manualfetch');





// RESIZE IMAGES WITH INTERVENTION
Route::get('{locale}/resizetest', function (Request $request) {

    return view('resize');
});

Route::post('/resize2', function (Request $request) {
    $uploadedFile = $request->file('file');

    $manager = new ImageManager(new Driver());
    $image   = $manager->read($uploadedFile);

    $image->resize($request->width, $request->height);

// resize only image height to 200 pixel
//    $image->resize(height: 200);

    $resizedPath = $request->width.'x'.$request->height.'.'.$uploadedFile->getClientOriginalExtension();
    Storage::disk('public')->put($resizedPath, (string) $image->encode());

    // Return the resized image as a download
    return response()->download(storage_path('app/public/'.$resizedPath))->deleteFileAfterSend(true);
})->name('resize2');


Route::post('/convert', function (Request $request) {
    $uploadedFile = $request->file('file');

    $manager = new ImageManager(new Driver());
    $image   = $manager->read($uploadedFile);

    $encoded = $image->toPng();

// resize only image height to 200 pixel
//    $image->resize(height: 200);

    $resizedPath = 'png'.'.'.'png';
    Storage::disk('public')->put($resizedPath, (string) $encoded);

    // Return the resized image as a download
    return response()->download(storage_path('app/public/'.$resizedPath))->deleteFileAfterSend(true);
})->name('convert');



// GOOGLE TRANSLATE

Route::get('{locale}/detect', function () {

    $token    = config('apikeys.google');
    $response = Http::post('https://translation.googleapis.com/language/translate/v2/detect?key='.$token, [
        'q' => 'გამარჯობა',
    ]);
    $data=$response->json();
    return $data['data']['detections'][0][0]['language'];

});

Route::get('{locale}/translate', function () {

    $token    = config('apikeys.google');
    $response = Http::post('https://translation.googleapis.com/language/translate/v2?key='.$token, [
        'q'      => 'ძაღლლის მზის სათვალეებში პლიაჟზე',
        'target' => 'en',
    ]);
    $data=$response->json();
    return $data['data']['translations'][0]['translatedText'];

});

Route::get('/{locale}/task',function (){
    $task = Midjourney::withoutGlobalScopes()->where('status', '=', 'pending')->first();
dd($task);
});



Route::get('{locale}/jobtest', function () {

    NewUserNotifyAdminJob::dispatch(User::first()); // Use a sample user

});





//PIAPI KLING TEST

Route::get('{locale}/klingtest', function () {

    // 163aaf75-354f-4b7c-a4f6-5a671053c4f4

    $response=Http::withHeaders([
        'Content-Type' => 'application/json',
        'User-Agent'   => 'Apidog/1.0.0 (https://apidog.com)',
        'x-api-key'    => config('apikeys.piapi'),
    ])->post('https://api.piapi.ai/api/v1/task', [
        'model'=> 'kling',
        'task_type'=> 'video_generation',
        'input'=> [
            'prompt' => 'ninja kittens fighting',
            'duration'=> 5,
            'aspect_ratio'=> '16:9',
            'mode'=>'std',
            'version' => '1.0',
            'image_url'=>'https://local.ews.ge/storage/148/1_flux-schnell13562.jpeg',
        ],
    ]);


    return $response->json();

});



Route::get('{locale}/klingfetch', function () {

    $response=Http::withHeaders([
        'x-api-key'    => config('apikeys.piapi'),
    ])->get('https://api.piapi.ai/api/v1/task/84023b83-f5e6-4bd8-ab7f-af8b02a7214a');

    return $response->json();
});

Route::get('{locale}/klingcancel', function () {

    $response=Http::withHeaders([
        'x-api-key'    => config('apikeys.piapi'),
    ])->delete('https://api.piapi.ai/api/v1/task/03b377fb-2de5-457c-b6ba-cca2a44c3b20');

    return $response->json();
});


// RUNWAY TEST

Route::get('{locale}/runwaytest', function () {


    $response=Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization'    => 'Bearer '.config('apikeys.runway'),
        'X-Runway-Version' => "2024-11-06"
    ])->post('https://api.dev.runwayml.com/v1/image_to_video',[
        'promptImage' => 'https://i.ibb.co/Gp0mt90/1-flux-schnell56099.jpg',
        'model'=>'gen3a_turbo',
        'promptText'=>'girl drinking beer till the end',
        'watermark'=>false,
        'duration'=>5,
        'ratio'=>'1280:768'
    ]);


    if ($response->successful()) {
        $runway=Runway::create(
            [
                'task_id'=>$response->json()['id'],
                'prompt_en'=>'girl drinking beer till the end',
                'duration'=>5,
                'ratio'=>'1280:768',
                'status'=>'pending',
                'provider'=>'runway',
            ]
        );
    }

        return $response->json();

});

Route::get('{locale}/runwayfetch', function () {

    $runway = Runway::withoutGlobalScopes()->where('status', '=', 'pending')->with('user')->first();

    if ($runway) {

        $response=Http::withHeaders([
            'Authorization'    => 'Bearer '.config('apikeys.runway'),
            'X-Runway-Version' => "2024-11-06"
        ])->get('https://api.dev.runwayml.com/v1/tasks/70e4ae50-89fd-4d72-9f16-07bfa85c6508');

        if ($response->successful()) {
//                Log::channel('midjourney')->info('api call is successful');

            if ($response->json()['status'] === 'SUCCEEDED') {

                Log::channel('runway')->info('Runway webhook success-  '.$runway->task_id, [
                    'response' => $response->json(),
                ]);


                $user = $runway->user->first();

                $runway->video_url = $response->json()['output']['0'];
                $runway->status = 'completed';
                $runway->save();

                $videourl= Http::get($response->json()['output']['0'])->body();
                $random = random_int(10000, 99999);
                $videourl->save(public_path($user->id.'_'.$random.'_runway.mp4'));
                $runway->addMedia(public_path($user->id.'_'.$random.'_runway.mp4'))->toMediaCollection('runway_videos');
                File::delete(public_path($user->id.'_'.$random.'_runway.mp4'));

                // SEND SMS NOTIFICATION

                $text1 = 'გამარჯობა';
                $text2 = 'Midjourney -მ დაასრულა თქვენი მოთხოვნა, გთხოვთ იხილოთ ფოტოები ლინკზე';
                $text3 = 'https://imageai.test/midjourney';

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
            }



            // Deduct Balance from App
            (new AppBalanceService())->appBalance('runway', 'runway'.$runway->duration);

            // Deduct Balance from User
            (new UserBalanceService)->deductBalance('runway', $runway->id, config('variables.runway'.$runway->duration.'-price'));

        }else {

            Log::channel('runway')->info('Runway webhook success-  '.$runway->task_id, [
                'response' => $response->json(),
            ]);

            Mail::to('gmta.constantine@gmail.com')->send(new RunwayErrorMail($runway->task_id,$runway->user->first(),$response->json()));
        }
    }




});


Route::get('/{locale}/image',function(){



});


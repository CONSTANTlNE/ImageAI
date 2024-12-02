<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\BogController;
use App\Http\Controllers\ColorizationController;
use App\Http\Controllers\FluxController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MidjourneyController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MobileVerificationController;
use App\Http\Controllers\RunwayController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\UserController;
use App\Jobs\NewUserNotifyAdminJob;
use App\Mail\FluxErrorMail;
use App\Mail\RunwayErrorMail;
use App\Models\Balance;
use App\Models\Flux;
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


Route::prefix('{locale?}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware(['localization'])
    ->group(function () {
        Route::controller(LandingController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/terms', 'terms')->name('terms');
            Route::get('/public/gallery', 'gallery')->name('landing.gallery');
            Route::get('/public/gallery/{model}', 'galleryModel')->name('landing.gallery.model');
        });
    });


//ADMIN ROUTES
Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware(['localization', 'auth', 'admin'])
    ->controller(LocalizationController::class)
    ->group(function () {
        Route::get('/admin/main', 'adminMain')->name('admin.main');
        Route::get('/admin/languages', 'languages')->name('languages');
        Route::post('/admin/languages/position/change', 'changePosition')->name('changePosition');
//        Start JSON CRUD
        Route::get('/admin/static/translation/add', 'addTranslation')->name('addStaticTranslation');
        Route::post('/admin/static/translation/store', 'storeStaticTranslations')->name('storeStaticTranslations');
        Route::post('/admin/static/translation/update', 'updateStaticTranslation')->name('updateStaticTranslation');
//        End JSON CRUD
        Route::get('/admin/testpage', 'testPage')->name('testPage');
        Route::post('/admin/language/store', 'createLanguage')->name('createLanguage');
        Route::post('/admin/language/status/update', 'updateLangStatus')->name('updateLangStatus');
        Route::post('/admin/language/delete', 'deleteLanguage')->name('deleteLanguage');
        Route::post('/admin/language/main/update', 'setMainLang')->name('setMainLang');
    });


//Mobile Verification ROUTES
Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware(['localization', 'auth'])
    ->controller(MobileVerificationController::class)
    ->group(callback: function () {
        Route::get('/mobile', 'index')->name('verify.mobile.index');
        Route::post('/mobile/save', 'storeMobile')->name('verify.mobile.store');
        Route::post('/mobile/resend/code', 'codeResend')->name('verify.mobile.resend');
        Route::post('/mobile/verify', 'verify')->name('verify.mobile');
        Route::post('/mobile/change', 'changeMobile')->name('verify.mobile.change');
    });


//App ROUTES
Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware(['localization', 'auth', 'verified'])
    ->group(function () {
        //  Midjourney Routes
        Route::controller(MidjourneyController::class)->group(function () {
            Route::get('/midjourney', 'index')->name('midjourney');
            Route::post('/midjourney/create', 'imagine')->name('midjourney.create');
            Route::post('/midjourney/variation', 'variation')->name('midjourney.variation');
            Route::get('/midjourney/fetch', 'fetch')->name('midjourney.fetch');
            Route::post('/midjourney/delete}', 'delete')->name('midjourney.delete');
            Route::get('/midjourney/download', 'download')->name('midjourney.download');
            Route::post('/midjourney/make/public', 'makePublic')->name('midjourney.make.public');
        });

        // Remove background routes
        Route::controller(AiController::class)->group(function () {
            Route::get('/remove-bg', 'removeBGindex')->name('bg.remove');
            Route::post('/remove-bg/create', 'removeBGcreate')->name('remove');
            Route::get('/remove-bg/download/{id?}', 'downloadBG')->name('bg.download');
            Route::post('/remove-bg/delete/{removebg?}', 'delete')->name('bg.delete');
            Route::get('/remove-bg/gallery', 'galleryBG')->name('bg.gallery');


            // Add background image Not Used
            Route::get('/add-bg', 'addBGindex')->name('bg.add');
            Route::post('/add-bg/save', 'addBGstore')->name('bg.save');
            Route::post('/add-bg/delete/{addbg}', 'addBGdelete')->name('bg.delete2');
            Route::get('/add-bg/download/{id}', 'addBGdownload')->name('bg.download2');

            // add background color  Not Used
            Route::get('/add-bg/color/{removebg}', 'addBGcolorindex')->name('bg.add.color');
            Route::get('/add-bg/color/', 'addBGcolorindex')->name('bg.add.color2');

            // Resize images  Not Used
            Route::get('resize', 'resizeIndex')->name('resize.index');
        });

        // Flux Routes
        Route::controller(FluxController::class)->group(function () {
            Route::get('/flux-schnell', 'index')->name('flux-schnell');
            Route::post('/flux-schnell/prompt', 'schnellGenerate')->name('flux-schnell.prompt');
            Route::post('/flux-schnell/delete/{flux?}', 'schnelldelete')->name('flux-schnell.delete');
            Route::get('/flux-schnell/download', 'download')->name('flux.download');
            Route::post('/flux-schnell/make/public', 'makePublic')->name('flux.make.public');
        });

        // Runway Routes
        Route::controller(RunwayController::class)->group(function () {
            Route::get('/runway', 'index')->name('runway');
            Route::post('runway/queue', 'create')->name('runway.queue');
            Route::post('runway/delete', 'delete')->name('runway.delete');
            Route::get('runway/download', 'download')->name('runway.download');
            // Choose From Gallery (for remove BG or Runway)
            Route::get('/gallery/htmx', 'galleryHtmx')->name('runway.gallery.htmx');
        });

        // Gallery and User Balance
        Route::controller(MainController::class)->group(function () {
            // Gallery
            Route::get('/gallery/{model}', 'gallery')->name('gallery');
            // User Balance
            Route::post('/balance/check/htmx', 'checkUserBalance')->name('userbalance.check');
            Route::get('/balance/history', 'checkUserBalanceHistory')->name('userbalance.history');
        });

        // User Credentials
        Route::controller(UserController::class)->group(function () {
            Route::post('/user/credentials/update', 'update')->name('credentials.update');
        });

        // BOG return amount request
        Route::controller(BogController::class)->group(function () {
            Route::get('/bog/auth', 'bogAuth')->name('bog.auth.htmx');
            Route::post('/bog/payment/request', 'sendPaymentRequest')->name('bog.payment.request');
            Route::get('/bog/userrequest/return/amount', 'userRequest')->name('bog.user.request');
        });

        // Colorization
        Route::controller(ColorizationController::class)->group(function () {
            Route::get('/colorization', 'index')->name('colorize.index');
            Route::post('/colorization/create','colorize')->name('colorize.create');
            Route::get('/colorization/download', 'download')->name('colorize.download');
            Route::post('/colorization/delete','delete')->name('colorize.delete');

        });

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
Route::controller(SocialiteController::class)->group(function () {
    Route::get('auth/google/redirect', 'googleredirect')->name('google.login');
    Route::get('auth/google/callback', 'googlecallback');
    Route::get('auth/facebook/redirect', 'facebookedirect')->name('facebook.login');
    Route::get('auth/facebook/callback', 'facebookcallback');
});


// =============================  TESTING ROUTES   =========================

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
    $data     = $response->json();

    return $data['data']['detections'][0][0]['language'];
});

Route::get('{locale}/translate', function () {
    $token    = config('apikeys.google');
    $response = Http::post('https://translation.googleapis.com/language/translate/v2?key='.$token, [
        'q'      => 'ძაღლლის მზის სათვალეებში პლიაჟზე',
        'target' => 'en',
    ]);
    $data     = $response->json();

    return $data['data']['translations'][0]['translatedText'];
});

Route::get('/{locale}/task', function () {
    $task = Midjourney::withoutGlobalScopes()->where('status', '=', 'pending')->first();
    dd($task);
});

Route::get('{locale}/jobtest', function () {
    NewUserNotifyAdminJob::dispatch(User::first()); // Use a sample user

});


//PIAPI KLING TEST

Route::get('{locale}/klingtest', function () {
    // 163aaf75-354f-4b7c-a4f6-5a671053c4f4

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'User-Agent'   => 'Apidog/1.0.0 (https://apidog.com)',
        'x-api-key'    => config('apikeys.piapi'),
    ])->post('https://api.piapi.ai/api/v1/task', [
        'model'     => 'kling',
        'task_type' => 'video_generation',
        'input'     => [
            'prompt'       => 'ninja kittens fighting',
            'duration'     => 5,
            'aspect_ratio' => '16:9',
            'mode'         => 'std',
            'version'      => '1.0',
            'image_url'    => 'https://local.ews.ge/storage/148/1_flux-schnell13562.jpeg',
        ],
    ]);


    return $response->json();
});

Route::get('{locale}/klingfetch', function () {
    $response = Http::withHeaders([
        'x-api-key' => config('apikeys.piapi'),
    ])->get('https://api.piapi.ai/api/v1/task/84023b83-f5e6-4bd8-ab7f-af8b02a7214a');

    return $response->json();
});

Route::get('{locale}/klingcancel', function () {
    $response = Http::withHeaders([
        'x-api-key' => config('apikeys.piapi'),
    ])->delete('https://api.piapi.ai/api/v1/task/03b377fb-2de5-457c-b6ba-cca2a44c3b20');

    return $response->json();
});


// RUNWAY TEST
Route::get('{locale}/runwaytest', function () {
    $response = Http::withHeaders([
        'Content-Type'     => 'application/json',
        'Authorization'    => 'Bearer '.config('apikeys.runway'),
        'X-Runway-Version' => "2024-11-06",
    ])->post('https://api.dev.runwayml.com/v1/image_to_video', [
        'promptImage' => 'https://i.ibb.co/Gp0mt90/1-flux-schnell56099.jpg',
        'model'       => 'gen3a_turbo',
        'promptText'  => 'girl drinking beer till the end',
        'watermark'   => false,
        'duration'    => 5,
        'ratio'       => '1280:768',
    ]);


    if ($response->successful()) {
        $runway = Runway::create(
            [
                'task_id'   => $response->json()['id'],
                'prompt_en' => 'girl drinking beer till the end',
                'duration'  => 5,
                'ratio'     => '1280:768',
                'status'    => 'pending',
                'provider'  => 'runway',
            ],
        );
    }

    return $response->json();
});

Route::get('{locale}/runwayfetch', function () {
    $runway = Runway::withoutGlobalScopes()->where('status', '=', 'pending')->with('user')->first();

    if ($runway) {
        $response = Http::withHeaders([
            'Authorization'    => 'Bearer '.config('apikeys.runway'),
            'X-Runway-Version' => "2024-11-06",
        ])->get('https://api.dev.runwayml.com/v1/tasks/70e4ae50-89fd-4d72-9f16-07bfa85c6508');

        if ($response->successful()) {
//                Log::channel('midjourney')->info('api call is successful');

            if ($response->json()['status'] === 'SUCCEEDED') {
                Log::channel('runway')->info('Runway webhook success-  '.$runway->task_id, [
                    'response' => $response->json(),
                ]);


                $user = $runway->user->first();

                $runway->video_url = $response->json()['output']['0'];
                $runway->status    = 'completed';
                $runway->save();

                $videourl = Http::get($response->json()['output']['0'])->body();
                $random   = random_int(10000, 99999);
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
            (new UserBalanceService)->deductBalance('runway', $runway->id,
                config('variables.runway'.$runway->duration.'-price'));
        } else {
            Log::channel('runway')->info('Runway webhook success-  '.$runway->task_id, [
                'response' => $response->json(),
            ]);

            Mail::to('gmta.constantine@gmail.com')->send(new RunwayErrorMail($runway->task_id, $runway->user->first(),
                $response->json()));
        }
    }
});

Route::get('/{locale}/image', function () {});


// Route Error Pages

Route::get('{locale}/error', function () {
    return view('errors.500');
});

// NBG
Route::get('{locale}/nbg', function () {
    $response = HTTP::get('https://nbg.gov.ge/gw/api/ct/monetarypolicy/currencies/ka/json');

    return $response->json();
});


// BOG return amount back
Route::get('{locale}/bogreturn', function () {
    $order_id = '36ae1a6a-3885-4859-be55-47cec3fbdea6';
    $amount   = 0.05;
    $response = (new \App\Services\BogService())->Refund($order_id, $amount);

    if (isset($response['key']) && $response['key'] === 'request_received') {
        Log::channel('bog_refund_request')->info('Refund Success'.' '.'user: '.auth()->user()->id.' '.auth()->user()->email,
            ['Details' => $response]);
    } else {
        Log::channel('bog_refund_request')->info('Refund Error'.' '.'user: '.auth()->user()->id.' '.auth()->user()->email,
            ['Details' => $response]);
    }


    return $response;
});

// BOG return amount back
Route::get('{locale}/media', function () {
    $flux = Flux::with('media')
        ->whereHas('media', function ($query) {
            $query->where('public', 1); // Replace 'your_column_name' with the actual column name
        })
        ->get();
});

// Colorization API

Route::get('{locale}/colorizationn', function () {
    return view('colorization');
});



Route::post('{locale}/colorization/colorize', function (Request $request) {

    $file = $request->file('image');

    $response = Http::withHeaders([
        'x-rapidapi-host' => 'colorize-photo1.p.rapidapi.com',
        'x-rapidapi-key'  => config('apikeys.pallete'),
    ])
        ->asMultipart()
        ->post('https://colorize-photo1.p.rapidapi.com/colorize_image_with_auto_prompt', [
            [
                'name'     => 'image',  // Field name in the API
                'contents' => fopen($file->getRealPath(), 'r'),  // Open the file
                'filename' => $file->getClientOriginalName(),  // Original file name
            ],
            [
                'name'     => 'temperature',
                'contents' => '-0.1',
            ],
            [
                'name'     => 'raw_captions',
                'contents' => 'false',
            ],
            [
                'name'     => 'standard_filter_id',
                'contents' => '1',
            ],
            [
                'name'     => 'white_balance',
                'contents' => 'false',
            ],
            [
                'name'     => 'resolution',
                'contents' => 'watermarked-sd',
            ],
            [
                'name'     => 'auto_color',
                'contents' => 'true',
            ],
            [
                'name'     => 'artistic_filter_id',
                'contents' => '0',
            ],
            [
                'name'     => 'saturation',
                'contents' => '1.1',
            ],
        ]);


    if ($response->successful()) {

        $imageContent = $response->body();
        $imageName = 'colorized_' . time() . '.jpg';  // You can change the extension if needed based on the API response
        Storage::disk('public')->put('images/' . $imageName, $imageContent);
        $imageUrl = Storage::url('images/' . $imageName);
        return response()->json([
            'message' => 'Image colorized successfully',
            'image_url' => $imageUrl, // You can send the URL to the frontend
        ]);
    } else {

        Log::channel('colorize_request')->info('Request Error user:'.' '.auth()->user()->id, [
            'user email'=>auth()->user()->email,
            'response' => $response->json(),
        ]);

    }

})->name('colorize.test');


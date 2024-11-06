<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\FluxController;
use App\Http\Controllers\MidjourneyController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RunwayController;
use App\Http\Controllers\SocialiteController;
use App\Jobs\WebmConversion;
use App\Models\Balance;
use App\Models\Midjourney;
use App\Models\Runway;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\WebM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use Intervention\Image\Drivers\Gd\Driver;


Route::get('/{locale?}', function () {
    return view('index');
})->name('index');


Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware(['localization', 'auth',])
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
        Route::post('/flux-schnell/save', [FluxController::class, 'schnellsave'])->name('flux-schnell.save');
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

    return $response->json();
});

Route::get('{locale}/translate', function () {
    $token    = config('apikeys.google');
    $response = Http::post('https://translation.googleapis.com/language/translate/v2?key='.$token, [
        'q'      => 'ძაღლლის მზის სათვალეებში პლიაჟზე',
        'target' => 'en',
    ]);

    return $response->json();
});


<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\FluxController;
use App\Http\Controllers\MidjourneyController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RunwayController;
use App\Jobs\WebmConversion;
use App\Models\Balance;
use App\Models\Midjourney;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\WebM;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use Intervention\Image\Drivers\Gd\Driver;


Route::get('/', function () {
    return view('index');
})->name('index');


Route::middleware('auth')
    ->group(function () {
        Route::get('/flux-schnell', [MainController::class, 'index'])->name('dashboard');

        //  Midjourney Routes
        Route::get('/midjourney', [MidjourneyController::class, 'index'])->name('midjourney');
        Route::post('/midjourney/create', [MidjourneyController::class, 'imagine'])->name('midjourney.create');
        Route::get('/midjourney/fetch', [MidjourneyController::class, 'fetch'])->name('midjourney.fetch');
        Route::post('/midjourney/delete}',
            [MidjourneyController::class, 'delete'])->name('midjourney.delete');
        Route::post('/image/create/htmx', [MidjourneyController::class, 'createHtmx'])->name('midjourney.create.htmx');
        Route::get('/midjourney/download', [MidjourneyController::class, 'download'])->name('midjourney.download');

        // Remove background routes
        Route::get('/remove-bg', [AiController::class, 'removeBGindex'])->name('bg.remove');
        Route::post('/remove-bg/create', [AiController::class, 'removeBG'])->name('remove');
        Route::get('/remove-bg/download/{id}', [AiController::class, 'downloadBG'])->name('bg.download');
        Route::post('/remove-bg/delete/{removebg}', [AiController::class, 'delete'])->name('bg.delete');
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
        Route::post('runway/queue',[RunwayController::class,'create'])->name('runway.queue');
        Route::get('/runway/htmx', [RunwayController::class, 'galleryHtmx'])->name('runway.gallery.htmx');


        // Gallery
        Route::get('/gallery/{model}', [MainController::class, 'gallery'])->name('gallery');


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
    });


// TESTING ROUTES

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
    $balance           = new Balance;
    $balance->balance  = 3.81;
    $balance->provider = 'MIDJOURNEY';
    $balance->rate     = 2.7136;
    $balance->save();

    $balance           = new Balance;
    $balance->balance  = 3.81;
    $balance->provider = 'FALAI';
    $balance->rate     = 2.7136;
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


//FAL AI TEST ENDPOINTS

Route::get('manualrunway',[RunwayController::class,'manualrunway'])->name('runway.index');
Route::post('runwayq',[RunwayController::class,'manual'])->name('runway.queue2');


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
    $response=Http::withHeaders(['Authorization'=> 'Key '. $key  ])->post('https://queue.fal.run/fal-ai/runway-gen3/turbo/image-to-video?fal_webhook=https://local.ews.ge/api/runway/webhook', [
        'prompt' => 'dog wearing a sunglasses chillin on the sandy beach',
    ]);


    return $response->json();
})->name('queue');




Route::get('manualfetch',function(){

    $key=config('apikeys.falAI');
    $response=Http::withHeaders(['Authorization'=> 'Key '. $key])->get('https://queue.fal.run/fal-ai/runway-gen3/turbo/image-to-video/requests/bf92505f-a7dc-42f4-93fd-edb06079cff4');
//    bf92505f-a7dc-42f4-93fd-edb06079cff4
    return $response->json();
})->name('manualfetch');




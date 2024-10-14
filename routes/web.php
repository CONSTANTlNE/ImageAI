<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\FluxController;
use App\Http\Controllers\MidjourneyController;
use App\Http\Controllers\MainController;
use App\Models\Midjourney;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
//use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\Drivers\Gd\Driver;


Route::get('/', function () {
    return view('welcome');
})->name('landing');


Route::middleware('auth')
    ->group(function () {

        Route::get('/dashboard',[MainController::class,'index'])->name('dashboard');

        //  Midjourney Routes
        Route::get('/image/generate',[MidjourneyController::class,'index'])->name('midjourney');
        Route::get('/image/create',[MidjourneyController::class,'imagine'])->name('midjourney.create');
        Route::get('/image/fetch',[MidjourneyController::class,'fetch'])->name('midjourney.fetch');

        Route::post('/image/delete',[MidjourneyController::class,'delete'])->name('midjourney.delete');
        Route::post('/image/create/htmx',[MidjourneyController::class,'createHtmx'])->name('midjourney.create.htmx');
        Route::get('/images',[MidjourneyController::class,'imagesPreview'])->name('midjourney.preview');

        // Remove background routes
        Route::get('/remove-bg',[AiController::class,'removeBGindex'])->name('bg.remove');
        Route::post('/remove-bg/create',[AiController::class,'removeBG'])->name('remove');
        Route::get('/remove-bg/download/{id}',[AiController::class,'downloadBG'])->name('bg.download');
        Route::get('/remove-bg/gallery',[AiController::class,'galleryBG'])->name('bg.gallery');

        // Add background image
        Route::get('/add-bg',[AiController::class,'addBGindex'])->name('bg.add');
        Route::post('/add-bg/save',[AiController::class,'addBGstore'])->name('bg.save');
        Route::post('/add-bg/delete/{addbg}',[AiController::class,'addBGdelete'])->name('bg.delete');
        Route::get('/add-bg/download/{id}',[AiController::class,'addBGdownload'])->name('bg.download2');

        // add background color
        Route::get('/add-bg/color/{removebg}',[AiController::class,'addBGcolorindex'])->name('bg.add.color');
        Route::get('/add-bg/color/',[AiController::class,'addBGcolorindex'])->name('bg.add.color2');

        // Flux Routes
        Route::get('/flux-schnell',[FluxController::class,'index'])->name('flux-schnell');
        Route::post('/flux-schnell/prompt', [FluxController::class,'schnellGenerate'] )->name('flux-schnell.prompt');
        Route::post('/flux-schnell/save', [FluxController::class,'schnellsave'] )->name('flux-schnell.save');

        // Test Routes
        Route::get('/webp',[MidjourneyController::class,'webp'])->name('webp');
        Route::get('/detect',[MidjourneyController::class,'detect'])->name('detect');



      Route::get('php',function(){
         return  phpinfo();
      });


        Route::get('encode', function() {

            $imagePath = storage_path('app/public/tmp_image_1728062379.png');


            if (!file_exists($imagePath)) {
                return "File not found: " . $imagePath;
            }
            $manager = new ImageManager(new Driver());

            $image = $manager->read(storage_path('app/public/tmp_image_1728062379.png'));

            $encoded = $image->toWebp(60);

            Storage::disk('public')->put('test.webp', $encoded);




        });

    });



Route::get('token',function (){

    $user=auth()->user();
//    1|BsSD6oVb8wPqXjdApw4rjjbaAyFUr5aNnos7oiMG76a5d164
//    return $user->createToken('token')->plainTextToken;

    return auth()->user()->tokens;

});


Route::get('/flux-dev', [FluxController::class,'promptJs'] )->name('flux');
Route::get('/fal', function () { return view('fal');} )->name('flux');


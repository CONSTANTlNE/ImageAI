<?php

namespace App\Http\Controllers;

use App\Models\Flux;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class FluxController extends Controller
{

    public function index(Request $request)
    {
        $flux=flux::where('model','schnell')
            ->whereDate('created_at',Carbon::today())
            ->with('media')
            ->get();

//        dd($flux[0]);

        return view('user.pages.image-fluxShnell',compact('flux'));
    }

    public function schnellGenerate(Request $request)
    {
        $prompt          = $request->prompt;
        $schnell         = new Flux();
        $schnell->model  = 'schnell';
        $schnell->prompt = $prompt;
        $key='c4fc7928-afcd-4045-a5dc-20fdd82ed030:cc2ca7774e7cca01341794853f85f01e';
        $schnell->save();

        return view('user.htmx.flux-schnell', compact('prompt','key'));
    }


    public function schnellsave(Request $request)
    {
        $flux=Flux::where('prompt',$request->prompt)
            ->where('image_url',null)
            ->first();


        $imageContents = Http::get($request->url)->body();
        Storage::disk('public')->put('test.png', $imageContents);
        $fullPath = storage_path('app/public/test.png');

        $manager = new ImageManager(new Driver());
        $image = $manager->read($fullPath);
        $encoded = $image->toWebp(80);
        Storage::disk('public')->delete('test.png');

        Storage::disk('public')->put(auth()->id().'_'.'flux-schnell'.'.webp', $encoded);
        $flux->addMedia(storage_path('app/public/'.auth()->id().'_'.'flux-schnell'.'.webp'))->toMediaCollection('flux-schnell');
        Storage::disk('public')->delete(auth()->id().'_'.'flux-schnell'.'.webp');


        return back();
    }

}

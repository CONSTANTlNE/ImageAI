<?php

namespace App\Http\Controllers;

use App\Models\Balance;
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
        $flux = Flux::where('model', 'schnell')
            ->whereDate('created_at', Carbon::today())
            ->with('media')
            ->get();

        $flux2 = Flux::where('model', 'schnell')
            ->with('media')
            ->take(30)
            ->orderBy('created_at', 'desc')
            ->get();

//        dd($flux[0]);

        return view('user.pages.image-fluxShnell', compact('flux', 'flux2'));
    }

    public function schnellGenerate(Request $request)
    {
        $prompt          = $request->prompt;
        $schnell         = new Flux();
        $schnell->model  = 'schnell';
        $schnell->prompt_en = $prompt;
        $key             = 'c4fc7928-afcd-4045-a5dc-20fdd82ed030:cc2ca7774e7cca01341794853f85f01e';
        $schnell->save();

        $rate=Balance::where('provider', 'FALAI')
            ->whereNotNull('rate')
            ->orderby('created_at', 'desc')
            ->first();

        $cost=0.003*$rate->rate;

        $balance=new Balance;
        $balance->user_id=auth()->id();
        $balance->provider='FALAI';
        $balance->model='flux-schnell';
        $balance->balance=-0.003;
        $balance->cost_gel=$cost;
        $balance->sell=0.03;
        $balance->profit=0.03-$cost;
        $balance->save();



        return view('user.htmx.flux-htmx', compact('prompt', 'key'));
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
        $encoded = $image->toWebp();
        Storage::disk('public')->delete('test.png');

        Storage::disk('public')->put(auth()->id().'_'.'flux-schnell'.'.webp', $encoded);
        $flux->addMedia(storage_path('app/public/'.auth()->id().'_'.'flux-schnell'.'.webp'))->toMediaCollection('flux-schnell');
        Storage::disk('public')->delete(auth()->id().'_'.'flux-schnell'.'.webp');



        return back();
    }

    public function schnelldelete(Flux $flux){
        if($flux) {
            if($flux->media){
                $flux->media->each(function($media){
                    $media->delete();
                });
            }
            $flux->delete();
        }
        return back();
    }

    public function download(Request $request){

        $flux = Flux::where('id',$request->id)->with('media')->first();

        if($flux) {
            $media = $flux->media[0];
            $filePath = $media->getPath();
            return response()->download($filePath, $media->file_name);
        }
    }

}

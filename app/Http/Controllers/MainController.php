<?php

namespace App\Http\Controllers;

use App\Models\Flux;
use App\Models\Midjourney;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('user.pages.dashboard');
    }


    public function gallery(Request $request,$model)
    {

        if($model==='flux-schnell'){
            $model  = 'Schnell';
            $fluxes = Flux::where('model', 'schnell')->with('media')->paginate(30);
            return view('user.pages.gallery', compact('fluxes', 'model'));
        }

        if ($model === 'midjourney') {
            $model='Midjourney';
            $midjourneys = Midjourney::where('status', '=', 'completed')->with('media')->paginate(30);
            return view('user.pages.gallery', compact('midjourneys', 'model'));
        }

    }

}

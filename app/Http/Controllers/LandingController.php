<?php

namespace App\Http\Controllers;

use App\Models\Flux;
use App\Models\Midjourney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LandingController extends Controller
{
    public function index(Request $request) {

//        $response=HTTP::get('https://nbg.gov.ge/gw/api/ct/monetarypolicy/currencies/ka/json');

//        return $response->json();
        return view('index');
    }

    public function terms(Request $request) {

        return view('terms');
    }

    public function gallery(Request $request) {

        return view('landingpages.gallery');
    }

    public function galleryModel(Request $request,$locale, $model, $perpage = 9) {

//        dd($request->all());

        $validated = $request->validate([
            'page' => 'numeric',
            'perpage' => 'numeric',
        ]);

        $perpage  = $request->input('perpage', $perpage);
        $page     = $request->input('page');
        $perpage1 = 9;
        $perpage2 = 18;
        $perpage3 = 36;


        $models=['flux','midjourney','removebg','runway'];
        if (!in_array($model, $models)){
            return back()->with('alert_error', 'გალერეა არ მოიძებნა');
        }

        if ($model === 'flux') {
            $fluxes= Flux::with('media')
                ->where('public', 1)
                ->withoutGlobalScopes()
                ->paginate($perpage)->appends($request->query());
            $data=$fluxes;
//            dd($data);

            // IF PAGE IS MORE THAT LAST PAGE return back with last page data
            if ($page > $data->lastPage()) {
                return redirect()->route('landing.gallery.model',
                    ['model' => $model, 'perpage' => $perpage, 'page' => $data->lastPage()]);
            }

            return view('landingpages.modelgallery',compact('fluxes', 'model', 'perpage1', 'perpage2', 'perpage3', 'data',));
        }


        if ($model === 'midjourney') {

            $midjourneys= Midjourney::with('media')
                ->whereHas('media', function ($query) {
                    $query->where('public', 1);
                })
                ->withoutGlobalScopes()
                ->paginate($perpage)->appends($request->query());


            $data=$midjourneys;

            // IF PAGE IS MORE THAT LAST PAGE return back with last page data
            if ($page > $data->lastPage()) {
                return redirect()->route('gallery',
                    ['model' => $model, 'perpage' => $perpage, 'page' => $data->lastPage()]);
            }
            return view('landingpages.modelgallery',compact('midjourneys','model', 'perpage1', 'perpage2', 'perpage3', 'data'));
        }
    }
}

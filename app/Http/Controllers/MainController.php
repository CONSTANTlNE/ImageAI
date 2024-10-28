<?php

namespace App\Http\Controllers;

use App\Models\Flux;
use App\Models\Midjourney;
use App\Models\Removebg;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('user.pages.dashboard');
    }


    public function gallery(Request $request, $model, $perpage = 8)
    {
        $perpage  = $request->input('perpage', $perpage);
        $page     = $request->page;
        $data     = '';
        $perpage1 = 8;
        $perpage2 = 16;
        $perpage3 = 32;


        if ($model === 'flux-schnell') {
            $fluxes = Flux::where('model', $model)->with('media')
                ->orderBy('created_at', 'desc')
                ->paginate($perpage)->appends($request->query());
            $data   = $fluxes;

            // IF PAGE IS MORE THAT LAST PAGE return back with last page data
            if ($page > $data->lastPage()) {
                return redirect()->route('gallery',
                    ['model' => $model, 'perpage' => $perpage, 'page' => $data->lastPage()]);
            }

            return view('user.pages.gallery', compact('fluxes', 'model', 'perpage1', 'perpage2', 'perpage3', 'data'));
        }

        if ($model === 'midjourney') {
            $midjourneys = Midjourney::where('status', '=', 'completed')->with('media')
                ->orderBy('created_at', 'desc')
                ->paginate($perpage)->appends($request->query());
            $data        = $midjourneys;

            // IF PAGE IS MORE THAT LAST PAGE return back with last page data
            if ($page > $data->lastPage()) {
                return redirect()->route('gallery',
                    ['model' => $model, 'perpage' => $perpage, 'page' => $data->lastPage()]);
            }

            return view('user.pages.gallery',
                compact('midjourneys', 'model', 'perpage1', 'perpage2', 'perpage3', 'data'));
        }


        if ($model === 'removebg') {
            $removebgs = Removebg::with('media')
                ->orderBy('created_at', 'desc')
                ->paginate($perpage)->appends($request->query());
            $data   = $removebgs;

            // IF PAGE IS MORE THAT LAST PAGE return back with last page data
            if ($page > $data->lastPage()) {
                return redirect()->route('gallery',
                    ['model' => $model, 'perpage' => $perpage, 'page' => $data->lastPage()]);
            }

            return view('user.pages.gallery', compact('removebgs', 'model', 'perpage1', 'perpage2', 'perpage3', 'data'));
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Flux;
use App\Models\Midjourney;
use App\Models\Removebg;
use App\Models\Runway;
use App\Models\UserBalance;
use App\Services\UserBalanceService;
use Illuminate\Http\Request;

class MainController extends Controller
{



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

        if ($model === 'runway') {
            $runways = Runway::with('media')
                ->orderBy('created_at', 'desc')
                ->paginate($perpage)->appends($request->query());
            $data   = $runways;

            // IF PAGE IS MORE THAT LAST PAGE return back with last page data
            if ($page > $data->lastPage()) {
                return redirect()->route('gallery',
                    ['model' => $model, 'perpage' => $perpage, 'page' => $data->lastPage()]);
            }

            return view('user.pages.gallery', compact('runways', 'model', 'perpage1', 'perpage2', 'perpage3', 'data'));
        }

    }

    public function checkUserBalance() {

        $balance = Userbalance::sum('balance');

        return view('user.htmx.userbalance-htmx', compact('balance'));

    }

    public function checkUserBalanceHistory(Request $request,$perpage = 10) {

        $perpage  = $request->input('perpage', $perpage);
        $perpage1 = 10;
        $perpage2 = 15;
        $perpage3 = 25;
        $model=$request->model;


        if ($model && $model!=='all') {
            $history = Userbalance::where('model', $model)->
            with('flux.media', 'midjourney.media', 'removebg.media', 'runway.media')->paginate($perpage)->appends($request->query());
            $totabymodel =$history->sum(function ($userBalance ) use ($model) {
                return $userBalance->balance < 0 & $userBalance->model == $model ? $userBalance->balance : 0;
            });

            return view('user.pages.history', compact('history', 'perpage1', 'perpage2', 'perpage3', 'model','totabymodel'));

        }




        $history = Userbalance::with('flux.media', 'midjourney.media', 'removebg.media', 'runway.media')->paginate($perpage);


        $totalfill = $history->sum(function ($userBalance) {
            return $userBalance->balance > 0 ? $userBalance->balance : 0 ;
        });
        $totalspend = $history->sum(function ($userBalance) {
            return $userBalance->balance < 0 ? $userBalance->balance : 0;
        });


        return view('user.pages.history', compact('history', 'perpage1', 'perpage2', 'perpage3', 'model','totalfill','totalspend'));

    }
}

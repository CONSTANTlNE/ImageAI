<?php

namespace App\Http\Controllers;

use App\Models\Flux;
use App\Models\Midjourney;
use App\Models\Removebg;
use App\Models\Runway;
use App\Models\User;
use App\Models\UserBalance;
use App\Services\UserBalanceService;
use Illuminate\Http\Request;

class MainController extends Controller
{



    public function gallery(Request $request,$locale, $model, $perpage = 8)
    {


        $perpage  = $request->input('perpage', $perpage);
        $page     = $request->page;
        $data     = '';
        $perpage1 = 8;
        $perpage2 = 16;
        $perpage3 = 32;

        $models=['flux-schnell','midjourney','removebg','runway'];
        if (!in_array($model, $models)){
            return back()->with('alert_error', 'გალერეა არ მოიძებნა');
        }

        if ($model === 'flux-schnell') {
            $fluxes = Flux::where('model', $model)->with('media')
                ->orderBy('created_at', 'desc')
                ->paginate($perpage)->appends($request->query());
            $data   = $fluxes;
            $count=Flux::where('model', $model)->count();

            // IF PAGE IS MORE THAT LAST PAGE return back with last page data
            if ($page > $data->lastPage()) {
                return redirect()->route('gallery',
                    ['model' => $model, 'perpage' => $perpage, 'page' => $data->lastPage()]);
            }

            return view('user.pages.gallery', compact('fluxes', 'model', 'perpage1', 'perpage2', 'perpage3', 'data', 'count'));
        }

        if ($model === 'midjourney') {
            $midjourneys = Midjourney::where('status', '=', 'completed')->with('media')
                ->orderBy('created_at', 'desc')
                ->paginate($perpage)->appends($request->query());
            $data        = $midjourneys;
            $count = Midjourney::where('status', 'completed')
                ->withCount('media') // Count media items for each record
                ->get()
                ->sum('media_count'); // Sum up the media counts

            // IF PAGE IS MORE THAT LAST PAGE return back with last page data
            if ($page > $data->lastPage()) {
                return redirect()->route('gallery',
                    ['model' => $model, 'perpage' => $perpage, 'page' => $data->lastPage()]);
            }

            return view('user.pages.gallery',
                compact('midjourneys', 'model', 'perpage1', 'perpage2', 'perpage3', 'data', 'count'));
        }

        if ($model === 'removebg') {
            $removebgs = Removebg::with('media')
                ->orderBy('created_at', 'desc')
                ->paginate($perpage)->appends($request->query());
            $data   = $removebgs;
            $count=Removebg::count();

            // IF PAGE IS MORE THAT LAST PAGE return back with last page data
            if ($page > $data->lastPage()) {
                return redirect()->route('gallery',
                    ['model' => $model, 'perpage' => $perpage, 'page' => $data->lastPage()]);
            }

            return view('user.pages.gallery', compact('removebgs', 'model', 'perpage1', 'perpage2', 'perpage3', 'data', 'count'));
        }

        if ($model === 'runway') {
            $runways = Runway::with('media')
                ->orderBy('created_at', 'desc')
                ->paginate($perpage)->appends($request->query());
//            dd($runways);
            $data   = $runways;
            $count=Runway::count();

            // IF PAGE IS MORE THAT LAST PAGE return back with last page data
            if ($page > $data->lastPage()) {
                return redirect()->route('gallery',
                    ['model' => $model, 'perpage' => $perpage, 'page' => $data->lastPage()]);
            }

            return view('user.pages.gallery', compact('runways', 'model', 'perpage1', 'perpage2', 'perpage3', 'data','count'));
        }

    }

    public function checkUserBalance() {

        $balance = round(Userbalance::sum('balance'), 2, PHP_ROUND_HALF_DOWN);

        return view('user.htmx.userbalance-htmx', compact('balance'));

    }

    public function checkUserBalanceHistory(Request $request,$locale,$perpage = 10) {

        $perpage  = $request->input('perpage', $perpage);
        $perpage1 = 10;
        $perpage2 = 15;
        $perpage3 = 25;
        $model=$request->model;


        if ($model && $model!=='all') {
            $history = Userbalance::where('model', $model)->
            with('flux.media', 'midjourney.media', 'removebg.media', 'runway.media')->paginate($perpage)->appends($request->query());

            $sum=UserBalance::where('model', $model)->select('balance')->get();
            $totabymodel =$sum->sum(function ($userBalance )  {
                return $userBalance->balance < 0  ? $userBalance->balance : 0;
            });

            if ($model==='fill'){
                $sum=UserBalance::select('balance')->get();
                $totalfill = $sum->sum(function ($userBalance)  {
                    return $userBalance->balance > 0 ? $userBalance->balance : 0 ;
                });
                return view('user.pages.history', compact('history', 'perpage1', 'perpage2', 'perpage3', 'model','totabymodel','totalfill'));
            }
            return view('user.pages.history', compact('history', 'perpage1', 'perpage2', 'perpage3', 'model','totabymodel'));
        }




        $history = Userbalance::with('flux.media', 'midjourney.media', 'removebg.media', 'runway.media')->paginate($perpage);

         $sum=UserBalance::select('balance')->get();
        $totalfill = $sum->sum(function ($userBalance) {
            return max($userBalance->balance, 0);
        });
        $totalspent = $sum->sum(function ($userBalance) {
            return $userBalance->balance < 0 ? $userBalance->balance : 0;
        });


        return view('user.pages.history', compact('history', 'perpage1', 'perpage2', 'perpage3', 'model','totalfill','totalspent'));

    }
}

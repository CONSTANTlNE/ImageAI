<?php

namespace App\Http\Controllers;

use App\Models\Colorization;
use App\Models\UserBalance;
use App\Services\AppBalanceService;
use App\Services\UserBalanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ColorizationController extends Controller
{
    public function index(Request $request){

        $colorized=Colorization::whereDate('created_at', Carbon::today())
            ->with('media')
            ->get();

        $colorizations=Colorization::with('media')
            ->take(30)
            ->orderBy('created_at', 'desc')
            ->get();


        return view ('user.pages.colorize',compact('colorized','colorizations'));
    }

    public function colorize(Request $request){


//        dd($request->all());
        $validate=$request->validate([
           'image'=>'required|mimes:jpeg,png,jpg|max:2048',
           'resolution'=>'required|in:sd,full-hd'
        ]);

        if (!(new UserBalanceService())->checkBalance('colorize'.$request->resolution)) {
            return back()->with('alert_error', 'არასაკმარისი ბალანსი');
        }


        $file = $request->file('image');


        $response = Http::withHeaders([
            'x-rapidapi-host' => 'colorize-photo1.p.rapidapi.com',
            'x-rapidapi-key'  => config('apikeys.pallete'),
        ])
            ->asMultipart()  // Tell Laravel HTTP client to send as multipart
            ->post('https://colorize-photo1.p.rapidapi.com/colorize_image_with_auto_prompt', [
                [
                    'name'     => 'image',  // Field name in the API
                    'contents' => fopen($file->getRealPath(), 'r'),  // Open the file
                    'filename' => $file->getClientOriginalName(),  // Original file name
                ],
                [
                    'name'     => 'temperature',
                    'contents' => '-0.1',
                ],
                [
                    'name'     => 'raw_captions',
                    'contents' => 'false',
                ],
                [
                    'name'     => 'standard_filter_id',
                    'contents' => '1',
                ],
                [
                    'name'     => 'white_balance',
                    'contents' => 'false',
                ],
                [
                    'name'     => 'resolution',
                    'contents' => $request->resolution,
                ],
                [
                    'name'     => 'auto_color',
                    'contents' => 'true',
                ],
                [
                    'name'     => 'artistic_filter_id',
                    'contents' => '0',
                ],
                [
                    'name'     => 'saturation',
                    'contents' => '1.1',
                ],
            ]);


        if ($response->successful()) {

            $imageContent = $response->body();

            $rand=random_int(10000,99999);
            // Create a temporary file
            $tempFilePath = tempnam(sys_get_temp_dir(), auth()->user()->id.'_colorized_'.$rand) . '.jpg';

            // Write the image content to the temporary file
            file_put_contents($tempFilePath, $imageContent);

            $colorize=Colorization::create([
                'model'=>'colorize'
            ]);

            $colorize->addMedia($tempFilePath)->toMediaCollection('colorized');


            // Deduct Balance from App
            (new AppBalanceService())->appBalance('pallete', 'colorize'.$request->resolution);

            // Deduct Balance from User
            (new UserBalanceService)->deductBalance('colorization', $colorize->id, config('variables.colorize'.$request->resolution.'-price'));

             return back();

        } else {

            Log::channel('colorize_request')->info('Request Error user:'.' '.auth()->user()->id, [
                'user email'=>auth()->user()->email,
                'response' => $response->json(),
            ]);

            return back()->with('alert_error', 'ბოდიშს გიხდით, დაფიქსირდა ტექნიკური ხარვეზი');
        }
    }

    public function download(Request $request){
        $colorized = Colorization::where('id', $request->id)->with('media')->first();

        if ($colorized) {
            $media    = $colorized->media[0];
            $filePath = $media->getPath();

            return response()->download($filePath, $media->file_name);
        }
    }

    public function delete(Request $request){

        if ($request->has('id')) {
            $colorized = Colorization::where('id', $request->id)->first();
            if ($colorized->media) {
                $colorized->media->each(function ($media) {
                    $media->delete();
                });
            }
            // first remove ID from userbalance because of relationship
            $userBalance = UserBalance::where('colorization_id', $colorized->id)->first();
            if ($userBalance) {
                $userBalance->colorizations_id = null;
                $userBalance->save();
            }

            $colorized->delete();
            return back()->with('alert_success', 'ფოტო წარმატებით წაიშალა');
        }
    }



}

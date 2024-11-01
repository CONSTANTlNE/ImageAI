<?php

namespace App\Http\Controllers;

use App\Models\Addbg;
use App\Models\Flux;
use App\Models\Removebg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AiController extends Controller
{
    public function removeBGindex()
    {
        $images = Removebg::whereNotNull('url')
            ->where('url', '!=', '')
            ->whereDate('created_at', Carbon::today())
            ->with('media')
            ->get();

        $images2 = Removebg::whereNotNull('url')
            ->where('url', '!=', '')
            ->with('media')
            ->select('id')
            ->take(30)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.pages.remove-bg2', compact('images2','images'));
    }

    public function removeBG(Request $request)
    {

//        dd($request->all());
        $bearerToken = config('apikeys.edenapi');

//        File Upload
        if ($request->hasFile('images') && $request->file('images')[0]!==null) {

            $file     = $request->file('images')[0]; // Get the first image file from the request
            $filePath = $file->path();

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$bearerToken,
            ])->attach('file', file_get_contents($filePath), $file->getClientOriginalName()) // Attach file
            ->asMultipart() // Force multipart mode
            ->timeout(60)
                ->post("https://api.edenai.run/v2/image/background_removal", [
                [
                    'name'     => 'providers', // Multipart field for providers
                    'contents' => 'microsoft', // Providers as individual strings, one at a time
                ],
                [
                    'name'     => 'response_as_dict',
                    'contents' => 'true',
                ],
                [
                    'name'     => 'attributes_as_list',
                    'contents' => 'false',
                ],
                [
                    'name'     => 'show_base_64',
                    'contents' => 'true',
                ],
                [
                    'name'     => 'show_original_response',
                    'contents' => 'false',
                ],
            ]);


            // send error email and log !

            if ($response->successful()) {

                $imageBase64 = $response->json()['microsoft']['image_b64'];
                $cost        = $response->json()['microsoft']['cost'];
                $url         = $response->json()['microsoft']['image_resource_url'];

                $bg           = new Removebg();
                $bg->url      = $url;
                $bg->cost     = $cost;
                $bg->provider = 'microsoft';
                $bg->save();


                $imageContents = Http::get($url)->body();
                Storage::disk('public')->put('test.png', $imageContents);
                $fullPath = storage_path('app/public/test.png');

                $manager = new ImageManager(new Driver());
                $image = $manager->read($fullPath);
                $encoded = $image->toWebp(60);
                Storage::disk('public')->delete('test.png');



                Storage::disk('public')->put('test.webp', $encoded);
                $bg->addMedia(storage_path('app/public/test.webp'))->toMediaCollection('removebg');
                Storage::disk('public')->delete('test.webp');


                return back()->with('alert_success', 'ფონი წარმატებით წაიშალა')->with('url', $url);

            }
        }
//        if Selected from Galleries
        if($request->has('file_url') && $request->input('file_url')){

            $file_url=$request->input('file_url');
//dd($file_url);
            $headers = [
                'Authorization' => 'Bearer '.$bearerToken,
            ];

            $url = 'https://api.edenai.run/v2/image/background_removal';

            $jsonPayload = [
                'providers' => 'microsoft',
                'file_url' => $file_url,
            ];

            $response = Http::withHeaders($headers)->timeout(60)
                ->post($url, $jsonPayload);

            if ($response->successful()) {

                $imageBase64 = $response->json()['microsoft']['image_b64'];
                $cost        = $response->json()['microsoft']['cost'];
                $url         = $response->json()['microsoft']['image_resource_url'];

                $bg           = new Removebg();
                $bg->url      = $url;
                $bg->cost     = $cost;
                $bg->provider = 'microsoft';
                $bg->save();


                $imageContents = Http::get($url)->body();
                Storage::disk('public')->put('test.png', $imageContents);
                $fullPath = storage_path('app/public/test.png');

                $manager = new ImageManager(new Driver());
                $image = $manager->read($fullPath);
                $encoded = $image->toJpeg();
                Storage::disk('public')->delete('test.png');


                Storage::disk('public')->put('test.webp', $encoded);
                $bg->addMedia(storage_path('app/public/test.webp'))->toMediaCollection('removebg');
                Storage::disk('public')->delete('test.webp');


                return back()->with('alert_success', 'ფონი წარმატებით წაიშალა')->with('url', $url);

            } else {

                dd($response->json());
            }

        }




        return back()->with('alert_error', 'გთხოვთ ატვირთეთ ფოტო');
    }

    public function downloadBG(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        $removebg=Removebg::where('id',$request->id)->with('media')->first();
        $media = $removebg->media->first(); // Replace with your logic to find media

        $filePath = $media->getPath(); // Use getPath() to get the physical path
        // Force the download

        return response()->download($filePath, $media->file_name);

    }

    public function galleryBG(Request $request){
        $images = Removebg::with('media')->get();

        return view('user.pages.remove-bg-gallery', compact('images'));
    }

    public function delete(Request $request,Removebg $removebg){

        if ($request->has('id')) {

            $removebg2 = Removebg::where('id', $request->id)->first();
            if($removebg2->media){
                $removebg2->media->each(function($media){
                    $media->delete();
                });
            }
            $removebg2->delete();
            return back()->with('alert_success', 'ფოტო წარმატებით წაიშალა');
        }


        if($removebg) {
            if($removebg->media){
                $removebg->media->each(function($media){
                    $media->delete();
                });
            }
            $removebg->delete();
            return back()->with('alert_success', 'ფოტო წარმატებით წაიშალა');
        }


    }




    // Add Background
    public function addBGindex()
    {
        $images = Addbg::with('media')->get();

        return view('user.pages.add-bg', compact('images'));
    }

    public function addBGstore(Request $request): \Illuminate\Http\RedirectResponse
    {

        $addbg = new Addbg();
        $addbg->save();


        // Get the base64-encoded image data from the request
        $imageData = $request->input('canvas_image');

        // Remove the "data:image/png;base64," part from the string
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        // Decode the base64 string to binary data
        $image = base64_decode($imageData);

        // Generate a unique file name
        $fileName = 'canvas_image_' . time() . '.png';

        // Save the file to storage (you can adjust the path as needed)
        Storage::disk('public')->put($fileName, $image);




        $file = Storage::disk('public')->get($fileName);


        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $encoded = $image->toWebp(60);
        Storage::disk('public')->delete($fileName);
        Storage::disk('public')->put('addbg.webp', $encoded);

        $addbg->addMedia(public_path('storage/addbg.webp'))->toMediaCollection('addbg');
        Storage::disk('public')->delete('addbg.webp');

        return back()->with('alert_success', 'ფოტო წარმატებით შეინახა');
    }

    public function addBGdelete(Addbg $addbg): \Illuminate\Http\RedirectResponse
    {

//        dd($addbg);
        $addbg->media->each(function ($media) {
            $media->delete();
        });
        $addbg->delete();
        return back()->with('alert_success', 'წარმატებით წაიშალა');
    }

    public function  addBGdownload(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        $removebg=Addbg::where('id',$request->id)->with('media')->first();
        $media = $removebg->media->first(); // Replace with your logic to find media

        $filePath = $media->getPath(); // Use getPath() to get the physical path
        // Force the download
        return response()->download($filePath, $media->file_name);


    }

    // add background color
    public function addBGcolorindex(Removebg $removebg)
    {

        $images = Addbg::with('media')->get();

        return view('user.pages.add-color', compact('images','removebg'));
    }


}

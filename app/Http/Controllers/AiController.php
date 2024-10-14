<?php

namespace App\Http\Controllers;

use App\Models\Addbg;
use App\Models\Removebg;
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
            ->with('media')
            ->get();

        return view('user.pages.remove-bg', compact('images'));
    }

    public function removeBG(Request $request)
    {
        // Prepare the request data
        $bearerToken = config('apikeys.edenapi');

        if ($request->hasFile('images')) {
            $file     = $request->file('images')[0]; // Get the first image file from the request
            $filePath = $file->path();
//        dd(fopen($file->getPathname(), 'r'));
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


            if ($response->successful()) {
                $imageBase64 = $response->json()['microsoft']['image_b64'];
                $cost        = $response->json()['microsoft']['cost'];
                $url         = $response->json()['microsoft']['image_resource_url'];// Adjust this based on the structure of your response

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
//            $imageData = base64_decode($imageBase64);
//            $filePath = storage_path('app/public/processed_image.png');
//            file_put_contents($filePath, $imageData);

            } else {
                return response()->json([
                    $response->body(),
                ], $response->status());
            }
        }

        return back()->with('alert_error', 'გთხოვთ ატვირთეთ ფოტო');
    }

    public function downloadBG(Request $request)
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

    // Add Background
    public function addBGindex()
    {
        $images = Addbg::with('media')->get();

        return view('user.pages.add-bg', compact('images'));
    }

    public function addBGstore(Request $request)
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

    public function addBGdelete(Addbg $addbg){

//        dd($addbg);
        $addbg->media->each(function ($media) {
            $media->delete();
        });
        $addbg->delete();
        return back()->with('alert_success', 'წარმატებით წაიშალა');
    }

    public function  addBGdownload(Request $request)
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

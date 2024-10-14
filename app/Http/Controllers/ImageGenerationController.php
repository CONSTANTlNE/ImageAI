<?php

namespace App\Http\Controllers;

use App\Models\ImageGeneration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageGenerationController extends Controller
{


    public function createOpenAI(Request $request)
    {

        $language='ka';

        //DETECT LANGUAGE
        $detectlanguage = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-rapidapi-host' => 'deep-translate1.p.rapidapi.com',
            'x-rapidapi-key' => 'e4143241camshb336aeb2dbe3d42p1a53f6jsnb38c61c5fb11',
        ])->post('https://deep-translate1.p.rapidapi.com/language/translate/v2/detect', [
            'q' => $request->input('prompt'),
            'data' => [
                'detections' => [
                    [
                        'language' => 'en',
                        'isReliable' => false,
                        'confidence' => 0.9867512,
                    ],
                ],
            ],
        ]);



        if ($detectlanguage->successful()) {
            $language = $detectlanguage['data']['detections'][0]['language'];
        }


        if($language==='ka'){

            $response1 = Http::withHeaders([
                'Content-Type'    => 'application/json',
                'x-rapidapi-host' => 'deep-translate1.p.rapidapi.com',
                'x-rapidapi-key'  => 'e4143241camshb336aeb2dbe3d42p1a53f6jsnb38c61c5fb11',
            ])->post('https://deep-translate1.p.rapidapi.com/language/translate/v2', [
                'q'      => $request->input('prompt'),
                'source' => 'ka',
                'target' => 'en',
            ]);


            $responseBody1 = $response1->json();

            $promptka=$request->input('prompt');
            $prompteng=$responseBody1['data']['translations']['translatedText'];


            // =======  Open Ai ==========


            $response = Http::withHeaders([
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer '.'sk-qXu84bF2XFe4TfPw7WhnyTYtWh3WDkeYfmr8wKbco7T3BlbkFJzlb_y3qc_mWDlw8AEBv10speotgfCZtQ3HhKJ68-8A',
            ])->post('https://api.openai.com/v1/images/generations', [
                'model'           => 'dall-e-3',
                'style'           => 'vivid',
                'quality'         => 'standard',
                'prompt'          => $prompteng,
                'n'               => 1,
                'size'            => '1024x1024',
                'response_format' => 'b64_json',
            ]);


            $responseBody = $response->json();

        }


        if($language==='en'){

            //        Open Ai


            $response = Http::withHeaders([
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer '.'sk-qXu84bF2XFe4TfPw7WhnyTYtWh3WDkeYfmr8wKbco7T3BlbkFJzlb_y3qc_mWDlw8AEBv10speotgfCZtQ3HhKJ68-8A',
            ])->post('https://api.openai.com/v1/images/generations', [
                'model'           => 'dall-e-3',
                'style'           => 'vivid',
                'quality'         => 'standard',
                'prompt'          => $request->input('prompt'),
                'n'               => 1,
                'size'            => '1024x1024',
                'response_format' => 'b64_json',
            ]);

            $promptka='';
            $prompteng=$request->input('prompt');

            $responseBody = $response->json();
        }




//        $url = $responseBody['data'][0]['url'];
        $b64 = $responseBody['data'][0]['b64_json'];


        $image = ImageGeneration::create([
            'user_id'           => auth()->user()->id,
            'user_prompt_ka'    => $promptka,
            'user_prompt_en'    => $prompteng,
            'ai_revised_prompt' => $responseBody['data'][0]['revised_prompt'],
        ]);





        // Decode the base64 string to binary image data
        $decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',
            $b64));

        // Generate a unique filename for the stored image (you may customize this as needed)
        $filename = 'openai_image_'.$image->id.'.png';

        // Store the image data using Laravel's storage system
        Storage::disk('public')->put($filename, $decodedImageData);

        // Convert to WEBP
        $manager = new ImageManager(new Driver());
        $webp = $manager->read(storage_path('app/public/'.$filename))->toWebp(60);


        // Save the converted WEBP image temporarily in the public disk
        $tempWebpPath = 'temp_image_' . $image->id . '.webp'; // File name only
        Storage::disk('public')->put($tempWebpPath, $webp);


        // Add the converted image to the media library
        $image->addMedia(Storage::disk('public')->path($tempWebpPath))
            ->toMediaCollection('openai_images');

        // Delete the temporary file
        Storage::disk('public')->delete($tempWebpPath);
        Storage::disk('public')->delete($filename);



        return view('user.pages.image-generator', compact('image'));
//        return view('user.pages.image-generator', ['image' => $image]);

    }

    public function create(Request $request){


    }

    public function delete(Request $request){

        $image = ImageGeneration::where('user_id', auth()->user()->id)->where('id', $request->input('image_id'))->first();

        foreach ($image->getMedia('openai_images') as $media) {
            $media->delete();
        }

        $image->delete();
        return back();
    }

    public function createHtmx(Request $request)
    {
        $prompt = $request->input('prompt');

        $response = Http::withHeaders([
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer '.'sk-qXu84bF2XFe4TfPw7WhnyTYtWh3WDkeYfmr8wKbco7T3BlbkFJzlb_y3qc_mWDlw8AEBv10speotgfCZtQ3HhKJ68-8A',
        ])->post('https://api.openai.com/v1/images/generations', [
            'model'  => 'dall-e-3',
            'prompt' => $prompt,
            'n'      => 1,
            'size'   => '1024x1024',
        ]);


        $responseBody = $response->json();
        $url          = $responseBody['data'][0]['url'];

        $image = ImageGeneration::create([
            'user_id' => auth()->user()->id,
            'prompt'  => $request->input('prompt'),
        ]);

        $image->addMediaFromUrl($url)->toMediaCollection('openai_images');


        return view('user.pages.htmx.imagegenerationHTMX', compact('image'));
//        return view('user.pages.image-generator', ['image' => $image]);

    }

    public function imagesPreview(){

        $images = ImageGeneration::where('user_id', auth()->user()->id)
            ->with('media')
            ->orderBy('id', 'desc')  // Order by 'id' or 'created_at' in descending order
            ->get();

        return view('user.pages.images-preview', compact('images'));
    }




    // ======== Testing

    public function webp(Request $request){
        $manager = new ImageManager(new Driver());
        $image = $manager->read(public_path('5.png'))->toWebp(60);

        // Save the converted image
        $filePath = public_path('output_image.webp');
        $image->save($filePath);


    }


    public function detect(Request $request){
        // Text you want to detect the language for
        $textToDetect = 'hello my name is Constantine';

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-rapidapi-host' => 'deep-translate1.p.rapidapi.com',
            'x-rapidapi-key' => 'e4143241camshb336aeb2dbe3d42p1a53f6jsnb38c61c5fb11',
        ])->post('https://deep-translate1.p.rapidapi.com/language/translate/v2/detect', [
            'q' => $textToDetect,
            'data' => [
                'detections' => [
                    [
                        'language' => 'en',
                        'isReliable' => false,
                        'confidence' => 0.9867512,
                    ],
                ],
            ],
        ]);

// Get the response body as an array
        $responseData = $response->json();



// Optionally, check if the request was successful
        if ($response->successful()) {
            $language = $responseData['data']['detections'][0]['language'];

            dd($language);
        } else {
            // Handle the error
            dd($response->status(), $response->body());
        }


    }

}

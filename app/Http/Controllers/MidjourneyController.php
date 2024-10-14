<?php

namespace App\Http\Controllers;

use App\Models\ImageGeneration;
use App\Models\Midjourney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidjourneyController extends Controller
{

    public function index(Request $request)
    {
        $image = Midjourney::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')  // Order by 'id' or 'created_at' in descending order
            ->first();

        return view('user.pages.image-midjourney', compact('image'));
    }

    public function imagine(Request $request)
    {
        $url = 'https://api.piapi.ai/mj/v2/imagine';

        $payload = [
            'prompt'           => 'empty image of a background for using in photography for dish images',
            'process_mode'     => 'relax',
            'aspect_ratio'     => '4:3',
            'webhook_endpoint' => 'https://local.ews.ge/api/midjourney/webhook',
            'webhook_secret'   => '1|BsSD6oVb8wPqXjdApw4rjjbaAyFUr5aNnos7oiMG76a5d164',
        ];

        $response = Http::withHeaders([
            'X-API-KEY'  => config('apikeys.piapi'),
            'User-Agent' => 'Apidog/1.0.0 (https://apidog.com)',
        ])->post($url, $payload);


        if ($response->successful() && $response->json()['status'] !== false) {

          $midjourney = Midjourney::create([
                'task_id' => $response->json()['task_id'],
            ]);

           return view('test',compact('midjourney'));
        } else {
            // Handle the error response
            return response()->json(['error' => 'Failed to process request'], $response->status());
        }
    }

    public function fetch(Request $request)
    {
        $task=Midjourney::latest()->first();

        $url = 'https://api.piapi.ai/mj/v2/fetch';

        $payload = [
            'task_id'           => $task->task_id,
        ];

        $response = Http::withHeaders([
            'X-API-KEY'  => config('apikeys.piapi'),
            'User-Agent' => 'Apidog/1.0.0 (https://apidog.com)',
        ])->post($url, $payload);


        if ($response->successful() && $response->json()['status'] !== false) {

            $status=$response->json()['status'];
            $url = $response->json()['task_result']['image_url'];

            return view('user.htmx.midjourney-fetch',compact('status','url'));

        } else {
            // Handle the error response
            return response()->json(['error' => 'Failed to process request'], $response->status());
        }
    }

    public function webhook(Request $request)
    {
        $secret = '1|BsSD6oVb8wPqXjdApw4rjjbaAyFUr5aNnos7oiMG76a5d164';

        Log::channel('webhooks')->info('Webhook received', [
            'headers' => $request->headers->all(),
            'payload' => $request->all(),
            'ip_address' => $request->ip(),
        ]);


        if ($request->header('x-webhook-secret') !== $secret) {
            abort(403, 'Unauthorized webhook request.');
        }


        return response('Webhook logged', 200);
    }

}

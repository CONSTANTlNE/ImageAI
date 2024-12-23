<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TranslationService {

    public $token;

    public function __construct() {
        $this->token = config('apikeys.google');
    }

    public function detectAndTranslate($validated) {
        // Detect language
        $response = Http::post('https://translation.googleapis.com/language/translate/v2/detect?key='.$this->token, [
            'q' => $validated['prompt'],
        ]);

        $detectedLanguage = $response->json()['data']['detections'][0][0]['language'];

        // Translate
        if ($detectedLanguage !== 'en') {
            $translationResponse = Http::post('https://translation.googleapis.com/language/translate/v2?key='.$this->token, [
                'q'      => $validated['prompt'],
                'target' => 'en',
            ]);

            $translatedText = $translationResponse->json()['data']['translations'][0]['translatedText'];
        } else {
            $translatedText = $validated['prompt'];
        }

        return [
            'language' => $detectedLanguage,
            'translation' => $translatedText,
        ];
    }
}

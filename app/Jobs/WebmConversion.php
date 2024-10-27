<?php

namespace App\Jobs;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\WebM;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class WebmConversion implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $timeout = 3600;
    private $videoPath;

    /**
     * Create a new job instance.
     */
    public function __construct($videoPath)
    {
        $this->videoPath = $videoPath; // Store the video file path

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Log::channel('ffmpeg')->info('Starting video conversion: ', [
            'path'    => $this->videoPath
        ]);

        if (!file_exists($this->videoPath)) {
            Log::channel('ffmpeg')->info('Video file not found: ', [
                'path'    => $this->videoPath
            ]);

            return;
        }

        try {
            $ffmpeg = FFMpeg::create();
            $video = $ffmpeg->open($this->videoPath);

            $webmFormat = new WebM();
            $webmFormat->setVideoCodec('libvpx')
                ->setAudioCodec('libvorbis');

            $outputPath = public_path('videos/conversion.webm');
            $video->save($webmFormat, $outputPath);

            Log::channel('ffmpeg')->info('FFmpeg conversion failed: ', [
                'success'    => $outputPath,
            ]);

        } catch (\Exception $e) {
            Log::channel('ffmpeg')->info('FFmpeg conversion failed: ', [
                'error'    => $e->getMessage(),
            ]);
        }
    }


}

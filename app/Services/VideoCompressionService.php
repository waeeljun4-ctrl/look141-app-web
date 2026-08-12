<?php

namespace App\Services;

use FFMpeg\Format\Video\X264;
use FFMpeg\FFMpeg;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoCompressionService
{
    /**
     * Video compression runs SYNCHRONOUSLY inside the upload request, by design.
     *
     * Queueing this work would require a persistent `queue:work` process plus a
     * job-status polling UI so the admin knows when the encode finished — that is
     * real infrastructure this project doesn't have yet. A synchronous encode is
     * acceptable here because product-video uploads are an infrequent, admin-only
     * action (not a customer-facing, high-volume flow), so a few extra seconds on
     * the upload request is an acceptable tradeoff versus building queue infra.
     */
    public function compressAndStore(UploadedFile $file, string $directory, string $disk = 'public'): string
    {
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => config('services.ffmpeg.binary'),
            'ffprobe.binaries' => config('services.ffmpeg.probe'),
        ]);

        $video = $ffmpeg->open($file->getRealPath());

        $format = new X264('aac', 'libx264');
        // php-ffmpeg's X264 format defaults to a 1000k bitrate + 2-pass encoding,
        // which would inject a conflicting "-b:v 1000k" alongside our "-crf 28"
        // and silently defeat CRF-based (quality-driven) compression. Zeroing the
        // bitrate switches it to single-pass, CRF-only encoding as intended.
        $format->setKiloBitrate(0);
        $format->setAdditionalParameters(['-crf', '28', '-preset', 'medium']);

        $tempPath = sys_get_temp_dir().DIRECTORY_SEPARATOR.Str::random(40).'.mp4';

        $video->save($format, $tempPath);

        $path = $directory.'/'.Str::random(40).'.mp4';
        // Stream the file to storage instead of file_get_contents() — a
        // compressed video can easily exceed PHP's memory_limit if read
        // fully into a string first.
        $stream = fopen($tempPath, 'r');
        Storage::disk($disk)->put($path, $stream);
        if (is_resource($stream)) fclose($stream);

        @unlink($tempPath);

        return $path;
    }
}

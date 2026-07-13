<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class RemoteImageToJpeg
{
    /**
     * Fetch a remote image and return JPEG binary.
     * WebP (and other GD-supported formats) are converted to JPEG.
     */
    public static function convert(string $url, int $quality = 90): string
    {
        $response = Http::timeout(30)
            ->withHeaders([
                'Accept' => 'image/*,*/*',
                'User-Agent' => 'LoveThaiHome-ImageProxy/1.0',
            ])
            ->get($url);

        if (! $response->successful()) {
            throw new RuntimeException('Unable to download image.', $response->status());
        }

        $binary = $response->body();

        if ($binary === '') {
            throw new RuntimeException('Empty image response.');
        }

        if (! function_exists('imagecreatefromstring') || ! function_exists('imagejpeg')) {
            throw new RuntimeException('GD extension is required to convert images.');
        }

        $image = @imagecreatefromstring($binary);

        if ($image === false) {
            throw new RuntimeException('Unsupported or invalid image data.');
        }

        if (function_exists('imagepalettetotruecolor') && ! imageistruecolor($image)) {
            imagepalettetotruecolor($image);
        }

        if (function_exists('imagealphablending') && function_exists('imagesavealpha')) {
            imagealphablending($image, true);
            imagesavealpha($image, false);
        }

        // Flatten transparency onto white for JPEG.
        $width = imagesx($image);
        $height = imagesy($image);
        $canvas = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($canvas, 255, 255, 255);
        imagefilledrectangle($canvas, 0, 0, $width, $height, $white);
        imagecopy($canvas, $image, 0, 0, 0, 0, $width, $height);
        imagedestroy($image);

        ob_start();
        $ok = imagejpeg($canvas, null, max(1, min(100, $quality)));
        $jpeg = (string) ob_get_clean();
        imagedestroy($canvas);

        if (! $ok || $jpeg === '') {
            throw new RuntimeException('Failed to encode JPEG.');
        }

        return $jpeg;
    }

    public static function looksLikeWebp(string $url, ?string $contentType = null, ?string $binary = null): bool
    {
        if ($contentType && str_contains(strtolower($contentType), 'webp')) {
            return true;
        }

        $path = strtolower((string) (parse_url($url, PHP_URL_PATH) ?? ''));

        if (str_ends_with($path, '.webp')) {
            return true;
        }

        if (is_string($binary) && strlen($binary) >= 12) {
            return str_starts_with($binary, 'RIFF') && str_contains(substr($binary, 0, 16), 'WEBP');
        }

        return false;
    }

    public static function logFailure(string $url, \Throwable $exception): void
    {
        Log::warning('Failed to convert remote image to JPEG.', [
            'url' => $url,
            'message' => $exception->getMessage(),
        ]);
    }
}

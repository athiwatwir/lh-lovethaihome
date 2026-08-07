<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use RuntimeException;

class UploadedImageNormalizer
{
    /**
     * Convert an uploaded image to a truecolor JPEG file.
     * Avoids API failures like: imagewebp(): Palette image not supported by webp
     */
    public static function toJpeg(UploadedFile $file, int $quality = 90): UploadedFile
    {
        if (! function_exists('imagecreatefromstring') || ! function_exists('imagejpeg')) {
            throw new RuntimeException('GD extension is required to normalize images.');
        }

        $binary = @file_get_contents($file->getRealPath());

        if ($binary === false || $binary === '') {
            throw new RuntimeException('Unable to read uploaded image.');
        }

        $image = @imagecreatefromstring($binary);

        if ($image === false) {
            throw new RuntimeException('Unsupported or corrupt image: '.$file->getClientOriginalName());
        }

        if (function_exists('imagepalettetotruecolor') && ! imageistruecolor($image)) {
            imagepalettetotruecolor($image);
        }

        if (function_exists('imagealphablending') && function_exists('imagesavealpha')) {
            imagealphablending($image, true);
            imagesavealpha($image, false);
        }

        $width = imagesx($image);
        $height = imagesy($image);
        $canvas = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($canvas, 255, 255, 255);
        imagefilledrectangle($canvas, 0, 0, $width, $height, $white);
        imagecopy($canvas, $image, 0, 0, 0, 0, $width, $height);
        imagedestroy($image);

        $tempPath = tempnam(sys_get_temp_dir(), 'lth_img_');

        if ($tempPath === false) {
            imagedestroy($canvas);
            throw new RuntimeException('Unable to create temporary image file.');
        }

        $jpegPath = $tempPath.'.jpg';
        @unlink($tempPath);

        $ok = imagejpeg($canvas, $jpegPath, max(1, min(100, $quality)));
        imagedestroy($canvas);

        if (! $ok || ! is_file($jpegPath)) {
            @unlink($jpegPath);
            throw new RuntimeException('Failed to encode uploaded image as JPEG.');
        }

        $original = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) ?: 'image';
        $filename = $original.'.jpg';

        return new UploadedFile(
            $jpegPath,
            $filename,
            'image/jpeg',
            null,
            true,
        );
    }

    /**
     * @param  list<UploadedFile>|array<int, UploadedFile>  $files
     * @return list<UploadedFile>
     */
    public static function manyToJpeg(array $files, int $quality = 90): array
    {
        $normalized = [];

        foreach ($files as $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }

            $normalized[] = self::toJpeg($file, $quality);
        }

        return $normalized;
    }

    /**
     * @param  list<UploadedFile>  $files
     */
    public static function cleanup(array $files): void
    {
        foreach ($files as $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }

            $path = $file->getPathname();

            if (is_string($path) && $path !== '' && is_file($path)) {
                @unlink($path);
            }
        }
    }
}

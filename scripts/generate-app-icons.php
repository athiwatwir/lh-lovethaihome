<?php

$srcPath = __DIR__.'/../public/images/logo/logo.png';
$src = imagecreatefrompng($srcPath);
$sw = imagesx($src);
$sh = imagesy($src);

function makeIcon($src, int $sw, int $sh, int $size, string $out, float $padRatio = 0.1): void
{
    $canvas = imagecreatetruecolor($size, $size);
    imagealphablending($canvas, true);
    imagesavealpha($canvas, true);

    $white = imagecolorallocate($canvas, 255, 255, 255);
    imagefilledrectangle($canvas, 0, 0, $size, $size, $white);

    $pad = (int) round($size * $padRatio);
    $inner = $size - ($pad * 2);
    imagecopyresampled($canvas, $src, $pad, $pad, 0, 0, $inner, $inner, $sw, $sh);
    imagepng($canvas, $out);
    imagedestroy($canvas);

    echo $out.PHP_EOL;
}

$base = __DIR__.'/../public/images/logo';
makeIcon($src, $sw, $sh, 180, $base.'/apple-touch-icon.png');
makeIcon($src, $sw, $sh, 192, $base.'/icon-192.png');
makeIcon($src, $sw, $sh, 512, $base.'/icon-512.png');
imagedestroy($src);

echo "done\n";

<?php
require_once '../vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

$image = Image::make('../public/media/source/unnamed.jpg');
$watermark = Image::make('../public/media/source/watermark.png');

$image->resize(200, 200);
$watermark->resize(50, 50);

$watermarkWidth = $watermark->width();
$watermarkHeight = $watermark->height();
$imageWidth = $image->width();
$imageHeight = $image->height();
$margin = 20;

$horizontalCount = floor(($imageWidth - $margin) / ($watermarkWidth + $margin)) * 2;
$verticalCount = floor(($imageHeight - $margin) / ($watermarkHeight + $margin)) * 2;

for ($i = 0; $i < $horizontalCount; $i++) {
    for ($j = 0; $j < $verticalCount; $j++) {
        $positionX = $i * ($watermarkWidth + $margin);
        $positionY = $j * ($watermarkHeight + $margin);
        $image->insert($watermark, 'top-left', $positionX, $positionY);
    }
}

$image->save('../public/media/result/result.jpg');

return $image->response('jpg');
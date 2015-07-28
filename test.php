<?php
require_once('load_image.php');
require_once('downsample_image.php');
require_once('watermark_image.php');
require_once('output_image.php');

$image = load_image('photo.jpeg');
$imageDownsampled = downsample_image($image, 960, 960);
$watermark = load_image('stamp.png');
$imageWatermarked = watermark_image($imageDownsampled, $watermark, 0, 0);

output_image($imageWatermarked);


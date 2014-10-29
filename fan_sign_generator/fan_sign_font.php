<?php
header('Content-Type: image/png');

$font = "fonts/" . $_GET['font'];

// Create the image
$im = imagecreatetruecolor(400, 50);
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 399, 49, $white);


// Create some colors
$color = imagecolorallocate($im, 50, 50, 50);
$red = imagecolorallocate($im, 150, 128, 128);


// Add the text
imagettftext($im, 34, 0, 10, 45, $black, $font, "LikesPlanet.com !");

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
?>

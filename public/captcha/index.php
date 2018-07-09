<?php
header("Content-Type: image/png");
session_start();

$fonts = glob('fonts/*.ttf');

//Créer une image
$image = imagecreate(150, 45);

$colorbg = imagecolorallocate($image, rand(128,255), rand(128,255), rand(128,255));


$char = "abcdefghijklmonpqrstuvwxyz0123456789";
$char = str_shuffle($char);
$length = rand(-7,-6);
$captcha = substr($char, $length);

$_SESSION['captcha'] = $captcha;

for ($j=0; $j < rand(4,6); $j++) { 
	$x1 = rand(0,160);
	$x2 = rand(0,160);
	$y1 = rand(0,45);
	$y2 = rand(0,45);
	$color = imagecolorallocate($image, rand(150,250), rand(150,250), rand(150,250));

	switch(rand(0,2)) {
		case 0:
			imageline($image, $x1, $y1, $x2, $y2, $color);
			break;
		case 1:
			imagerectangle($image, $x1, $y1, $x2, $y2, $color);
			break;
		case 2:
			imageellipse($image, $x1, $y1, $x2, $y2, $color);
			break;
	}
}

for ($i=0; $i < strlen($captcha); $i++) { 
	$font = array_rand($fonts);
	$colorfont = imagecolorallocate($image, rand(0,127), rand(0,127), rand(0,127));
	imagettftext($image, 18, rand(-25,25), 15*$i+18, 30, $colorfont, $fonts[$font], $captcha[$i]);
}


imagestring($image, 2, 100, 2, $captcha, imagecolorallocate($image, rand(0,127), rand(0,127), rand(0,127)));


imagepng($image);
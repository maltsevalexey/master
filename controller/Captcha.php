<?php
session_start();
header("Content-type: image/png");
$letters = 'a8bc1de0fghkl7m9no3pq5rst4uw2yxz6';
$strlenLetters = strlen($letters) - 1;
$captchaLen = rand(4,6);
$width = 120;
$height = 40;
$font = "font/orange juice 2.0.ttf";
$im = imagecreate($width, $height);
$bg = imagecolorallocate($im, 0, 255, 127);


//создаю 20 рандомных линий В РОЛИ ШУМА
for ($i = 0; $i < 20;$i++) {
    $col = imagecolorallocate($im, 255, 165, 0);
    $x1= rand(5, 60);
    $x2 = rand(5, 115);
    $y1= rand(5, 30);
    $y2 = rand(5, 30);
    $line = imageline($im, $x1, $y1, $x2, $y2,  $col);
}
$captcha = '';
$x = 7 ;
for($i = 0; $i < $captchaLen; $i++){
    //пишу текст
    $captcha .= $letters[rand(0, $strlenLetters)];
    $x = ($width - 20) / $captchaLen * $i + 5;
    $x = rand($x, $x+4);
    $y = $height - ( ($height - $font_size) / 2 );
    $font_size = rand(15, 20);
    $color = imagecolorallocate( $im, rand(0, 100), rand(0, 100), rand(0, 100) );
    $angle = rand(0, 25);
    imagettftext($im, $font_size, $angle, $x, $y, $color, $font,  $captcha[$i]);
}
$_SESSION['captcha'] = $captcha;
imagepng($im);
imagedestroy($im);
require_once $_SERVER['DOCUMENT_ROOT']."/project/controller/Captcha.php";

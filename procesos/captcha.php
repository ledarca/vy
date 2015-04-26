<?php session_start();

function random($length){
	$chars = "abcdefghijklmnopqrstvuwxyz23456789";
	$str="";
	$size = strlen($chars);
	for($i=0;$i<$length;$i++){
		$str .=$chars[mt_rand(0,$size-1)];
	}
	return $str;
}

$cap = random(6);

$_SESSION['real'] = $cap; 

$image = imagecreate(70,20);
$background = imagecolorallocate($image,153,255,0);
$foreground = imagecolorallocate($image, 0,0,0);

imagestring($image,5,10,1,$cap,$foreground);

header("Content-type: image/jpeg");
imagejpeg($image);  

/*
   // Genero el codigo y lo guardo en la sesión para consultarlo luego. 
 $captchaCode = substr(sha1(microtime() * mktime()), 0, 6); 
    $_SESSION['real'] = sha1($captchaCode); 
     
    // Genero la imagen 
    $img = imagecreate(70, 25); 
     
  // Colores 
    $bgColor = imagecolorallocate($img, 230, 230, 230); 
	$stringColor = imagecolorallocate($img, 90, 90, 90); 
    $lineColor = imagecolorallocate($img, 245, 245, 245); 
      
    // Fondo 
   imagefill($img, 0, 0, $bgColor); 
     
    imageline($img, 0, 5, 70, 5, $lineColor); 
    imageline($img, 0, 10, 70, 10, $lineColor); 
    imageline($img, 0, 15, 70, 15, $lineColor); 
    imageline($img, 0, 20, 70, 20, $lineColor); 
    imageline($img, 12, 0, 12, 25, $lineColor); 
    imageline($img, 24, 0, 24, 25, $lineColor); 
    imageline($img, 36, 0, 36, 25, $lineColor); 
    imageline($img, 48, 0, 48, 25, $lineColor); 
    imageline($img, 60, 0, 60, 25, $lineColor); 
     
    // Escribo el código 
    imageString($img, 5, 8, 5, $captchaCode, $stringColor); 
     
    // Image output. 
header("Content-type: image/jpeg");
imagejpeg($image);

*/
?>
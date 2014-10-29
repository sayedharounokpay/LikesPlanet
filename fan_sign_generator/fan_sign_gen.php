<?php


$fan_id = $_GET['fan_id'];
$msg = $_GET['msg'];
$font = "fonts/" . $_GET['font'];
$key = $_GET['key'];
$colorcode = $_GET['color'];
$fontsizee = $_GET['size'];
$paid = $_GET['paid'];
$speedq = $_GET['speedq'];
$yesremovewatermarksafe = 0;

session_start();
$host		=	"localhost"; // your mysql server address  localhost
$user		=	"likespla_planet"; // your mysql username
$pass		=	"planet2013planet"; // your mysql password
$tablename	=	"likespla_planet"; // your database name
if(!(@mysql_connect("$host","$user","$pass") && @mysql_select_db("$tablename"))) {
?>
MySQL Error
<?
    exit;
}

mysql_query("UPDATE `fans` SET `hits`=`hits`+'1' WHERE `id`='{$fan_id}'");

if($paid == 1) {
if(isset($_SESSION['login'])){

	$dbres= mysql_query("SELECT *,UNIX_TIMESTAMP(`online`) AS `online` FROM `users` WHERE `login`='{$_SESSION['login']}'");
	$data= mysql_fetch_object($dbres);

	$dbres0= mysql_query("SELECT * FROM `fanspaid` WHERE (`fan_id` = '{$fan_id}' AND `msg` = '{$msg}' AND `font` = '{$font}' AND `colorcode` = '{$colorcode}' AND `fontsizee` = '{$fontsizee}' AND `user_id` = '{$data->id}' ) ");
	$ext = mysql_num_rows($dbres0);

    if ($ext >= 1) {
    $yesremovewatermarksafe = 1;
    } else {
	if($data->coins >= 25) {
    	mysql_query("UPDATE `users` SET `coins`=`coins`-'25' WHERE `id`='{$data->id}'");
    	mysql_query("UPDATE `fans` SET `paid`=`paid`+'1' WHERE `id`='{$fan_id}'");
    	mysql_query("INSERT INTO `fanspaid` (fan_id, msg, font, colorcode, fontsizee, user_id) VALUES('{$fan_id}', '{$msg}', '{$font}', '{$colorcode}', '{$fontsizee}', '{$data->id}' ) ");
    	$yesremovewatermarksafe = 1;
    	} else {
    	echo "<center><font color='red' size='4'><b> You do not have enough Points to show this photo!</br></br> http://likesplanet.com/ </b></font></center>";
    	exit;
    	}
    }
} else {
	echo "<center><font color='red' size='4'><b> You are Not allowed to see this photo!</br></br> http://likesplanet.com/ </b></font></center>";
	exit;
}
}
  
header('Content-Type: image/png');

if($fan_id == 1){
$pincode="7851";
$pos_x = 70;
$pos_y = 482;
$rotation = 19;
}
if($fan_id == 2){
$pincode="4672";
$pos_x = 170;
$pos_y = 300;
$rotation = -14;
}
if($fan_id == 3){
$pincode="3472";
$pos_x = 115;
$pos_y = 470;
$rotation = 7;
}
if($fan_id == 4){
$pincode="6340";
$pos_x = 260;
$pos_y = 70;
$rotation = -12;
}
if($fan_id == 5){
$pincode="7536";
$pos_x = 470;
$pos_y = 370;
$rotation = 6;
}
if($fan_id == 6){
$pincode="7320";
$pos_x = 118;
$pos_y = 320;
$rotation = -1;
}
if($fan_id == 7){
$pincode="6523";
$pos_x = 286;
$pos_y = 255;
$rotation = -6;
}
if($fan_id == 8){
$pincode="2374";
$pos_x = 65;
$pos_y = 150;
$rotation = -1.8;
}
if($fan_id == 9){
$pincode="2334";
$pos_x = 33;
$pos_y = 195;
$rotation = -1.8;
}
if($fan_id == 10){
$pincode="3942";
$pos_x = 50;
$pos_y = 165;
$rotation = -12;
}
if($fan_id == 11){
$pincode="4554";
$pos_x = 148;
$pos_y = 205;
$rotation = -28;
}
if($fan_id == 12){
$pincode="8442";
$pos_x = 178;
$pos_y = 295;
$rotation = 0;
}
if($fan_id == 13){
$pincode="4382";
$pos_x = 200;
$pos_y = 298;
$rotation = 26;
}
if($fan_id == 14){
$pincode="5000";
$pos_x = 72;
$pos_y = 220;
$rotation = -2;
}
if($fan_id == 15){
$pincode="4834";
$pos_x = 125;
$pos_y = 340;
$rotation = 2;
}
if($fan_id == 16){
$pincode="7557";
$pos_x = 215;
$pos_y = 310;
$rotation = -5;
}
if($fan_id == 17){
$pincode="7558";
$pos_x = 90;
$pos_y = 215;
$rotation = 8;
}
if($fan_id == 18){
$pincode="1111";
$pos_x = 110;
$pos_y = 370;
$rotation = -4;
}
if($fan_id == 19){
$pincode="4242";
$pos_x = 230;
$pos_y = 217;
$rotation = 3;
}
if($fan_id == 20){
$pincode="1425";
$pos_x = 58;
$pos_y = 260;
$rotation = -6;
}
if($fan_id == 21){
$pincode="1679";
$pos_x = 265;
$pos_y = 272;
$rotation = 0;
}
if($fan_id == 22){
$pincode="1020";
$pos_x = 270;
$pos_y = 175;
$rotation = -4;
}
if($fan_id == 23){
$pincode="1245";
$pos_x = 222;
$pos_y = 178;
$rotation = -9;
}
if($fan_id == 24){
$pincode="1750";
$pos_x = 178;
$pos_y = 251;
$rotation = 36;
}
if($fan_id == 25){
$pincode="6230";
$pos_x = 130;
$pos_y = 296;
$rotation = -22;
}
if($fan_id == 26){
$pincode="9386";
$pos_x = 70;
$pos_y = 240;
$rotation = -11;
}
if($fan_id == 27){
$pincode="7862";
$pos_x = 184;
$pos_y = 300;
$rotation = 2;
}
if($fan_id == 28){
$pincode="5330";
$pos_x = 142;
$pos_y = 190;
$rotation = -24;
}
if($fan_id == 29){
$pincode="6420";
$pos_x = 194;
$pos_y = 184;
$rotation = -14;
}
if($fan_id == 30){
$pincode="6481";
$pos_x = 110;
$pos_y = 90;
$rotation = -23;
}
if($fan_id == 31){
$pincode="7639";
$pos_x = 300;
$pos_y = 114;
$rotation = 6;
}
if($fan_id == 32){
$pincode="6563";
$pos_x = 194;
$pos_y = 122;
$rotation = -1;
}
if($fan_id == 33){
$pincode="6530";
$pos_x = 75;
$pos_y = 180;
$rotation = -6.5;
}
if($fan_id == 34){
$pincode="5357";
$pos_x = 272;
$pos_y = 220;
$rotation = 1;
}
if($fan_id == 35){
$pincode="3570";
$pos_x = 366;
$pos_y = 238;
$rotation = 2.8;
}
if($fan_id == 36){
$pincode="8765";
$pos_x = 330;
$pos_y = 290;
$rotation = 4;
}
if($fan_id == 37){
$pincode="8120";
$pos_x = 200;
$pos_y = 260;
$rotation = -1;
}

// Create the image
$im = imagecreatefromjpeg ("fans/fan" . $fan_id . "_" . $pincode . ".jpg");




// Create some colors
$color = $color;
$leftR = hexdec(substr($colorcode ,0,2));
$leftG = hexdec(substr($colorcode ,2,2));
$leftB = hexdec(substr($colorcode ,4,2));
$color = imagecolorallocate($im, $leftR, $leftG, $leftB);
$red = imagecolorallocate($im, 150, 128, 128);


// Add the text
imagettftext($im, $fontsizee, $rotation, $pos_x, $pos_y, $color, $font, $msg);


if ($yesremovewatermarksafe == 0) {
imageline($im, 30, 30, imagesx($im), imagesy($im), $red);
imageline($im, imagesx($im), 0, 0, imagesy($im), $red);
imagettftext($im, 12, 0, 5, 20, $red, "fonts/prev.ttf", "Preview - LikesPlanet.com");
	if($speedq == '1') {
	imagejpeg($im, NULL, 40);
	} else {
	imagejpeg($im, NULL, 90);
	}
} else {
imagepng($im);
}

// Using imagepng() results in clearer text compared with imagejpeg()
imagedestroy($im);
?>

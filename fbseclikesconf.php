<?
include('config.php');
foreach($_GET as $key => $value) {
	$protect[$key] = filter($value);
}

$siteurl = $_POST['siteurl'];

if(preg_match("/\bpages\b/i", $siteurl)){
$x110 = explode('/', $siteurl);
$name0 = $x110[5];}
else {
$x110 = explode('/', $siteurl);
$name0 = $x110[3];
}

if(preg_match("/\bref\b/i", $name0)){
$x1100090 = explode('?', $name0);
$name0 = $x1100090[0];
}

$name1 = explode('facebook.', $name0);
$name2 = $name1[1];

$mystring85 = 'hello';
$mystring85 = file_get_contents('http://www.facebook.com/');


$ch = curl_init("http://www.facebook.com/");
  curl_setopt( $ch, CURLOPT_POST, false );
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
  curl_setopt( $ch, CURLOPT_HEADER, false );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  $datauu = curl_exec( $ch );

$pos = strpos($mystring85, $name2);

if ($pos === false) {
echo $datauu;
} else {
echo '1';
}

?>
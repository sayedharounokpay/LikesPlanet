<?
function filter($data) {
	$data = trim(htmlentities(strip_tags($data)));
	
	if (get_magic_quotes_gpc())
		$data = stripslashes($data);
	
	return $data;
}

foreach($_GET as $key => $value) {
	$_GET[$key] = filter($value);
}

?>

<html>
    <body>
    
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript">
function clickme(json){
	if (json.state == "on"){
			setTimeout('click_callback()',1500);
	}
	else {click_callbackOFF();}
};
</script>

<center>
<g:plusone callback="clickme" href="<? echo $_GET["google"];?>" size="medium"></g:plusone>
</center>

<script>
function click_callback() {
var id = '<? echo $_GET["id"];?>';
var user = '<? echo $_GET["user"];?>';
var owner = '<? echo $_GET["owner"];?>';
var username = '<? echo $_GET["username"];?>';
window.location = 'http://www.likesasap.com/greceive2.php?id='+id+'&user='+user+'&owner='+owner+'&username='+username;
}

function click_callbackOFF() {
var google = '<? echo $_GET["google"];?>';
window.location = 'http://www.likesasap.net/skipg3.php?site='+google;
}
</script>		

	</body>
 </html>
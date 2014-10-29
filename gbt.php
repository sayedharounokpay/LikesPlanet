<?
include('config.php');
foreach($_GET as $key => $value) {
	$protectie[$key] = filter($value);
}
$id = $protectie['url'];
$sit2= mysql_query("SELECT * FROM `google` WHERE `id`='{$id}'");
$sit = mysql_fetch_object($sit2);
if($sit->google!= ""){
?>
<html>
<style type="text/css">
body {
	background-color: transparent;
	margin: 0;
	padding: 0 0 0 22px;
	text-align: center;
	}
</style>
<body>
<div id="fb-root"></div>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript">
function clickme(json){
	if (json.state == "on"){
		if (typeof parent.click_callback == 'function') setTimeout('parent.click_callback("<? echo $sit->id;?>","<? echo $sit->google;?>")',1000);
	}
	else{setTimeout('parent.click_callbackOFF("<? echo $sit->id;?>","<? echo $sit->google;?>")',500);}
};
</script>
<g:plusone callback="clickme" href="<? echo $sit->google;?>" size="medium"></g:plusone>
</body>
</html><?}?>
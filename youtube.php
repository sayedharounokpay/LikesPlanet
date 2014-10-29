<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>
<body id="tab1"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="youtube.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addyt.php">Add Youtube Video</a></li> 
	<li class="tab3"><a href="ytpages.php">My Videos</a></li> 
</ul>
</div>
<h1>Youtube Videos</h1>
Click on 'Play' button, watch video on YouTube for 33 seconds to earn Points/Cash.

<?
  $site2 = mysql_query("SELECT * FROM `youtube` WHERE (`active` = '0' AND `points` > `cpc`) AND `id` NOT IN (SELECT `site_id` FROM `played` WHERE `user_id`='{$data->id}') ORDER BY `cpc` DESC LIMIT 0, 1");
  $ext = mysql_num_rows($site2);
if($ext > 0){
?>
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
 
};
;

  function refreshpage()
   {
      window.location.reload();
   }
</script>
<center><div id="Hint" style="display:none;"></div></center>
<center>
<div id="tbl2">
<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

$splitarray = explode('?v=', $site->youtube);
$videoname = $splitarray[1];
if(preg_match("/&/i", $videoname)){
$x110 = explode('&', $videoname);
$name = $x110[0];
}
else {
$name = $videoname;
}
$nameimg9 = 'http://i.ytimg.com/vi/' . $name . '/default.jpg';

?>
<div class="clearer">&nbsp;</div>
<div class="infobox" id="<? echo $site->id;?>" style="height: 300px; width: 290px; background: #F3F4F4; border: 5px solid #36A6CB; border-radius: 12px; position: relative; padding: 6px; margin: 8px 8px 0 0;">
<center>
	<div class="clearer">&nbsp;</div>
	<div><font color='green' size='3'> <b><? echo $site->cpc-1;?> Points = $<?echo number_format(($site->cpc-1)/$coinsdollar,4);?> </b></font></div>
	<div class="clearer">&nbsp;</div>
	<div class="title"> <a style="color:blue;"> <b> <? echo $site->title;?> </b></a></div>
	<div class="clearer">&nbsp;</div>
	<div>
	<center>
	<img src="<? echo $nameimg9; ?>" border="0" style="border-radius: 12px;">
	</center>
	</div>
	<div class="clearer">&nbsp;</div>
	
	<div>
        <a href="javascript:void(0);" onclick="SurfPlayVideo();"  >
	<input type="submit" class="submit" value="Play" style="height: 40px; width: 140px;" />
	</a>
	</div>
<script language=javascript>
var mywindow;
var mysite1=0;
var starttime=0;
var endtime=0;
var sectime = 1;
var timerseconds = 0;
var mysiteT = 0;
var nowplaying = 0;

function SurfPlayVideo() {
mywindow = window.open('<? echo $site->youtube;?>');
$("#Hint").html('<img src="img/loader.gif">');
$.ajax({ type: "GET", url: "gettime.php", success: function(msg){ 
	starttime = msg;
	mysite1='<? echo $site->id; ?>';
	mysiteT='<? echo $site->user; ?>';
	timerseconds = 34;
	nowplaying = 1;
	document.getElementById("Hint").style.display='block';
	setTimeout("DisplayTimer();", 1000);
	setTimeout("OkAddCoinsWell2();", 32000);
	} });
}
function DisplayTimer(){
	if (nowplaying == 1){
	timerseconds =timerseconds -1;
	$("#Hint").html('<font size="3"><h1>You will earn points/cash in '+timerseconds+' Seconds.</h1></font>');
	setTimeout("DisplayTimer();", 1000);
	}
}

function OkAddCoinsWell2(){
	nowplaying = 0;
	$("#Hint").html('<img src="img/loader.gif">');
	if(mywindow.closed){
		alert('You had closed popup window !');
		window.location = 'http://likesplanet.com';}
	else{
		$.ajax({ type: "GET", url: "gettime.php", success: function(msg){ 
			endtime = msg; 
			sectime = endtime - starttime;
			if (sectime < 26) {
				alert ( 'You did NOT watch the video!' );}
			else {
				$.ajax({
        				type: "POST",
        				url: "ytreceive.php",
        				data: "data="+mysite1+ "---" + '<? echo $data->id;?>' + "---" + mysiteT,        
        				cache: false,
        				success: function(){ 
        				$("#Hint").html('<font size="3"><h1>Points added to your balance!</h1></font>');        				
        				setTimeout("RefreshMe();", 1000);
        				}
    				});
			}
			mywindow.close();
		} });
	}
}
function RefreshMe(){window.location.reload(true);}
</script>
</center>
</div>
<?}?>
</div>
<div class="clearer">&nbsp;</div>
<div class='infobox'> Watch this video, then Refresh to see more videos!</div>
</center>

<?}else{?>
<center></br>
<? $message00 = "Sorry, there are no more coins to be earned at the moment.</br>Please come back again later.</br><a href='buy.php'><b>Feel like you need more coins? You can purchase them now!</b></a>"; ?>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message00;?> </font> </td></tr>
</table>
</center>
<?}?>

	<div class="clearer">&nbsp;</div>

<? include('footer.php');?>

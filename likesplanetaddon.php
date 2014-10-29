<?php
include('headeraddon.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$userid = $get['userid'];
$siteid = $get['siteid'];

?>

<body id="tab1" style="background-color: transparent;"> 

<center>
<p>Click on 'Like' button, Like Page then Close Popup.</p>
<p><font color='darkgreen'><b>SKIP</b> Pages already liked.</font></p>
</center>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.tables.js"></script>

<center><div id="Hint" class="smartbox" style="background: #FFFFFF; border-radius: 12px; border: 2px solid #cdcdcd; display:block; padding: 2px; position: center; height: 22px;"></div></center>

<? 
  $siteliked4[] = "'none'";
  $siteliked2 = mysql_query("SELECT * FROM `likesplanetaddonliked` WHERE (`user_id`='{$userid}' AND `site_id`='{$siteid}') ");
  for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = "'" . $siteliked->page_id . "'" ; }
    
  $site2 = mysql_query("SELECT * FROM `facebook` WHERE (`active` = '0' AND `points` > `cpc`) AND (`target`='') AND `id` NOT in (".implode(',', $siteliked4).") ORDER BY `cpc` DESC LIMIT 0, 1;");
  
  $ext = mysql_num_rows($site2);
  
$sitestoday = mysql_query("SELECT * FROM `likesplanetaddonlikedtoday` WHERE (`user_id`='{$userid}' AND `site_id`='{$siteid}') ");
$sitestodayext = mysql_num_rows($sitestoday);
if ($sitestodayext < 50) {

  
if($ext > 0){
?><div id="fb-root"></div>

<div id="tbl00">
<center>
<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

if (strpos($site->facebook, '?') != false) {
$mobilelinksO = explode('?', $site->facebook);
$mobilelink = $mobilelinksO[0];
} else {
$mobilelink = $site->facebook;
}

$pictureofpageall = explode('/', $mobilelink);
if (strpos($site->facebook, '/pages/') != false) {
$pictureofpage = "https://graph.facebook.com/" . $pictureofpageall[5] . "/picture";
} else {
$pictureofpage = "https://graph.facebook.com/" . $pictureofpageall[3] . "/picture";
}

$mobilelink = str_replace('www.', '', $mobilelink );
$mobilelink = str_replace('facebook.', 'm.facebook.', $mobilelink );
$mobilelink = str_replace('m.m.facebook', 'm.facebook', $mobilelink );
?>

<div class="smartbox" id="<? echo $j;?>" style="height: 160px; width: 200px; background: #FFC9FF; border: 5px solid #FF99FF; border-radius: 45px; padding: 6px; margin: 8px 8px 0 0; float: left;">
<center>
        
        <div><b> <font color='blue'><? echo $site->title;?></font> </b> </div>
        </br>
        <div> <img src="<? echo $pictureofpage; ?>" style="border-radius: 10px;"> </div>
        <div><font color='green'> $<b><?echo number_format($site->cpc/10000,4);?></b> </font></div>
        <center>
	<div>
        <a href="javascript:void(0);" onclick="OpenLike('<? echo $siteid;?>', '<? echo $site->id;?>', '<? echo $site->user;?>', '<? echo $userid;?>', '<? echo $mobilelink;?>');"  >
	<input type="submit" class="submit" value="Like" style="height: 28px;" />
	</a>
	</div>
        </center>
        
        </br>
	<div>
	<a href="#" onclick="SkipThisPage('<? echo $siteid;?>', '<? echo $userid;?>', '<? echo $site->id;?>', '<? echo $j;?>');"><font color='grey' size=1>[Skip]</font></a>
	</div>

</center>
</div>

<div class="clearer">&nbsp;</div>

<iframe style="display:block; position: center; height: 1px; width: 1px;" 
        scrolling="no" frameborder="0" id="likeme1"></iframe>
<iframe style="display:block; position: center; height: 1px; width: 1px;" 
        scrolling="no" frameborder="0" id="likeme2"></iframe>

<script type="text/javascript">
var mywindow;
function OpenLike(mysiteid, mypageid, pageowner, myuserid, mypageurl){
	mywindow = window.open(mypageurl, "LikesPlanet");
	var timer11 = setInterval(function() {   
    		if(mywindow.closed) {  
        	clearInterval(timer11);  
        	GetSubCount(mysiteid, mypageid, pageowner, myuserid);
    		}  
		}, 1000);  
	document.getElementById("Hint").style.display='block';
	$("#Hint").html('<img src="img/loader.gif">');
	$.ajax({
		type: "GET",
		url: "likesplanetaddon_start.php",
		data: "sitename1="+mysiteid+"---"+mypageid+"---"+pageowner+"---"+myuserid,
		success: function(msg){
			if (msg > 0){
			$("#Hint").html('<font size="4" color="blue">Like Page, and Close oppened window.</font>');
			} else {
			$("#Hint").html('<font size="4" color="red">Page link is Broken. Please skip it.</font>');
			SkipThisPage(mysiteid, myuserid, mypageid);
			}
		}
	});
}
function GetSubCount(mysiteid, mypageid, pageowner, myuserid){
	document.getElementById("Hint").style.display='block';
	$("#Hint").html('<img src="img/loader.gif">');
	$.ajax({
		type: "GET",
		url: "likesplanetaddon_conf.php",
		data: "sitename1="+mysiteid+"---"+mypageid+"---"+pageowner+"---"+myuserid,
		success: function(msg){
			if (msg.indexOf("NOT32") > 0){
			SkipThisPage(mysiteid, myuserid, mypageid);
			$("#Hint").html('<font size="4" color="red">Not Liked!</font>');
			} else {
			$("#Hint").html('<font size="4" color="green">Confirming...</font>');
				if (msg.indexOf("www.") > 0){
				var res11 = msg;
				var res22 = msg.replace("www.","");
				} else {
				var res11 = msg.replace("://","://www.");
				var res22 = msg;
				}
				document.getElementById('likeme1').contentWindow.location = res11;
				document.getElementById('likeme2').contentWindow.location = res22;
				var timer11 = setInterval(function() { window.location.reload(); }, 6000);  
			}
		}
	});
	}
function SkipThisPage(basicsiteid, userid, pageid, blockid){
		$("#Hint").html('<img src="img/loader.gif">');
		$.ajax({
        		type: "POST",
        		url: "skipfbaddon.php",
        		data: "data="+ basicsiteid + "---" + pageid + "---" + userid,        
        		cache: false,
        		success: function(){
        			$("#Hint").html('<font size="4" color="blue">Skipped !</font>');
        			window.location.reload();
        		}
    		});
	}
</script>

<?}?>
</center>


</div>

<div class="clearer">&nbsp;</div>

<?}} else { ?>
<div class="msg_error">Come back tomorrow.</div>
<div class="msg_error">You can do only 50 likes every day.</div>
<?}?>


	<div class="clearer">&nbsp;</div>

<? include('footeraddon.php');?>
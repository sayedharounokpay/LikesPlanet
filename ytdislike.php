<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>
<body id="tab1"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="ytdislike.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addytdislike.php">Add Video</a></li> 
	<li class="tab3"><a href="ytdislikepages.php">My Videos</a></li> 
</ul>
</div>
<h1>YouTube Dislike Videos</h1>
<p>Here you can Dis-Like videos on Youtube to earn Points/Money.</p>
<p>Click on 'Dislike' button, Dis-Like video on YouTube, Wait for 5 seconds, Refresh video page, then 'Close' oppened popup-window.</p>

<? 
if ($_REQUEST["skip"] > 0) {
 mysql_query("INSERT INTO `ytdisliked` (user_id, site_id) VALUES('{$data->id}', '{$_REQUEST['skip']}')"); } ?>

<?

  $siteliked4[] = -1;
  $siteliked2 = mysql_query("SELECT * FROM `ytdisliked` WHERE (`user_id`='{$data->id}') ");
  for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->site_id; }

  $site2 = mysql_query("SELECT * FROM `ytdislike` WHERE (`active` = '0' AND `points` > '1')  AND `user`!='{$data->id}' AND `id` NOT in (".implode(',', $siteliked4).") ORDER BY `cpc` DESC LIMIT 0, 8");
  $ext = mysql_num_rows($site2);
  
if($ext > 0){
?><div id="fb-root"></div>

<script>
  function refreshpage()
   {
      window.location.reload();
   }
   function removeElement(parentDiv, childDiv){
         if (document.getElementById(childDiv)) {     
                    var child = document.getElementById(childDiv);
                    var parent = document.getElementById(parentDiv);
                    parent.removeChild(child);}
    }
</script>

<div id="tbl">
<center><div id="Hint" class="smartbox" style="background: #FFFFFF; border-radius: 12px; border: 2px solid #cdcdcd; display:block; padding: 2px; position: center; height: 55px;"></div></center>
<div class="clearer">&nbsp;</div>

<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
if(preg_match("/&/i", $site->ytdislike)){
$x110 = explode('&', $site->ytdislike);
$name = $x110[0];
}
else {
$name = $site->ytdislike;
}

?>
<div class="smartbox" id="<? echo $site->id;?>" style="width: 270px; height: 280px; background: #EFEFEF; border-radius: 15px; float: left; position: relative; border: 5px solid #36A6CB; padding: 2px; -webkit-border-radius: 15px; -moz-border-radius: 15px; margin:8px;">
<center>
        <div><font color='green' size='3'> <b><? echo $site->cpc-1;?> Points = $<?echo number_format(($site->cpc-1)/$coinsdollar,4);?> </b></font></div>
	</br>
	<div> <a href="https://www.youtube.com/watch?v=<? echo $site->ytdislike;?>" target="_blank"> <img src="http://i.ytimg.com/vi/<? echo $name; ?>/default.jpg" border="0" title="Open and Like Video" style="border-radius: 12px;"> </a></div>
        
        <div><b> <a href="https://www.youtube.com/watch?v=<? echo $site->ytdislike;?>" target="_blank"> <font color='blue'><? echo $site->title;?></font> </a> </b> </div>
        </br>
        
        <div>
        <a href="javascript:void(0);" onclick="OpenLike('<? echo $site->id;?>', '<? echo $site->user;?>', '<? echo $site->ytdislike;?>', '<? echo $site->cpc;?>');"  >
	<input type="submit" class="submit" value="Dis-Like" Like="height: 38px;" />
	</a>
	</div>
	
	</br>
	<div>
	<a href="javascript:void(0);" onclick="SkipThisPage('<? echo $site->id;?>');"><font color='grey' size=2>[Skip]</font></a>
	&nbsp;&nbsp;
	<a href="javascript:void(0);" onclick="ReportThisPage('<? echo $site->id;?>');"><font color='darkred' size=1>[Report]</font></a>
	</div>
</center>
</div>


<script type="text/javascript">
var mywindow;
var waittoconfirm = 0;
var AddCPCnow = 0;
var MybalancenowI = 0;
MybalancenowI = <? echo $data->coins; ?> ;

function WaitToConfirmIt() {
	if (waittoconfirm > 0) {
	waittoconfirm = waittoconfirm - 1;
	setTimeout("WaitToConfirmIt();", 1000);
	}
}
function OpenLike(mysiteid, siteowner, mysite, cpc){
	AddCPCnow = cpc - 1;
	MybalancenowI = MybalancenowI + AddCPCnow;
	$("#Mybalancenow").html(numberWithCommas(MybalancenowI));
	mywindow = window.open("https://www.youtube.com/watch?v=" + mysite, "LikesPlanet");
	var timer11 = setInterval(function() {   
    		if(mywindow.closed) {  
        	clearInterval(timer11);  
        	GetSubCount(mysiteid, siteowner, mysite);
    		}  
		}, 1000);  
	document.getElementById("Hint").style.display='block';
	if (waittoconfirm < 1) {
	waittoconfirm = 0;
	setTimeout("WaitToConfirmIt();", 1000);
	$("#Hint").html('<img src="img/loader.gif">');
	$.ajax({
		type: "GET",
		url: "ytdislikestart.php",
		data: "sitename1="+mysiteid+ "---" + siteowner,
		success: function(msg){
			if (msg > 0){
			$("#Hint").html('<font size="4" color="blue">Dislike, and Close oppened window.</font>');
			} else {
			$("#Hint").html('<font size="4" color="red">Video link is Broken. Please skip it and like another.</font>');
			mywindow.close();
			}
		}
	});
	
	}
	else {
	$("#Hint").html('<font size="4" color="blue">Please wait ' + waittoconfirm + ' Seconds to confirm again!</font>');
	}
	
	
	}
function SkipThisPage(mysiteid){
		document.getElementById("Hint").style.display='block';
		$("#Hint").html('<img src="img/loader.gif">');
		$.ajax({
        		type: "POST",
        		url: "ytdislikeskip.php",
        		data: "data="+ mysiteid + "---" + '<? echo $data->id;?>',        
        		cache: false,
        		success: function(){
        		$("#Hint").html('<font size="4" color="blue">Skipped!</font>');
        		removeElement('tbl', mysiteid);
        		}
    		});
	}
function ReportThisPage(mysiteid){
		document.getElementById("Hint").style.display='block';
		$("#Hint").html('<img src="img/loader.gif">');
		$.ajax({
        		type: "POST",
        		url: "ytdislikeskipr.php",
        		data: "data="+ mysiteid + "---" + '<? echo $data->id;?>',        
        		cache: false,
        		success: function(){
        		$("#Hint").html('<font size="4" color="blue">Skipped!</font>');
        		removeElement('tbl', mysiteid);
        		}
    		});
	}
	
function GetSubCount(mysiteaccid1, pageuserowner, code){
	document.getElementById("Hint").style.display='block';
	if (waittoconfirm < 1) {
	waittoconfirm = 0;
	setTimeout("WaitToConfirmIt();", 1000);
	$("#Hint").html('<img src="img/loader.gif">');
	$.ajax({
		type: "GET",
		url: "ytdislikeconf.php",
		data: "sitename1="+mysiteaccid1+ "---" + pageuserowner + "---" + code,
		success: function(msg){
			
			if (msg > 0){
			$("#Hint").html('<font size="4" color="green">Disliked! '+msg+' Points added to your balance.</font>');
			removeElement('tbl', mysiteaccid1);
			}
			if (msg == '-1'){
			$("#Hint").html('<font size="4" color="green">Ok. Points Added.</font>');
			removeElement('tbl', mysiteaccid1);
			}
			if (msg == 0){
			$("#Hint").html('<font size="4" color="red">Not Disliked!</font>');
			}
		}
	});
	
	}
	else {
	$("#Hint").html('<font size="4" color="blue">Please wait ' + waittoconfirm + ' Seconds to confirm again!</font>');
	}
	
	}
</script>
	
<?}?>

<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>

</div>
<div class='infobox'> Dislike Youtube Video then refresh page to see the addition of points!

<form action='' method='' onsubmit='refreshpage();'>
<input name='refresh' type='submit' value='Refresh'>
</form></div>

<?}else{?>
<div class="msg_error">Sorry, there are no more coins to be earned at the moment. Please try again later.</div>
<div class="msg_success"><a href="buy.php"><b>Feel like you need more coins? You can purchase them now!</b></a></div><?}?>

	<div class="clearer">&nbsp;</div>

<? include('footer.php');?>

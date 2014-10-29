<?php
$page_title = "LikesPlanet.com | Do Facebook Likes to Earn Money or Get Likes for Your Pages.";

include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$x110 = explode('(', $data->country);
$x110o = explode(')', $x110[1]);
	if ($x110o[0] == ''){ $x110o[0] = 'XX'; }
$usertargetc = '(' . $x110o[0] . ')';

?>
<div class="clearer">&nbsp;</div>

<body id="tab2"> 
<div>
<ul id="tabnav">  
	<li class="tab2"><a href="fbstdlikes.php">Earn Points</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="addfb.php">Add Facebook Page</a></li> 
	<li class="tab4"><a href="fbpages.php">My Pages</a></li> 
</ul>
</div>

<h1>Facebook Pages Likes - Become a Fan and Earn points/cash.</h1>
<p>To get free points/cash by liking others Facebook Pages click on 'Like' button, You will see simple Mobile copy of Fan-Page.</p>
<p>Wait for Some Seconds before giving like on FB, Like page, then close popup window to 'Confirm' automatically and earn Points/Cash!</p>
<p><font size='3'><font color='darkred'>If you see any page <b>Already liked</b>, <b>SKIP</b> button First, <b>then Close</b> popup window.</font></font></p>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.tables.js"></script>

<? 
if ($_REQUEST["skip"] > 0) {
 mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$data->id}', '{$_REQUEST['skip']}')"); }
  
  $siteliked4[] = "'none'";
  $siteliked2 = mysql_query("SELECT * FROM `liked` WHERE (`user_id`='{$data->id}') ");
  for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = "'" . $siteliked->site_id . "'" ; }
  
  $site2 = mysql_query("SELECT * FROM `facebook` WHERE (`active` = '0' AND `points` > `cpc`) AND (`target`='' OR `target` LIKE '%{$usertargetc}%' ) AND `id` NOT in (".implode(',', $siteliked4).") ORDER BY `cpc` DESC LIMIT 0, 12;");
  $ext = mysql_num_rows($site2);
  
if($ext > 0){
?><div id="fb-root"></div>

<script>
function refreshpage()
   {window.location.reload();}
function removeElement(parentDiv, childDiv){
         if (document.getElementById(childDiv)) {     
                    var child = document.getElementById(childDiv);
                    var parent = document.getElementById(parentDiv);
                    parent.removeChild(child);}
    }
</script>

<div id="tbl" style="width: 850px;">

</br>


<center><div id="Hint" class="smartbox" style="background: #FFFFFF; border-radius: 12px; border: 2px solid #cdcdcd; display:block; padding: 2px; position: center; height: 22px;"></div></center>
</br>

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
<div class="smartbox" id="<? echo $site->id;?>" style="height: 195px; width: 250px; background: #FFC9FF; border: 5px solid #FF99FF; border-radius: 45px; float: left; position: relative; padding: 6px; margin: 8px 8px 0 0;">
<center>
        <div><font color='green' size='3'> <b><? echo $site->cpc-1;?> Points = $<?echo number_format(($site->cpc-1)/$coinsdollar,4);?> </b></font></div>
	</br>
	<div> <img src="<? echo $pictureofpage; ?>" style="border-radius: 10px;"></div>
        </br>
        <div><b><font color='blue'><? echo $site->title;?></font></b> </div>
        </br>
        
        <div>
        <a href="javascript:void(0);" onclick="OpenLike('<? echo $site->id;?>', '<? echo $site->user;?>', '<? echo $mobilelink;?>', '<? echo $site->cpc;?>');"  >
	<input type="submit" class="submit" value="Like" style="height: 28px;" />
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
<?}?>

<script type="text/javascript">
var mywindow;
var waittoconfirm = 0;
var nowlikeittt = 0;
var myVarTimer;
var alertme = 0;
var donotconfirm = 0;
function WaitToConfirmIt() {
	if (waittoconfirm > 0) {
	waittoconfirm = waittoconfirm - 1;
	setTimeout("WaitToConfirmIt();", 1000);
	}
}
function OpenLike(mysiteid, siteowner, mysite, cpc){
	document.getElementById("Hint").style.display='block';
	if (nowlikeittt < 1) {
	if (waittoconfirm < 1) {
	donotconfirm = 0;
	mywindow = window.open("fbstartlikeref.php?sitename1=" + mysiteid + "---" + siteowner, "LikesPlanet");
	var timer11 = setInterval(function() {   
		    		if(mywindow.closed) {  
		        	clearInterval(timer11);  
		        	GetSubCount(mysiteid, siteowner);
		    		}  
				}, 1000);  
	waittoconfirm = 0;
	nowlikeittt = 33;
	$("#Hint").html('<font size="4" color="blue">Like Page, and Close oppened window.</font>');
	myVarTimer = setTimeout(function(){  mywindow.close()  },27000);
	setTimeout("WaitToConfirmIt();", 1000);
	}
	else {
	$("#Hint").html('<font size="4" color="blue">Please wait ' + waittoconfirm + ' Seconds to confirm again!</font>');
	}
	}
	}
function SkipThisPage(mysiteid){
		document.getElementById("Hint").style.display='block';
		clearTimeout(myVarTimer);
		$("#Hint").html('<img src="img/loader.gif">');
		donotconfirm = 1;
		mywindow.close();
		$.ajax({
        		type: "POST",
        		url: "skipfb.php",
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
		clearTimeout(myVarTimer);
		$("#Hint").html('<img src="img/loader.gif">');
		donotconfirm = 1;
		mywindow.close();
		$.ajax({
        		type: "POST",
        		url: "skipfbR.php",
        		data: "data="+ mysiteid + "---" + '<? echo $data->id;?>',        
        		cache: false,
        		success: function(){
        		$("#Hint").html('<font size="4" color="blue">Skipped!</font>');
        		removeElement('tbl', mysiteid);
        		}
    		});
	}
	
function GetSubCount(mysiteaccid1, pageuserowner){
	if (donotconfirm < 1) {
	document.getElementById("Hint").style.display='block';
	clearTimeout(myVarTimer);
	if (nowlikeittt > 1) {
	if (waittoconfirm < 1) {
	setTimeout("WaitToConfirmIt();", 1000);
	$("#Hint").html('<img src="img/loader.gif">');
	$.ajax({
		type: "GET",
		url: "fblikesconflike.php",
		data: "sitename1="+mysiteaccid1+ "---" + pageuserowner,
		success: function(msg){
			waittoconfirm = 0;
			nowlikeittt = 0;
			if (msg > 0){
			$("#Hint").html('<font size="4" color="green">Liked! '+msg+' Points added to your balance.</font>');
			document.getElementById('Mybalancenow').contentWindow.location.reload(true);
				alertme = 0;
			} else if (msg == -1){
			$("#Hint").html('<font size="4" color="red">UNLIKED !!</font>');
			document.getElementById('Mybalancenow').contentWindow.location.reload(true);
			alertme = alertme +1;
				if(alertme >= 3) { alert("Alert: Sorry, Give REAL Likes, or You will get banned automatically!"); }
			} else if (msg == 0){
			$("#Hint").html('<font size="4" color="red">Not Liked!</font>');
			alertme = alertme +1;
				if(alertme >= 3) { alert("Alert: Give REAL Likes, or You will get banned !"); }
			} else if (msg == -99){
			$("#Hint").html('<font size="4" color="red">Not Liked!</font>');
			alert('Sorry.. You Do NOT give likes correctly. Come back next hour!');
			} else {
			$("#Hint").html('<font size="4" color="green">Liked! Points added to your balance.</font>');
			document.getElementById('Mybalancenow').contentWindow.location.reload(true);
				alertme = 0;
			}
			removeElement('tbl', mysiteaccid1);
		}
	});
	
	}
	else {
	$("#Hint").html('<font size="4" color="blue">Please wait ' + waittoconfirm + ' Seconds to confirm again!</font>');
	}
	}
	} else {
	waittoconfirm = 0;
	nowlikeittt = 0;
	}
	}
</script>

</div>

<div class="clearer">&nbsp;</div>

<div class='infobox'> 

<form action='' method='' onsubmit='refreshpage();'>
<input name='refresh' type='submit' value='Load More Pages...' style='width: 200px;'>
</form></div>

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
<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$x110 = explode(' (', $data->country);
$usertargetc = '(' . $x110[1];

?>


<center>
<div>
<div class="infobox" style="width: 500px;">
<div>
You are <font color='green'><b>Level <?echo (1+ $LevelNumBon);?></b></font>, You will get <font color='#8B008B'><b>Bonus +<?echo $LevelNumBon*0.1;?></b></font> Extra Points for each like you do.
</div>
<? if ($LevelNumBon < $maxlevelup) { ?>
<div>
<font color='blue'>Do more <b><? echo ((1+ $LevelNumBon)*$PointsPerLevel - $data->likes - ($PointsPerLevel/2)); ?></b> likes to <b>Level Up!</b></font>
</div>
<? } ?>
</div>
</div>
</center>

<body id="tab1"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="fbstdlikes.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addfb.php">Add Facebook Page</a></li> 
	<li class="tab3"><a href="fbpages.php">My Pages</a></li> 
</ul>
</div>

<h1>Facebook Pages Likes - Become a Fan and Earn points/cash.</h1>


<?
if ($data->fbuser == ''){
?>
<div class="msg_error" style="background: #FFFF00;">First, You have to Enter your FaceBook Username you will use to Like Pages.</div>
<div class="msg_success"><a href="fbseolikeusername.php"><b>Click Here to Enter your Facebook Username!</b></a></div>
<?
}
else{
?>
<div class="smartbox" style="height: 50px; width: 64px; background: #EFEFEF; border-radius: 15px; float: left; position: relative; border: 2px solid #cdcdcd; padding: 5px 5px 5px 5px; -webkit-border-radius: 15px; -moz-border-radius: 15px; margin: 5px 5px 5px 5px ;">
&nbsp;
<img src="https://graph.facebook.com/<? echo $data->fbuser; ?>/picture">
</div>
<div class="smartbox" style="height: 25px; width: 410px; background: #EFEFEF; border-radius: 15px; float: left; position: relative; border: 2px solid #cdcdcd; padding: 5px 5px 5px 5px; -webkit-border-radius: 15px; -moz-border-radius: 15px; margin: 5px 5px 5px 5px ;">
&nbsp;&nbsp;&nbsp;
<a href="fbphotosusername.php"><font color='blue' size='4'>Click Here to Change Facebook account.</font></a>
</div>
<div class="clearer">&nbsp;</div>

<p>To get free points/cash by liking others Facebook Pages click on 'Like' button, You will see simple Mobile copy of Fan-Page.</p>
<p>Press 'Like' button then come back and 'Confirm' to earn Points/Cash!</p>
<p><font color='green' style="background-color: yellow;"><b>NEW:</font> <font color='green'>Liking system updated, You have to use 'Like' button to do likes on simple Mobile page.</b></font></p>
<p><font color='darkred'>If you see any page Already liked, <b>Do NOT</b> Try to like it again, simply 'Skip' it.</font></p>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.tables.js"></script>

<? 
if ($_REQUEST["skip"] > 0) {
 mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$data->id}', '{$_REQUEST['skip']}')"); }
  
  $siteliked4[] = -1;
  $siteliked2 = mysql_query("SELECT * FROM `liked` WHERE (`user_id`='{$data->id}') ");
  for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->site_id; }
  
  
  $site2 = mysql_query("SELECT * FROM `facebook` WHERE (`active` = '0' AND `points` > `cpc`) AND (`target`='' OR `target` LIKE '%{$usertargetc}%' ) AND `id` NOT in (".implode(',', $siteliked4).") ORDER BY `cpc` DESC LIMIT 0, 9;");
  
  
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

<div id="tbl">
<center><div id="Hint" class="smartbox" style="background: #FFFFFF; border-radius: 12px; border: 2px solid #cdcdcd; display:block; padding: 2px; position: center; height: 22px;"></div></center>
<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

if(preg_match("/\bpages\b/i", $site->facebook)){
$x110 = explode('/', $site->facebook);
$name0 = $x110[5];}
else { $x110 = explode('/', $site->facebook);
$name0 = $x110[3]; }
if(preg_match("/\bref\b/i", $name0)){
$x110009 = explode('?', $name0);
$name0 = $x110009[0];
}

$url0   = 'https://graph.facebook.com/'. urlencode($name0); 
$mystring0 = file_get_contents($url0);
$x1103 = explode('likes"', $mystring0);
$x11103 = explode(':', $x1103[1]);
$x111033 = explode(',', $x11103[1]);

$x1104 = explode('id"', $mystring0);
$x11104 = explode('"', $x1104[1]);
$x111044 = explode('"', $x11104[1]);

$sitemobile = explode('book', $site->facebook);
$sitemobile0 = 'https://m.facebook' . $sitemobile[1];

?>
<div class="smartbox" id="<? echo $site->id;?>" style="height: 135px; width: 225px; background: #EFEFEF; border-radius: 15px; float: left; position: relative; border: 2px solid #cdcdcd; padding: 2px; -webkit-border-radius: 15px; -moz-border-radius: 15px; margin: 3px 4px 0 0;">
<center>
        
        <div><b> <a href="<? echo $site->facebook;?>" target="_blank"> <font color='blue'><? echo $site->title;?></font> </a> </b> </div>
        <div> <img src="https://graph.facebook.com/<? echo $x111044[0]; ?>/picture"> </div>
        <div><font color='green'> <b><? echo $site->cpc-1;?></b> Points = $<?echo number_format(($site->cpc-1)/$coinsdollar,5);?> </font></div>
        
        <div>
	<input type="submit" class="submit" style="background: #409999; border-radius: 10px;" value="Like" onclick="OpenLike('<? echo $sitemobile0;?>');" />
	<input type="submit" class="submit" style="background: #409940; border-radius: 10px;" value="Confirm" onclick="GetSubCount('<? echo $site->facebook;?>', '<? echo $site->id;?>', '<? echo $x111033[0];?>', '<? echo $site->user;?>');" />
	</div>
	<div>
	<a href="#" onclick="SkipThisPage('<? echo $site->id;?>');"><font color='grey' size=1>[Skip]</font></a>
	&nbsp;&nbsp;
	<a href="#" onclick="ReportThisPage('<? echo $site->id;?>');"><font color='darkred' size=1>[Report]</font></a>
	</div>
        
</center>

	
</div>

<?}?>

<script type="text/javascript">
var mywindow;

var waittoconfirm = 0;
function WaitToConfirmIt() {
	if (waittoconfirm > 0) {
	waittoconfirm = waittoconfirm - 1;
	setTimeout("WaitToConfirmIt();", 1000);
	}
}

function OpenLike(mysite){
	mywindow = window.open(mysite);
	}
function SkipThisPage(mysiteid){
		document.getElementById("Hint").style.display='block';
		$("#Hint").html('<img src="img/loader.gif">');
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
		$("#Hint").html('<img src="img/loader.gif">');
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
	
function GetSubCount(mysiteaccname1, mysiteaccid1, mysitecount1, pageuserowner){
	document.getElementById("Hint").style.display='block';
	if (waittoconfirm < 1) {
	waittoconfirm = 2;
	setTimeout("WaitToConfirmIt();", 1000);
	$("#Hint").html('<img src="img/loader.gif">');
	var urltoconf = 'https://facebook.com/<? echo $data->fbuser; ?>/favorites';
	$.post('fbseclikesconf.php',{mysiteid: mysiteaccid1, pageowner: pageuserowner, siteurl: mysiteaccname1, conf: urltoconf } ,  function(msg){
			if (msg == '1'){
			$("#Hint").html('<font size="4" color="green">Liked! Points added to your balance.</font>');
			mywindow.close();
			removeElement('tbl', mysiteaccid1);
			}
			else {
			$("#Hint").html('<font size="4" color="red">Not Liked!</font>');
			alert(msg);
			}
		}
	);
	}
	else {
	$("#Hint").html('<font size="4" color="blue">Please wait ' + waittoconfirm + ' Seconds to confirm again!</font>');
	}
	
	}
</script>

</div>

<div class="clearer">&nbsp;</div>

<div class='infobox'> Like the pages and refresh page to see the addition of points!

<form action='' method='' onsubmit='refreshpage();'>
<input name='refresh' type='submit' value='Refresh'>
</form></div>

<?}else{?>
<div class="msg_error">Sorry, there are no more coins to be earned at the moment. Please try again later.</div>
<div class="msg_success"><a href="buy.php"><b>Feel like you need more coins? You can purchase them now!</b></a></div>
<?}}?>

	<div class="clearer">&nbsp;</div>

<? include('footer.php');?>
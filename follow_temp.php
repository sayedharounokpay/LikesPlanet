<?php
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
	<li class="tab2"><a href="follow.php">Earn Points</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="addfollow.php">Add Profile</a></li> 
	<li class="tab4"><a href="followpages.php">My Profiles</a></li> 
</ul>
</div>

<h1>Twitter Followers - Follow Profiles to Earn points/cash.</h1>
<p>Here you can Follow Twitter Profiles to earn Points/Money.</p>
<p>Click on 'Follow' button, Follow profile on Twitter then 'Close Oppened Window'.</p>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.tables.js"></script>

<?
  
  $siteliked4[] = -1;
  $siteliked2 = mysql_query("SELECT * FROM `followed` WHERE (`user_id`='{$data->id}') ");
  for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->site_id; }
  
  $site2 = mysql_query("SELECT * FROM `follow` WHERE (`active` = '0' AND `points` > `cpc`) AND (`target`='' OR `target` LIKE '%{$usertargetc}%' ) AND `id` NOT in (".implode(',', $siteliked4).") ORDER BY `cpc` DESC LIMIT 0, 12;");
  
  
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

?>
<div class="smartbox" id="<? echo $site->id;?>" style="height: 220px; width: 250px; background: #FFC9FF; border: 5px solid #FF99FF; border-radius: 45px; float: left; position: relative; padding: 6px; margin: 8px 8px 0 0;">
<center>
        <div><font color='green' size='3'> <b><? echo $site->cpc-1;?> Points = $<?echo number_format(($site->cpc-1)/$coinsdollar,5);?> </b></font></div>
	</br>
	<div> <a href="https://twitter.com/intent/user?screen_name=<? echo $site->follow;?>" target="_blank"> <img src="<? echo $site->picture; ?>" border="0" title="Open and Follow"> </a></div>
        
        <div><b> <a href="https://twitter.com/intent/user?screen_name=<? echo $site->follow;?>" target="_blank"> <font color='blue'><? echo $site->title;?></font> </a> </b> </div>
        </br>
        
        <div>
        <a href="javascript:void(0);" onclick="OpenLike('<? echo $site->id;?>', '<? echo $site->user;?>', '<? echo $site->follow;?>', '<? echo $site->cpc;?>');"  >
	<input type="submit" class="submit" value="Follow" Like="height: 38px;" />
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
	mywindow = window.open("https://twitter.com/intent/user?screen_name=" + mysite, "LikesPlanet");
	var timer11 = setInterval(function() {   
    		if(mywindow.closed) {  
        	clearInterval(timer11);  
        	GetSubCount(mysiteid, siteowner);
    		}  
		}, 1000);  
	document.getElementById("Hint").style.display='block';
	if (waittoconfirm < 1) {
	waittoconfirm = 2;
	setTimeout("WaitToConfirmIt();", 1000);
	$("#Hint").html('<img src="img/loader.gif">');
	$.ajax({
		type: "POST",
		url: "followstart.php",
		data: "sitename1="+mysiteid+ "---" + siteowner,
		success: function(msg){
			alert(msg);
			$("#Hint").html('<font size="4" color="blue">Follow, and Close oppened window.</font>');
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
        		url: "followskip.php",
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
        		url: "followskipr.php",
        		data: "data="+ mysiteid + "---" + '<? echo $data->id;?>',        
        		cache: false,
        		success: function(){
        		$("#Hint").html('<font size="4" color="blue">Skipped!</font>');
        		removeElement('tbl', mysiteid);
        		}
    		});
	}
	
function GetSubCount(mysiteaccid1, pageuserowner){
	document.getElementById("Hint").style.display='block';
	if (waittoconfirm < 1) {
	waittoconfirm = 2;
	setTimeout("WaitToConfirmIt();", 1000);
	$("#Hint").html('<img src="img/loader.gif">');
	$.ajax({
		type: "GET",
		url: "followconf.php",
		data: "sitename1="+mysiteaccid1+ "---" + pageuserowner,
		success: function(msg){
			
			if (msg > 0){
			$("#Hint").html('<font size="4" color="green">Followed! '+msg+' Points added to your balance.</font>');
			document.getElementById('Mybalancenow').contentWindow.location.reload(true);
			removeElement('tbl', mysiteaccid1);
			}
			if (msg == '-1'){
			$("#Hint").html('<font size="4" color="green">Ok. Points Added.</font>');
			document.getElementById('Mybalancenow').contentWindow.location.reload(true);
			removeElement('tbl', mysiteaccid1);
			}
			if (msg == 0){
			$("#Hint").html('<font size="4" color="red">Not Followed!</font>');
			}
		}
	});
	
	}
	else {
	$("#Hint").html('<font size="4" color="blue">Please wait ' + waittoconfirm + ' Seconds to confirm again!</font>');
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
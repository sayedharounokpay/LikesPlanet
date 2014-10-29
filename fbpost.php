<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$x110 = explode('(', $data->country);
$x110o = explode(')', $x110[1]);
	if ($x110o[0] == ''){ $x110o[0] = 'XX'; }
$usertargetc = '(' . $x110o[0] . ')';

?>

<body id="tab1"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="fbpost.php">Like Photos to Earn</a></li> 
	<li class="tab3"><a href="fbpostadd.php">Add New Photo/Post</a></li> 
	<li class="tab4"><a href="fbpostmy.php">My Photos</a></li> 
</ul>
</div>
<h1>FaceBook Post Likes</h1>
<p>Here you can Like FaceBook Photos/Posts and Earn Points/Cash!</p>

<? if ($data->fbn == ''){ ?>
<div class="msg_error">First, You have to Enter your FaceBook User-Name you will use to Like Posts.</div>
<div class="msg_success"><a href="fbphotosusername.php"><b>Click Here to Enter your Facebook Username!</b></a></div>
<? } else { ?>
<div class="msg_success" style="border-radius: 45px;"><a href="fbphotosusername.php">Make sure Your Login is (<font><? echo $data->fbn;?></font>), <font style="background-color: #fff;">Click Here to Change it.</font></a></div>
<div class="clearer">&nbsp;</div>
<? }
if ($data->fbn != ''){
  $siteliked4[] = -1;
  $siteliked2 = mysql_query("SELECT * FROM `postdone` WHERE (`user_id`='{$data->id}') ");
  for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->site_id; }
  $site2 = mysql_query("SELECT * FROM `post` WHERE (`active` = '0' AND `points` >= `cpc` AND `user`!='{$data->id}') AND (`target`='' OR `target` LIKE '%{$usertargetc}%' )  AND `id` NOT in (".implode(',', $siteliked4).") ORDER BY `cpc` DESC LIMIT 0, 12;");
  
  $ext = mysql_num_rows($site2);
if($ext>0){
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
<center><div id="Hint" class="smartbox" style="background: #FFFFFF; border-radius: 12px; border: 2px solid #cdcdcd; display:block; padding: 2px; position: center;"></div></center>
<div id="tbl" style="height: 850px;">
<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>
<div class="smartbox" id="<? echo $site->id;?>" style="height: 230px; width: 370px; background: #F3F4F4; border: 5px solid #36A6CB; border-radius: 12px; float: left; position: relative; padding: 6px; margin: 8px 8px 0 0;">
	<center>
	<a style="color:brown; text-align:center;"> <div class="points00">  <b> <? echo $site->title;?> </b></div></a>
	<div class="points">
	<b><font color='green'>Points: </font><font color='blue'>(<? echo $site->cpc-1;?>)</font></b>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<b><font color='green'>Cash: </font><font color='blue'>($<?echo number_format(($site->cpc-1)/$coinsdollar,4);?>)</font></b>
	</div>
	</center>
	
<div class="points">
<table cellpadding="0" cellspacing="0" border="0" style="margin-top: 1px; padding: 0px;">
<tr>
<td width="200">
  <center>
  <? if($site->image != '' ) {?>
  <a href="<? echo $site->details;?>" target="_blank"><img src="<? echo $site->image;?>" border="0" height="110" width="140" title="Open" style="border-radius: 24px;"></a>
  <? } else { ?>
  <a href="<? echo $site->details;?>" target="_blank"><img src="img/FBPOSTP.jpg" border="0" height="110" width="140" title="Open" style="border-radius: 24px;"></a>
  <? } ?>
  </center>
</td>
<td width="20"></td>
<td width="130">
<center>
<div>
<a href="javascript:void(0);" onclick="OpenLike('<? echo $site->details;?>', '<? echo $site->id;?>', '<? echo $site->user;?>');"><input type="submit" class="submit" style="width: 130px; height: 50px; font-size: 28" value="Like" /></a>
</div>
<div class="clearer">&nbsp;</div>

<div>
<a href="javascript:void(0);" onclick="JumpThisSite('<? echo $site->id;?>');"><font color='grey' size=2>[Skip]</font></a>
&nbsp;&nbsp;&nbsp;
<a href="javascript:void(0);" onclick="SkipThisSite('<? echo $site->id;?>');"><font color='red' size=1>[Report]</font></a>

</div>

</center>
</td>
</tr>
</table>
</div>
	<center>
	<div class="points">
	<font color='green'>Info:</font>  <font color='blue'><? echo $site->post;?></font>
	</div>
	</center>
	
<script language=javascript>
var mywindow;
	
function SetAcc(siteid1, uid){
document.getElementById("Hint").style.display='block';
$("#Hint").html('<img src="img/loader.gif">');
$.post('fbpostcheck.php',{id:siteid1, uid:uid} ,  function(msg){
aaa = msg.substr(2);
if ( aaa == 'no' ){ 
$("#Hint").html('<font size="4" color="red">Not Liked! Make sure Username is correct, Try once again or Skip.</font>');
} else {
removeElement('tbl',siteid1);
$("#Hint").html('<font size="4" color="green">Liked! Points/Cash added to your balance.</font>');
}
 } );
};
	
	function OpenLike(mysite, siteid1, uid){
	mywindow = window.open(mysite);
	var timer11 = setInterval(function() {   
    		if(mywindow.closed) {  
        	clearInterval(timer11);  
        	SetAcc(siteid1, uid);
    		}  
		}, 100);  
	document.getElementById("Hint").style.display='block';
	$("#Hint").html('<font size="4" color="blue">Like Photo/Post, and Close oppened window.</font>');
	}
	function SkipThisSite(mysite){
	$.post('fbpostskip.php',{id: mysite});
	removeElement('tbl',mysite);
    	$("#Hint").html('<font size="3"><h1>Skipped!</h1></font>');
	}
	function JumpThisSite(mysite){
	$.post('fbpostjump.php',{id: mysite});
	removeElement('tbl',mysite);
    	$("#Hint").html('<font size="3"><h1>Skipped!</h1></font>');
	}
	</script>
</div>
	
<?
}?>
</div>

<div class="clearer">&nbsp;</div>

<div class='infobox'> Need More Photos to Like? Click on 'Refresh' button to see more.
<form action='' method='' onsubmit='refreshpage();'>
<input name='refresh' type='submit' value='Refresh'>
</form></div>

<?}else{?>
<center></br>
<? $message00 = "Sorry, there are no more coins to be earned at the moment.</br>Please come back again later.</br><a href='buy.php'><b>Feel like you need more coins? You can purchase them now!</b></a>"; ?>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message00;?> </font> </td></tr>
</table>
</center>
<?}
 }?>

	<div class="clearer">&nbsp;</div>

<? include('footer.php');?>

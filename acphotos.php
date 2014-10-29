<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>
<body id="tab1"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="acphotos.php">Like Covers to Earn</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="acphotosadd.php">Add New Cover</a></li> 
	<li class="tab4"><a href="acphotosmy.php">My Covers</a></li> 
</ul>
</div>
<h1>FaceBook Cover Photos Likes</h1>
Here you can Like Cover Photos on FaceBook and Earn Points/Cash!

<?

if ($data->fbn == ''){
?>
<div class="msg_error" style="background: #FFFF00;">First, You have to Enter your FaceBook User-Name you will use to Like Photos.</div>
<div class="msg_success"><a href="fbphotosusername.php"><b>Click Here to Enter your Facebook Username!</b></a></div>
<?
}
else{
?>
<div class="msg_success"><a href="fbphotosusername.php">Make sure Your Login is (<? echo $data->fbn;?>), Click Here to Change it!</a></div>
<div class="clearer">&nbsp;</div>
<?
  $site2 = mysql_query("SELECT * FROM `photos2` WHERE (`active` = '0' AND `points`+1 > 'cpc'  AND `user`!='{$data->id}'   AND (`id` NOT IN (SELECT `site_id` FROM `photosdone2` WHERE `user_id`='{$data->id}')  )  )    ORDER BY `cpc` DESC LIMIT 0, 12");
  $ext = mysql_num_rows($site2);
if($ext>0){
?><div id="fb-root"></div>
<script>
function removeElement(parentDiv, childDiv){
     if (document.getElementById(childDiv)) {     
          var child = document.getElementById(childDiv);
          var parent = document.getElementById(parentDiv);
          parent.removeChild(child);
     }
}
  function refreshpage()
   {
      window.location.reload();
   }
</script>
<center><div id="Hint" style="display:none;"></div></center>
<div id="tbl" style="height: 700px;">
<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
$owner = mysql_query("SELECT * FROM `users` WHERE (`id` = '{$site->user}') ");
$owner1 = mysql_fetch_object($owner);

$name0 = $site->details;
$x110 = explode('fbid=', $name0);
$x1110 = explode('&set=', $x110[1]);
$url0   = 'https://graph.facebook.com/'. urlencode($x1110[0]). '/likes'; 
$mystring0 = file_get_contents($url0);

?>
<div class="tbl tbl-facebook" id="<? echo $site->id;?>" style="height: 190px; width: 350px; padding-top: 2px;">
	<a style="color:brown; text-align:center;"> <div class="points00">  <b> <? echo $site->title;?> </b></div></a>
	<div class="points">
	<b><font color='green'>Coins: </font><font color='blue'>(<? echo $site->cpc-1;?>)</font></b>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<b><font color='green'>Cash: </font><font color='blue'>($<?echo number_format(($site->cpc-1)/$coinsdollar,5);?>)</font></b>
	</div>
	
<div class="points">
<table cellpadding="0" cellspacing="0" border="0" style="margin-top: 1px; padding: 0px;">
<tr>
<td width="180">
  
</td>
<td width="50"></td>
<td width="100">
<center>
<div>
<input type="submit" class="submit" value="Like" onclick="OpenLike('<? echo $site->details;?>');" />
</div>
<div>
<input type="submit" class="submit" value="Confirm" onclick="SetAcc('<? echo $site->details;?>', '<? echo $data->fbn;?>', '<? echo $site->id;?>', '<? echo $data->id;?>');" />
</div>
<div class="clearer">&nbsp;</div>
<div>
<input type="submit" class="submit" style="width: 60px;" value="Skip" onclick="SkipThisSite('<? echo $site->id;?>','<? echo $site->title;?>','<? echo $site->user;?>'  );" /></div>
</center>
</td>
</tr>
</table>
</div>

	<div class="points">
	<b><font color='green'>Info:</font>  <font color='blue'><? echo $site->photo;?></font></b>
	</div>
	
<script language=javascript>
var mywindow;
	
function SetAcc(mysitedetails, myusername1, siteid1, uid){
document.getElementById("Hint").style.display='block';
$("#Hint").html('<font size="3"><h1>Confirming...</h1></font>');
removeElement('tbl',siteid1);
$.post('acphotoscheck.php',{details: mysitedetails, fbname:myusername1, id:siteid1, uid:uid} ,  function(msg){
if (msg=='yes'){ 
$("#Hint").html('<font size="3"><h1>Liked! You got Points/Money.</h1></font>');
mywindow.close();
} else {
nomsg = 'FaceBook says ' + msg + ' Does Not Liked this photo! Please Try Again, or Make sure your FaceBook Name is Correct.'
alert (nomsg ) ;
$("#Hint").html('<font size="3"><h1>Not Liked !</h1></font>');
}
 } );
};
	
	function OpenLike(mysite){
	mywindow = window.open(mysite);
	}
	function SkipThisSite(mysite,mysitetitle,mysiteuserowner,mysitecpc){
	$.post('acphotoskip.php',{id: mysite, title:mysitetitle, owner:mysiteuserowner});
	removeElement('tbl',mysite);
    	$("#Hint").html('<font size="3"><h1>Skipped!</h1></font>');
	}
	</script>
</div>
	
<?
}?>
</div>

<div class='infobox'> Need More Photos to Like? Click on 'Refresh' button to see more.
<form action='' method='' onsubmit='refreshpage();'>
<input name='refresh' type='submit' value='Refresh'>
</form></div>

<?}else{?>
<div class="msg_error">Sorry, there are no more coins to be earned at the moment. Please try again later.</div>
<div class="msg_success"><a href="buy.php"><b>Feel like you need more coins? You can purchase them now!</b></a></div><?}?>

<?}?>

	<div class="clearer">&nbsp;</div>

<? include('footer.php');?>
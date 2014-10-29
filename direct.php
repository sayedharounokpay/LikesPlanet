<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>
<body id="tab1"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="direct.php">Earn Coins</a></li> 
	<li class="tab2"><a href="adddirect.php">Add Website</a></li> 
	<li class="tab3"><a href="directpages.php">My Websites</a></li> 
</ul>
</div>
<h1>Websites Direct Visits</h1>
Here you can Visit Websites to earn Points/Money, It is Not Auto-Surf.
</br></br>

<?
  $site2 = mysql_query("SELECT * FROM `directlink` WHERE (`active` = '0' AND `points` > `cpc` AND (`reports` < `likes` OR `reports`<3)) AND (`id` NOT IN (SELECT `site_id` FROM `directlinked` WHERE `user_id`='{$data->id}') AND `user`!='{$data->id}') ORDER BY `cpc` DESC LIMIT 0, 12");
  $ext = mysql_num_rows($site2);
if($ext > 0){
?>

<font color='blue'>Click on <b>'Visit'</b>, Wait for 5 seconds, then click <img src="http://cdn.adf.ly/static/image/skip_ad/en.png" border="0" height="22px" title="Skip AD"> button, Copy website URL, Paste and <b>'Confirm'</b> to get points.</font>
</br></br>

<div id="fb-root"></div>
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
<center><div id="Hint" class="smartbox" style="background: #FFFFFF; border-radius: 12px; border: 2px solid #cdcdcd; display:block; padding: 2px; position: center;"></div></center>
<div id="tbl" style="width: 850px;">
<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>	
<div class="smartbox" id="<? echo $site->id;?>" style="height: 300px; width: 270px; background: #F3F4F4; border: 5px solid #36A6CB; border-radius: 12px; float: left; position: relative; padding: 6px; margin: 8px 8px 0 0;">
	<center>
	<div class="title"> <a style="color:blue;"> <b> <? echo $site->title;?> </b></a></div>
	<div><font color='green'>Points: <b><? echo $site->cpc-1;?></b></font></div>
	<div><font color='green'>Cash: <b>$<?echo number_format(($site->cpc-1)/$coinsdollar,5);?></b></font></div>
	<div class="clearer">&nbsp;</div>
	
	<div ><input type="submit" class="submit" value="Visit" style="background: #409940; border-radius: 10px;" onClick="VisitThisPage('<? echo $site->adfly;?>', '<? echo $site->id;?>');" /></div >
	
	</br>
	
	<form name = "tt<? echo $site->id;?>" >
	<b>Enter URL :</b>
	<input type="text" name="firstName" size="16" maxlength="150" value="http://" />
	</br></br>
	<input type="button" value="Confirm" style="background: #409940; border-radius: 10px; color: white;" onClick="OkAddCoinsWell2(this.form, '<? echo $site->id;?>', '<? echo $site->user;?>' );" />
	</form>
	
	</br>
	<div><a href="#" onClick="SkipThisPage('<? echo $site->id;?>');"><font color='grey' size=1>[Skip/Report]</font></a></div>
	</center>
</div>

<?}?>

	<script language=javascript>
	var mywindow;
	var mywindowid;
	function VisitThisPage(mysiteadfly, mysiteid){
	$("#Hint").html("<font size=4 color='blue'>Click on 'Skip Ads' and Copy Website URL, Paste here and 'Confirm'.</font>");
	mywindow = window.open(mysiteadfly);
	mywindowid = mysiteid;
	document.getElementById("Hint").style.display='block';
	}
	function OkAddCoinsWell2(frm, mysiteid, mysiteuser){
		document.getElementById("Hint").style.display='block';
		$("#Hint").html('<img src="img/loader.gif">');
		$.ajax({
        		type: "POST",
        		url: "directreceive.php",
        		data: "data="+mysiteid+ "---" + mysiteuser + "---" + frm.firstName.value,
        		cache: false,
        		success: function(msg55){
        			if (msg55 > 1){
        			$("#Hint").html("<font size=4 color='green'> Points added to your balance!</font>");
				removeElement('tbl',mysiteid);
				mywindow.close();
        			} else {
        			$("#Hint").html("<font size=4 color='red'> URL is Not Correct!</font>");
        			removeElement('tbl',mysiteid);
				}
        		}
    		});
	}
	function SkipThisPage(mysite,myid){
	$("#Hint").html("<font size=4 color='blue'>Skipping ...</font>");
	$.ajax({
        		type: "POST",
        		url: "skipdirect.php",
        		data: "data="+mysite+"&user_id="+'<?php echo $data->id;?>',        
        		cache: false,
        		success: function(){
        			$("#Hint").html("<font size=4 color='blue'>Skipped !</font>");
    				removeElement('tbl',mysite);
        		}
    		});
	}
	</script>

</div>
<div class="clearer">&nbsp;</div>
<div class='infobox'> Keep websites on Popup playing on to earn Points/Cash!</div>

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

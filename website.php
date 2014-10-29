<?php
$page_title = "Get More Website Traffic and Improve Alexa Rank - LikesPlanet.com";
$meta_description = "Get More Website Traffic and Improve Alexa Rank - LikesPlanet.com";

include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$x110 = explode('(', $data->country);
$x110o = explode(')', $x110[1]);
	if ($x110o[0] == ''){ $x110o[0] = 'XX'; }
$usertargetc = '(' . $x110o[0] . ')';

?>

<div>
<ul id="tabnav">  
	<li class="tab1"><a href="website.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addw.php">Add Website</a></li> 
	<li class="tab3"><a href="wpages.php">Your Websites</a></li> 
</ul>
</div>
<h1>Websites Exchange</h1>
Here you can Visit Websites to earn Points/Money, It is Not Auto-Surf. </br>
Click "Visit" => wait for the timer to reach 0 => click "ok"
<?



$site2 = mysql_query("SELECT * FROM `website` WHERE (`active` = '0' AND `points` > `cpc` AND (`reports` < `likes` OR `reports`<3) AND (`target`='' OR `target` LIKE '%{$usertargetc}%' ) ) AND (`id` NOT IN (SELECT `site_id` FROM `visited` WHERE `user_id`='{$data->id}')) ORDER BY `cpc` DESC LIMIT 0, 9");



$ext = mysql_num_rows($site2);
if ($get['reportbrokenlink'] == "1"){mysql_query("UPDATE `users` SET `coins`=`coins`+250 WHERE `id`='{$data->id}'");}
if($ext > 0){
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
<center><div id="Hint" class="smartbox" style="background: #FFFFFF; border-radius: 12px; border: 2px solid #cdcdcd; display:block; padding: 2px; position: center; "></div></center>
<div id="tbl">
<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>	
<div class="smartbox" id="<? echo $site->id;?>" style="height: 340px; width: 270px; background: #F3F4F4; border: 5px solid #36A6CB; border-radius: 12px; float: left; position: relative; padding: 6px; margin: 8px 8px 0 0;">
	<center>
	<div><font color='green' size='3'><b>Points: <? echo $site->cpc-1;?> = $<?echo number_format(($site->cpc-1)/$coinsdollar,4);?></b></font></div>
	<div class="clearer">&nbsp;</div>
	<div class="title"> <a style="color:blue;"> <b> <? echo $site->title;?> </b></a></div>
	<iframe src="http://likesasap.com/gen_thumbs/stw_example_code.php?url=<? echo $site->website;?>"
        scrolling="no" frameborder="0"
        style="border:none; width:200px; height:180px;"></iframe>
	<div>
	<a href="javascript:void(0);" onclick="VisitThisPage('<? echo $site->id;?>', '<? echo $site->cpc;?>','<? echo $site->website;?>','<? echo $site->title;?>','<? echo $site->user;?>', '<? echo $site->no_ref; ?>');"  >
	<input type="submit" class="submit" value="Visit" />
	</a>
	</div>
	<div class="clearer">&nbsp;</div>
	<div><a href="#" onclick="SkipThisPage('<? echo $site->id;?>');"><font color='grey' size=1>[Skip]</font></a></div>
	</center>
</div>

<?}?>

	<script language=javascript>
	var mywindow;
	var mycpc1;
	var nowvisit=0;
	var mysite1=0;
	var mysiteT=0;
	var starttime=0;
	var endtime=0;
	var sectime = 1;
	var timerseconds = 0;
	var userowner1 = 0;
	var MybalancenowI = 0;
	function DisplayTimer(){
	if (nowvisit == 1) {
	if (timerseconds >0 ) {timerseconds =timerseconds -1;
	$("#Hint").html("<font size=4 color='blue'>You will earn points/cash in "+timerseconds+" seconds</font>");
	setTimeout("DisplayTimer();", 1000);
	} else {
	$("#Hint").html("<font size=4 color='blue'>Adding Points to your balance...</font>");
	}
	}
	}
	function VisitThisPage(mysite,mycpc,mysiteurl,mysitetitle,userowner,noreff){
	MybalancenowI = <? echo number_format($data->coins,1); ?> + MybalancenowI + 10;
	$("#Mybalancenow").html(numberWithCommas(MybalancenowI));
	if (nowvisit==0){
	$("#Hint").html("<font size=4 color='blue'>Opening Website...</font>");
	if(noreff==0) {
	mywindow = window.open(mysiteurl);
	} else {
	mywindow = window.open(mysiteurl);
	}
	document.getElementById("Hint").style.display='block';
	timerseconds = 25;
	mysiteT=mysitetitle;
	userowner1 = userowner;
	$.ajax({ type: "GET", url: "gettime.php?p", success: function(msg){ 
	starttime = msg;
	setTimeout("OkAddCoinsWell2();", 25000);
	setTimeout("DisplayTimer();", 1000);
	mycpc1=mycpc;
	mysite1=mysite;
	nowvisit=1;
	} });
	
	}
	else{alert("You can visit only one page in time !");}
	}
	function OkAddCoinsWell2(){
		if(mywindow.closed){
			alert("You had closed popup window !");
			window.location = 'http://www.likesplanet.com';}
		else{
		
		$.ajax({
        		type: "POST",
        		url: "wreceive.php?p",
        		data: "data="+mysite1+ "---" + '<? echo $data->id;?>' + "---0---" + userowner1,  
        		cache: false
    		});
    		
    		alert("Click on OK to Earn (" + (mycpc1-1) + ") Points.");
    		$("#Hint").html("<font size=4 color='green'>"+ (mycpc1-1) +" Points added to your balance!</font>");
		mywindow.close();	
		nowvisit=0;
		removeElement('tbl',mysite1);		
		
  		}
	}
	function SkipThisPage(mysite){
	$("#Hint").html("<font size=4 color='blue'>Skipping ...</font>");
	$.ajax({
        		type: "POST",
        		url: "skipw.php",
        		data: "data="+mysite+ "---" + '<? echo $data->id;?>',        
        		cache: false
    		});
    	$("#Hint").html("<font size=4 color='blue'>Skipped !</font>");
    	removeElement('tbl',mysite);
	}
	</script>

</div>
<div class="clearer">&nbsp;</div>
</br></br>
<div class='infobox'> Keep websites on Popup playing on to earn Points/Cash! Refresh page to see more sites!</div>

<?}else{?>
<center></br>
<? $message00 = "Sorry, there are no more coins to be earned at the moment.</br>Please come back again later.</br><a href='buy.php'><b>Feel like you need more coins? You can purchase them now!</b></a>"; ?>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message00;?> </font> </td></tr>
</table>
</center>
<?}?>

	<div class="clearer">&nbsp;</div>
	
	<center>
<h1>Do you want FREE traffic?</h1>

Likesplanet shows you an EASY and FREE way to get over 5k daily visitors to your website/blog!</br></br>

<a target="_blank" href="https://hitleap.com/by/scriptsic"><img alt="Free Traffic Exchange" src="http://hitleap.com/assets/banner.png" style="border: 0px"></a></br></br>

step 1: click the banner above and register</br></br>

step 2: install the autosurf software provided after registration</br></br>

step 3: run the software to earn points automatically</br></br>

step 4: add your websites/pages</br></br>

Congratulations! You are now getting FREE traffic!</br></br>
</center>


<? include('footer.php');?>

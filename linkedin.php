<?php
$page_title = "Free LinkedIn Shares - LikesPlanet.com";
$meta_description = "Free LinkedIn Shares - LikesPlanet.com";
$meta_keywords = "LinkedIn, Shares, Free, Fans, Social Media Exchanger, LikesPlanet.com";

include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$x110 = explode(' (', $data->country);
$usertargetc = '(' . $x110[1];

?>

<body id="tab1"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="linkedin.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addlinkedin.php">Add Website</a></li> 
	<li class="tab3"><a href="linkedinpages.php">My Websites</a></li> 
</ul>
</div>

<h1>Linkedin Shares - Sahre Websites on Linkedin and Earn points/cash.</h1>
<p>To get free points/cash by sharing others Sites, click on 'Share' button.</p>
<p>You can 'Skip' sites that you do not want to like.</p>

<? 
  
  $siteliked4[] = "'none'";
  $siteliked2 = mysql_query("SELECT * FROM `linked` WHERE (`user_id`='{$data->id}') ");
  for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = "'" . $siteliked->site_id . "'"; }
  
  $site2 = mysql_query("SELECT * FROM `linkedin` WHERE (`active` = '0' AND `points` > `cpc`) AND (`target`='' OR `target` LIKE '%{$usertargetc}%' ) AND `id` NOT in (".implode(',', $siteliked4).") ORDER BY `cpc` DESC LIMIT 0, 6;");
  
  $ext = mysql_num_rows($site2);
  
if($ext > 0){
?><div id="fb-root"></div>

<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>

<script>
function refreshpage()
   {window.location.reload();}
function removeElement(parentDiv, childDiv){
   if (document.getElementById(childDiv)) {     
   var child = document.getElementById(childDiv);
   var parent = document.getElementById(parentDiv);
   parent.removeChild(child);
}}
</script>

<div class="clearer">&nbsp;</div>

<div id="tbl" style="width: 850px;">
<center><div id="Hint" class="smartbox" style="background: #FFFFFF; border-radius: 12px; border: 2px solid #cdcdcd; display:block; padding: 2px; position: center; "></div></center>
<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

?>
<div class="smartbox" id="<? echo $site->id;?>" style="width: 270px;
background: #F3F4F4;
border: 5px solid #36A6CB;
border-radius: 12px;
float: left;
position: relative;
padding: 6px;
margin: 8px 8px 0 0;">
<center>
	
	<div><font color='blue'><b> <? echo $site->title;?> </b></font></div>
	<div class="clearer">&nbsp;</div>
	<div><font color='green'> <b><? echo $site->cpc-1;?></b> Points = $<?echo number_format(($site->cpc-1)/$coinsdollar,5);?> </font></div>
	<div class="clearer">&nbsp;</div>
	
        <div style="height:28px;">
        <script type="IN/Share" data-url="<? echo $site->linkedin;?>" data-counter="right" data-onsuccess="shared<? echo $site->id;?>"></script>
        <script type="text/javascript">
	function shared<? echo $site->id;?>(){
	document.getElementById("Hint").style.display='block';
	$("#Hint").html('<img src="img/loader.gif">');
	
	$.ajax({
        		type: "POST",
        		url: "linkedinreceive.php",
        		data: "data="+'<? echo $site->id;?>' + "---" + '<? echo $site->user;?>',        
        		cache: false,
        		success: function(){
        		$("#Hint").html('<font size="4" color="green">Shared with Successful !</font>');        		
        		myiddtemp = '<? echo $site->id;?>';
			removeElement('tbl', myiddtemp );
        		}
    	});
	
	}
	</script>
        </div>
        
        <div class="clearer">&nbsp;</div>

<div><a href="#" onclick="SkipThisPage('<? echo $site->id;?>');"><font color='grey' size=1>[Skip]</font></a></div>

</center>
</div>

<?}?>

<script>
function SkipThisPage(mysite){
	$("#Hint").html("<font size=4 color='blue'>Skipping ...</font>");
	$.ajax({
        		type: "POST",
        		url: "skiplinked.php",
        		data: "data="+mysite+ "---" + '<? echo $data->id;?>',        
        		cache: false
    		});
    	$("#Hint").html("<font size=4 color='blue'>Skipped !</font>");
    	removeElement('tbl',mysite);
	}
</script>

</div>

<div class="clearer">&nbsp;</div>

<div class='infobox'> Sahre sites and refresh page to see the addition of points!

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
<?}?>

	<div class="clearer">&nbsp;</div>

<? include('footer.php');?>

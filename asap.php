<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
$LevelNumBon = number_format($data->likes/90,0);
?>

<center>
<div>
<div class="infobox" style="width: 500px;">
<? if ($LevelNumBon < 3){
?>
<div>
You are <font color='green'><b>Level <?echo (1+ $LevelNumBon);?></b></font>, You will get <font color='#8B008B'><b>Bonus +<?echo $LevelNumBon;?></b></font> Extra Points for each like you do.
</div>
<div>
<font color='blue'>Do more <b><? echo ((1+ $LevelNumBon)*90 - $data->likes - 45); ?></b> likes to <b>Level Up!</b></font>
</div>
<?} else{
$LevelNumBon=3;
?>
<div>
You are <font color='green'><b>Level <?echo (1+ $LevelNumBon);?></b></font>, You will get <font color='#8B008B'><b>Bonus +<?echo $LevelNumBon;?></b></font> Extra Points for each like you do.
</div>
<?}?>
</div>
</div>
</center>

<body id="tab1"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="fbstd.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addfb.php">Add Facebook Page</a></li> 
	<li class="tab3"><a href="fbpages.php">Your Pages</a></li> 
</ul>
</div>

<h1>Facebook Fan Pages</h1>
Here you can Do Likes to earn Points/Money.

<? 
if ($_REQUEST["skip"] > 0) {
 mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$data->id}', '{$_REQUEST['skip']}')"); }

  $site2 = mysql_query("SELECT * FROM `facebook` WHERE (`active` = '0' AND `points` > '1') AND `id` NOT IN (SELECT `site_id` FROM `liked` WHERE `user_id`='{$data->id}') ORDER BY `cpc` DESC LIMIT 0, 12");
  $ext = mysql_num_rows($site2);
  
if($ext > 0){
?><div id="fb-root"></div>

<script>
  function refreshpage()
   {
      window.location.reload();
   }
</script>

<div class="clearer">&nbsp;</div>
<div> If Like button does not appear, You can click 'OPEN' button and Like Page, then click 'CONFIRM' to earn coins. </div>

<div id="tbl">
<center><div id="Hint" style="display:none;"></div></center>
<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

?>
<div class="tbl tbl-facebook" id="<? echo $site->id;?>" style="height: 135px; width: 225px; padding-top: 0px;">
<center>
        
        <iframe src="fbframe3.php?id=<? echo $site->id; ?> &url=<? echo $site->facebook; ?>&title=<? echo $site->title; ?>&bon=<? echo $LevelNumBon; ?>&cpc=<? echo $site->cpc; ?>"
        scrolling="no" frameborder="0"
        style="border:none; width:222px; height:130px"></iframe>
        
</center>

	
</div>

<?}?>

</div>
<div class='infobox'> Like the pages and refresh page to see the addition of points!

<form action='' method='' onsubmit='refreshpage();'>
<input name='refresh' type='submit' value='Refresh'>
</form></div>

<?}else{?>
<div class="msg_error">Sorry, there are no more coins to be earned at the moment. Please try again later.</div>
<div class="msg_success"><a href="buy.php"><b>Feel like you need more coins? You can purchase them now!</b></a></div>
<?}?>

	<div class="clearer">&nbsp;</div>

<? include('footer.php');?>
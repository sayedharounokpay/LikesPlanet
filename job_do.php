<?php
$page_title = "Let People Do your Micro Jobs - LikesPlanet.com";
$meta_description = "Let People Do your Micro Jobs - LikesPlanet.com";
$meta_keywords = "Microjobs, Find, Workers, Social Media Exchanger, LikesPlanet.com";

include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>

<div id="tab2"> 
<div>
<ul id="tabnav">  
	<li class="tab2"><a href="job_do.php">Earn Points</a></li> 
	<li class="tab20"><a href="job_ido.php">Jobs I Do</a></li> 
	<li class="tab3"><a href="job_add.php">Add New Job</a></li> 
	<li class="tab4"><a href="job_my.php">My Jobs</a></li> 
</ul>
</div>
</div>


<h1>Earn Points by Doing Jobs</h1>
<p>Here you can Do Small Jobs to Earn Points/Cash!</p>
<p>Do only Honest Works, If any dispute happens on job, You and job owner <font color='red'>will Lose Points!</font></p>
<p>It is better to do jobs with High RANK of Job Owner, Higher Rank means Job Owner approves honest works.</p>

<?
  $siteliked4[] = -1;
  $siteliked2 = mysql_query("SELECT * FROM `jobsdone` WHERE (`worker`='{$data->id}') ");
  for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = $siteliked->job_id; }
  $site2 = mysql_query("SELECT * FROM `jobs` WHERE (`active` = '0' AND `points` >= `cpc` AND `user`!='{$data->id}')  AND `id` NOT in (".implode(',', $siteliked4).") ORDER BY `id` DESC LIMIT 0, 7;");
  
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
<center>
	<div id="Hint" class="smartbox" style="background: #FFFFFF; border-radius: 12px; border: 2px solid #cdcdcd; display:block; padding: 2px; position: center;"></div></center>
<div id="tbl">
<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

$attachedfilephoto = $site->photo;
if ($attachedfilephoto == "") {
	$attachedfilephoto = "<img src='img/FBPOSTP.jpg' border='0' height='200' width='300' style='border-radius: 24px;' />";
	} else {
	$attachedfilephoto = "<img src='" . $attachedfilephoto . "' border='0' height='200' width='300' style='border-radius: 24px;' />";
}

$jobworker = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE `id`='{$site->user}' "));

$x11102oo = explode('(', $jobworker->country);
$x111022oo = explode(')', $x11102oo[1]);
if ($x111022oo[0] == '' ) $x111022oo[0] = 'US';
if ($x111022oo[0] == 'DE' ) $x111022oo[0] = 'GM';
if ($x111022oo[0] == 'TR' ) $x111022oo[0] = 'TU';
if ($x111022oo[0] == 'PH' ) $x111022oo[0] = 'RP';
if ($x111022oo[0] == 'DZ' ) $x111022oo[0] = 'AG';
if ($x111022oo[0] == 'BW' ) $x111022oo[0] = 'BC';
if ($x111022oo[0] == 'PT' ) $x111022oo[0] = 'PO';
if ($x111022oo[0] == 'VN' ) $x111022oo[0] = 'VM';
if ($x111022oo[0] == 'RU' ) $x111022oo[0] = 'RS';
if ($x111022oo[0] == 'OM' ) $x111022oo[0] = 'MU';
if ($x111022oo[0] == 'GB' ) $x111022oo[0] = 'UK';
if ($x111022oo[0] == 'GE' ) $x111022oo[0] = 'GG';
if ($x111022oo[0] == 'LB' ) $x111022oo[0] = 'LE';
if ($x111022oo[0] == 'AZ' ) $x111022oo[0] = 'AJ';
if ($x111022oo[0] == 'LV' ) $x111022oo[0] = 'LG';
if ($x111022oo[0] == 'UA' ) $x111022oo[0] = 'UP';
if ($x111022oo[0] == 'LK' ) $x111022oo[0] = 'CO';
if ($x111022oo[0] == 'SD' ) $x111022oo[0] = 'SU';
if ($x111022oo[0] == 'BD' ) $x111022oo[0] = 'BG';

?>






<div id="<? echo $site->id;?>" >

<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px; border: 0px;">
<tr><td width="400"><font color='grey' size='3'>Job Title: <b><? echo $site->title;?></b></font></td> <td width="50"> </td> <td width="400"> <font color='green' size='4'> <b><? echo number_format($site->cpc * 0.9,0); ?></b> Points = $<? echo number_format($site->cpc * 0.9 / 5000,3); ?></td>  </tr>
</table>


<table>
<tr>
<td width="320"> <? echo $attachedfilephoto; ?> </td> 
<td width="50"></td>
<td width="500"> <center><textarea readonly name="url" style="width:450px;height:130px; font-size: 14px; padding: 10px;" ><? echo $site->job;?></textarea>

<div style="margin-bottom: 10px;">Job Owner: <img src="https://www.cia.gov/library/publications/the-world-factbook/graphics/flags/large/<? echo Strtolower($x111022oo[0]); ?>-lgflag.gif" border="0" title="Country of Job Owner: <? echo $jobworker->country; ?>" height="16" width="24" > <font color='blue'><? echo $jobworker->login;?></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rank: <b><font color="<?if($jobworker->rank >= 0){echo 'green';}else{echo 'red';}?>"> <? echo $jobworker->rank;?> </font></b> <? if($jobworker->rank >= 0) { ?>
<img src='img/rank_up.png' height='20' width='20' title="Approved Works: <? echo $jobworker->rank;?>">
<? } else { ?>
<img src='img/rank_down.png' height='20' width='20' title="Denied Works: <? echo $jobworker->rank;?>">
<? } ?></div>


<input type="submit" class="submitgreen"  value="I Can Do It !" onclick="OpenLike('<? echo $site->id; ?>', '<? echo $site->keycode; ?>');" />
&nbsp; &nbsp; &nbsp; &nbsp;
<input type="submit" class="submit"  value="Skip, I Can Not." onclick="SkipThisPage('<? echo $site->id; ?>');" />
</center>
</td> 
</tr>
</table>
</div>












<?
}?>
</div>
<div class="clearer">&nbsp;</div>

<script language=javascript>
var mywindow;
function OpenLike(mysiteid, mysitecode){
	mywindow = window.open("job_doit.php?jid=" + mysiteid + "&keycode=" + mysitecode);
	document.getElementById("Hint").style.display='block';
	$("#Hint").html('<font size="4" color="green">It is time to get busy! Do job Honestly or You will lose points.</font>');
	removeElement('tbl', mysiteid);
	}
function SkipThisPage(mysiteid){
		document.getElementById("Hint").style.display='block';
		$("#Hint").html('<img src="img/loader.gif">');
		$.ajax({
        		type: "POST",
        		url: "jobskip.php",
        		data: "data="+ mysiteid + "---" + '<? echo $data->id;?>',        
        		cache: false,
        		success: function(){
        		$("#Hint").html('<font size="4" color="blue">Job Skipped!</font>');
        		removeElement('tbl', mysiteid);
        		}
    		});
	}
</script>

<?}else{?>
<center></br>
<? $message00 = "Sorry, there are no more coins to be earned at the moment.</br>Please come back again later.</br><a href='buy.php'><b>Feel like you need more coins? You can purchase them now!</b></a>"; ?>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message00;?> </font> </td></tr>
</table>
</center>
<?}?>


<? include('footer.php');?>

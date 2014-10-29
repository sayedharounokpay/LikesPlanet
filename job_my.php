<?php
$page_title = "Let People Do your Micro Jobs - LikesPlanet.com";
$meta_description = "Let People Do your Micro Jobs - LikesPlanet.com";
$meta_keywords = "Microjobs, Find, Workers, Social Media Exchanger, LikesPlanet.com";

include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$high = $get['high'];

?>
<body id="tab4"> 
<div>
<ul id="tabnav"> 
	<li class="tab2"><a href="job_do.php">Earn Points</a></li> 
	<li class="tab20"><a href="job_ido.php">Jobs I Do</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="job_add.php">Add New Job</a></li> 
	<li class="tab4"><a href="job_my.php">My Jobs</a></li> 
</ul>
</div>
<h1>My Jobs</h1>
<div class="clearer">&nbsp;</div>

		<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="200">			
			Job Title
			</th>	
			<th>			
			<b>Done</b>			
			</th>
			<th>			
			Pending		
			</th>	
            		<th>			
			<b>Points</b>			
			</th>
			<th>			
			CPC		
			</th>
			<th>			
			<b>Actions</b>
			</th>
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `jobs` WHERE `user`='{$data->id}' ORDER BY `id` DESC ");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>												
				<center><a href="job_add_2.php?jkc=<? echo $site->keycode;?>" target="_blank" title="Edit My Job" style="<?if($site->active == 1){echo "color:red;";}else{echo "color:green;";}?>" ><? echo $site->title;?></a></center>
				</br>
				<? if($site->photo != '' ) {?>
				<img src="<? echo $site->photo;?>" width="150" height="100px" style="border-radius: 10px;">
				<? } else { ?>
				<img src="img/FBPOSTP.jpg" width="150" height="100px" style="border-radius: 10px;">
				<? } ?>
				</br>
				</td>				
				<td>				
				<center><font color='green' size='4'><b><? echo $site->likes;?></b></font></center>
				</td>
				<td>				
				<center><font color='black' size='4'><b><? echo $site->pending;?></b></font></center>
				</td>
				<? if($high == $site->id) { ?>
				<td style="background: #ffff00;">
				<? } else { ?>
				<td>
				<? } ?>						
				<font color="<?if($site->points < $site->cpc){echo 'red';}else{echo 'blue';}?>">
				<center><? echo $site->points;?></center>			
				</td>
				<td>	
				<center><? echo $site->cpc;?></center>		
				</td>
				<td>				
				<a href="job_add_2.php?jkc=<? echo $site->keycode;?>" target="_blank"><img src="img/pencil2.png" border="0" title="Edit"></a>		
				</br>
				<a href="job_coins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="job_coins2.php?id=<? echo $site->id;?>"><img src="img/retract2.png" border="0" title="Retract Coins"></a>	
				
				</td>			
			</tr>
			</tbody><?}?>
</table>	


<div class="clearer">&nbsp;</div>



<h1>Jobs Pending My Review:</h1>
<div class="clearer">&nbsp;</div>

		<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="160">			
			Job Title
			</th>	
			<th>			
			<b>Worker</b>			
			</th>
			<th>			
			<b>Status</b>
			</th>	
			<th>			
			<b>Action</b>
			</th>
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `jobsdone` WHERE `owner`='{$data->id}' AND `status`!='0' ORDER BY `id` DESC ");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

$jobworker = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE `id`='{$site->worker}' "));
$jobdata = mysql_fetch_object(mysql_query("SELECT * FROM `jobs` WHERE `id`='{$site->job_id}' "));

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
			<tbody>
			<tr>
				<td width="240">												
				<center><font color='blue' size='2'><? echo $jobdata->title;?></font></center>
				</td>				
				<td>
				<center></br><font color='blue' size='3'><b><? echo $jobworker->login;?></b></font></br></br><img src="https://www.cia.gov/library/publications/the-world-factbook/graphics/flags/large/<? echo Strtolower($x111022oo[0]); ?>-lgflag.gif" border="0" title="Country of Worker: <? echo $jobworker->country; ?>" height="16" width="24" > &nbsp; &nbsp; <font size=3>Rank: <? echo $jobworker->rank; ?> </font> </center></br>
				</td>
				<td width="120">				
				<center>
				<? if($site->status == 1) { ?>
				<font color='blue' size='2'> Waiting for Work </font>
				<? } ?>
				<? if($site->status == 2) { ?>
				<font color='green' size='2'> <b>Your Review </br> is Needed</b> </font>
				<? } ?>
				<? if($site->status == 3) { ?>
				<font color='red' size='2'> Cancelled. </font>
				<? } ?>
				<? if($site->status == 4) { ?>
				<font color='green' size='2'> Complete. </font>
				<? } ?>
				</center>
				</td>
				<td width="180">				
				<center>
				<? if($site->status == 1) { ?>
				<a href='job_order.php?oid=<? echo $site->id;?>' target="_blank"><font color='blue' size='3'>See Progress of Work</font></a>
				<? } ?>
				<? if($site->status == 2) { ?>
				<a href='job_order.php?oid=<? echo $site->id;?>' target="_blank"><font color='green' size='4'><b>Accept/Deny</b></font></a>
				<? } ?>
				<? if($site->status == 3 OR $site->status == 4) { ?>
				<a href='job_order.php?oid=<? echo $site->id;?>' target="_blank"><font color='grey' size='2'>History</font></a>
				<? } ?>
				</center>
				</td>	
			</tr>
			</tbody><?}?>
</table>	


<? include('footer.php');?>
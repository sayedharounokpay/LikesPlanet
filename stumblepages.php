<?php
$page_title = "Free StumbleUpon Followers - LikesPlanet.com";
$meta_description = "Free StumbleUpon Followers - LikesPlanet.com";
$meta_keywords = "StumbleUpon, Fans, Free, Followers, Social Media Exchanger, LikesPlanet.com";

include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$high = $get['high'];

?>
<body id="tab4"> 
<div>
<ul id="tabnav"> 
	<li class="tab2"><a href="stumble.php">Earn Points</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="addstumble.php">Add Stumble Profile</a></li> 
	<li class="tab4"><a href="stumblepages.php">My Profiles</a></li> 
</ul>
</div>

<h1>Stumble Followers - My Profiles</h1>
<p>Here You can see How manu followers you received for each profile, and How many people had 'Skipped' your profile!</p>
<p>When users 'Skip' your profile a lot of times, Your profile will be Closed, You can Activate it once again.</p>
<p>When your profile is Closed, Please make sure Profile Username is Correct, 'Edit' it and Activate it again if you like.</p>
<p>Remember to ADD Coins to your profile. or it will Not receive followers even if you have points in account balance.</p>

		<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="150">			
			<b>Page</b>			
			</th>			
            <th width="100">			
			<font color='green'><b>Followers</b></font>			
			</th>
            <th>			
			<b>CPC</b>			
			</th>			
			<th>			
			<b>Points</b>			
			</th>
			<th>			
			Skips/<font color='red'>Reports</font>		
			</th>	
			<th>			
			<b>Target</b>			
			</th>	
			<th>			
			<b>Stop At</b>			
			</th>		
			<th width="150">			
			<b>Add/Retract Points</b>			
			</th>				
		</tr>
        </thead>					
<?
  
  $site2 = mysql_query("SELECT * FROM `stumble` WHERE `user`='{$data->id}' ORDER BY `id` DESC");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

$imageurlurl = $site->pageid;


?>		
			<tbody>
			<tr>
				<td>	
				<a href="http://www.stumbleupon.com/stumbler/<? echo $site->stumble;?>" target="_blank" title="<? echo $site->title;?>" style="<?if($site->active == 1){echo "color:red;";}else{echo "color:green;";}?>" > <img src="<? echo $site->photo; ?>" width="60"> </a>
				
				<? if($site->active == 1) {?>
				&nbsp;&nbsp;
					<? if($site->lastreallikes >= $site->top ) {?>
					<img src="img/DONE.png" title="Done at <? echo $site->lastreallikes; ?>!">
					<? } else { ?>
					<img src="img/alerticon.png" title="Paused at <? echo $site->lastreallikes; ?>!">
					<? } ?>
				<? } else { ?>
				<font color='grey'> &nbsp; ~<? echo $site->lastreallikes; ?> </font>
				<? } ?>	
				
				</td>	
				<td>				
				<b><font color='green' size='4'><? echo $site->likes; ?></b></font> 	
				</td>
				<td>				
				<? echo $site->cpc;?>			
				</td>
				<? if($high == $site->id) { ?>
				<td style="background: #ffff00;">
				<? } else { ?>
				<td>
				<? } ?>	
				<font color="<?if($site->points < 10){echo 'red';}else{echo 'blue';}?>">
				<? echo $site->points;?>			
				</font>
				</td>
				<td>				
				<? echo $site->jump;?> - <font color='red'><? echo $site->skipped;?></font>	
				</td>
				<td>		
				<font color="<?if($site->target != ''){echo 'blue';}else{echo 'grey';}?>">
					<? if($site->target == ''){echo 'off';} else{ echo 'On';}; ?>
				</font>
				</td>
				<td>		
				<font color="<?if($site->top > 0){echo 'blue';}else{echo 'grey';}?>">
				<? echo $site->top;?>			
				</font>
				</td>
				<td>	
				<center>			
				<a href="stumbleedit.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/pencil2.png" border="0" title="Edit"></a>
				<a href="delstumble.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/delete2.png" border="0" title="Delete Profile"></a>			
				</br>						
				<a href="stumblecoins.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="stumblecoins2.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/retract2.png" border="0" title="Retract Coins"></a>
				</center>
				</td>	
			</tr>
			</tbody><?}?>
</table>

<? include('footer.php');?>
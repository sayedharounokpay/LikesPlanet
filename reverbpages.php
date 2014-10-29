<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$high = $get['high'];

?>
<body id="tab4"> 
<div>
<ul id="tabnav"> 
	<li class="tab2"><a href="reverb.php">Earn Points</a></li> 
	<li class="tab3"><a href="addreverb.php">Add Profile</a></li> 
	<li class="tab4"><a href="reverbpages.php">My Profiles</a></li> 
</ul>
</div>

<h1>ReverbNation Fans - My Profiles.</h1>
<p>Here You can see How many fans you received for each profile, and How many people had 'Skipped' your profile.</p>
<p>Remember to ADD Points to your profile. or it will Not receive fans even if you have points in account balance.</p>

		<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="150">			
			<b>Profile</b>			
			</th>			
            <th width="100">			
			<font color='green'><b>Fans</b></font>			
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
			<th width="150">			
			<b>Add/Retract Points</b>			
			</th>				
		</tr>
        </thead>					
<?
  
  $site2 = mysql_query("SELECT * FROM `reverb` WHERE `user`='{$data->id}' ORDER BY `id` DESC");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

$imageurlurl = $site->pageid;


?>		
			<tbody>
			<tr>
				<td>	
				<a href="http://www.reverbnation.com/<? echo $site->reverb;?>" target="_blank" title="<? echo $site->title;?>" style="<?if($site->active == 1){echo "color:red;";}else{echo "color:green;";}?>" > <img src="<? echo $site->photo;?>" border="0" height="75" width="75" title="<? echo $site->title;?>"> </a>
				
				<? if($site->active == 1) {?>
				&nbsp;&nbsp;
					<img src="img/alerticon.png" title="Paused!">
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
				<center>			
				<a href="reverbedit.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/pencil2.png" border="0" title="Edit"></a>
				<a href="reverbdel.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/delete2.png" border="0" title="Delete Profile"></a>			
				</br>						
				<a href="reverbcoins.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="reverbcoins2.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/retract2.png" border="0" title="Retract Coins"></a>
				</center>
				</td>	
			</tr>
			</tbody><?}?>
</table>

<? include('footer.php');?>

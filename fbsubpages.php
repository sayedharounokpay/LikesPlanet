<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$high = $get['high'];

?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="fbsubs.php">Earn Points</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp; </li>
	<li class="tab2"><a href="addfbsub.php">Add Profile</a></li> 
	<li class="tab3"><a href="fbsubpages.php">My Profiles</a></li> 
</ul>
</div>

<h1>Facebook Followers - My Profiles.</h1>
<p>Here You can see How many followers you received for each profile, and How many people had 'Skipped' your profile.</p>
<p>When users 'Skip' your profile a lot of times, Your profile will be Closed, You can Activate it once again.</p>
<p>When your profile is Closed, Please make sure Profile URL CODE is Correct, 'Edit' it and Activate it again if you like.</p>
<p>Remember to ADD Points to your profile. or it will Not receive fans even if you have points in account balance.</p>

		<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>Profile</b>			
			</th>		
            <th>			
			<font color='green'><b>Followers</b></font>			
			</th>
            <th>			
			<b>CPC</b>			
			</th>			
			<th>			
			<b>Points</b>			
			</th>
			<th>			
			<b>Target</b>			
			</th>
			<th>			
			Skips/<font color='red'>Reports</font>		
			</th>		
			<th width="180">			
			<b>Add/Retract Points</b>			
			</th>				
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `fbsub` WHERE `user`='{$data->id}' ORDER BY `likes` DESC");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<a href="https://www.facebook.com/<? echo $site->fbsub;?>" target="_blank"> <img src="https://graph.facebook.com/<? echo $site->fbsub;?>/picture" border="0" title="<? echo $site->title;?>" > </a>
				</td>				
				<td>				
				<font color='green' size='3'><b><? echo $site->likes;?></b></font>			
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
				<font color="<?if($site->target != ''){echo 'blue';}else{echo 'grey';}?>">
					<? if($site->target == ''){echo 'off';} else{ echo 'On';}; ?>
				</font>
				</td>
				<td>				
				<? echo $site->jump;?> - <font color='red'><? echo $site->skipped;?></font>	
				</td>
				<td>				
				<a href="editfbsub.php?id=<? echo $site->id;?>"><img src="img/pencil2.png" border="0" title="Edit"></a>							
				<a href="delfbsub.php?id=<? echo $site->id;?>"><img src="img/delete2.png" border="0" title="Delete Profile"></a>				
				</br>
				<a href="fbsubcoins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="fbsubcoins2.php?id=<? echo $site->id;?>"><img src="img/retract2.png" border="0" title="Retract Coins"></a>	
				</td>					
			</tr>
			</tbody><?}?>
</table>	

<? include('footer.php');?>
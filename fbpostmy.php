<?php
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
	<li class="tab1"><a href="fbpost.php">Like Photos to Earn</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="fbpostadd.php">Add New Photo/Post</a></li> 
	<li class="tab4"><a href="fbpostmy.php">My Photos</a></li> 
</ul>
</div>
<h1>My FaceBook Photos</h1>

<p><b> Your post/photo becomes <font color='red'>Disabled</font> ? <a href="disabled.php">Click here to solve the problem.</a> </b> </p> 

<div class="clearer">&nbsp;</div>

<p>Here You can see How manu likes you received for each photo, and How many people had 'Skipped' your photos!</p>
<p>When users 'Skip' your photo a lot of times, Your photo will be Closed temporary, You can Activate it once again.</p>
<p>When your photo is Closed, Please make sure URL is Correct, 'Edit' it and Activate it again if you like.</p>
<p>Remember to ADD Coins to your photos. or it will Not receive likes even if you have points in account balance.</p>


		<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			Photo	
			</th>	
			<th>			
			<b>Likes</b>			
			</th>	
            		<th>			
			<b>Points</b>			
			</th>
			<th>			
			CPC		
			</th>
			<th>			
			Skips/<font color='red'>Reports</font>			
			</th>
            		<th width="240">			
			<b>Add/Retract Points</b>			
			</th>						
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `post` WHERE `user`='{$data->id}' ORDER BY `id` DESC ");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<a href="<? echo $site->details;?>" target="_blank" title="Visit My Post" style="<?if($site->active == 1){echo "color:red;";}else{echo "color:green;";}?>" ><? echo $site->title;?></a>
				</br>
				<? if($site->image != '' ) {?>
				<a href="<? echo $site->details;?>" target="_blank"> <img src="<? echo $site->image;?>" width="100px" height="70px" style="border-radius: 10px;"> </a>
				<? } else { ?>
				<a href="<? echo $site->details;?>" target="_blank"> <img src="img/FBPOSTP.jpg" width="100px" height="70px" style="border-radius: 10px;"> </a>
				<? } ?>
				</td>				
				<td>				
				<font color='green' size='3'><b><? echo $site->likes;?></b> Likes.</font>
				</br>
				</br><font color='blue' size='2'><b><? echo $site->likes+$site->jump+$site->reports;?></b> Hits.</font>
				</br>
				<a href="fbpostwho.php?id=<? echo $site->id;?>" target="_blank"><p>(Who liked me?)</p></a>		
				</td>
				<? if($high == $site->id) { ?>
				<td style="background: #ffff00;">
				<? } else { ?>
				<td>
				<? } ?>						
				<font color="<?if($site->points < 10){echo 'red';}else{echo 'blue';}?>">
				<? echo $site->points;?>			
				</td>
				<td>				
				<? echo $site->cpc;?>			
				</td>
				<td>				
				<? echo $site->jump;?> - <font color='red'><? echo $site->reports;?></font>			
				</td>
				<td>				
				<a href="fbpostedit.php?id=<? echo $site->id;?>"><img src="img/pencil2.png" border="0" title="Edit"></a>		
				<a href="fbpostcoins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="fbpostcoins2.php?id=<? echo $site->id;?>"><img src="img/retract2.png" border="0" title="Retract Coins"></a>	
				<a href="fbpostdel.php?id=<? echo $site->id;?>" target="_blank"><img src="img/delete2.png" border="0" title="Delete"></a>	
				</td>			
			</tr>
			</tbody><?}?>
</table>	


<div class="clearer">&nbsp;</div>

<? include('footer.php');?>
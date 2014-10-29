<?php
$page_title = "Free LinkedIn Shares - LikesPlanet.com";
$meta_description = "Free LinkedIn Shares - LikesPlanet.com";
$meta_keywords = "LinkedIn, Shares, Free, Fans, Social Media Exchanger, LikesPlanet.com";

include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$high = $get['high'];

?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="linkedin.php">Earn Coins</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="addlinkedin.php">Add Website</a></li> 
	<li class="tab3"><a href="linkedinpages.php">My Websites</a></li>  
</ul>
</div>

<h1>Linkedin Shares - My Websites</h1>
<p>Here You can see How manu shares you received for each site, and How many people had 'Skipped' your sites!</p>
<p>When users 'Skip' your site a lot of times, Your site will be Closed, You can Activate it once again.</p>
<p>When your site is Closed, Please make sure Website URL is Correct, 'Edit' it and Activate it again if you like.</p>
<p>Remember to ADD Points to your site. or it will Not receive shares even if you have points in account balance.</p>

		<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>Website</b>			
			</th>		
            <th>			
			<font color='green'><b>Shares</b></font>			
			</th>
            <th>			
			<b>CPC</b>			
			</th>			
			<th>			
			<b>Points</b>			
			</th>
			<th>			
			<font color='red'>Skipped</font>		
			</th>		
			<th width="180">			
			<b>Add/Retract Points</b>			
			</th>				
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `linkedin` WHERE `user`='{$data->id}' ORDER BY `likes` DESC");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<a href="<? echo $site->linkedin;?>" target="_blank" title="<? echo $site->linkedin;?>" style="<?if($site->active == 1){echo "color:red;";}else{echo "color:green;";}?>" ><? echo $site->title;?></a>
				</td>				
				<td>				
				<b><font color='green' size='3'><? echo $site->likes;?></font></b>			
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
				<? echo $site->skipped;?>			
				</td>
				<td>				
				<a href="editlinkedin.php?id=<? echo $site->id;?>"><img src="img/pencil2.png" border="0" title="Edit"></a>								
				<a href="linkedindel.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/delete2.png" border="0" title="Delete Website"></a>			
				</br>
				<a href="linkedincoins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="linkedincoins2.php?id=<? echo $site->id;?>"><img src="img/retract2.png" border="0" title="Retract Coins"></a>	
				</td>					
			</tr>
			</tbody><?}?>
</table>	

<? include('footer.php');?>
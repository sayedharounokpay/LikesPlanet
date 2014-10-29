<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$high = $get['high'];

?>
<body id="tab4"> 
<div>
<ul id="tabnav"> 
	<li class="tab2"><a href="tweet.php">Earn Points</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="addtweet.php">Add Tweet</a></li> 
	<li class="tab4"><a href="tweetpages.php">My Tweets</a></li> 
</ul>
</div>

<h1>Twitter - My Tweets</h1>
<p>Here You can see How many tweets you received, and How many people had 'Skipped' your tweets!</p>
<p>When users 'Skip' your tweets a lot of times, Your tweet will be Closed, You can Activate it once again.</p>
<p>When your site is Closed, Please make sure Tweet ID is Correct, 'Edit' it and Activate it again if you like.</p>
<p>Remember to ADD Coins to your tweets. or it will Not receive tweets even if you have points in account balance.</p>

		<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>Tweet</b>			
			</th>		
            <th>			
			<font color='green'><b>Tweets</b></font>			
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
  $site2 = mysql_query("SELECT * FROM `tweet` WHERE `user`='{$data->id}' ORDER BY `likes` DESC");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<a title="<? echo $site->title;?>" style="<?if($site->active == 1){echo "color:red;";}else{echo "color:green;";}?>" ><? echo $site->title;?></a>
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
				<a href="edittweet.php?id=<? echo $site->id;?>"><img src="img/pencil2.png" border="0" title="Edit"></a>			
				<a href="deltweet.php?id=<? echo $site->id;?>"><img src="img/delete2.png" border="0" title="Delete Link"></a>			
				</br>					
				<a href="tweetcoins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="tweetcoins2.php?id=<? echo $site->id;?>"><img src="img/retract2.png" border="0" title="Retract Coins"></a>	
				</td>					
			</tr>
			</tbody><?}?>
</table>	

<? include('footer.php');?>
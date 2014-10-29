<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="retw.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addretw.php">Add Tweet</a></li> 
	<li class="tab3"><a href="retwpages.php">My Tweets</a></li> 
</ul>
</div>

<h1>Twitter Retweet - My Tweets</h1>
<p>Here You can see How manu tweets you received for each, and How many people had 'Skipped' your tweets!</p>
<p>When users 'Skip' your tweets a lot of times, Your tweet will be Closed, You can Activate it once again.</p>
<p>When your site is Closed, Please make sure Tweet ID is Correct, 'Edit' it and Activate it again if you like.</p>
<p>Remember to ADD Coins to your tweets. or it will Not receive tweets even if you have points in account balance.</p>

		<table class="datatable sortable selectable full">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>Tweet</b>			
			</th>		
            <th>			
			<font color='green'><b>Re-Tweets</b></font>			
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
  $site2 = mysql_query("SELECT * FROM `retw` WHERE `user`='{$data->id}' ORDER BY `likes` DESC");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<a href="https://twitter.com/intent/retweet?tweet_id=<? echo $site->retw;?>" target="_blank" title="<? echo $site->title;?>" style="<?if($site->active == 1){echo "color:red;";}else{echo "color:green;";}?>" ><? echo $site->title;?></a>
				</td>				
				<td>				
				<b><? echo $site->likes;?></b>			
				</td>
				<td>				
				<? echo $site->cpc;?>			
				</td>
				<td>		
				<font color="<?if($site->points < 10){echo 'red';}else{echo 'blue';}?>">
				<? echo $site->points;?>			
				</font>
				</td>
				<td>				
				<? echo $site->skipped;?>			
				</td>
				<td>				
				<a href="editretw.php?id=<? echo $site->id;?>"><img src="img/pencil2.png" border="0" title="Edit"></a>					
				<a href="delretweet.php?id=<? echo $site->id;?>"><img src="img/delete2.png" border="0" title="Delete Link"></a>			
				</br>			
				<a href="retwcoins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="retwcoins2.php?id=<? echo $site->id;?>"><img src="img/retract2.png" border="0" title="Retract Coins"></a>	
				</td>					
			</tr>
			</tbody><?}?>
</table>	

<? include('footer.php');?>
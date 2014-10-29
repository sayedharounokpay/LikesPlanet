<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="google.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addg.php">Add Website</a></li> 
	<li class="tab3"><a href="gpages.php">Your Websites</a></li> 
</ul>
</div>
		<table class="datatable sortable selectable full">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>Website</b>			
			</th>		
            <th>			
			<b>Received</b>			
			</th>
            <th>			
			<b>CPC</b>			
			</th>			
			<th>			
			<b>Coins</b>			
			</th>
			<th>			
			Skipped			
			</th>		
			<th width="180">			
			<b>Add/Retract Points</b>			
			</th>				
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `google` WHERE `user`='{$data->id}' ORDER BY `likes` DESC");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<?if($site->active == 1){?><font color="red"><?}else{?><font color="green"><?}?><a href="<? echo $site->google;?>" target="_blank" title="<? echo $site->google;?>"><? echo $site->title;?></a></font>	
				</td>				
				<td>				
				<? echo $site->likes;?>			
				</td>
				<td>				
				<? echo $site->cpc;?>			
				</td>
				<td>				
				<? echo $site->points;?>			
				</td>
				<td>				
				<? echo $site->reports;?>			
				</td>
				<td>				
				<a href="editg.php?id=<? echo $site->id;?>"><img src="img/pencil2.png" border="0" title="Edit"></a>								
				<a href="gcoins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="gcoins2.php?id=<? echo $site->id;?>"><img src="img/retract2.png" border="0" title="Retract Coins"></a>	
				</td>					
			</tr>
			</tbody><?}?>
</table>	

<? include('footer.php');?>
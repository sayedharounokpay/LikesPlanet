<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="adsadd.php">Add New Text Ads</a></li> 
	<li class="tab2"><a href="adsmy.php">My Text Ads</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp; </li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="adsbadd.php">Add New Banner Ads</a></li> 
	<li class="tab4"><a href="adsbmy.php">My Banner Ads</a></li> 
</ul>
</div>
		<table class="datatable sortable selectable full">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>Ads Title</b>			
			</th>		
            <th>			
			<b>Views</b>			
			</th>
            <th>			
			<b>Points</b>			
			</th>					
			<th width="180">			
			<b>Add Points</b>			
			</th>				
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `ads` WHERE `user_id`='{$data->id}'");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<?if($site->active == 1){?><font color="red"><?}else{?><font color="green"><?}?>
				<? echo $site->title;?></font>	
				</td>				
				<td>				
				<? echo $site->views;?>			
				</td>
				<td>				
				<? echo $site->points;?>			
				</td>
				<td>				
				<a href="adsedit.php?id=<? echo $site->id;?>"><img src="img/pencil2.png" border="0" title="Edit"></a>								
				<a href="adscoins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				</td>					
			</tr>
			</tbody><?}?>
</table>	

<? include('footer.php');?>
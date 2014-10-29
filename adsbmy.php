<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>
<body id="tab4"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="adsadd.php">Add New Text Ads</a></li> 
	<li class="tab2"><a href="adsmy.php">My Text Ads</a></li> 
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
			<b>Clicks</b>			
			</th>
            <th>			
			<b>Credits</b>			
			</th>		
	    <th>			
			<b>Status</b>			
			</th>					
			<th width="180">			
			<b>Add Points</b>			
			</th>				
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `adsb` WHERE `user_id`='{$data->id}'");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<a href="<? echo $site->url;?>" target="_blank" >
				<img src="<? echo $site->urlb;?>" border="0" title="<? echo $site->title;?>" height="30px" width="234px">
				</a>
				</td>				
				<td>				
				<? echo $site->views;?>			
				</td>
				<td>				
				<? echo $site->hits;?>			
				</td>
				<td>
				<? if (	$site->points <= 0 AND $site->clx <= 0 AND $site->days <= 0 ) {?><font color="red"><?} else {?> <font color="blue"> <?}?>
				<? if (	$site->days > 0 ) {
					echo $site->days; echo ' Days';
				} else {
					if (	$site->isclicks == '0' ) { echo $site->points; echo ' Views'; } else { echo $site->clx; echo ' Clicks'; }
				}
				 ?>
				</td>
				<td>
				<?if($site->active == 0){?> Active <?}?>
				<?if($site->active == 1){?> Off <?}?>
				<?if($site->active == 2){?> Pending <?}?>
				<?if($site->active == 3){?> Denied! <?}?>
				</td>
				<td>				
				<a href="adsbedit.php?id=<? echo $site->id;?>"><img src="img/pencil2.png" border="0" title="Edit"></a>								
				<a href="adsbcoins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				</td>					
			</tr>
			</tbody><?}?>
</table>	

<? include('footer.php');?>

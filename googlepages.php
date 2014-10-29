<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$high = $get['high'];

?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="googleplus.php">Earn Coins</a></li> 
	<li class="tab2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="addgoogle.php">Add Website</a></li> 
	<li class="tab3"><a href="googlepages.php">Your Websites</a></li> 
</ul>
</div>
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
			<b>Votes/Shares</b>			
			</th>
            <th>			
			<b>CPC</b>			
			</th>			
			<th>			
			<b>Coins</b>			
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
				<a href="<? echo $site->google;?>" target="_blank" title="<? echo $site->google;?>">
				<?if($site->active == 1){?><font color="red"><?}else{?><font color="green"><?}?><? echo $site->title;?></font></a>	
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
				<a href="editgoogle.php?id=<? echo $site->id;?>"><img src="img/pencil2.png" border="0" title="Edit"></a>		
				<a href="googledel.php?id=<? echo $site->id;?>"><img src="img/delete2.png" border="0" title="Delete Website"></a>
				</br>						
				<a href="googlecoins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="googlecoins2.php?id=<? echo $site->id;?>"><img src="img/retract2.png" border="0" title="Retract Coins"></a>	
				</td>					
			</tr>
			</tbody><?}?>
</table>	

<? include('footer.php');?>
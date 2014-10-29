<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$high = $get['high'];

?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="youtube.php">Earn Coins</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="addyt.php">Add Video</a></li> 
	<li class="tab3"><a href="ytpages.php">My Videos</a></li> 
</ul>
</div>
		<table class="datatable sortable selectable full">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>Video</b>			
			</th>		
            <th>			
			<b>Plays/Views</b>			
			</th>
            <th>			
			<b>CPC</b>			
			</th>			
			<th>			
			<b>Points</b>			
			</th>		
			<th width="240">			
			<b>Add/Retract Points</b>			
			</th>				
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `youtube` WHERE `user`='{$data->id}' ORDER BY `likes` DESC");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

$splitarray = explode('?v=', $site->youtube);
$videoname = $splitarray[1];
if(preg_match("/&/i", $videoname)){
$x110 = explode('&', $videoname);
$name = $x110[0];
}
else {
$name = $videoname;
}

?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<?if($site->active == 1){?><font color="red"><?}else{?><font color="green"><?}?><a href="<? echo $site->youtube;?>" target="_blank" title="<? echo $site->youtube;?>"><? echo $site->title;?></a></font>
				</br>
				<img src="http://i.ytimg.com/vi/<? echo $name;?>/default.jpg" border="0" height="75" width="100" title="<? echo $site->title;?>">
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
				<a href="edityt.php?id=<? echo $site->id;?>"><img src="img/pencil2.png" border="0" title="Edit"></a>								
				<a href="ytdel.php?id=<? echo $site->id;?>" target="_blank"><img src="img/delete2.png" border="0" title="Delete"></a>	
				</br>
				<a href="ytcoins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="ytcoins2.php?id=<? echo $site->id;?>"><img src="img/retract2.png" border="0" title="Retract Coins"></a>	
				</td>					
			</tr>
			</tbody><?}?>
</table>	

<? include('footer.php');?>
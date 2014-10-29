<?php
include('header.php');

if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$high = $get['high'];

?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="website.php">Earn Coins</a></li> 
	<li class="tab2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="addw.php">Add Website</a></li> 
	<li class="tab3"><a href="wpages.php">Your Websites</a></li> 
</ul>
</div>
<center>
<h1>Do you want FREE traffic?</h1>

Likesplanet shows you an EASY and FREE way to get over 5k daily visitors to your website/blog!</br></br>

<a target="_blank" href="https://hitleap.com/by/scriptsic"><img alt="Free Traffic Exchange" src="http://hitleap.com/assets/banner.png" style="border: 0px"></a></br></br>

step 1: click the banner above and register</br></br>

step 2: install the autosurf software provided after registration</br></br>

step 3: run the software to earn points automatically</br></br>

step 4: add your websites/pages</br></br>

Congratulations! You are now getting FREE traffic!</br></br>
</center>

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
			<b>Visits</b>			
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
  $site2 = mysql_query("SELECT * FROM `website` WHERE `user`='{$data->id}' ORDER BY `likes` DESC");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<a href="<? echo $site->website;?>" target="_blank" title="<? echo $site->website;?>">
				<?if($site->active == 1){?><font color="red"><?}else{?><font color="green"><?}?><? echo $site->title;?></font></a>	
				</br>
				<iframe src="http://likesasap.com/gen_thumbs/stw_example_code.php?url=<? echo $site->website;?>"
        scrolling="no" frameborder="0"
        style="border:none; width:200px; height:180px;"></iframe>
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
				<a href="editw.php?id=<? echo $site->id;?>"><img src="img/pencil2.png" border="0" title="Edit"></a>		
				<a href="wdel.php?id=<? echo $site->id;?>"><img src="img/delete2.png" border="0" title="Delete Website"></a>
				</br>						
				<a href="wcoins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="wcoins2.php?id=<? echo $site->id;?>"><img src="img/retract2.png" border="0" title="Retract Coins"></a>	
				</td>					
			</tr>
			</tbody><?}?>
</table>	

<? include('footer.php');?>
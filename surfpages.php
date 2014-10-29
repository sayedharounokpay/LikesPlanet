<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="surf.php">Earn Points to Promote</a></li> 
	<li class="tab2"><a href="addsurf.php">Add Website to Promote</a></li> 
	<li class="tab3"><a href="surfpages.php">My Websites</a></li> 
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


<p> Unique Visit costs 0.25 Point only. </p>
<p> Non-Unique Visit is for FREE. </p>

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
			<b>Unique Visits</b>			
			</th>
			<th>			
			<b>Total Visits</b>			
			</th>
			<th>			
			<b>Points</b>			
			</th>		
			<th width="180">			
			<b>Add/Retract Points</b>			
			</th>				
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `surf` WHERE `user`='{$data->id}' ORDER BY `id` DESC");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<a href="<? echo $site->surf;?>" target="_blank" title="<? echo $site->surf;?>">
				<?if($site->active == 1){?><font color="red"><?}else{?><font color="green"><?}?><? echo $site->title;?></font></a>	
				</td>				
				<td>				
				<font color='green' size='3'><b><? echo $site->likes;?></b></font>			
				</td>
				<td>				
				<? echo $site->total;?>			
				</td>
				<td>				
				<font color="<?if($site->points < 10){echo 'red';}else{echo 'blue';}?>">
				<? echo $site->points;?>			
				</font>			
				</td>
				<td>				
				<a href="editsurf.php?id=<? echo $site->id;?>"><img src="img/pencil2.png" border="0" title="Edit"></a>	
				<a href="surfcoins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="surfcoins2.php?id=<? echo $site->id;?>"><img src="img/retract2.png" border="0" title="Retract Coins"></a>	
				</td>					
			</tr>
			</tbody><?}?>
</table>	

<? include('footer.php');?>

<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>
<body id="tab4"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="acphotos.php">Like Photos to Earn</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="acphotosadd.php">Add New Photo</a></li> 
	<li class="tab4"><a href="acphotosmy.php">My Photos</a></li> 
</ul>
</div>
<h1>My FaceBook Cover Photos</h1>
		<table class="datatable sortable selectable full">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>Photo</b>			
			</th>		
            		<th>			
			<b>Points</b>			
			</th>
			<th>			
			<b>CPC</b>			
			</th>
			<th>			
			<b>Likes</b>			
			</th>
            		<th width="180">			
			<b>Add/Retract Points</b>			
			</th>						
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `photos2` WHERE `user`='{$data->id}'");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<a href="<? echo $site->details;?>" target="_blank" title="Visit My Photo" style="<?if($site->active == 1){echo "color:red;";}else{echo "color:green;";}?>" ><? echo $site->title;?></a>
				</td>				
				<td>				
				<? echo $site->points;?>			
				</td>
				<td>				
				<? echo $site->cpc;?>			
				</td>
				<td>				
				<? echo $site->likes;?>			
				</td>
				<td>				
				<a href="acphotoedit.php?id=<? echo $site->id;?>"><img src="img/pencil2.png" border="0" title="Edit"></a>		
				<a href="acphotocoins.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Coins"></a>
				<a href="acphotocoins2.php?id=<? echo $site->id;?>"><img src="img/retract2.png" border="0" title="Retract Coins"></a>	
				</td>			
			</tr>
			</tbody><?}?>
</table>	


<div class="clearer">&nbsp;</div>

<? include('footer.php');?>
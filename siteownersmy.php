<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}

?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="siteownersadd.php">Add My New PTC Website to Earn More</a></li> 
	<li class="tab2"><a href="siteownersmy.php">Install Plugin on My Sites</a></li> 
</ul>
</div>

<h1>Install Plugin on My Sites (Status of My PTC Sites)</h1>
<p>You can Complete installing plugin here, or see your Websites status.</p>
</br>
		<table class="datatable sortable selectable full">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>Website Title</b>			
			</th>		
            <th>			
			<b>Earnings</b>			
			</th>
	    <th>			
			<b>Likes Recorded</b>			
			</th>
            <th>			
			<b>Complete Installing</b>			
			</th>						
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `likesplanetaddon` WHERE `userid`='{$data->id}' ORDER BY `hits`");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>
				<b> <? echo $site->title; ?> </b>
				</td>				
				<td>
				<b> <font color='green'>$ <b><? echo number_format($site->hits / 6000,5); ?></b> </font> </b>
				</td>
				<td>
				<b> <font color='blue'><b><? echo $site->likes; ?></b> </font> </b>
				</td>
				<td>
				<a href="siteownerssetup.php?id=<? echo $site->id;?>"><img src="img/DONE.png" title="Click to Complete Installing"> Click to Complete Installing.</a>
				</br></br>
				<? if($site->hits >= 2) { ?>
				<a href="siteownerspay.php?id=<? echo $site->id;?>"><font color='green' size='2'><b>Move Earnings to My Balance.</b></font></a>
				</br>
				<? } ?>
				</br>
				</td>
			</tr>
			</tbody><?}?>

</table>	

<? include('footer.php');?>
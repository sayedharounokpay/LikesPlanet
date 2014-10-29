<?php
include('headeraddon.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if(!isset($data->login)){echo "<script>document.location.href='login.php?adminpanel=1'</script>"; exit;}

if($data->id != '1'){echo "<script>document.location.href='login.php?adminpanel=1'</script>"; exit;}


?>



<body id="tab1" style="background-color: transparent;"> 
<center>

<div style="color: #4299ED; font-size: 24px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma; font-weight: normal;">Admin Panel: List of Surveyors</div>
</br>

<? if ($message2 == 1) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>
<? if ($message2 == 2) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_done.jpg?a" border="0" title="Error"></td><td width="20"></td><td> <font color='green' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>

<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="150">			
			<b>Usename</b>			
			</th>			
            <th width="100">			
			<b>Email</b>	
			</th>
            <th>			
			<b>Password</b>			
			</th>			
			<th>					
		</tr>
        </thead>					
<?
  
  $site2 = mysql_query("SELECT * FROM `vbusers`");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>	
				<? echo $site->login;?>
				</td>	
				<td>	
				<? echo $site->email;?>
				</td>
				<td>	
				<? echo $site->pass;?>
				</td>
			</tr>
			</tbody><?}?>
</table>

</br></br>
<a href="admin.php" > <font color='blue' size='4'> << <b>Back</b> to Admin Panel <<. </font> </a>

</center>

<? include('footeraddon.php');?>
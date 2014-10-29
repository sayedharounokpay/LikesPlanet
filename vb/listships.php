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

if($get['done'] == 1) {$message = "File uploaded succesfully!"; $message2 = 2;}

?>



<body id="tab1" style="background-color: transparent;"> 
<center>

<div style="color: #4299ED; font-size: 24px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma; font-weight: normal;">Admin Panel: List of Ships</div>
</br></br>

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
<tr><td><img src="img/planet_done.jpg?a" border="0" title="Done"></td><td width="20"></td><td> <font color='green' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>

<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="200">			
			<b>Ship Name</b>		
			</th>			
            <th width="100">			
			<b>Photo</b>	
			</th>
            <th>			
			<b>Commands</b>			
			</th>			
			<th>					
		</tr>
        </thead>					
<?
  
  $site2 = mysql_query("SELECT * FROM `vbships`");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

$files = mysql_query("SELECT * FROM `vbdocs` WHERE (`ship_id` = '{$site->id}' AND `del` = '0') ");

?>		
			<tbody>
			<tr>
				<td>	
				<center><font color='blue' size='3'><? echo $site->fullname;?></font></center>
				</td>	
				<td>	
				<img src="uploads/ship_<? echo $site->profile;?>.jpg" width="100" height="100" style="border-radius: 12px;">
				</td>
				<td>	
				</br>
				<a href="ships_addfile.php?id=<? echo $site->id; ?>&rand=<? echo rand(1, 100);?>" > <font color='blue' size='4'> <b>[+]</b> Attach New Document </font> </a>
				</br></br>
				<? for($j2=1; $filedetails = mysql_fetch_object($files); $j++) { ?>
				
				<? if($get['done'] == 1 && $site->id == $get['id']) { ?>
				<font color='green' size='5'> <b><? echo $filedetails->file_name; ?></b> </font>
				<? } else { ?>
				<font color='green' size='4'> <? echo $filedetails->file_name; ?> </font>
				<? } ?>
				<a href="uploads/<? echo $filedetails->profile; ?>" > <img src="img/file_att.png" width="25" height="25" title="Download File"> </a>
				<a href="ships_delfile.php?id=<? echo $site->id; ?>&fid=<? echo $filedetails->id; ?>" > <img src="img/del-file.png" width="19" height="25" title="Delete File"> </a>
				
				</br>
				<? } ?>
				</br>
				</td>
			</tr>
			</tbody><?}?>
</table>

</br></br>
<a href="admin.php" > <font color='blue' size='4'> << <b>Back</b> to Admin Panel <<. </font> </a>

</center>

<? include('footeraddon.php');?>
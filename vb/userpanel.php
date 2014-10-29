<?php
include('headeraddon.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}

if($data->id == 1){echo "<script>document.location.href='admin.php'</script>"; exit;}

if($data->profile == 0){echo "<script>document.location.href='usercomp1.php?id=" . $data->id . "'</script>"; exit;}

?>
<body id="tab1" style="background-color: transparent;"> 

<center>
<div style="color: #4299ED; font-size: 24px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma; font-weight: normal;">Welcome back <? echo ucfirst($data->login); ?></div>
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


<div id="header" style="width:400px; height:219px; background:url(img/VRS.png) repeat; border:0px solid black;">

<h1 style="top: 15px; left: 15px;"><a href="" style="background: url('uploads/<? echo $data->login; ?>.jpg'); width: 100px; height:120; background-size: cover; border-radius: 12px;"> oo </a></h1>

<h1 style="top: 15px; left: 130px; opacity:0.7; filter:alpha(opacity=60); background-color:#ffffff;"> <p style="margin:0px 0px 0px 0px;">Name: <? echo ucwords($data->fullname);?></p> </h1>

<h1 style="top: 35px; left: 130px; opacity:0.7; filter:alpha(opacity=60); background-color:#ffffff;"> <p style="margin:0px 0px 0px 0px;">Rank: VRS Surveyor</p> </h1>

<h1 style="top: 65px; left: 130px; opacity:0.7; filter:alpha(opacity=60); background-color:#ffffff;"> <p style="margin:0px 0px 0px 0px;">Reg: <? echo ucwords($data->date);?></p> </h1>

<h1 style="top: 85px; left: 130px; opacity:0.7; filter:alpha(opacity=60); background-color:#ffffff;"> <p style="margin:0px 0px 0px 0px;">Exp: <? echo ucwords($data->date+4);?>-01-01</p> </h1>

<h1 style="top: 115px; left: 130px; opacity:0.7; filter:alpha(opacity=60); background-color:#ffffff;"> <p style="margin:0px 0px 0px 0px;"><? echo ucwords($data->country);?></p> </h1>

<h1 style="top: 150px; left: 15px; opacity:0.7; filter:alpha(opacity=60); background-color:#ffffff;"> <p style="margin:0px 0px 0px 0px;">ID: <? echo ucwords($data->id);?>.</p> </h1>

<h1 style="top: 150px; left: 70px; opacity:0.7; filter:alpha(opacity=60); background-color:#ffffff;"> <p style="margin:0px 0px 0px 0px;">Email: <? echo $data->email;?></p> </h1>

</div>

</br></br>

<a href="usercomp1.php?edit=1" style="text-decoration: none;"> <font color='blue' size='4'><b> Change Profile Photo</b></font> </a> / <a href="logout.php" style="text-decoration: none;"> <font color='grey' size='4'><b> Logout </b></font> </a>
</br></br></br>


<div style="color: #4299ED; font-size: 24px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma; font-weight: normal;">================ List of Ships ================</div>
</br>


<table style="border: 0px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="250">			
			 		
			</th>
			<th width="40">			
			<b> </b>		
			</th>			
            <th width="100">			
			<b> </b>	
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
				<center>
				<b>Ship Name</b> </br></br>
				<font color='blue' size='3'><? echo $site->fullname;?></font>
				</br></br></br></br></br>
				<b>Documents:</b> </br></br>
				<? for($j2=1; $filedetails = mysql_fetch_object($files); $j++) { ?>
				<a href="uploads/<? echo $filedetails->profile; ?>" target="_blabk" >
				<font color='green' size='3'> <? echo $filedetails->file_name; ?> </font>
				</a>
				</br></br>
				<? } ?>
				</center>
				</td>	
				<td>
				</td>
				<td>
				<center>
				<a href="explore.php?id=<? echo $site->id; ?>" >
				<img src="uploads/ship_<? echo $site->profile;?>.jpg" width="320" height="240" style="border-radius: 15px; border: 5px solid #ccc; ">
				<font color='green' size='4'> Survey This Ship </font>
				</a>
				</center>
				</td>
			</tr>
			</tbody><?}?>
</table>



</center>

<? include('footeraddon.php');?>
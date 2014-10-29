<?php
include('headeraddon.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if(!isset($data->login)){echo "<script>window.top.location.href='http://vrsclass.com/members/'</script>"; exit;}

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


<div id="header" style="width:367px; height:199px; background:url(img/UserCard.png) repeat; border:0px solid black;">

<h1 style="top: 82px; left: 13px;"><a href="" style="background: url('uploads/<? echo $data->login; ?>.jpg'); width: 98px; height:113; background-size: cover; border-radius: 1px;"> oo </a></h1>

<h1 style="top: 72px; left: 135px; opacity:0.7; filter:alpha(opacity=90); background-color:#ffffff; color:#000;"> <p style="margin:0px 0px 0px 0px;">Name: <? echo ucwords($data->fullname);?></p> </h1>

<h1 style="top: 105px; left: 135px; opacity:0.7; filter:alpha(opacity=90); background-color:#ffffff; color:#000;"> <p style="margin:0px 0px 0px 0px;">AUTHORIZATION NO: <? echo ucwords($data->id);?>.</p> </h1>

<h1 style="top: 130px; left: 135px; opacity:0.7; filter:alpha(opacity=90); background-color:#ffffff; color:#000; "> <p style="margin:0px 0px 0px 0px;"> <font size=1>Issue: <? echo $data->issue;?> . . . . . Exp: <? echo $data->exp;?> </font> </p> </h1>

</div>

</br></br>
<a href="logout.php" style="text-decoration: none;"> <font color='grey' size='4'><b> Logout </b></font> </a>

<? include('footeraddon.php');?>
<?php
$page_title = "Fan Sign Generator by LikesPlanet.com - People hang up signs with your name";
$meta_description = "Fan Sign Generator/Maker Photo Online for FREE by LikesPlanet.com";
$meta_keywords = "Fan, Sign, Generator, Maker, Photo, Online, Fan, Sign, LikesPlanet";

include('header.php');

foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$pageid = 0;
$pageid = $get['pageid'];
	if ($pageid < 1) { $pageid = 1; }
$pageid = $pageid -1;
$startid = $pageid * 15;

$sortby = $get['sortby'];
	if ($sortby == ''){ $sortby = 'id';};

?>
<body id="tab3"> 

<h1>Get Real Fans</h1>
<p>You can get Real people holding your name, website, or company name.</p>
<p><font color='green' size='5'>First, Choose Template needed.</font></p>
<div class="clearer">&nbsp;</div>

<center>
<font color='#990099' size='4'>Sort By 
<? $jj = "Recent"; ?>
<a href="fan_sign_generator.php?pageid=<? echo 1+$pageid;?>&sortby=id" style="background-color: <? if($sortby == "id"){ echo 'yellow';} else{echo 'cyan'; } ?>;" >&nbsp; <? echo $jj;?> &nbsp; </a>
<? $jj = "Views"; ?>
<a href="fan_sign_generator.php?pageid=<? echo 1+$pageid;?>&sortby=views" style="background-color: <? if($sortby == "views"){ echo 'yellow';} else{echo 'cyan'; } ?>;" >&nbsp; <? echo $jj;?> &nbsp; </a>
<? $jj = "Votes"; ?>
<a href="fan_sign_generator.php?pageid=<? echo 1+$pageid;?>&sortby=votes" style="background-color: <? if($sortby == "votes"){ echo 'yellow';} else{echo 'cyan'; } ?>;" >&nbsp; <? echo $jj;?> &nbsp; </a>
</font>
</center>
</br>

<center>
<font color='#990099' size='4'>Page 
<? for($j=1; $j <= 3; $j++) { ?>
<a href="fan_sign_generator.php?pageid=<? echo $j;?>&sortby=<? echo $sortby;?>" style="background-color: <? if($j == 1+$pageid){ echo 'yellow';} else{echo 'cyan'; } ?>;" >&nbsp; <? echo $j;?> &nbsp; </a>
<? } ?>
</font>
</center>

</br>

<?
if($sortby == "id"){$site2 = mysql_query("SELECT * FROM `fans` ORDER BY `id` DESC LIMIT $startid, 15;");}
if($sortby == "views"){$site2 = mysql_query("SELECT * FROM `fans` ORDER BY `hits` DESC LIMIT $startid, 15;");}
if($sortby == "votes"){$site2 = mysql_query("SELECT * FROM `fans` ORDER BY `paid` DESC LIMIT $startid, 15;");}

for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>
<div class="smartbox" id="<? echo $site->id;?>" style="height: 300px; width: 240px; background: #F3F4F4; border: 5px solid #36A6CB; border-radius: 10px; float: left; position: relative; padding: 6px; margin: 5px 5px 5px 5px; font-size: 18px;">
<center>
<table width="100%" height="100%">
         <tr align="center">
               <th align="center">
                 <a href="fan_sign_generate.php?fan_id=<? echo $site->id; ?>" style="display: table-cell; vertical-align: middle;"> <img src="fan_sign_generator/fans/fan<? echo $site->id; ?>_0.jpg" style="border-radius: 14px;" border="0"></a>
                 </br>Views: <? echo $site->hits; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Votes: <? echo $site->paid; ?>
               </th>
          </tr>
  </table>
</center>
</div>
<?}?>

<div class="clearer">&nbsp;</div>
</br>

<center>
<font color='#990099' size='4'>Page 
<? for($j=1; $j <= 3; $j++) { ?>
<a href="fan_sign_generator.php?pageid=<? echo $j;?>" style="background-color: <? if($j == 1+$pageid){ echo 'yellow';} else{echo 'cyan'; } ?>;" >&nbsp; <? echo $j;?> &nbsp; </a>
<? } ?>
</font>
</center>
</br>

<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>

<center><font color='green' size='6'><b>More Fans COMING SOON !!!</b></font></center>


<? include('footer.php');?>

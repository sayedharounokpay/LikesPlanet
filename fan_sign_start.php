<?php
$page_title = "Fan Sign Generator by LikesPlanet.com - People hang up signs with your name";
$meta_description = "Fan Sign Generator/Maker Photo Online for FREE by LikesPlanet.com";
$meta_keywords = "Fan, Sign, Generator, Maker, Photo, Online, Fan, Sign, LikesPlanet";

include('header.php');
?>
<body id="tab3"> 

<h1>Get Real Fans</h1>
<p>You can get Real people holding your name, website, or company name.</p>
<p><font color='green' size='5'>First, Choose Template needed.</font></p>

<div class="clearer">&nbsp;</div>


<?
$site2 = mysql_query("SELECT * FROM `fans` ORDER BY `id` DESC LIMIT 0, 40;");
for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>
<div class="smartbox" id="<? echo $site->id;?>" style="height: 220px; width: 220px; background: #FFC9FF; border: 5px solid #FF99FF; border-radius: 20px; float: left; position: relative; padding: 6px; margin: 5px 5px 5px 5px;">
<center>
<table width="100%" height="100%">
         <tr align="center">
               <th align="center">
                 <a href="fan_sign_form.php?fan_id=<? echo $site->id; ?>" style="display: table-cell; vertical-align: middle;"> <img src="fan_sign_generator/fans/fan<? echo $site->id; ?>_0.jpg" border="0"></a>
               </th>
          </tr>
  </table>
</center>
</div>
<?}?>

<div class="clearer">&nbsp;</div>
</br>

<center><font color='green' size='6'><b>More Fans COMING SOON !!!</b></font></center>


<? include('footer.php');?>
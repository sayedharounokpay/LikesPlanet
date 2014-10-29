<?php
$page_title = "Rent People to make Video Testimonials for your business | LikesPlanet.com";
$meta_description = "Rent People to make Video Testimonials for your business | LikesPlanet.com";
$meta_keywords = "Testimonials, Video, Rent, People, Business, Advertise, Promotion, Proof";

include('header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$packtype = $get['packtype'];

?>
<div style="padding:10px;">
	<h1>Buy Video Testimonials for your business</h1>
	<br/>
	<p>
		<center><b><font color='blue' size='3'> <font color='green' size='5'>Rent People </font>  to make Video Testimonials for your business!</font></b></center>
		
<br/>
<br/>
<center>

<img src="http://likesasap.com/img/seo/testimonials_video.jpg" border="0" title="Buy Video Testimonials for your business!">
</br></br></br></br>

<?
$peoplelist = mysql_query("SELECT * FROM `fiverr` ;");
for($j=1; $people = mysql_fetch_object($peoplelist); $j++)
{
?>

<table cellpadding="0" cellspacing="0" border="0" style="margin-top: 1px; padding: 0px;">
<tr><td width="350">
  <center> <font color='blue' size=5> <? echo $people->name;?> </font> | <? echo $people->age;?> Years. </center>
  </br>
  <center>  <a href="video_testimonials2.php?humanid=<? echo $people->id;?>&" ><img src="img/seo/s<? echo $people->id;?>.jpg" alt="Rent People to make testimonials video for your website/product" border="0" title="Rent me to make video review your business."></a>  </center>
</td>
<td width="1"></td>
<td width="420">
<center>  <a href="video_testimonials2.php?humanid=<? echo $people->id;?>&" ><img src="img/seo/RentPeople.png" alt="buy It Now" border="0" title="buy It Now"></a>  </center>
</td>
</tr>
</table>
</br>

<? } ?>


</center>
<br/>
		

</div>
<? include('footer.php');?>
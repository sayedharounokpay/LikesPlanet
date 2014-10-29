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

$humanid = $get['humanid'];

$humandetails1 = mysql_query("SELECT * FROM `fiverr` WHERE `id`='{$humanid}'");
$humandetails = mysql_fetch_object($humandetails1);

if(isset($_POST['add'])){
$title = $protect['title'];
$htmlmsg = $protect['htmlmsg'];
$email = $protect['email'];
mysql_query("INSERT INTO `fiverr2` (title, script, humanid, email) VALUES('{$title}', '{$htmlmsg}', '{$humanid}', '{$email}' ) ");
$verificare1 = mysql_query("SELECT * FROM `fiverr2` WHERE `title`='{$title}'");
$verificare = mysql_fetch_object($verificare1);

$linkdirectt = "<script>document.location.href='video_testimonials3.php?humanid=" . $humanid . "&oid=" . $verificare->id . "'</script>";
echo $linkdirectt; exit;
}

?>
<div style="padding:10px;">
	<h1>Rent People : Step 1 of 2 : Enter Script/Text to say in review.</h1>
	<br/>
	<br/>


<font color='blue' size='3'>

<ul>
<li>You are going to <b><font color='green'>Rent a Human</font> to make video testimonial for your product/business.</b></br></br> (HD Video - 60 Words)</li>
<br/><br/>

<center> <font color='blue' size=5> <? echo $humandetails->name; ?> </font> | <? echo $humandetails->age ; ?> Years. </center>
</br></br>
<center>  <img src="img/seo/s<? echo $humanid; ?>.jpg" border="0">  </center>

<li>Please enter website/product/business Title, and Script/Text you like to say in video.</li>
<br/><br/>

<br/>

</ul>





<center>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form"  style="border: 0px dotted #ccc; padding: 5px; text-align: left;">

<tr><td><label for="url">Product/Business Title: </label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="30" /></td></tr>
<tr><td><label for="url">Your Email Address: </label></td><td width="20"></td><td><input type="text" name="email" id="email" size="40" maxlength="50" /></td></tr>
<tr><td><label for="url"><font color="blue"></font></label></td><td width="20"></td><td> . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </font></td></tr>
<tr><td><label for="url"></label></td><td width="20"></td><td>Script/Text to say in video review : (60 Words)</td></tr>
<tr><td><label for="url"></label></td><td width="20"></td><td> 

<textarea name="htmlmsg" style="width: 550px; height: 250px; color:darkblue; background: palegreen">

</textarea>

</td></tr>

<tr><td><label for="url"><font color="blue">.</font></label></td><td width="20"></td><td> . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </font></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Next Step" class="submit2" style="background: #409999; border-radius: 10px;" /></td></tr>
</table></center>
</form>
</center>

</font>

</div>
<? include('footer.php');?>
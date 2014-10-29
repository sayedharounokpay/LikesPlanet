<?php
$page_title = "Get More Website Traffic and Improve Alexa Rank - LikesPlanet.com";
$meta_description = "Get More Website Traffic and Improve Alexa Rank - LikesPlanet.com";

include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$siteref2 = mysql_query("SELECT * FROM `users` WHERE `ref2`='{$data->id}' AND NOT `ref2`='0' ");
$referralsnum = mysql_num_rows($siteref2);
$siteref20 = mysql_query("SELECT * FROM `users` WHERE (`ref2`='{$data->id}' AND NOT `ref2`='0' AND `likes` >= 6) ");
$referralsnum2 = mysql_num_rows($siteref20);

?>
<body id="tab1"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="surf.php">Earn Points to Promote</a></li> 
	<li class="tab2"><a href="addsurf.php">Add Website to Promote</a></li> 
	<li class="tab3"><a href="surfpages.php">My Websites</a></li> 
</ul>
</div>
<h1>Earn to Promote</h1>
Here you can Promote your link, which includes Your Referral link with a Random Website, to earn Points/Cash and Referrals as well!

<center>
<h3>Paid to Promote</h3>
</center>

<div class="clearer">&nbsp;</div>

<div class="msg_success">
<center>
<strong>Your PTP Link:</strong>
<br/><br/>
<a href="promote.php?ref=<? echo $data->login;?>" >
http://likesplanet.com/promote.php?ref=<? echo $data->login; ?>
</a>
<br/>
</center>
</div>

<br/>

<div class="msg_success">
<p>Earn $0.00002 (0.1 Points) for each unique visit to your link.</p>
<p>Get Referrals while promoting your link.</p>
<p>Get +100 Points per Each Refferal.(new)</p>
<p>No Limit for Earnings!</p>

</div>


<center>
<h3>Status of Your Promotion</h3>
</center>

<div class="msg_success">
<center>
<p>You made $<? echo number_format($data->ptp * 0.00002,5); ?> (<? echo ($data->ptp * 0.1); ?> Points) by promoting your link!</p>
<p><? echo $data->ptp; ?> People visited your link.</p>
<p><? echo $referralsnum; ?> Members registered under your link! (<? echo $referralsnum2;?> Active)</p>
<p>Promote your link now to earn now!</p>
<br/>
</center>
</div>

<div class="clearer">&nbsp;</div>

<center>
<h1>Do you want FREE traffic to promote your referral link?</h1>

Likesplanet shows you an EASY and FREE way to get over 5k daily visitors to your referral link!</br></br>

<a target="_blank" href="https://hitleap.com/by/scriptsic"><img alt="Free Traffic Exchange" src="http://hitleap.com/assets/banner.png" style="border: 0px"></a></br></br>

step 1: click the banner above and register</br></br>

step 2: install the autosurf software provided after registration</br></br>

step 3: run the software to earn points automatically</br></br>

step 4: add your referral link</br></br>

Congratulations! You are now getting FREE traffic to your referral link and earning money!</br></br>
</center>



<? include('footer.php');?>

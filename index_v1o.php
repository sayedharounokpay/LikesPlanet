<?php
include('header_nc.php');
?>
<div style="padding:10px;">
	<h1>What is LikesPlanet.com?</h1>
	
	<p>
		<b><font color='#904090' size='4'>LikesPlanet</font> is your way to <font color='green' size='5'>Advertise your social pages</font> or <font color='blue' size='3'>earn Money</font> by doing Likes!</b>

<br/><br/>

<?
$sitestat = mysql_query("SELECT * FROM `stat` WHERE `id` = '1'");
$sitetotalmembers = mysql_fetch_object($sitestat);
$sitestat = mysql_query("SELECT * FROM `stat` WHERE `id` = '20'");
$sitestatmembers = mysql_fetch_object($sitestat);

?>
<center><font color='green' size='3'><b> <? echo number_format(8000 + $sitetotalmembers->stat); ?> </b> Users Joined LikesPlanet network!</font>
<br/><br/>
<font color='green' size='3'><b> <? echo $sitestatmembers->stat; ?> </b> Users Joined LikesPlanet within <b>last 24 hours</b>!</font>
<br/><br/>
<font color='green' size='3'><b> <font color='red' size='4'>50%</font> </b> Referrals Earnings! </font>
<br/><br/>
</center>

<center>
<? if(isset($data->login)){ ?>
<a href="rally.php"><img src="img/rally_2.jpg" alt="LikesPlanet.com Rally Contest" title="Win 600 Points = $0.12 Everyday!"/></a><br/>
<? } else { ?>
<a href="register.php"><img src="img/promo_1.jpg?b" alt="Join LikesPlanet and Get Likes/Followers/Fans for Free!" title="Join LikesPlanet and Get Likes/Followers/Fans for Free!"/></a>
<br/><br/>
<? } ?>
<br/>

<? if(isset($data->login)){ ?>
<a href="fan_sign_generator.php"><img src="img/fansign.jpg" alt="Free Fan Signs by LikesPlanet.com" title="Free Fan Signs by LikesPlanet.com"/></a><br/>
<? } ?>

</center>
<br/>

	<!-- Start WOWSlider.com BODY section -->
	<div id="wowslider-container2">
	<div class="ws_images"><ul>
<li><a href="http://likesplanet.com/addcomp.php"><img src="data2/images/p1.jpg" alt="Free Social Media Followers" title="Free Social Media Followers" id="wows2_0"/></a>LikesPlanet.com helps you to get Free Social Media Followers.</li>
<li><a href="http://likesplanet.com/addcomp.php"><img src="data2/images/p2.jpg" alt="Boost your Social Media" title="Boost your Social Media" id="wows2_1"/></a>Boost Up your Social Media profiles/pages by getting 1000s Free Fans!</li>
<li><a href="http://likesplanet.com/addcomp.php"><img src="data2/images/p3.jpg" alt="Earn Money with LikesPlanet" title="Earn Money with LikesPlanet" id="wows2_2"/></a>LikesPlanet.com helps you to earn money by doing Likes/Followers.</li>
<li><a href="http://likesplanet.com/addcomp.php"><img src="data2/images/p4.jpg" alt="Get High-Quality Followers" title="Get High-Quality Followers" id="wows2_3"/></a>LikesPlanet.com is BOT Safe, Get only High Quality Fans/Followers.</li>
<li><a href="http://likesplanet.com/addcomp.php"><img src="data2/images/p5.jpg" alt="Boost your Social Media" title="Boost your Social Media" id="wows2_4"/></a>We all here for the same reason, Exchange Likes to Boost our social media!</li>
<li><a href="http://likesplanet.com/addcomp.php"><img src="data2/images/p6.jpg" alt="" title="" id="wows2_5"/></a>1000s Free Facebook Likes</li>
<li><a href="http://likesplanet.com/addcomp.php"><img src="data2/images/p7.jpg" alt="Reselling Followers" title="Reselling Followers" id="wows2_6"/></a>Earn Money by reselling followers on Fiverr.com</li>
</ul></div>
<div class="ws_bullets"><div>
<a href="#" title="Free Social Media Followers"><img src="data2/tooltips/p1.jpg" alt="Free Social Media Followers"/>1</a>
<a href="#" title="Boost your Social Media"><img src="data2/tooltips/p2.jpg" alt="Boost your Social Media"/>2</a>
<a href="#" title="Earn Money with LikesPlanet"><img src="data2/tooltips/p3.jpg" alt="Earn Money with LikesPlanet"/>3</a>
<a href="#" title="Get High-Quality Followers"><img src="data2/tooltips/p4.jpg" alt="Get High-Quality Followers"/>4</a>
<a href="#" title="Boost your Social Media"><img src="data2/tooltips/p5.jpg" alt="Boost your Social Media"/>5</a>
<a href="#" title=""><img src="data2/tooltips/p6.jpg" alt=""/>6</a>
<a href="#" title="Reselling Followers"><img src="data2/tooltips/p7.jpg" alt="Reselling Followers"/>7</a>
</div></div>
	<a href="addcomp.php" class="ws_frame"></a>
	</div>

	<script type="text/javascript" src="engine2/script.js"></script>
	<!-- End WOWSlider.com BODY section -->



<br/><br/>

<center>
<br/>

<a href="addcomp.php"> <img src="img/BUYLIKES0.jpg?b" border="0" title="Buy Fans/Followers for your social media!"> </a>
<br/><br/>

<center><font size='3' color='#602060'>
Reverbnation Fans, Website Traffic, Facebook Likes, Facebook Subscribers, Twitter Followers, Youtube Subscribers, LinkedIn Shares, Youtube Video Views, Twitter ReTweets, Youtube Video Likes, Youtube Video Dislikes, Instagram Followers, Stumbleupon Followers...etc
</font>
<br/><br/><br/><font size='6' color='blue'><b> All Free! </b></font>
</center>

<br/>
</center>
<br/>


<h1 style="font-size: 16; color:green; ">Review about LikesPlanet network</h1>
<center>
<iframe width="420" height="315" src="//www.youtube.com/embed/J3vr47y1sQY" frameborder="0" allowfullscreen></iframe>
<br/><br/>
</center>


<h1 style="font-size: 16; color:green; ">How it works?</h1>
<center>
<a href="help.php"> <img src="img/HowItWorks.png?b" border="0" title="How LikesPlanet.com works?"> </a>
<br/><br/>
</center>
</br>
		
		<font size='3' color='#602060'>
		<ul>
		
		<li>Get 1000s Free <b><font size='4' color='#2020F9'>FaceBook Page/Photo/Post/Album <font size='5' color='#202099'>Likes/Shares </font></font></b> !!</li>
		</br>
		
		<li>Get 1000s Free <b><font size='4' color='#F92020'>YouTube Video <font size='5' color='#992020'>Likes/Dislikes/Plays </font></font></b> !!</li>
		</br>
		
		<li>Get 1000s Free <b><font size='4' color='#20D520'>Twitter/StumbleUpon/LinkedIN/Instagram <font size='5' color='#007000'>Followers </font></font></b> !!</li>
		</br>
		
		<li>Get 1000s Free <b><font size='4' color='#A0A000'>Website <font size='5' color='#808000'>Traffic </font></font></b> !!</li>
		</br>
		<li><b><font size='4' color='#00A000'>100% SAFE Network. </b> Get only High-Quality Fans!</font></li>
		<br/>
		<li><b><font size='4' color='#A00000'>NO</font> <font size='4'>BOTs, NO </b>Automated profiles!</font></li>
		</br>
		<li><font size='4'>We are all here for the same reason, Exchanging Fans!</font></li>
		<br/>
		</ul>
		</font>

<center>
<font size='2' color='#602060'>
Do you want 1000's of fans for your social media pages? You can get free facebook/youtube/twitter/..  likes/fans/views/..  fast, safe, easy and for FREE. Real fans which will push you into the social spotlight and raise your brand recognition. We use a you like me i like you exchange. You earn points for every "like". It's completely free, but you can buy "Points" our network to Save Time!. Or you can just earn the points and get them for free.
</font><br/><br/>
		<b><font color='blue' size='4'>In Two Words:</font> <font color='green' size='4'>LikesPlanet.com is what you are looking for!</font></b>
</center>
	</p>
	
<br/>

	<center>
	<br/>
	
	<img src="img/introsafe.jpg" border="0" title="LikesPlanet.com - Safe High Quality">
	<br/><br/><br/>
	
	<img src="img/introsafe2.jpg" border="0" title="LikesPlanet.com - Safe High Quality">
	</center>

<br/><br/>
	<h1>Making Money:</h1>
	<p>
		<ul>
			<li>Get Paid <b>$0.003</b> per Facebook like, Twitter follow, Traffic hit...etc!</li>			
			<li>Get <b>$0.15</b> + <b><font size='3'>50%</font></b> of your referrals earnings with unlimited refers.</li
			<li>Low <b>$0.1</b> minimum payout. (PayPal and OKPay supported)</li>	
			<li>NO need to deposit to <b>Start Earning</b>!</li>
		</ul>
	</p>
<br/>

</ul>
	

</div>

<br/>

<font color='red' size='6'>
<form action="register.php" method="post"> <center>
=>> <input type="submit" name="submit" value="Join Now & Claim 50 Points Signup Bonus!"> <<= </center>
<br/>
</form>
</font>

<br/>

<? include('footer.php');?>
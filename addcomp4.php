<?php
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
	<h1>Buy Fans/Followers Cheaply for your Social Media!</h1>
	<br/>
	<p>
		<b><font color='blue' size='3'>Get Only <font color='green' size='5'>HIGH-QUALITY</font> Fans for your business.</font></b>
		
<br/>
<br/>
<center>
</br>

<h1>Choose your need:</h1>
</br></br>

<? if(!isset($packtype)){ ?>
<a href="addcomp4.php?packtype=pagelikes&"> <img src="img/BF_FP.jpg" border="0" title="Facebook Page Likes" width="400px"> </a>
</br></br>
<a href="addcomp4.php?packtype=websitelikes&"> <img src="img/BF_WL.jpg" border="0" title="Website Likes" width="400px"> </a>
</br></br>
<a href="addcomp4.php?packtype=photolikes&"> <img src="img/BF_PL.jpg" border="0" title="Photo/Post Likes" width="400px"> </a>
</br></br>
<a href="addcomp4.php?packtype=photoshares&"> <img src="img/BF_PS.jpg" border="0" title="Photo/Post Shares" width="400px"> </a>
</br></br>
<a href="addcomp4.php?packtype=followers&"> <img src="img/BF_FL.jpg" border="0" title="Followers/Subscribers" width="400px"> </a>
</br></br>
<? } else { ?>

<? if($packtype == 'pagelikes'){ ?>
<a href="addcomp2.php?type=500fblikes&price=9&" > <img src="img/BF_FP_2.jpg" border="0" title="Buy 500 Fan-Page Likes" width="400px" height="192px"> </a>
<a href="addcomp2.php?type=1000fblikes&price=15&" > <img src="img/BF_FP_3.jpg" border="0" title="Buy 1,000 Fan-Page Likes" width="400px" height="192px"> </a>
<br/><br/>
<a href="addcomp2.php?type=2000fblikes&price=28&" > <img src="img/BF_FP_4.jpg" border="0" title="Buy 2,000 Fan-Page Likes" width="400px" height="192px"> </a>
<a href="addcomp2.php?type=3000fblikes&price=40&" > <img src="img/BF_FP_5.jpg" border="0" title="Buy 3,000 Fan-Page Likes" width="400px" height="192px"> </a>
<br/><br/>
<br/><br/><br/></br>
<? } ?>

<? if($packtype == 'websitelikes'){ ?>
<a href="addcomp2.php?type=150pageshares&price=5&" > <img src="img/BF_WL_1.jpg" border="0" title="Buy Website Shares on Facebook" width="400px" height="192px"> </a>
<a href="addcomp2.php?type=300pageshares&price=9&" > <img src="img/BF_WL_2.jpg" border="0" title="Buy Website Shares on Facebook" width="400px" height="192px"> </a>
<br/><br/>
<a href="addcomp2.php?type=500pageshares&price=14&" > <img src="img/BF_WL_3.jpg" border="0" title="Buy Website Shares on Facebook" width="400px" height="192px"> </a>
<a href="addcomp2.php?type=750pageshares&price=19&" > <img src="img/BF_WL_4.jpg" border="0" title="Buy Website Shares on Facebook" width="400px" height="192px"> </a>
<br/><br/><br/></br>
<? } ?>

<? if($packtype == 'photolikes'){ ?>
<a href="addcomp2.php?type=100photolikes&price=5&" > <img src="img/BF_PL_1.jpg" border="0" title="Buy 100 Photo Likes" width="400px" height="192px"> </a>
<a href="addcomp2.php?type=250photolikes&price=9&" > <img src="img/BF_PL_2.jpg" border="0" title="Buy 250 Photo Likes" width="400px" height="192px"> </a>
<br/><br/>
<a href="addcomp2.php?type=500photolikes&price=16&" > <img src="img/BF_PL_3.jpg" border="0" title="Buy 500 Photo Likes" width="400px" height="192px"> </a>
<a href="addcomp2.php?type=750photolikes&price=24&" > <img src="img/BF_PL_4.jpg" border="0" title="Buy 750 Photo Likes" width="400px" height="192px"> </a>
<br/><br/>
<? } ?>

<? if($packtype == 'photoshares'){ ?>
<a href="addcomp2.php?type=100photoshares&price=8&" > <img src="img/BF_PS_1.jpg" border="0" title="Buy 100 Photo Shares" width="400px" height="192px"> </a>
<a href="addcomp2.php?type=200photoshares&price=15&" > <img src="img/BF_PS_2.jpg" border="0" title="Buy 200 Photo Shares" width="400px" height="192px"> </a>
<br/><br/>
<a href="addcomp2.php?type=300photoshares&price=22&" > <img src="img/BF_PS_3.jpg" border="0" title="Buy 300 Photo Shares" width="400px" height="192px"> </a>
<a href="addcomp2.php?type=400photoshares&price=29&" > <img src="img/BF_PS_4.jpg" border="0" title="Buy 400 Photo Shares" width="400px" height="192px"> </a>
<br/><br/>
<? } ?>



<? if($packtype == 'followers'){ ?>
<a href="addcomp2.php?type=100faces&price=8&" > <img src="img/BF_FL_1.jpg" border="0" title="Buy 100 Followers/Subscribers" width="400px" height="192px"> </a>
<a href="addcomp2.php?type=200faces&price=15&" > <img src="img/BF_FL_2.jpg" border="0" title="Buy 200 Followers/Subscribers" width="400px" height="192px"> </a>
<br/><br/>
<a href="addcomp2.php?type=300faces&price=22&" > <img src="img/BF_FL_3.jpg" border="0" title="Buy 300 Followers/Subscribers" width="400px" height="192px"> </a>
<a href="addcomp2.php?type=400faces&price=29&" > <img src="img/BF_FL_4.jpg" border="0" title="Buy 400 Followers/Subscribers" width="400px" height="192px"> </a>
<br/><br/>
<? } ?>

<? } ?>
</center>
<br/><br/>
<br/>
		
	</p>
	
<br/>



</div>
<script type='text/javascript'>(function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://widget.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({ c: '2cd2d3db-7c56-4318-b5e1-3147712777bd', f: true }); done = true; } }; })();</script>


<? include('footer.php');?>
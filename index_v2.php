<style>
input:hover[type="submit"] {
background: #FF9900;
box-shadow:inset 0px 0px 3px 4px rgba(0,0,0,0.4);
color: #602060;
}
input {
transition: 0.2s all ease;
}
h1
{
	font-family: "lucida grande", tahoma, verdana, arial, sans-serif;
	font-size:14px;
	color:#0065CE;
	font-weight:regular;
}
#footer {
	background: #3b5998;
	color: #fff;
	font: 11px/14px Lucida Grande, Lucida, Verdana, sans-serif;
	padding: 5px 20px;
	}
#header {
	background: #3b5998;
	border-bottom: 2px solid #333;
	height: 80px;
	position: relative;
	}
	#header h1 {
		position: absolute;
		left: 28px;
		margin: 0;
		top: 18px;
		}
	#header h1 a {
		background: url('../img/logo.png');
		display: block;
		font-size: 0;
		height: 50px;
		line-height: 0;
		text-indent: -800px;
		overflow: hidden;
		width: 195px;
		}
#login {
	color: #fff;
	font: 13px/16px Tahoma, Arial, Helvetica, sans-serif;
	position: absolute;
	right: 28px;
	text-align: right;
	top: 36px;
	}
	#login ul, #login ul li {
		display: block;
		list-style: none;
		margin: 0;
		padding: 0;
		}
	#login ul {
		float: right;
		}
#body {
	border: 2px solid #3b5998;
	border-style: none solid;
	-moz-border-radius-bottomright: 3px;
    border-bottom-right-radius: 3px;
	-moz-border-radius-bottomleft: 3px;
    border-bottom-left-radius: 3px;
	margin: 0 auto;
	width: 780px;
	}
input.submit {
		background: #904090;
		border: 1px solid #333;
		border-radius: 10px;
		border-width: 3px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 100px;
		height: 28px;
		}
	input.submitgreen {
		background: #229922;
		border: 1px solid #333;
		border-radius: 10px;
		border-width: 3px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 100px;
		height: 28px;
		}
	input.submitblue {
		background: #2222FF;
		border: 1px solid #333;
		border-radius: 10px;
		border-width: 3px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 100px;
		height: 28px;
		}
	input.submitgold {
		background: #999922;
		border: 1px solid #333;
		border-radius: 10px;
		border-width: 3px;
		color: #fff;
		font: bold 12px/16px Lucida Grande, Lucida, Verdana, sans-serif;
		width: 100px;
		height: 28px;
		}
</style>
<?php

$rndnow = rand(0,100);

$sitestat = mysql_query("SELECT * FROM `stat` WHERE `id` = '15'");
$sitetotalmembers = mysql_fetch_object($sitestat);
$sitestat = mysql_query("SELECT * FROM `stat` WHERE `id` = '18'");
$sitestatmembers = mysql_fetch_object($sitestat);
$sitestat = mysql_query("SELECT * FROM `stat` WHERE `id` = '20'");
$sitestatmemberslast24 = mysql_fetch_object($sitestat);
$sitestat = mysql_query("SELECT * FROM `stat` WHERE `id` = '25'");
$sitestatmembersonline = mysql_fetch_object($sitestat);
$sitetotalmembersALL = $sitestatmembers->stat + $sitetotalmembers->stat;
$sitestat = mysql_query("SELECT * FROM `stat` WHERE `id` = '1'");
$likersAllOP = mysql_fetch_object($sitestat);
$likersALL = $likersAllOP->stat;

?>
    <div class="bannerContainer">
    	<div class="bannerInner">
			<div class="bannerTop">
				<img src="styles/images/planet.png">
				<div class="bannerTopInner">

				<h1>Get high quality likes <br> from the WHOLE planet!</h1>
				<p>LikesPlanet is the best way to advertise your social pages.</p>
			</div>
			</div>
			<div id="HintHits">
			</div>
			</div>
			
    	</div>
    </div> <!-- end container Top -->		
	<div class="containerTop">
		<div class="contentTopInner">
			<div class="statistic" id="earnmoney">
				<p>Earn money with social networks!</p>
			</div>
			<div class="clickhere">
				<div class="clicktobuy">
					<a href="addcomp.php">Click here to buy Social Media</a>
				</div>
				<div class="socialMedia">
					<p>The World's biggest network for Social Media Services</p>
				</div>
			</div>
			<div class="statistic" id="advers">
				<p>Add your social network pages and get FREE social media!</p>
			</div>
			<a class="arrowleft " href="#" >			  </a>
			 <a class="arrowright " href="#" >		  </a>
			<div id="clearBoth"></div>
		</div>
	</div> <!-- end container Mid -->
	
   <div class="profitContainer">
		<div class="profitInner">
			<h3>get 50% Referrals Earnings! </h3>
			<p>Facebook Likes, Facebook Subscribers, Twitter Followers, Youtube Subscribers, LinkedIn Shares, Youtube Video Views,<br> Twitter ReTweets, Youtube Video Likes, Youtube Video Dislikes, Instagram Followers, Stumbleupon Followers, Reverbnation <br>Fans, Website Traffic...etc </p>
		</div>
   </div> <!--end profitContainer -->
	
	<div class="mainContainer">
		<div class="mainInner">
			<h3>How it works?</h3>
			<div class="freesignup statictis">
				<p>Free Signup</p>
			</div>
			<div class="likepage statictis">
				<p>Like/View Pages</p>
			</div>
			<div class="cashout statictis">
				<p>Cashout earnings</p>
			</div>
			<div class="usepoint statictis">
				<p>Use points to get Fans</p>
			</div>
		</div>
	</div>
	<div class="mainMidContainer">
		<div class="mainMidInner">
			<div class="leftcash">
				<h3>Want to Buy Likes/Fans/Hits Directly?</h3>
				<div class="buyfun">
					<div class="funny">
						<h3>Buy social media</h3>
						<p>100% real fans for your business!</p>
					</div>
					<div class="viewout">
						<h3>NO BOTs, NO <br>Fake profiles!</h3>
						<div class="viewoutoffer">
							<a href="addcomp.php">Check Our Prices</a>
						</div>
					</div>
				</div>
			</div>
			<div class="rightList">
				<ul>
					<li>Get 1000s Free FaceBook Page/Photo/Post/Album Likes/Shares !!</li>
					<li>Get 1000s Free YouTube Video Likes/Dislikes/Plays !!</li>
					<li>Get 1000s Free Twitter/StumbleUpon/ LinkedIN /Instagram Followers !!</li>
					<li>Get 1000s Free Website Traffic !!</li>
					<li>100% SAFE Network. Get only High-Quality Fans!</li>
					<li>NO BOTs, NO Automated profiles!</li>
					<li>We are all here for the same reason, Exchanging Fans!</li>
				</ul>
			</div>
			<div id="clearBoth"></div>
		</div>
	</div> <!---end mainMidCOntainer -->
	<div class="mainBottomContainer"> 
		<div class="mainBottomInner">
			<div class="leftMainBottom">
				<div class="earnmoney statistic">
					<h3>Earn Money</h3>
					<p>By doing likes/follows/hits</p>
				</div>
				<ul>
					<li class="payments">
						
							<a href="#" id="paypal"></a>
							<a href="#" id="okpay"></a>
							<a href="#" id="payza"></a>
							<div id="clearBoth"></div>
						
					</li>
					<li>Fast Payments</li>
					<li>$2 Minimum Cashout</li>
					<li>$0.5 Easy Daily Earnings</li>
				</ul>
			</div>
			<div class="rightMainBottom">
				<div class="adveryour statistic">
					<h3>Advertise your</h3>
					<p>SocialMedia Pages</p>
				</div>
				<ul>
					<li class="facebook">Free +10000 Likes/Followers</li>
					<li class="youtube">Views/Likes/Dislikes/...etc</li>
					<li class="anymore">
						<a href="#" class="twitter"></a>
						<a href="#" class="in"></a>
						<a href="#" class="google"></a>
						<a href="#" class="mail"></a>
						<a href="#" class="anymore1">and many more!</a>
					</li>
				</ul>
			</div>
		</div>

	</div> <!--end mainBottomContainer -->

	<div class="joinContainer">
		<div class="joinInner">
			<div class="joinNow">
				<a href="register.php">join now and claim 50 points signup bonus</a>
			</div>

		</div>
	</div> <!--end joinContainer -->	
	



<script type="text/javascript">
        var AddHitsMade = 0;
        var AddHitsMade1 = 0;
        var LikersStart = 0;
        var LikersStart1 = 0;
        var LastReg24 = 0;
        var UsersOnline = 0;
        var UsersOnline1 = 200;
        setTimeout("DisplayHintCounter();", 120);
        function DisplayHintCounter() {
            var randd = Math.floor((Math.random() * 1000) + 1);
            if (randd > 300) {
                AddHitsMade = AddHitsMade + 1;
            }
            if (randd > 994) {
                LikersStart = LikersStart + 1;
            }
            if (randd > 960) {
                UsersOnline1 = UsersOnline1 + 1;
            }
            if (randd < 39) {
                UsersOnline1 = UsersOnline1 - 1;
            }
            AddHitsMade1 = <?php echo $sitetotalmembersALL; ?> + AddHitsMade;
            LikersStart1 = <?php echo $likersALL; ?> + LikersStart;
            LastReg24 = <?php echo $sitestatmemberslast24->stat; ?> + LikersStart;
            UsersOnline = <?php echo $sitestatmembersonline->stat; ?> + UsersOnline1;
            $("#HintHits").html("<div class='bannerMid'><div class='bannerMidInner'><div class='raise'><p><span>" + numberWithCommas(AddHitsMade1) + "</span> &nbsp;&nbsp;Hits/likes delivered</br><span>" + numberWithCommas(LikersStart1) + "</span> &nbsp;&nbsp; Members and counting! </p> </div></div></div><div class='bannerBot'><div class='bannerBotInner'><div class='statistic' id='user'><p><span>" + numberWithCommas(LastReg24) + "</span> &nbsp; Members joined in the last 24 hours!</p></div><div class='statistic' id='online'><p><span>" + numberWithCommas(UsersOnline) + "</span> &nbsp; Online!</p></div></div></div>");
            setTimeout("DisplayHintCounter();", 70);
        }
        function numberWithCommas(x) {
            x = x.toString();
            var pattern = /(-?\d+)(\d{3})/;
            while (pattern.test(x))
                x = x.replace(pattern, "$1,$2");
            return x;
        }

function OpenPage(mysite){
	document.location.href=mysite;
	}
</script>






<script language=javascript>
var NextStep=0;
var icoNum=1;
setTimeout("NextIcoo();", 7000);

var NextStepB=0;
var icoNumB=3;
setTimeout("NextIcooB();", 8000);

function NextIcoo() {
if (NextStep == 0) {
	document.getElementById("slideshowme").style.opacity = 0;
	setTimeout("NextIcoo();", 500);
	}
if (NextStep == 1) {
	icoNum=icoNum+1;
		if(icoNum >= 3) {icoNum=1;}
	var picurl = "url(img/index_v2_" + icoNum + ".jpg)";
	document.getElementById("slideshowme").style.background = picurl;
	setTimeout("NextIcoo();", 1);
	}
if (NextStep == 2) {
	document.getElementById("slideshowme").style.opacity = 1;
	NextStep=-1;
	}
NextStep = NextStep +1;
if(NextStep == 0) {
setTimeout("NextIcoo();", 5000);
}
}

function NextIcooB() {
if (NextStepB == 0) {
	document.getElementById("slideshowme2").style.opacity = 0;
	setTimeout("NextIcooB();", 500);
	}
if (NextStepB == 1) {
	icoNumB=icoNumB+1;
		if(icoNumB >= 6) {icoNumB=3;}
	var picurl = "url(img/index_v2_" + icoNumB + ".jpg)";
	document.getElementById("slideshowme2").style.background = picurl;
	setTimeout("NextIcooB();", 1);
	}
if (NextStepB == 2) {
	document.getElementById("slideshowme2").style.opacity = 1;
	NextStepB=-1;
	}
NextStepB = NextStepB +1;
if(NextStepB == 0) {
setTimeout("NextIcooB();", 5000);
}
}
</script>


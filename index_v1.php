	<div class="accountContentContainer">
		<div class="accountContentInner">
			<a href="referrals.php" class="accountContentTop">
				<div class="referral_system_left">
					<p>New Referral System:</p>
				</div>
				<div class="referral_system_right">
					<p>Earn  <span>50%</span>  Points of Your Referrals  <span>+100</span>  Points per active referral <span>+0.1</span>  point per ref link visit.</p>
				</div>
			</a>
			
			<center><div class="clicktobuy">
					<a href="addcomp.php">Click here to buy Social Media</a>
				</div></center>
				<br/>
			
			<div class="accountContentCenter">
				<div class="YourPoints">
					<p>Your Points:</p>
					<h3><? echo number_format($data->coins,1); ?></h3>
				</div>
				<div class="viphours">
					<p>vip hours:</p>
					<h3><? echo $data->pr;?> <span>hours</span></h3>
				</div>
				
				<div class="accountContentCenterLeft">
					<a href="buy.php" class="buyPoint">
						<p>BUY POINTS</p>
					</a>
					<a href="prem.php" class="buyVip">
						<p>BUY VIP</p>
					</a>
					<a href="cashout.php" class="Requestpayment">
						<p>Request payment</p>
					</a>
				</div>
				
			</div>
			<div class="accountContentBottom">
				<div class="accountContentBottomLeft">
					<div class="rallycontest">
						<h3>rally contest</h3>
						<p>helps to win <span>600</span> points everyday</p>
					</div>
					<a href="rally.php">CLICK TO VIEW MORE</a>
				</div>
				<div class="accountContentBottomright">					
					<div class="place_your_text">
						<h3>place your <br>text or banner ad</h3>
						<a href="prem.php">Upgrade</a>
					</div>			
					<div class="and_advertise">
						<h3>and advertise <br>x2 Cheaper!</h3>
						<a href="adsadd.php">place an ad</a>
					</div>
				</div>
			</div>
			
		</div><!-- end accountContentInner -->
	</div> <!-- end accountContentContainer -->





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
            AddHitsMade1 = <? echo $sitetotalmembersALL; ?> + AddHitsMade;
            LikersStart1 = <? echo $likersALL; ?> + LikersStart;
            LastReg24 = <? echo $sitestatmemberslast24->stat; ?> + LikersStart;
            UsersOnline = <? echo $sitestatmembersonline->stat; ?> + UsersOnline1;
            $("#HintHits").html("<font color='green' size='4'><b><font color='blue'>" + numberWithCommas(AddHitsMade1) + "</font></b> Hits/likes delivered by +<b>" + numberWithCommas(LikersStart1) + "</b> Likers! &nbsp; &nbsp; and still counting...</br></br><b><font color='blue'>" + numberWithCommas(LastReg24) + "</font></b> Users Joined LikesPlanet within <b>last 24 hours</b>! &nbsp; &nbsp; <b><font color='blue'>" + numberWithCommas(UsersOnline) + "</font></b> Online!</font>");
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


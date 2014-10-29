<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

?>

<br/>
<h1> Referrals Center </h1>
<div> <p> </p></div>

<p> Promote your refferal URL and Duplicate your Points/Money! </p>

<div class="msg_success"><center>
<a href="promote.php?ref=<? echo $data->login;?>" >
http://likesplanet.com/promote.php?ref=<? echo $data->login; ?>
</a>
</center></div>
</br>
<div class="msg_success"><center>
<a href="promote.php?ref=<? echo $data->login;?>" >
http://likesplanet.com/register.php?ref=<? echo $data->login; ?>
</a>
</center></div>

<br/>

<div class="leftMainBottom" style="width: 800px;">
<ul>
<li>You will earn <b><font color='red'>50%</font></b> of <b>All Your Referrals!</b></li>
<li>If any of your referrals collect points (by Facebook, YouTube,...etc) You will earn 50% of his work!</li>
<li>Website Traffic is NOT included in this 50% referral system. (All Social Media Systems are included)</li>
<li>You will get <b>100 Points</b> for <b>Each Active Referral.</b> (+10 points to join, +100 bonus points for 100 hits).</li>
<li>Earn bonus Points/Money for Each Unique visit to your refferal link!</li>
</ul>
<h3>Result: When you have more referrals, you can earn $4 EASY Everyday!</h3>
</div>
<br/>

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
<br/>


<h1> Banners </h1>

<p> <img src="img/banner1.jpg"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/banner1.jpg</p> 
<br/>

<p> <img src="img/anim1.gif"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/anim1.gif</p> 
<br/>
<p> <img src="img/anim2.gif"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/anim2.gif</p> 
<br/>

<p> <img src="img/banner2.jpg"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/banner2.jpg</p> 
<br/>
<p> <img src="img/banner3.jpg"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/banner3.jpg</p> 
<br/>
<p> <img src="img/banner4.jpg"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/banner4.jpg</p> 
<br/>
<p> <img src="img/banner5.jpg"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/banner5.jpg</p> 
<br/>
<p> <img src="img/banner6.jpg"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/banner6.jpg</p> 
<br/>
<p> <img src="img/banner7.jpg"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/banner7.jpg</p> 
<br/>

<p> <img src="img/banner9.jpg"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/banner9.jpg</p> 
<br/>
<p> <img src="img/banner10.jpg"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/banner10.jpg</p> 
<br/>
<p> <img src="img/banner11.jpg"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/banner11.jpg</p> 
<br/><br/><br/>

<p> <img src="img/banner12.jpg"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/banner12.jpg</p> 
<br/>
<p> <img src="img/banner13.jpg"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/banner13.jpg</p> 
<br/>
<p> <img src="img/banner14.jpg"  style="margin: auto;"></p>
<p>http://likesplanet.com/img/banner14.jpg</p> 
<br/>



</br></br>


<h1> Your Referrals </h1>
		<table class="datatable sortable selectable full">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>Username</b>			
			</th>
			<th>			
			<b>Last Login</b>			
			</th>
			<th>			
			<b>Hits Made</b>			
			</th>
			<th>			
			<b>Your Earnings</b>			
			</th>			
		</tr>
        	</thead>

<?

$totalmyearnings = 0;

  $site2 = mysql_query("SELECT * FROM `users` WHERE `ref2`='{$data->id}' AND NOT `ref2`='0' ORDER BY `id` DESC");

  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

$siteliked2 = mysql_query("SELECT * FROM `refclaimed` WHERE (`user`='{$data->id}' and `ref`='{$site->id}' ) ");
$verificare = mysql_num_rows($siteliked2);

$totalmyearnings = $totalmyearnings + $site->totalgive / 2;

?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<center><? echo $site->login;?>	</center>	
				</td>
				<td>												
				<center><? echo $site->online;?></center>			
				</td>
				<td>
				<?
					if($site->likes	< 6) {
					echo "<font color='grey'><center>" . $site->likes . "</center></font>";
					} else {
					echo "<font color='green'><center><b>" . $site->likes . "<b></center></font>";
					$totalmyearnings = $totalmyearnings + 10;
					}
				?>	
				</td>
				<td>
				<? if($site->likes <= 99) { ?>
					<font color='green'> <? echo $site->totalgive / 2; ?> </font>		
				<? } else { ?>	
					<? if($verificare == 0) { ?>
					<a href="ref_claim.php?ref=<? echo $site->id; ?>"> <font color='green' size='3'> <b> Click to get 100 Points! </b></font> </a>	
					<? } else { ?>
					<font color='green'> <? echo 100 + $site->totalgive / 2; $totalmyearnings=$totalmyearnings+100; ?> </font>
					<? } ?>
				<? } ?>		
				</td>				
			</tr>
			</tbody><?}?>
	
	
	<tbody>
			<tr>
				<td>												
				</td>				
				<td>	
				</br>
				<center>-------</center>								
				</td>
				<td>
				</br>
				<center>----------------------------</center>											
				</td>
				<td>
				</br>
				<center>----------------------------</center>
				</td>
				<td>
				</br>
				<center>----------------------------</center>
				</td>				
			</tr>
			</tbody>
			
	
		<tbody>
			<tr>
				<td>							
                info							
				</td>				
				<td>												
					
				</td>
				<td>												
							
				</td>
				<td>
				<center>
				<font color='grey'>more 6 hits:</font> </br>
				<font color='green'><b>+10 points.</b></font>
				</center>
				</td>
				<td>
				<center>
				<font color='blue'>more 100 hits:</font> </br>
				<font color='green'><b>+100 points.</b></font>
				</center>
				</td>				
			</tr>
			</tbody>

			<tbody>
			<tr>
				<td>												
				</td>				
				<td>	
				<center>-------</center>								
				</td>
				<td>
				<center>----------------------------</center>											
				</td>
				<td>
				<center>----------------------------</center>
				</td>
				<td>
				<center>----------------------------</center>
				</td>				
			</tr>
			</tbody>


		<tbody>
			<tr>
				<td>							
                Total
				</td>				
				<td>												
					
				</td>
				<td>												
							
				</td>
				<td>
				
				</td>
				<td>
				<center> <font color='green'> <b><? echo $totalmyearnings;?></b> Points.</font> </center>
				</td>				
			</tr>
			</tbody>


		
</table>	




<? include('footer.php');?>

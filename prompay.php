<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){


mysql_query("INSERT INTO `payprom` (user_id, am, url1, url2, url3, url4, url5) VALUES('{$data->id}', '{$protectie['cash']}', '{$protectie['adr1']}', '{$protectie['adr2']}', '{$protectie['adr3']}', '{$protectie['adr4']}', '{$protectie['adr5']}' ) ");

$message = "Promote URLs sent with success!</br>Please allow 4 to 7 days to Review your Promotion URLs."; $message2 = 2;
}
?>

<body id="tab3"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="cashout.php">Cashout Money</a></li> 
	<li class="tab2"><a href="cashoutmy.php">Cashout History</a></li> 
</ul>
</div>

<h1>Promote Your Payment Proofs and Earn Extra Money</h1>
<div class="clearer">&nbsp;</div>

<? echo $msg;?>

<center><p><img src="img/2/cashout2.jpg" border="0" title="Promote and Earn Extra Money"></p></center>

<p><b>Rules :</b></p>
<p>You should promote Payment Proof on <b>5 Different Blogs</b>.</p>
<p>Payment Proof should <b>include a Photo</b> of your payment recieved from LikesASAP.com</p>
<p>You will earn Payment Amount <b>x1000</b> Points, so when your payment is $0.5 then you will earn +500 Points.</p>
<p>You can promote Payment Proof Once only for each payment, or you you will Get Banned.</p>
<p>You Should include your Referral URL in your blog, to earn +50 points + 5% earning of Each user join by your referral, +100 Points for each active refferal!</p>

<div class="clearer">&nbsp;</div>

<p><b>You Promoted Payment Proof ?</b></p>
<p>After you promote your payment proof, Post your 5 Promotion URLs below to earn extra points :</p>

<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="cash">Amount of Payment Proof ($):</label></td><td width="20"></td><td><input type="text" name="cash" id="cash" size="40" maxlength="30" value="0.1"  /></td></tr>

<tr><td><label for="adr1">Promotion URL 1 :</label></td><td width="20"></td><td><input type="text" name="adr1" id="adr1" size="40" value="http://" /></td></tr>
<tr><td><label for="adr2">Promotion URL 2 :</label></td><td width="20"></td><td><input type="text" name="adr2" id="adr2" size="40" value="http://" /></td></tr>
<tr><td><label for="adr2">Promotion URL 3 :</label></td><td width="20"></td><td><input type="text" name="adr3" id="adr3" size="40" value="http://" /></td></tr>
<tr><td><label for="adr2">Promotion URL 4 :</label></td><td width="20"></td><td><input type="text" name="adr4" id="adr4" size="40" value="http://" /></td></tr>
<tr><td><label for="adr2">Promotion URL 5 :</label></td><td width="20"></td><td><input type="text" name="adr5" id="adr5" size="40" value="http://" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Done for 5 blogs? Click here." class="submit" style="width: 250px;" /></td></tr>
</table></center>
</form>

<? include('footer.php');?>
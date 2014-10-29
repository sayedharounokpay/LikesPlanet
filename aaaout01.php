<?php
include('config.php');

foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$ii = $get['ii'];

echo "<font color='white' size='1'>";

if($ii > 5){
$cashout = mysql_fetch_object(mysql_query("SELECT * FROM `cashout` WHERE (`i`='".mysql_escape_string({$ii})."') "));
if(3 > 2){
 
mysql_query("UPDATE `cashout` SET `pending`='5' WHERE `i`='".mysql_escape_string({$cashout->i})."'");
 
 	ini_set("display_errors", 1);
 	
 	try
 	{
 		$secWord  = "XXXXXXXXXXXXXXXX"; // wallet API password
 		$WalletID = "OKnnnnnnnn"; // wallet ID

 		$datePart = gmdate("Ymd");
 		$timePart = gmdate("H");
 		$authString = $secWord.":".$datePart.":".$timePart;

 		
 		$sha256 = bin2hex(mhash(MHASH_SHA256, $authString));
 		$secToken = strtoupper($sha256);

 		


 		$client = new SoapClient("https://api.okpay.com/OkPayAPI?wsdl");

 		

 		

 		$webService = $client->Get_Date_Time();

 		$wsResult = $webService->Get_Date_TimeResult;
 		

 		$obj = new stdClass();
 		
 		$obj->WalletID = $WalletID;
 		$obj->SecurityToken = $secToken;
 		$obj->Currency = "USD";

 		$webService1 = $client->Wallet_Get_Currency_Balance($obj);
 		$wsResult1 = $webService1->Wallet_Get_Currency_BalanceResult;

 		//print_r($wsResult1);


		
 		$obj->WalletID = $WalletID;
 		$obj->SecurityToken = $secToken;
 		$webService1 = $client->Wallet_Get_Balance($obj);
 		$wsResult1 = $webService1->Wallet_Get_BalanceResult;
 		//print_r($wsResult1);

		
 		$obj->WalletID = $WalletID;
 		$obj->SecurityToken = $secToken;
 		$obj->Currency = "USD";
 		$obj->Receiver = $cashout->adr;
 		$obj->Amount = $cashout->cash - 0.01;
 		$obj->Comment = "Payout from LikesPlanet.com";
 		$obj->IsReceiverPaysFees = FALSE;
 		$webService1 = $client->Send_Money($obj);
 		$wsResult1 = $webService1->Send_MoneyResult;
 		if ($wsResult1->Status == "Completed") {
 		
 		mysql_query("UPDATE `cashout` SET `pending`='1' WHERE `i`='".mysql_escape_string({$cashout->i})."'");
 		echo "<center><a href='aaaout.php' target='_parent'> <b><font color='green' size='5'>PAID.  Click to Next.</font></b> </a></center></br></br></br></br></br></br></br>";
 		
$cashoutdata0 = mysql_query("SELECT * FROM `cashout` WHERE ( `i` = '{$ii}' ) ");
$cashoutdata = mysql_fetch_object($cashoutdata0);
$usernamehere0 = mysql_query("SELECT * FROM `users` WHERE ( `id` = '{$cashoutdata->id}' ) ");
$usernamehere = mysql_fetch_object($usernamehere0);

// Send another email to confirm support.
// To email address
$email = $usernamehere->email;
$email_name = 'LikesPlanet.com network';

// From email address
$from = $siteme->site_email;
$from_name = 'LikesPlanet.com';

// The message
$subject = 'LikesPlanet | OKPay Payment Sent.';

$message = "Hello ".$usernamehere->login." !

Your OKPay Payment already Paid.

http://www.likesplanet.com/cashoutmy.php

";

$message_html = "<html><body><p>
</p>
Hello ".$usernamehere->login." !
<br /><br /><br /><br />
<font color='blue' size=3><b>
Your OKPay Payment Already Paid.
</b></font>
<br /><br /><br /><br /><br /><br />
Do you want to Duplicate Your Earnings?
<br /><br />
Post your payment proof on 5 blogs, to get Payment Amount x1000 Points.
<br /><br />
http://www.likesplanet.com/prompay.php
<br /><br />
or Post here to get points = Payment amount x500.
http://blog.likesplanet.com/payments-proofs-post-your-payment-proof-and-earn-extra-pointsmoney/
<br /><br /><br /><br />
You like to earn 600 or 1,000 Points ?
<br /><br />
Make a blog write about LikesPlanet, Use this application to get paid:
<br /><br />
http://www.likesplanet.com/extrapoints.php
<br /><br />
<br /><br /><br /><br />
http://likesplanet.com/cashoutmy.php
<br /><br /><br /><br />
<br />
Thanks for using LikesPlanet network.
<br />
</body></html>";

/***********************************************/
/* No need to modify anything down here */
/* Note that these are needed to send the mail */
/***********************************************/
// Generate text + html version
$random_hash = md5(date("r", time()));

$mailmessage = "
--PHP-alt-".$random_hash."
Content-Type: text/plain; charset=\"iso-8859-1\"
Content-Transfer-Encoding: 7bit

$message

--PHP-alt-".$random_hash."
Content-Type: text/html; charset=\"iso-8859-1\"
Content-Transfer-Encoding: 7bit

$message_html

--PHP-alt-".$random_hash."--
";

// Headers
// To send HTML mail, the Content-type header must be set
$headers = "From: ".$from_name." <".$from.">" . "\r\n";
$headers .= "Reply-To: ".$from_name." <".$from.">" . "\r\n";
$headers .= "Date: ".date("r") . "\r\n";

// Additional headers
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Type: multipart/alternative; boundary=\"PHP-alt-" . $random_hash . "\"\r\n";
$headers .= "Message-Id: <" . md5(uniqid(microtime())) . "@" . $_SERVER["SERVER_NAME"] . ">\r\n";

// Send the mail
mail($email, $subject, $mailmessage, $headers);

		} else {
		
		echo "<center><a href='aaaout.php' target='_parent'> <b><font color='red' size='4'>Something Wrong, Check Manually or Skip Payment.</font></b> </a></center></br></br></br></br></br></br></br>";
		
		}
		
		$obj->WalletID = $WalletID;
		$obj->SecurityToken = $secToken;
		$obj->TxnID = "123456789";
		////$webService3 = $client->Transaction_Get($obj);
		////$wsResult3 = $webService3->Transaction_GetResult;
        //print_r($wsResult3);

 	}
 	catch (Exception $e)
 	{
 		print  "Caught exception: ".  $wsResult1 . "\n";
 	}
 	
 } else {
 echo "<center><a href='aaaout.php' target='_parent'> <b><font color='blue' size='4'>Something Wrong, Check Manually or Skip Payment. (maybe Already Paid?)</font></b> </a></center></br></br></br></br></br></br></br>";
 }
 }
 ?>

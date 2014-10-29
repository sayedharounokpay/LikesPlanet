<?php
$page_title = "Payment Proofs from LikesPlanet.com | Earn Money from Facebook/YouTube/Twitter/..etc";
$meta_description = "Payment Proofs from LikesPlanet.com | Earn Money from Facebook/YouTube/Twitter/..";
$meta_keywords = "Payment, Proof, Earn, Money, Paid, Proofs, PaidToLike, LikesPlanet.com";

include('header.php');

foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$pageid = 0;
$pageid = $get['pageid'];
	if ($pageid < 1) { $pageid = 1; }
$pageid = $pageid -1;
$startid = $pageid * 150;

$totalpaid = 400;
$totalpayments = 0;
$site20 = mysql_query("SELECT * FROM `cashout` WHERE (`pending`='1' OR `pending`='0' OR `pending`='5') ");
for($j=1; $site0 = mysql_fetch_object($site20); $j++)
{
$totalpaid = $totalpaid + $site0->cash;
$totalpayments = $totalpayments + 1;
}

?>

<h1>Recent Withdraw History</h1>
Some users we do Not pay because they do not enter Correct Payment Address, or Their Account on PayPal/OKPay/Payza is Limited for a reason.
We ask all users review their payment status to get paid.


</br></br>

<font size='3' color='green'>Total Paid: <b>$<? echo number_format($totalpaid,2);?></b> by <? echo $totalpayments;?> payments.</font>
</br></br>



		<table class="datatable sortable selectable full">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>UserName</b>			
			</th>		
            <th>			
			<b>Payment</b>			
			</th>
            <th>			
			<b>Method</b>			
			</th>	
	    <th>			
			<b>Status</b>			
			</th>	
	    <th>			
			<b>Date</b>			
			</th>			
					
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `cashout` WHERE (`pending`='1' OR `pending`='0' OR `pending`='5')  ORDER BY `i` DESC LIMIT $startid, 150");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
$userp2 = mysql_query("SELECT * FROM `users` WHERE `id`='{$site->id}' ");
$userp = mysql_fetch_object($userp2);

$x11102oo = explode('(', $userp->country);
$x111022oo = explode(')', $x11102oo[1]);
if ($x111022oo[0] == '' ) $x111022oo[0] = 'US';
if ($x111022oo[0] == 'DE' ) $x111022oo[0] = 'GM';
if ($x111022oo[0] == 'TR' ) $x111022oo[0] = 'TU';
if ($x111022oo[0] == 'PH' ) $x111022oo[0] = 'RP';
if ($x111022oo[0] == 'DZ' ) $x111022oo[0] = 'AG';
if ($x111022oo[0] == 'BW' ) $x111022oo[0] = 'BC';
if ($x111022oo[0] == 'PT' ) $x111022oo[0] = 'PO';
if ($x111022oo[0] == 'VN' ) $x111022oo[0] = 'VM';
if ($x111022oo[0] == 'RU' ) $x111022oo[0] = 'RS';
if ($x111022oo[0] == 'OM' ) $x111022oo[0] = 'MU';
if ($x111022oo[0] == 'GB' ) $x111022oo[0] = 'UK';
if ($x111022oo[0] == 'GE' ) $x111022oo[0] = 'GG';
if ($x111022oo[0] == 'LB' ) $x111022oo[0] = 'LE';
if ($x111022oo[0] == 'AZ' ) $x111022oo[0] = 'AJ';
if ($x111022oo[0] == 'LV' ) $x111022oo[0] = 'LG';
if ($x111022oo[0] == 'UA' ) $x111022oo[0] = 'UP';
if ($x111022oo[0] == 'LK' ) $x111022oo[0] = 'CO';
if ($x111022oo[0] == 'SD' ) $x111022oo[0] = 'SU';
if ($x111022oo[0] == 'BD' ) $x111022oo[0] = 'BG';

?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j+$startid;?>							
				</td>				
				<td>												
				<img src="https://www.cia.gov/library/publications/the-world-factbook/graphics/flags/large/<? echo Strtolower($x111022oo[0]); ?>-lgflag.gif" border="0" title="Country : <? echo $userp->country; ?>" height="16" width="24" > 
				<? echo $userp->login;?>
				</td>				
				<td>				
				<b><font color="green" size="<? echo 2 + $site->cash;?>"> $ <? echo $site->cash;?>	 </font></b>		
				</td>
				<td>				
				<?if($site->method == 'lr'){echo "LibertyReserve";}
				  if($site->method == 'ap'){echo "Alert Pay";}
				  if($site->method == 'pz'){echo "<font style='background-color: #99FFFF;'> Payza</font>";}
				  if($site->method == 'pp'){echo "<font style='background-color: #9999FF;'> PayPal</font>";}
				  if($site->method == 'ok'){echo "<font style='background-color: #FFF999;'> OKPay </font>";}
				  if($site->method == 'pm'){echo "PerfectMoney";}
				  if($site->method == 'mb'){echo "Money Bookers";} ?>			
				</td>
				<td>	
				<? if ($site->pending =='1') { echo "<font color='green'><b>Paid</b></font>"; }
				if ($site->pending =='5') { echo "<font color='green'>Now Paying...</font>"; }
				if ($site->pending =='0') { echo "<font color='grey'>Pending ...</font>"; } ?>
				</td>
				<td>
				<? echo $site->date;?>
				</td>
							
			</tr>
			</tbody><?}?>
</table>	

</br>

<center>
<font color='#990099' size='2'>Page 
<? 
$site200 = mysql_query("SELECT * FROM `cashout` WHERE (`pending`='1' OR `pending`='0' OR `pending`='5') ");
$verificareA = mysql_num_rows($site200);
$verificareA00 = $verificareA / 150;
$verificareA00 = $verificareA00 + 1;

for($j=1; $j <= $verificareA00; $j++) { ?>
<a href="payproof.php?pageid=<? echo $j;?>" style="background-color: <? if($j == 1+$pageid){ echo 'yellow';} else{echo 'cyan'; } ?>;" >&nbsp; <? echo $j;?> &nbsp; </a>
<? } ?>
</font>
</center>




<? include('footer.php');?>
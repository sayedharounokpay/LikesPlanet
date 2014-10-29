<?php
include('headeraddon.php');

$thisweek = 0;
$thisweekcashout = 0;

date_default_timezone_set("Europe/Riga");

$tomorrow = mktime(0,0,0,date("m"),date("d"), date("Y"));
$date11 = date("Y-m-d", $tomorrow);

$allcashout = mysql_query("SELECT * FROM `orders` WHERE ( `date`='{$date11}' ) ");
$totalnotpaid = 0;
$totalnum0 = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalnotpaid = $totalnotpaid + $cashout->price;
$totalnum0 = $totalnum0 + 1;
$thisweek = $thisweek + $cashout->price;
}

$allcashout = mysql_query("SELECT * FROM `cashout` WHERE ( `date`='{$date11}' AND `pending`!='2')  ");
$totalcashout = 0;
$totalnum = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalcashout = $totalcashout + $cashout->cash;
$totalnum = $totalnum + 1;
$thisweekcashout = $thisweekcashout + $cashout->cash;
}
?>
<center></br></br>
<h2>Sales</h2>
</br>
<p>Today : <b>$<?echo $totalnotpaid;?></b> &nbsp;&nbsp;&nbsp;/<?echo $totalnum0;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -$<b><?echo $totalcashout;?></b>/<?echo $totalnum;?> </p>





<?
$tomorrow = mktime(0,0,0,date("m"),date("d")-1, date("Y"));
$date11 = date("Y-m-d", $tomorrow);

$allcashout = mysql_query("SELECT * FROM `orders` WHERE ( `date`='{$date11}' ) ");
$totalnotpaid = 0;
$totalnum0 = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalnotpaid = $totalnotpaid + $cashout->price;
$totalnum0 = $totalnum0 + 1;
$thisweek = $thisweek + $cashout->price;
}

$allcashout = mysql_query("SELECT * FROM `cashout` WHERE ( `date`='{$date11}'  AND `pending`!='2' ) ");
$totalcashout = 0;
$totalnum = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalcashout = $totalcashout + $cashout->cash;
$totalnum = $totalnum + 1;
$thisweekcashout = $thisweekcashout + $cashout->cash;
}
?>

<p><?echo $date11;?> : <b>$<?echo $totalnotpaid;?></b> &nbsp;&nbsp;&nbsp;/<?echo $totalnum0;?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -$<b><?echo $totalcashout;?></b>/<?echo $totalnum;?> </p>








<?
$tomorrow = mktime(0,0,0,date("m"),date("d")-2, date("Y"));
$date11 = date("Y-m-d", $tomorrow);

$allcashout = mysql_query("SELECT * FROM `orders` WHERE ( `date`='{$date11}' ) ");
$totalnotpaid = 0;
$totalnum0 = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalnotpaid = $totalnotpaid + $cashout->price;
$totalnum0 = $totalnum0 + 1;
$thisweek = $thisweek + $cashout->price;
}

$allcashout = mysql_query("SELECT * FROM `cashout` WHERE ( `date`='{$date11}' AND `pending`!='2' ) ");
$totalcashout = 0;
$totalnum = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalcashout = $totalcashout + $cashout->cash;
$totalnum = $totalnum + 1;
$thisweekcashout = $thisweekcashout + $cashout->cash;
}
?>

<p><?echo $date11;?> : <b>$<?echo $totalnotpaid;?></b>  &nbsp;&nbsp;&nbsp;/<?echo $totalnum0;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -$<b><?echo $totalcashout;?></b>/<?echo $totalnum;?> </p>





<?
$tomorrow = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
$date11 = date("Y-m-d", $tomorrow);

$allcashout = mysql_query("SELECT * FROM `orders` WHERE ( `date`='{$date11}' ) ");
$totalnotpaid = 0;
$totalnum0 = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalnotpaid = $totalnotpaid + $cashout->price;
$totalnum0 = $totalnum0 + 1;
$thisweek = $thisweek + $cashout->price;
}

$allcashout = mysql_query("SELECT * FROM `cashout` WHERE ( `date`='{$date11}' AND `pending`!='2' ) ");
$totalcashout = 0;
$totalnum = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalcashout = $totalcashout + $cashout->cash;
$totalnum = $totalnum + 1;
$thisweekcashout = $thisweekcashout + $cashout->cash;
}
?>
<p><?echo $date11;?> : <b>$<?echo $totalnotpaid;?></b>  &nbsp;&nbsp;&nbsp;/<?echo $totalnum0;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -$<b><?echo $totalcashout;?></b>/<?echo $totalnum;?> </p>






<?
$tomorrow = mktime(0,0,0,date("m"),date("d")-4,date("Y"));
$date11 = date("Y-m-d", $tomorrow);

$allcashout = mysql_query("SELECT * FROM `orders` WHERE ( `date`='{$date11}' ) ");
$totalnotpaid = 0;
$totalnum0 = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalnotpaid = $totalnotpaid + $cashout->price;
$totalnum0 = $totalnum0 + 1;
$thisweek = $thisweek + $cashout->price;
}

$allcashout = mysql_query("SELECT * FROM `cashout` WHERE ( `date`='{$date11}' AND `pending`!='2' ) ");
$totalcashout = 0;
$totalnum = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalcashout = $totalcashout + $cashout->cash;
$totalnum = $totalnum + 1;
$thisweekcashout = $thisweekcashout + $cashout->cash;
}
?>
<p><?echo $date11;?> : <b>$<?echo $totalnotpaid;?></b>  &nbsp;&nbsp;&nbsp;/<?echo $totalnum0;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -$<b><?echo $totalcashout;?></b>/<?echo $totalnum;?> </p>






<?
$tomorrow = mktime(0,0,0,date("m"),date("d")-5, date("Y"));
$date11 = date("Y-m-d", $tomorrow);

$allcashout = mysql_query("SELECT * FROM `orders` WHERE ( `date`='{$date11}' ) ");
$totalnotpaid = 0;
$totalnum0 = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalnotpaid = $totalnotpaid + $cashout->price;
$totalnum0 = $totalnum0 + 1;
$thisweek = $thisweek + $cashout->price;
}

$allcashout = mysql_query("SELECT * FROM `cashout` WHERE ( `date`='{$date11}' AND `pending`!='2' ) ");
$totalcashout = 0;
$totalnum = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalcashout = $totalcashout + $cashout->cash;
$totalnum = $totalnum + 1;
$thisweekcashout = $thisweekcashout + $cashout->cash;
}
?>
<p><?echo $date11;?> : <b>$<?echo $totalnotpaid;?></b>  &nbsp;&nbsp;&nbsp;/<?echo $totalnum0;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -$<b><?echo $totalcashout;?></b>/<?echo $totalnum;?> </p>







<?
$tomorrow = mktime(0,0,0,date("m"),date("d")-6, date("Y"));
$date11 = date("Y-m-d", $tomorrow);

$allcashout = mysql_query("SELECT * FROM `orders` WHERE ( `date`='{$date11}' ) ");
$totalnotpaid = 0;
$totalnum0 = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalnotpaid = $totalnotpaid + $cashout->price;
$totalnum0 = $totalnum0 + 1;
$thisweek = $thisweek + $cashout->price;
}

$allcashout = mysql_query("SELECT * FROM `cashout` WHERE ( `date`='{$date11}' AND `pending`!='2' ) ");
$totalcashout = 0;
$totalnum = 0;
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalcashout = $totalcashout + $cashout->cash;
$totalnum = $totalnum + 1;
$thisweekcashout = $thisweekcashout + $cashout->cash;
}
?>
<p><?echo $date11;?> : <b>$<?echo $totalnotpaid;?></b>  &nbsp;&nbsp;&nbsp;/<?echo $totalnum0;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -$<b><?echo $totalcashout;?></b>/<?echo $totalnum;?> </p>



<h1> This Week : $<? echo $thisweek; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -$<b><?echo $thisweekcashout ;?></b> </h1>


<?
$site2 = mysql_query("SELECT * FROM `orders` ORDER BY `id` DESC");
for($j=1; $site = mysql_fetch_object($site2); $j++)
{
$totalsales = $totalsales + $site->price;
}
?>

<div class="clearer">&nbsp;</div>
<h1> <font size=4>Total Sales : $<? echo number_format($totalsales,1); ?> </font> </h1>

<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>

<?
$totalnotpaid = 0;
$totalnotpaidnum = 0;
$totalcashout = 0;
$totalcashoutnum = 0;

for($dayofmonth=1; $dayofmonth < 31; $dayofmonth++)
{
$tomorrow = mktime(0,0,0,date("m"),date("d")-$dayofmonth, date("Y"));
$date11 = date("Y-m-d", $tomorrow);

$allcashout = mysql_query("SELECT * FROM `orders` WHERE ( `date`='{$date11}' ) ");
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalnotpaid = $totalnotpaid + $cashout->price;
$totalnotpaidnum = $totalnotpaidnum + 1;
}

$allcashout = mysql_query("SELECT * FROM `cashout` WHERE ( `date`='{$date11}' AND `pending`!='2' ) ");
for($j=1; $cashout = mysql_fetch_object($allcashout); $j++)
{
$totalcashout = $totalcashout + $cashout->cash;
$totalcashoutnum = $totalcashoutnum + 1;
}

}

$netprofitsmonth = $totalnotpaid - $totalcashout - 25;
$smallestnetprofitsmonth = $netprofitsmonth * 0.68;
?>

<div class="clearer">&nbsp;</div>
<h1> This Month: $<b><? echo $totalnotpaid; ?></b> /<? echo $totalnotpaidnum;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -$<b><? echo $totalcashout;?></b> /<? echo $totalcashoutnum;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Profits: <? echo number_format($netprofitsmonth,0); ?>  </h1>

<div class="clearer">&nbsp;</div>









<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>
</center>
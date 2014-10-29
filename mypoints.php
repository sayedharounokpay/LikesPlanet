<?
include('config.php');
?>
<center><b><font color='#604060' size='4'>
<a href="buy.php" target="_parent" STYLE="TEXT-DECORATION: NONE">
<? echo number_format($data->coins,1); ?>
</a>
<? if ($data->bought == '0') { ?>
</br>---------------</br>
<a href="cashout.php" target="_parent" STYLE="TEXT-DECORATION: NONE"><font color='green'>$<?echo number_format($data->coins/$coinsdollar,3);?></font></a>
<? } else { ?>
</br>---------------</br>
	<? if($data->pr == '0') { ?>
	No VIP.
	<? } else { ?>
	<? echo number_format($data->pr,0); ?> h.VIP
	<? } ?>
<? } ?>
</center></b></font>
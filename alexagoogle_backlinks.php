<?
include('config.php');
?>

<center>

<?
$backlinkslist = mysql_query("SELECT * FROM `alexagoogle` WHERE (`life` > '0') ORDER BY RAND() ");
mysql_query("UPDATE `alexagoogle` SET `views`=`views`+'1' WHERE (`life` > '0') ");

  for($j=1; $backlinksdata = mysql_fetch_object($backlinkslist); $j++)
{
?>

<a href="<? echo $backlinksdata->url; ?>" title="<? echo $backlinksdata->title; ?>"> <font color='green' size='4'> <? echo $backlinksdata->keyword; ?> </font> </a>

</br></br>

<?
}
?>

</center>
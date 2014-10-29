<?php
include('config.php');
?>

<script language=javascript>
setTimeout(RefreshLiveMe,5000);
function RefreshLiveMe(){
window.location.href = window.location.href + 'r';
clearTimeout(RefreshLiveMe);setTimeout(RefreshLiveMe,59000);
}
</script>

<body id="tab3"> 

<? 

  $site2 = mysql_query("SELECT * FROM last_hits ORDER BY `id` DESC LIMIT 0, 12");
  $mmillesecc = microtime(true);
  
  for($j=1; $site = mysql_fetch_object( $site2 ); $j++)
  {

switch ($site->site_type) {
    case 'p':
        $dothat32 = 'surfed';
        $imgicoo = "w";
        break;
    case 'fb':
        $dothat32 = 'liked';
        $imgicoo = "fb";
        break;
    case 'fbs':
        $dothat32 = 'followed';
        $imgicoo = "fb";
        break;
    case 'fbw':
        $dothat32 = 'shared';
        $imgicoo = "fb";
        break;
    case 'w':
        $dothat32 = 'viewed';
        $imgicoo = "w";
        break;
    case 'yt':
        $dothat32 = 'viewed';
        $imgicoo = "yt";
        break;
    case 'ytl':
        $dothat32 = 'liked';
        $imgicoo = "yt";
        break;
    case 'ytd':
        $dothat32 = 'disliked';
        $imgicoo = "yt";
        break;
    case 'su':
        $dothat32 = 'followed';
        $imgicoo = "su";
        break;
    case 'rn':
        $dothat32 = 'followed';
        $imgicoo = "rv";
        break;
    case 'li':
        $dothat32 = 'followed';
        $imgicoo = "in";
        break;
    case 'tw':
        $dothat32 = 'followed';
        $imgicoo = "tw";
        break;
    case 'is':
        $dothat32 = 'followed';
        $imgicoo = "su";
        break;
    case 'rt':
        $dothat32 = 'tweeted';
        $imgicoo = "tw";
        break;
    case 'ins':
        $dothat32 = 'followed';
        $imgicoo = "ins";
        break;
}

$ll = $mmillesecc - $site->time;

?>

	<img src="img/b_<? echo $imgicoo;?>.png" style="border-radius: 4px; width: 15px; height: 15px;"> <font color='grey'> <b> <font color='green'> <? echo ucfirst($site->user_name); ?> </font></b> <? echo $dothat32; ?>  <font color='blue'> <? echo $site->site_name;?> </font>
	Last <? echo number_format($ll); ?> Seconds.
	</font>
	</br>			

<?}?>

<? include('footeraddon.php');?>
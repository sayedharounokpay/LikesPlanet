<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$x110 = explode(' (', $data->country);
$usertargetc = '(' . $x110[1];

?>

<body id="tab2"> 
<div>
<ul id="tabnav">  
	<li class="tab2"><a href="tweet.php">Earn Points</a></li> 
	<li class="tab3"><a href="addtweet.php">Add Tweet</a></li> 
	<li class="tab4"><a href="tweetpages.php">My Tweets</a></li> 
</ul>
</div>

<h1>Tweet on Twitter - Tweet and Earn points/cash.</h1>
<p>To get free points/cash, click on 'Tweet' button.</p>
<p>You can 'Skip' tweets that you do not like.</p>


<? 
  
  $siteliked4[] = "'none'";
  $siteliked2 = mysql_query("SELECT * FROM `tweeted` WHERE (`user_id`='{$data->id}')");
  for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = "'" . $siteliked->site_id . "'"; }
  
  $site2 = mysql_query("SELECT * FROM `tweet` WHERE (`active` = '0' AND `points` > `cpc`) AND (`target`='' OR `target` LIKE '%{$usertargetc}%' ) AND `id` NOT in (".implode(',', $siteliked4).") ORDER BY `cpc` DESC LIMIT 0, 1");
  
// echo  "SELECT * FROM `tweet` WHERE (`active` = '0' AND `points` > `cpc`) AND (`target`='' OR `target` LIKE '%{$usertargetc}%' ) AND `id` NOT in (".implode(',', $siteliked4).") ORDER BY `cpc` DESC LIMIT 0, 1";
  $ext = mysql_num_rows($site2);
  
if($ext > 0){
?><div id="fb-root"></div>

<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>

<script>
function refreshpage()
   {window.location.reload();}
function removeElement(parentDiv, childDiv){
	
	
   if (document.getElementById(childDiv)) {     
   var child = document.getElementById(childDiv);
   var parent = document.getElementById(parentDiv);
   parent.removeChild(child);
  window.location.reload();
}}
</script>

<div class="clearer">&nbsp;</div>

<div id="tbl" style="width: 850px;text-align: center;" >
<center><div id="Hint" class="smartbox" style="background: #FFFFFF; border-radius: 12px; border: 2px solid #cdcdcd; display:block; padding: 2px; position: center;"></div></center>
<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

?>

<div class="smartbox" id="<? echo $site->id;?>" style="height: 220px; width: 270px; background: #F3F4F4; border: 5px solid #36A6CB; border-radius: 12px;  position: relative; padding: 6px; margin: 8px 8px 0 297px;">
	<center>
	<div><font color='blue'><b> <? echo $site->title;?> </b></font></div>
	<div class="clearer">&nbsp;</div>
	<div><font color='green'> <b><? echo $site->cpc-1;?></b> Points = $<?echo number_format(($site->cpc-1)/$coinsdollar,5);?> </font></div>
	<div class="clearer">&nbsp;</div>
	
        <div style="height:28px;">
        
        <a href="https://twitter.com/share" class="twitter-share-button" data-url="<? echo $site->id;?>" data-text="<? echo $site->tweet;?>" data-count="horizontal"></a>
        
        <script type="text/javascript">
        (function($) {

            $(document).ready(function() {


                $.getScript("http://platform.twitter.com/widgets.js", function(){

                    twttr.events.bind('tweet', function(event) {
			
			var targetUrl = event.target.src;
                        var query = getQueryParams(targetUrl);
                        
                        var tweet_id = "<? echo $site->id;?>";
                        var owner = "<? echo $data->id;?>";

                        
                	document.getElementById("Hint").style.display='block';
			$("#Hint").html('<img src="img/loader.gif">');
                	$.ajax({
                    		type: "POST",
                    		url: "tweetreceive.php",
                    		data: "id="+ tweet_id + "&owner=" + owner,
                    		success: function(msg){
                       		 	$("#Hint").html('<font size="4" color="green">Tweeted with Successful !</font>');
                       		 	//window.location.reload();
                        		removeElement('tbl', '<? echo $site->id;?>');                        		
                    		}
                	});

                    });

                });

            });

            })(jQuery);

            

            function getQueryParams(qs) {

                qs = qs.split("+").join(" ");

                var params = {}, tokens,

                    re = /[?&]?([^=]+)=([^&]*)/g;

                while (tokens = re.exec(qs)) {

                    params[decodeURIComponent(tokens[1])]

                        = decodeURIComponent(tokens[2]);

                }

                return params;

            }

        </script>
        </div>
        
        <div class="clearer">&nbsp;</div>

<div><a href="#" onClick="SkipThisPage('<? echo $site->id;?>');"><font color='grey' size=1>[Skip]</font></a></div>

</center>
</div>

<?}?>

<script>


function SkipThisPage(mysiteid){
	$("#Hint").html("<font size=4 color='blue'>Skipping ...</font>");
	$.ajax({
        		type: "POST",
        		url: "skiptweet.php",
        		data: "data="+mysiteid+ "---" + '<? echo $data->id;?>',        
        		cache: false,
				success: function(msg){
    	window.location.href="tweet.php";                   
                    		}
    		});
    	$("#Hint").html("<font size=4 color='blue'>Skipped !</font>");

	}
</script>


<div class="clearer">&nbsp;</div>

<div class='infobox'> Tweet above and refresh page to see the addition of points!

<form action='' method='' onsubmit='refreshpage();'>
<input name='refresh' type='submit' value='Refresh'>
</form></div>

<?}else{?>
<center></br>
<? $message00 = "Sorry, there are no more coins to be earned at the moment.</br>Please come back again later.</br><a href='buy.php'><b>Feel like you need more coins? You can purchase them now!</b></a>"; ?>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message00;?> </font> </td></tr>
</table>
</center>
<?}?>

	<div class="clearer">&nbsp;</div>

<? include('footer.php');?>

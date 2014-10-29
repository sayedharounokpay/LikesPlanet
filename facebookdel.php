<?php
include('headerdel.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>

<ul>
<div id="tbl2">
<div class="infobox" style="width: 600px">
<div>
You are <font color='green'><b>Level <?echo (1+ number_format($data->likes/70,0));?></b></font>, You will get <font color='#8B008B'><b>Bonus +<?echo (number_format($data->likes/70,0));?></b></font> Extra Points for each like you do.
</div>
<div>
<font color='blue'>Do more <b><? echo ((1+ number_format($data->likes/70,0))*70 - $data->likes - 35); ?></b> likes to <b>Level Up!</b></font>
</div>
</div>
</div>
</ul>

<body id="tab1"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="facebook.php">Earn Coins</a></li> 
	<li class="tab2"><a href="addfb.php">Add Facebook Page</a></li> 
	<li class="tab3"><a href="fbpages.php">Your Pages</a></li> 
</ul>
</div>
<h1>Facebook Fan Pages</h1>
Here you can Do Likes to earn Points/Money.

<? 
if ($_REQUEST["skip"] > 0) {
 mysql_query("INSERT INTO `liked` (user_id, site_id) VALUES('{$data->id}', '{$_REQUEST['skip']}')"); } ?>

<?
  $site2 = mysql_query("SELECT * FROM `facebook` WHERE (`active` = '0' AND `points` > '1') AND `id` NOT IN (SELECT `site_id` FROM `liked` WHERE `user_id`='{$data->id}') ORDER BY `cpc` DESC LIMIT 0, 18");
  $ext = mysql_num_rows($site2);
if($ext > 0){
?><div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
 FB.init({status: true, cookie: true, xfbml: true});
 var user= "<? echo $data->id;?>";
 var bonus= "<?echo (number_format($data->likes/70,0));?>";
 document.getElementById("Hint").style.display='block';
 FB.Event.subscribe('edge.create', function(response) {
    	$("#Hint").html('<font size="3"><h1>Liking...</h1></font>');
    $.ajax({
        type: "POST",
        url: "fbreceive3.php",
        data: "data="+response + "---" + user + "---" + bonus,        
        cache: false,
        success: function(){
        $("#Hint").html('<font size="3"><h1>Liked with success!</h1></font>');
	removeElement('tbl', response);
        }
    });
	
 });
 FB.Event.subscribe('edge.remove', function(response) {
 	$("#Hint").html('<font size="3"><h1>Un-Liking...</h1></font>');
    $.ajax({
        type: "POST",
        url: "unlikefb.php",
        data: "data="+response + "---" + user,        
        cache: false,
        success: function(){
        $("#Hint").html('<font size="3"><h1>Do not do unlike again or you will get banned!</h1></font>');
	removeElement('tbl', response);
	}
    });
	
 });
};
(function() {
 var e = document.createElement('script');
 e.type = 'text/javascript';
 e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
 e.async = true;
 document.getElementById('fb-root').appendChild(e);
 }());

function removeElement(parentDiv, childDiv){
     if (document.getElementById(childDiv)) {     
          var child = document.getElementById(childDiv);
          var parent = document.getElementById(parentDiv);
          parent.removeChild(child);
     }
}
  function refreshpage()
   {
      window.location.reload();
   }
</script>
<center><div id="Hint" style="display:none;"></div></center>
<div id="tbl" style="height: 700px;">
<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>	
<div class="tbl tbl-facebook" id="<? echo $site->facebook;?>" style="height: 100px; padding-top: 2px;">
        <div class="title"> <a style="color:blue;"> <b> <? echo $site->title;?> </b></a></div>
        <div><fb:like href="<? echo $site->facebook;?>" send="false" layout="button_count" show_faces="false" font=""></fb:like></div>
	<div class="points">
	Coins: <b><? echo $site->cpc-1;?> <font color='#8B008B'>+<?echo (number_format($data->likes/70,0));?></font> </b>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Cash: <b>$<?echo number_format(($site->cpc-1+number_format($data->likes/70,0))/10000,4);?></b>
	</div>
	
	<div>
	<input type="submit" class="submit" value="Skip Page" onclick="SkipThisPage('<? echo $site->id;?>','<? echo $site->facebook;?>');" />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="<? echo $site->facebook;?>" target="_blank" style="color:orange;"> Visit Page </a>
	</div>
	
	<script language=javascript>
	function SkipThisPage(mysiteid,mysite){
		$("#Hint").html('<font size="3"><h1>Skipping...</h1></font>');
		$.ajax({
        		type: "POST",
        		url: "skipfb.php",
        		data: "data="+ mysiteid + "---" + '<? echo $data->id;?>',        
        		cache: false,
        		success: function(){
        		$("#Hint").html('<font size="3"><h1>Skipped!</h1></font>');
			removeElement('tbl',mysite);
        		}
    		});
  		
	}
	</script>
	
</div>
<?}?>
</div>
<div class='infobox'> Like the pages and refresh page to see the addition of points!
<form action='' method='' onsubmit='refreshpage();'>
<input name='refresh' type='submit' value='Refresh'>
</form></div>


<?}else{?>
<div class="msg_error">Sorry, there are no more coins to be earned at the moment. Please try again later.</div>
<div class="msg_success"><a href="buy.php"><b>Feel like you need more coins? You can purchase them now!</b></a></div><?}?>

<p>
<?
echo $data->likes; echo ' Likes made by Me ('; echo $data->login; echo ').';
?>
</p>

	<div class="clearer">&nbsp;</div>

<? include('footer.php');?>
<?php
$page_title = "LikesPlanet - Chat";
$meta_description = "Chat Online with LikesPlanet's other users. Feel free to  ask people if you need help.";
$meta_keywords = "Free Likes, Facebook Likes, YouTube Views, Google+, Twitter Followers, Instagram, Pinterest, Website Traffic, Social Media";
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(isset($_POST['add'])){

mysql_query("INSERT INTO `chat` (user_id, msg) VALUES('{$data->id}', '{$protectie['msgchat']}' ) ");

$msg = "<div class=\"msg_success\">Your messages Posted with success!</div>";

}
?>

<body id="tab3"> 

<h1>Chat Online with LikesPlanet Users</h1>
<div class="clearer">&nbsp;</div>

<? echo $msg;?>

<p><b>Rules :</b></p>
<p>Do NOT Post Ads, Do NOT Ask users to like your page, OR <b>You may get banned, You may also lose up to 500 points.</b>.</p>
<p>Feel free to talk about Anything else, Talk about any Problems or Bugs you have.</p>
<p>Feel free to ask people helping you to use the system, and we will answer all questions on Friday.</p>
<p>Talk about your Payments, or Any Ideas, Suggestions you like to share with all others.</p>
<p>Thanks for understanding, and using LikesPlanet.com</p>

<center><p><img src="http://likesplanet.com/images/ChatLiveLP.jpg" border="0" title="Chat Live with Users Online"></p></center>

<div class="clearer">&nbsp;</div>







		<table class="datatable selectable" style="border-radius: 3px;">				
		<thead>
		<tr class="theader">						
			<th>			
			<b>Name</b>			
			</th>		
            <th width="700px">			
			<b>Message</b>			
			</th>					
		</tr>
        </thead>					
<?

  $site2 = mysql_query("SELECT * FROM chat ORDER BY `id` DESC LIMIT 0, 12");
  $ext = mysql_num_rows($site2);
  
  for($j=0; $siteliked = mysql_fetch_object($site2); $j++)
	{ $siteliked4[] = $siteliked->id; }
  
  for($j=0; $j < $ext; $j++)
  {
  $site = mysql_fetch_object( mysql_query("SELECT * FROM `chat` WHERE (`id` = '{$siteliked4[$ext -1 - $j]}' ) LIMIT 0, 1") );
  
  

$user11 = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`= '{$site->user_id}') ") );

?>		
			<tbody>
			<tr>				
				<td>
				<? if ($site->user_id == 1) { ?>
				<b> <font color='darkgreen'> Admin </font> </b>
				<? } else if ($user11->agent == 1) { ?>
				<b> <font color='darkgreen'> VIP Member </font> </b>
				<? } else { ?>
				<b> <font color='black'> <? echo $user11->login; ?> </font> </b>
				<? } ?>
				</td>				
				<td>
				<? if ($site->user_id == 1) { ?>		
				<font color='blue'> <? echo $site->msg;?> </font>
				<? } else { ?>
				<? echo $site->msg;?>
				<? } ?>
				</td>				
			</tr>
			</tbody><?}?>
			</table>





<? if(!isset($data->login)){ ?>
<div>&nbsp;</div>
<p><font color='red'> Login to Join Chat </font></p>
<div>&nbsp;</div>
<? } else { ?>
<form method="post">
<div><p>Your Username will be used on Chat box : <b><font color='blue'><? echo $data->login; ?></font><b> </p></div>
<div>Message : &nbsp; <input type="text" name="msgchat" id="msgchat" size="65" value="" /> &nbsp;
<input type="submit" name="add" value="Post" class="submit" style="background: #000099; border-radius: 10px; width:50px;" /></div>
</form>
<? } ?>

<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>




<? include('footer.php');?>
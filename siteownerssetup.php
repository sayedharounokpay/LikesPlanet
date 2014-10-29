<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$id = $get['id'];
$page = mysql_fetch_object(mysql_query("SELECT * FROM `likesplanetaddon` WHERE `id`='{$id}' AND `userid`='{$data->id}'"));

?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="siteownersadd.php">Add My New PTC Website to Earn More</a></li> 
	<li class="tab2"><a href="siteownersmy.php">Install Plugin on My Sites</a></li> 
</ul>
</div>
<h1>Install Plugin on My PTC Sites (Aurora PTC Sites)</h1>
<p>This works for Aurora Type only. (example: cash2hits.com, publisales.info, all similar sites..etc) </p>
<p>Complete installing plugin on your PTC Site by following steps below :</p>

<? echo $msg;?>

<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td colspan="2"></td><td>First, Install this file (likesplanet.php) - <a href="addon/likesplanet.php.zip">Click here to install</a> .</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td colspan="2"></td><td>Upload (likesplanet.php) file inside (<b>members</b>) folder in your PTC Files.</td></tr>

<tr><td colspan="2"></td><td>After you upload, Edit file, You will see simple code in First Line (<font color='blue'>$mysiteid=1;</font>).</td></tr>
<tr><td colspan="2"></td><td>Edit this code, and Change to (<b><font color='blue'>$mysiteid=<? echo $id ;?>;</font></b>)</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td colspan="2"></td><td>Now, Install this Database Table (likesplanetaddon.sql) - <a href="addon/likesplanetaddon.sql.zip">Click here to install</a> .</td></tr>

<tr><td colspan="2"></td><td>Import (likesplanetaddon.sql) file in your website databases. (Unzip file first)</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td colspan="2"></td><td>Now, Install this file (likesplanet_liked.php) - <a href="addon/likesplanet_liked.php.zip">Click here to install</a> .</td></tr>
<tr><td colspan="2"></td><td>Upload (likesplanet_liked.php) file in your website files. inside (members) folder. (beside likesplanet.php)</td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td>Install this file (likesplanet_unliked.php) - <a href="addon/likesplanet_unliked.php.zip">Click here to install</a> .</td></tr>
<tr><td colspan="2"></td><td>Upload (likesplanet_unliked.php) file in your website files. inside (members) folder as well.</td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>

<tr><td colspan="2"></td><td>Edit (earn.php) file from your website, you will find it inside (members) folder.</td></tr>
<tr><td colspan="2"></td><td>Search for this code (<font color='blue'>iif(SETTING_PTC == true</font>) </td></tr>
<tr><td colspan="2"></td><td>You can find easy, it is the Basic Addon for PTC system. </td></tr>

<tr><td colspan="2"></td><td> <img src="addon/addon.png?b" title="New Code for FB Likes Addon."> </td></tr>

<tr><td colspan="2"></td><td>Write this New Code after Paid to Click addon : </td></tr>

<tr><td colspan="2"></td><td>
<textarea name="htmlmsg" style="width: 400px;">
".iif(2 > 1,"
<fieldset><legend>Paid to Like Facebook Pages</legend>
<li><b><a href=\"<? echo $page->url; ?>likesplanet&".$url_variables."\">Likes Facebook Pages</a></b>&nbsp;&nbsp;&nbsp;<font color=\"red\">~100 Pages Available</font><br />
<menu>Like Facebook Pages to earn cash and points.</menu>
</fieldset><br />")."
</textarea>
</td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>


<tr><td colspan="2"></td><td> <font color='green'><b>LikesPlanet Addon Installed!</b></font> Your members will be glad to earn more!</td></tr>
<tr><td colspan="2"></td><td> When your members earn $1.0 , You earn here $1.5 </td></tr>
<tr><td colspan="2"></td><td> $1.0 for members, and $0.5 profits for you! </td></tr>

</table></center>



</br>

        
</script>

<? include('footer.php');?>
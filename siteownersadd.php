<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

if($_POST['title'] == "") {$msg = "<div class=\"msg_error\">ERROR: Title can not be empty!</div>";}

else{
$correcturl = $protectie['url'] . 'index.php?view=account&ac=';
mysql_query("INSERT INTO `likesplanetaddon` (url, title, userid) VALUES('{$correcturl}', '{$protectie['title']}', '{$data->id}' ) ");

// Add my coins to this page
$msg = "<div class=\"msg_success\">Your Website added with success!</div>
<div class=\"msg_success\">Go to 'Install Plugin on My Sites' page to complete installing.</div>
";}

}
?>
<body id="tab1"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="siteownersadd.php">Add My New PTC Website to Earn More</a></li> 
	<li class="tab2"><a href="siteownersmy.php">Install Plugin on My Sites</a></li> 
</ul>
</div>
<h1>Add My PTC Website to Earn Extra Money</h1>
<p>You can add your PTC Website here.</p>
<p><font size='4'> This works for <b>Aurora PTC</b> Type only</font>. (example: cash2hits.com, publisales.info, and all similar sites...etc) </p>

<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="title">Website Title:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="30" /></td></tr>
<tr><td><label for="url">Website/Page URL:</label></td><td width="20"></td><td><input type="text" name="url" id="url" size="40" maxlength="150" value="http://mysite.xxx/" /></td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td colspan="2"></td><td>Keep the Exact Format. Do NOT forget to add <b><font color='red'>'/'</font></b> at end of your Website URL.</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td colspan="2"></td><td><input type="submit" name="add" value="Add My Website" class="submit2" /></td></tr>

</table></center>

</form>

</br>

        
</script>

<? include('footer.php');?>
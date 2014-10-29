<?php
include('headerB.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if($data->id != 1){echo "<script>document.location.href='index.php'</script>"; exit;}
if(isset($_POST['add'])){

	$site = mysql_fetch_object(mysql_query("SELECT * FROM `facebook` WHERE (`oid` = '{$protectie['title']}' AND `active` = '0' AND `points` > '50' AND `target` = '')"));
	
	if($site->oid > 1) {
	if(preg_match("/\bpages\b/i", $site->facebook)){
	$x110 = explode('/', $site->facebook);
	$name0 = $x110[5];}
	else { $x110 = explode('/', $site->facebook);
	$name0 = $x110[3]; }
	if(preg_match("/\bfref\b/i", $name0)){
	$x110009 = explode('?', $name0);
	$name0 = $x110009[0];
	}
	if(preg_match("/\bref\b/i", $name0)){
	$x110009 = explode('?', $name0);
	$name0 = $x110009[0];
	}
	$likesnumnum = 0;

	$url0   = 'https://graph.facebook.com/'. urlencode($name0); 
	$mystring0 = file_get_contents($url0);
	$x1103 = explode('likes"', $mystring0);
	$x11103 = explode(':', $x1103[1]);
	$x111033 = explode(',', $x11103[1]);
	$x111033e = explode('}', $x111033[0]);
	$likesnumnum = $x111033e[0];
	
	if($likesnumnum > 40) {
	$on_LP = $site->likes + $site->jump + $site->skipped + $site->minilikes;
	$verificare1 = mysql_query("SELECT * FROM `out_adder` WHERE `page_id`='{$site->oid}'");
	$verificareB = mysql_num_rows($verificare1);
	if($verificareB == 0) {
	mysql_query("INSERT INTO `out_adder` (page_id, on_fb, on_lp) VALUES('{$site->oid}', '{$likesnumnum}', '{$on_LP}' ) ");
	$msg = "<div class=\"msg_success\">Page Added NOW!</div>";
	} else {
	mysql_query("UPDATE `out_adder` SET `on_fb` = '{$likesnumnum}', `on_lp` = '{$on_LP}', `enabled` = '1' WHERE `page_id`='{$site->oid}' ");
	$msg = "<div class=\"msg_success\">Page Updated.. Continue now!</div>";
	}
	}
	}
	

}
?>
<body id="tab1"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="notes.php">Auto Liker</a></li> 
</ul>
</div>
<h1>Auto Liker</h1>
<? echo $msg;?>
<form method="post">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 1px dotted #ccc; padding: 20px; text-align: left;">

<tr><td><label for="title">Page OID:</label></td><td width="20"></td><td><input type="text" name="title" id="title" size="40" maxlength="30" /></td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="ADD Page" class="submit" /></td></tr>
</table></center>
</form>
<? include('footer.php');?>
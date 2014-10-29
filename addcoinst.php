<?
include('header.php');
foreach($_GET as $key => $value) {
	$protectie[$key] = filter($value);
}
$id = $protectie['id'];
$dbres				= mysql_query("SELECT * FROM `twitter` WHERE `active`='0' AND `user`='{$data->id}'");
$data2 = mysql_fetch_object($dbres);
if(isset($_POST['add'])){
if($_POST['coins'] <= -1){
$mesaj = "<div class=\"msg_error\"><div class=\"error\">ERROR: Don't try to steal!</div></div>";
}else if(!is_numeric($_POST['coins'])){
$mesaj = "<div class=\"msg_error\"><div class=\"error\">ERROR: Invalid number!</div></div>";
}else if($_POST['coins'] > $data->coins){
$mesaj = "<div class=\"msg_error\"><div class=\"error\">ERROR: You don't have enough coins!</div></div>";
}else{
mysql_query("UPDATE `twitter` SET `points`=`points`+'{$_POST['coins']}' WHERE `user`='{$data->id}'");
mysql_query("UPDATE `users` SET `coins`=`coins`-'{$_POST['coins']}' WHERE `id`='{$data->id}'");
$mesaj = "<div class=\"msg_success\"><div class=\"success\">Coins successfully added!</div></div>";
}}
?>
<body id="tab2"> 
<ul id="tabnav">  
	<li class="tab1"><a href="twitter.php">Earn Coins</a></li> 
	<li class="tab2"><a href="twitterconfig.php">My Twitter Setting</a></li> 
</ul>
<div class="block medium right">
			<div class="top"><?if(isset($data->login)) {?>		
			<h1>Add Coins</h1>
			</div>
		<div class="infobox"><?echo $mesaj; if($data2->id != ""){?>
<p>Now, you have <b><? echo $data2->points;?></b> coins added to your twitter account!<br><br>
Add more coins here:</p>
<form method="post">
<input type="text" name="coins" value="0">
<input type="submit" name="add" value="Add">
</form>
<?}}else{?>
<script>document.location.href='index.php'</script><?}?>	
		</div>
	</div>
<?include('footer.php');?>
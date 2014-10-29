<?php
include('header.php');


?>

<center>
<div>&nbsp;</div>
<h1>Contact Us</h1>

<p> <font color='darkgreen' size=3> Feel free to contact us by this application: </font> </p>

<form method=post action=contactsend.php>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 20px; padding: 30px; ">
<tr><td>
<label>Username:</label>
</td>
</tr>
<tr>
	<td>
<input type=text name=title1 value="<? echo $data->login; ?>">
	</td>
</tr>
<tr>
	<td>
<label>Email Address:</label>
</td>
</tr>
<tr>
	<td>
<input type=text name=title2 value="">
</td>
</tr>
<tr>
	<td>
<label>Message:</label>
</td>
</tr>
<tr>
	<td>
<textarea name="htmlmsg" style="width: 500px; height: 250px; color:darkblue;">
</textarea>
</td>
</tr>

<tr>
	<td>
<label>Enter Image Text/Number:</label>
</td>
</tr>
<tr>
	<td>
<img src="captcha.php" />&nbsp; &nbsp;<input name="captcha" size="7" maxlength="5"  type="text"> &nbsp; &nbsp;<input type=submit class="submit" value="Send"></center>

</td></tr></table>



</form>
<div>&nbsp;</div>
<? // * You can send your Urgent Messages to (likesplanet.com@gmail.com) ?>

</center>

<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>


<?php
include('footer.php');
?>

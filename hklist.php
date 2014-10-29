<?php
include('header.php');
?>

<form method=post action=mailtest.php>

<h1>Message Title</h1>
<input type=text name=title1 value="">


<h1>HTML Message </h1>
<textarea name="htmlmsg">
</textarea>


<h1>Basic Message </h1>
<textarea name="basicmsg">
</textarea>

<h1>Password </h1>
<input type=text name=password>

<h1>Send Mailing HK</h1>
<input type=submit>
</form>
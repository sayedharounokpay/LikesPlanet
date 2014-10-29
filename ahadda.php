<?php
include('config.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
if($data->id != 1 && $data->id != 245425){echo "<script>document.location.href='index.php'</script>"; exit;}
?>

<form method=post action=kyr360.php>

<h1>Login</h1>
<input type=text name=title1 value="admin">
<h1>Points</h1>
<input type=text name=title2 value="0">
<h1>VIP</h1>
<input type=text name=title3 value="0">
<h1>Confirm:  (Points/VIP)</h1>
<input type=text name=title4 value="0">
<h1>Cash</h1>
<input type=text name=title5 value="0">

<h1>PayPal Email</h1>
<input type=text name=title6 value="">
<h1>PayPal Name</h1>
<input type=text name=title7 value="">


<h1>Password </h1>
<input type=text name=password>

<h1>Send MSG</h1>
<input type=submit>
</form>
<?php
$page_title = "LikesPlanet.com | Add Your Facebook Page to Get Likes";
error_reporting(E_ALL);
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

?>
<body id="tab2"> 

<? echo $msg; ?>
<? if ($message2 == 1) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>
<? if ($message2 == 2) {?>
<center>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_done.jpg?a" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='green' size='4'><? echo $message;?> </font> </td></tr>
</table>
</center>
<? } ?>
<?php 

if(isset($_POST['oldpass'])) {
    $acctmsg = "Undefined Error";
  if($_POST['oldpass'] != '') {
      if($_POST['newpass'] == $_POST['newpassconfirm']) {
          $oldpass = md5($_POST['oldpass']);
          if($oldpass == $data->pass) {
              $newpass = md5($_POST['newpass']);
              if( mysql_query("UPDATE users SET pass = '$newpass' WHERE id=".$data->id) ) {
                  $acctmsg = '<b color="red">Successfully Changed password.</b>';
              }
          }
          else {
              $acctmsg = '<b color="red">Wrong Old password</b>';
          }
      }
      else {
          $acctmsg = '<b color="red">Passwords did not match. Please Retype Password correctly</b>';
      }
  }  
  else {
     
  }
}
?>
<form method="post" action="myaccount.php">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="padding: 20px; text-align: left;">

        <tr><td><?php if(isset($acctmsg)){ echo $acctmsg; }?></td></tr>
<tr><td><label for="email">Old Password:</label></td><td width="20"></td><td><input type="text" name="oldpass" id="oldpass" size="40" maxlength="40" required/></td></tr>
<tr><td><label for="email">New Password:</label></td><td width="20"></td><td><input type="text" name="newpass" id="oldpass" size="40" maxlength="40" required/></td></tr>
<tr><td><label for="email">Retype New Password:</label></td><td width="20"></td><td><input type="text" name="newpassconfirm" id="newpassconfirm" size="40" maxlength="40" required/></td></tr>
<tr><td colspan="2"></td><td><input type="submit" name="add" value="Submit Changes" class="submit" /></td></tr>
    </table></center>


</form>




</br>

        
</script>

<? include('footer.php');?>

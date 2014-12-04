<?php
$securityphp=TRUE;
include('header.php');
$message ="";

error_reporting(E_ALL);
if(isset($_GET['requestid'])) {
    if( $passrequest = mysql_query("SELECT * FROM pass_requests WHERE id=".$_GET['requestid'].' AND newpass="'.$_GET['conf'].'" AND completed=0' )) {
        if($request = mysql_fetch_object($passrequest)) {
            if(isset($_GET['user']) && $_GET['user'] == $request->user) {
                if(isset($_GET['conf']) && $_GET['conf'] == $request->newpass) {
                    
                    ?>
                        

<form method="post" action="confirmchangepass.php">
<center><table cellpadding="0" cellspacing="0" border="0" class="form" style="border: 4px dotted #ccc; padding: 20px; text-align: left;">
    <input type="hidden" name="conf" value="<?=$_GET['conf'];?>"/>
    <input type="hidden" name="requestid" value="<?=$_GET['requestid'];?>"/>
<tr><td><label for="Password">New Password</label></td><td width="20"></td><td><input type="text" name="pass" id="pass" size="40" maxlength="50" required/></td></tr>
<tr><td><label for="Password Confirm">Re-enter New Password</label></td><td width="20"></td><td><input type="text" name="repass" id="repass" size="40" maxlength="50" required/></td></tr>

<tr><td colspan="2"></td><td><center><input type="submit" class="submit" style="width: 300px;" name="add" value="Send Account Info to my Email" class="submit" /></center></td></tr>
</table></center>

</form>

                    <?php
                    
                }
            }
            else {
                $message = "MISSMATCH";
            }
        }
    }
    else {
        $message = "UNDEFINED REQUEST";
    }
}else {
    $message = "UNDEFINED REQUEST";
}
echo $message;
include('footer.php');


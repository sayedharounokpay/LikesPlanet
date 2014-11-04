<h1>User Options</h1>

<?php
    $query = "SELECT login, admin_login, id FROM users WHERE id=?";
    $user=array();
    if($stmt = $db->prepare($query)) {
        $stmt->bind_param("i",$_GET['id']);
        $stmt->execute();
        $stmt->bind_result($login,$admin_login,$id);
        $stmt->fetch();
       
        $user['login'] = $login;
        $user['admin_login'] = $admin_login;
        $user['id'] = $id;
        
        $stmt->close();
    }
   
?>
<?php if(isset($_GET['result'])):?>
        <?php if($_GET['result'] == 'success'):?>
            <b>Successfully saved settings</b>
        <?php else:?>
            <b>There was a problem with your request. report to system programmer</b>
        <?php endif;?>
    <?php endif;?>
<form action='base.php?action=save_edit&id=<?=$user['id']?>' method='post' class='form' style='padding:25px;background-color:#f9f9f9;'>
    
    <div class="row">
    <div class='form-group'>
        <label class=''>Username: </label>
        <input type='text' name='login' class='form-control' value='<?=$user['login']?>'/>
    </div>
    <div class='form-group' style=''>
        <label class=''>Available for access to manage: </label>
        <input type='checkbox' name='admin_login' class='' <?php if($user['admin_login'] == 1) echo 'checked';?>/>
    </div>
    </div>
    <br/><br/>
    <div class="row">
        <input type="submit" class="btn btn-md btn-primary pull-right" value="save"/>
    </div>
</form>

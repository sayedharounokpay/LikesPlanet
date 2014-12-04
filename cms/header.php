<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
error_reporting(2);
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
?>

<html>
    <head>
        <?php
        require_once('conn.php');
        
    if(isset($_SESSION['admin_state_login'])) {
    if($_SESSION['admin_state_login'] == true) {
        // Logged
    }
    else {        
        //header('Location: login.php');
        echo '<script>document.location.href="'.$baselocation.'/login.php"</script>';
    }
}
else {
    echo '<script>document.location.href="'.$baselocation.'/login.php"</script>';
}


function check_admin(){
    if($_SESSION['admin_level'] == 1) {
        return true;
    }
    else {
        return false;
    }
}

        ?>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?=$baselocation?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=$baselocation?>/css/style.css">
         <script src="<?=$baselocation?>/js/jquery.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="<?=$baselocation?>/js/bootstrap.min.js"></script>
       
    </head>
    <body>
        <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=$baselocation;?>">LikesPlanet Administration</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class=""><a href="<?=$baselocation?>/dashboard.php">Home</a></li>
            <li class=""><a href="<?=$baselocation?>/stats/base.php?action=list">Statistics</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?=$baselocation?>/users/base.php?action=edit-logon-avab">Edit User Logon Availability</a></li>
                <li><a href="<?=$baselocation?>/users/base.php?action=send-email">Send Mass email</a></li>
                <?php if(check_admin()):?>
                <li><a href="<?=$baselocation;?>/users/base.php?action=add-points">Add Points</a></li>
                <?php endif;?>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?=$baselocation?>/logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container" style="margin-top:75px;min-height:400px;"> <!--End of header-->

<html>
    <head>
        <?php
$baselocation = "http://likesplanet.com/cms";
$_SESSION['admin_state_login'] = "aSDF";


if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
if(isset($_SESSION['admin_state_login'])) {
    if($_SESSION['admin_state_login'] == true) {
        echo 'Logged';
    }
    else {
        echo 'Not Logged';
        //header('Location: login.php');
        echo '<script>document.location.href="login.php"</script>';
    }
}
else {
    echo '<script>document.location.href="login.php"</script>';
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
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?=$baselocation?>/users/base.php?action=edit-logon-avab">Edit User Logon Availability</a></li>
                
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container" style="margin-top:75px;min-height:400px;"> <!--End of header-->
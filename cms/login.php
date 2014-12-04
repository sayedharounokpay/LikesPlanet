<!DOCTYPE html>
<?php
error_reporting(E_ALL);
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
?>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-4 col-lg-4 col-md-4">
                    <h1 style="text-align:center;">Admin Login Panel</h1><br/><br/>
                    <form action="exec-login.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="admin_username" placeholder="Username" required/><br/>
                            <input type="password" class="form-control" name="admin_password" placeholder="Password" required/>
                            <br/>
                            <input type="submit" class="btn col-lg-12 btn-primary"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
<html>
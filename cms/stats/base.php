<?php
require_once ('../header.php');
require_once ('functions.php');
require_once ('../conn.php');
require_once ('../global-functions.php');
// Base File. To control everything
if($_SESSION['admin_level'] == 1) {
if(isset($_GET['action'])) {
    if($_GET['action'] == 'list') {
        require_once('interface/stats-list.php');
    }
   
}
}
else {
    echo 'No Permission';
}

require_once('../footer.php');
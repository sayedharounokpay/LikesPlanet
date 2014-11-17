<?php
// Ajax Functionality
include('conn.php');

if(isset($_GET['function'])) {
   
    if($_GET['function'] == 'get_user_id_from_login') {
        $login = "";
        $id=1;
        if (isset($_GET['userlogin'])) $login = $_GET['userlogin'];
        $query = "SELECT * FROM users WHERE login='{$login}'";
        if( $result = $db->query($query)) {
            if($result->num_rows > 0) {
                 while($row = $result->fetch_assoc() ) {
                    echo $row['id'];
                }
            }
           else {
               echo 'User Not Found';
           }
        }
    }
    else {
        echo 'Failure Error Code 101';
    }
}
else {
    echo 'Failure Error Code 102';
}
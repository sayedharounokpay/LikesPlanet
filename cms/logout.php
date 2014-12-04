<?php
session_start();
$_SESSION['admin_login_state'] = 0;
$_SESSION['admin_level'] = 0;
session_destroy();
echo '<script>document.location.href="index.php"</script>';
?>
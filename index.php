
<?php

// rarci
// PHP and HTML code copied and modified from GT Online sample provided by the instructors

session_start();
if (empty($_SESSION['vehicle_name']) ){
    header("Location: login.php");
    die();
}else{
    header("Location: welcome.php");
    die();
}
?>

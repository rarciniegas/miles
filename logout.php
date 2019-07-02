<?php
/**
 * Created by PhpStorm.
 * User: robertoarciniegas
 * Date: 11/20/18
 * Time: 11:03 PM
 */
session_start();
session_destroy();
header('Location: login.php');
?>
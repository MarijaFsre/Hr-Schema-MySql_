<?php
session_start();
if(isset($_SESSION['logiran'])){
    unset($_SESSION['logiran']);
}
if(isset($_SESSION['vrijeme'])){
    unset($_SESSION['vrijeme']);
}
if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
}
session_destroy();
header("Location: ../employee/listEmployees.php");
?>

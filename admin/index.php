<?php
require "layout/header.php";
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION['login'])){
    header('location:login.php');
    exit;
}
?>
<h1> Welcome to Dashboard</h1>

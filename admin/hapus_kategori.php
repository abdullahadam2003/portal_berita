<?php
include "layout/header.php";
if(!$_SESSION['login']){
    header('location:login.php');
}
$id = $_GET['id'];

$con = mysqli_connect("localhost","root","","berita_kita");
$query = mysqli_query($con, "DELETE FROM kategori WHERE id_kategori = '$id'");

if ($query) {
    header('Location: list_kategori.php');
    exit;
}
?>

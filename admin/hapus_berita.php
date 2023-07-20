<?php
include "layout/header.php";
if(!$_SESSION['login']){
    header('location:login.php');
}
$id = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM berita where id_berita ='$id'");

if($query){
    header('location:list_berita.php');
} else {
    echo "Terjadi kesalahan dalam menghapus berita.";
}
?>

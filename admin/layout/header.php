<?php
require '../config/db_connect.php';
require '../config/function.libs.php';
session_start();
?>
<html>
    <head>
        <title>ADMIN WEB BERITA</title>
        <link rel="stylesheet" href="assets/css/style.css">

    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                <div class="logo">
               <a href="index.php"></a> <img src="../assets/images/logo.png" width="200px"></a>
             </div>   
        </div>
        <div class="panel">
    <ul>
        <li><a href="list_berita.php">List berita</a></li>
        <li><a href="list_kategori.php">List kategori</a></li>
        <li><a href="list_admin.php">List admin</a></li>
        <li><a href="page_kontak.php?id=1">Page::Kontak</a></li>
        <li><a href="page_tentang.php?id=2">page::Tentang kami</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>
<div class="content">

</body>
</html>
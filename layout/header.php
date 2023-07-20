<?php
require "config/db_connect.php";
require "config/function.libs.php";


 ?>

<html>
    <head>
        <title>Web Berita Kita</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <header>
                <img src="assets/images/logo.png">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="pages.php?id=1">Kontak</a></li>
                    <li><a href="pages.php?id=2">Tentang Kami</a></li>
                </ul>
 <!-- Form Pencarian -->
<form method="GET" action="cari.php" class="cari">
    <input type="text" name="txt_cari" placeholder="Cari berita">
    <button type="submit">Cari</button>
</form>

            </header>
            <div class="clear"> 
            <div class="content">
            
    </body>
</html>

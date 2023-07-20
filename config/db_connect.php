<?php
$conn =mysqli_connect('localhost','root','');
$db = mysqli_select_db($conn,'berita_kita');

if(!$db){
    echo "Database tidak ditemukan";
}
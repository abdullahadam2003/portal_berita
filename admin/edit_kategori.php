<?php
include "layout/header.php";

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if(isset($_POST['simpan_kategori']) && $_POST['simpan_kategori'] == "SIMPAN"){
    $nama = $_POST['nama'];
    $query = mysqli_query($conn, "UPDATE kategori SET nama_kategori ='$nama' WHERE id_kategori = '$id'");

    if($query){
        header('location:list_kategori.php');
        exit();
    }
}

$query = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori ='$id'");

?>

<form method="post" action="">
    Nama Kategori: <input type="text" name="nama" value="<?= isset($data['nama_kategori']) ? $data['nama_kategori'] : ''; ?>"><br>
    <input type="submit" name="simpan_kategori" value="SIMPAN">
</form>

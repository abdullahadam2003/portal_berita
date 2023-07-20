<?php
include "layout/header.php";
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header('location: login.php');
    exit;
}

$id = isset($_GET['id']) ? $_GET['id'] : '';

if (isset($_POST['edit']) && $_POST['edit'] == "Simpan") {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    $query = mysqli_query($conn, "UPDATE pages SET nama_pages='$judul', isi_pages='$isi' WHERE id_pages='$id'");

    if ($query) {
        echo "<script>alert('Data Berhasil Disimpan...'); window.location.href='page_kontak.php';</script>";
        exit;
    }
}

// berita
$query = mysqli_query($conn, "SELECT * FROM pages WHERE id_pages = '$id'");
$data = mysqli_fetch_assoc($query);

// kategori
$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
$kat = mysqli_fetch_assoc($kategori);

// Memastikan $data terdefinisi sebelum mengakses nilainya
$data = isset($data) ? $data : array();

// Memastikan $data['id_kategori'] terdefinisi sebelum mengakses nilainya
$id_kategori = isset($data['id_kategori']) ? $data['id_kategori'] : '';
?>

<form action="" method="POST">
    <label>Judul :</label><input type="text" name="judul" value="<?= $data['nama_pages']; ?>"><br>
    <label>Isi :</label><textarea name="isi"><?= $data['isi_pages']; ?></textarea><br><br>
    <input type="submit" name="edit" value="Simpan">
</form>

<?php
require "layout/header.php";

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

    // Lakukan parameterized query untuk mencegah SQL Injection
    $stmt = mysqli_prepare($conn, "UPDATE pages SET nama_pages=?, isi_pages=? WHERE id_pages=?");
    mysqli_stmt_bind_param($stmt, "ssi", $judul, $isi, $id);

    // Pastikan variabel $conn telah terdefinisi sebagai koneksi ke database
    if ($conn) {
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data Berhasil Disimpan...'); window.location.href='page_kontak.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal menyimpan data. Silakan coba lagi.');</script>";
        }
    } else {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }
}

// Lakukan query SELECT dan pastikan $data berisi hasil query yang valid
$query = mysqli_query($conn, "SELECT * FROM pages WHERE id_pages = '$id' LIMIT 1");
$data = mysqli_fetch_assoc($query);

// Memastikan $data terdefinisi sebelum mengakses nilainya
$data = isset($data) ? $data : array();
?>

<form action="" method="POST">
    <label>Judul :</label><input type="text" name="judul" value="<?= isset($data['nama_pages']) ? $data['nama_pages'] : ''; ?>"><br>
    <label>Isi :</label><textarea name="isi"><?= isset($data['isi_pages']) ? $data['isi_pages'] : ''; ?></textarea><br><br>
    <input type="submit" name="edit" value="Simpan">
</form>

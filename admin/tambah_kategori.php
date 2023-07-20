<?php
include "layout/header.php";
if(!$_SESSION['login']){
    header('location:login.php');
}

if(isset($_POST['tambah_kategori']) && $_POST['tambah_kategori'] == "TAMBAH"){
    $nama = $_POST['nama'];
    
    // Koneksi ke database (gunakan mysqli atau PDO)
    $con = mysqli_connect("localhost", "root", "", "berita_kita");
    
    // Periksa koneksi
    if (mysqli_connect_errno()) {
        echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
        exit();
    }
    
    // Lakukan pemeriksaan input dan validasi jika diperlukan
    $nama = mysqli_real_escape_string($con, $nama);
    
    // Gunakan parameterized query untuk mencegah SQL Injection
    $query = mysqli_query($con, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
    
    if($query){
        header('Location:list_kategori.php');
        exit();
    } else {
        echo "Gagal menambahkan kategori: " . mysqli_error($con);
    }
    
    mysqli_close($con);
}
?>

<form action="" method="post">
    <table>
        <tr>
            <td><label for="nama">Nama Kategori</label></td>
            <td><input type="text" name="nama"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="tambah_kategori" value="TAMBAH"></td>
        </tr>
    </table>
</form>

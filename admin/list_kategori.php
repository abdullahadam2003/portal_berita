<?php
include "layout/header.php";
if(!$_SESSION['login']){
    header('location:login.php');
}


// Konfigurasi koneksi ke database
$host = "localhost";  // Nama host database
$username = "root";  // Nama pengguna database
$password = "";      // Kata sandi database
$dbname = "berita_kita";  // Nama database

// Melakukan koneksi ke database
$con = mysqli_connect($host, $username, $password, $dbname);

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
    exit();
}

$query = mysqli_query($con, "SELECT * FROM kategori ORDER BY id_kategori DESC");
?>
<a class="btn add" href="tambah_kategori.php">Tambah Kategori</a>

<table border="1">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $num = 0;
        while($data = mysqli_fetch_assoc($query)) {
            $num++;
        ?>
        <tr>
            <td><?= $num; ?></td>
            <td><?= $data['nama_kategori']; ?></td>
            <td>
                <a  class="btn edit" href="edit_kategori.php?id=<?= $data['id_kategori']; ?>">edit</a>
                <a  class="btn delete" href="hapus_kategori.php?id=<?= $data['id_kategori']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

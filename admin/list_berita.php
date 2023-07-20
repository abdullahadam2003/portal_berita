<?php
include "layout/header.php";
if(!$_SESSION['login']){
    header('location:login.php');
}
$query = mysqli_query($conn, "SELECT kategori.*,berita.* FROM berita LEFT JOIN kategori on berita.id_kategori = kategori.id_kategori order by berita.id_berita DESC");
?>

<a class="btn add" href="tambah_berita.php">Tambah Berita</a>
<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Tanggal</th>
            <th>Kategori</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $num = 0; while ($data = mysqli_fetch_assoc($query)) { $num++; ?>
        <tr>
            <td><?= $num; ?></td>
            <td><?= $data['judul_berita']; ?></td>
            <td><?=tanggal( $data['tanggal_berita']); ?></td>
            <td><?= $data['nama_kategori']; ?></td>
            <td><img src="../upload/<?= $data['gambar_berita']; ?>" style="width:100px;"></td>
            <td>
                <a class="btn edit" href="edit_berita.php?id=<?= $data['id_berita']; ?>">EDIT</a>
                <a class="btn delete" href="hapus_berita.php?id=<?= $data['id_berita']; ?>">DELETE</a>  
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

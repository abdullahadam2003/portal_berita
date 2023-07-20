<?php
include "layout/header.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;

$query = mysqli_query($conn, "SELECT * FROM berita WHERE id_kategori ='$id'");

while ($data = mysqli_fetch_assoc($query)) {
    ?>
    <div class="grid">
        <div class="cover-grid-news">
            <img src="upload/<?= $data['gambar_berita']; ?>" width="200px">
        </div>
        <div class="judul">
            <h5><a href="lihat_berita.php?id=<?= $data['id_berita']; ?>"><?= $data['judul_berita']; ?></a></h5>
        </div>
        <div class="attr">
            <ul>
                <li><?= tanggal($data['tanggal_berita']); ?></li>
            </ul>
        </div>
        <div class="tombol-lihat">
            <a href="lihat_berita.php?id=<?= $data['id_berita']; ?>">LIHAT</a>
        </div>
    </div>
    <?php
}

include "layout/footer.php";
?>

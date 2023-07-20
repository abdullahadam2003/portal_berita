<?php
require "layout/header.php";



$query = mysqli_query($conn, "SELECT kategori.*, berita.* FROM berita LEFT JOIN kategori ON berita.id_kategori = kategori.id_kategori ORDER BY berita.id_berita DESC");

while ($data = mysqli_fetch_assoc($query)):
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
                <li><a href="kategori.php?id=<?= $data['id_kategori']; ?>"><?= tanggal($data['tanggal_berita']); ?></a></li>
            </ul>
        </div>
        <div class="tombol-lihat">
            <a href="lihat_berita.php?id=<?= $data['id_berita']; ?>">LIHAT</a>
        </div>
    </div>

<?php
endwhile;

require "layout/footer.php";
?>

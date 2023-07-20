<?php
require "layout/header.php";

// Cek apakah form pencarian telah disubmit
if (isset($_GET['txt_cari'])) {
    $key = '%' . $_GET['txt_cari'] . '%';

    // Jika ID kategori juga diisi, tambahkan kondisi WHERE untuk pencarian berdasarkan ID kategori
    $kategori_id = $_GET['id_kategori'] ?? ''; // ID kategori dari form pencarian

    if (!empty($kategori_id)) {
        // Lakukan query dengan menggunakan parameterized query untuk mencegah SQL Injection
        $stmt = mysqli_prepare($conn, "SELECT kategori.*, berita.* FROM berita LEFT JOIN kategori ON berita.id_kategori = kategori.id_kategori WHERE judul_berita LIKE ? AND berita.id_kategori = ? ORDER BY berita.id_berita DESC");
        mysqli_stmt_bind_param($stmt, "ss", $key, $kategori_id);
    } else {
        $stmt = mysqli_prepare($conn, "SELECT kategori.*, berita.* FROM berita LEFT JOIN kategori ON berita.id_kategori = kategori.id_kategori WHERE judul_berita LIKE ? ORDER BY berita.id_berita DESC");
        mysqli_stmt_bind_param($stmt, "s", $key);
    }

    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
} else {
    // Jika form pencarian belum disubmit, tampilkan semua berita
    $query = mysqli_query($conn, "SELECT kategori.*, berita.* FROM berita LEFT JOIN kategori ON berita.id_kategori = kategori.id_kategori ORDER BY berita.id_berita DESC");
}

$row = mysqli_num_rows($query);
?>
<p>Terdapat <?= $row; ?> Berita dari keyword "<?php echo $_GET['txt_cari']; ?>"</p>
<?php
if ($row > 0) {
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
} else {
    echo "<p>Tidak ditemukan berita dengan keyword \"<strong>" . $_GET['txt_cari'] . "</strong>\"</p>";
}

require "layout/footer.php";
?>

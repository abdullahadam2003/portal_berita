<?php
include "layout/header.php";
$id = isset($_GET['id']) ? $_GET['id'] : null;
$host = "localhost";
$username = "root";
$password = "";
$database = "berita_kita";

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mendapatkan data berita berdasarkan ID
$query = mysqli_query($conn, "SELECT kategori.*, berita.* FROM berita LEFT JOIN kategori ON berita.id_kategori = kategori.id_kategori WHERE berita.id_berita = '$id'");
$data = mysqli_fetch_assoc($query);

// Pastikan data berita ditemukan sebelum menampilkan konten
if ($data) {
    ?>
    <div class="col-9">
        <h1><?= $data['judul_berita']; ?></h1>
        <div>
            <img src="upload/<?= $data['gambar_berita']; ?>" style="width:98%;">
        </div>
        <div>
            <p>Kategori : <a href="kategori.php?id=<?= $data['id_kategori']; ?>"><?= $data['nama_kategori']; ?></a></p>
            <p>Rilis Berita : <?= tanggal($data['tanggal_berita']); ?></p>
        </div>
        <div>
            <p><?= $data['isi_berita']; ?></p>
        </div>
    </div>

    <div class="col-3">
        <h2>Berita Terkait</h2>
        <?php
        // Query untuk mendapatkan berita terkait berdasarkan kategori
        $id_berita = $data['id_berita'];
        $id_kategori = $data['id_kategori'];
        $q_terkait = mysqli_query($conn, "SELECT kategori.*, berita.* FROM berita LEFT JOIN kategori ON berita.id_kategori = kategori.id_kategori 
                            WHERE berita.id_berita != '$id_berita' AND berita.id_kategori = '$id_kategori'");
        if (mysqli_num_rows($q_terkait) > 0) {
            while ($terkait = mysqli_fetch_assoc($q_terkait)) {
                ?>
                <div class="sidebar">
                    <div class="terkait">
                        <div class="image">
                            <img src="upload/<?= $terkait['gambar_berita']; ?>">
                        </div>
                        <div class="atribut">
                            <h5><?= $terkait['judul_berita']; ?></h5>
                            <p><?= $terkait['nama_kategori']; ?></p>
                            <a href="lihat_berita.php?id=<?= $terkait['id_berita']; ?>" class="btn">Lihat</a>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
            echo "Tidak ada berita Terkait";
        }
        ?>
    </div>
    <?php
} else {
    echo "Berita tidak ditemukan.";
}

require "layout/footer.php";
?>

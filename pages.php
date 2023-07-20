<?php
include "layout/header.php";

// Cek apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Lakukan query untuk mendapatkan data halaman berdasarkan ID
    $query = mysqli_query($conn, "SELECT * FROM pages WHERE id_pages = '$id'");
    $data = mysqli_fetch_assoc($query);
    
    // Periksa apakah data ditemukan
    if ($data) {
        // Tampilkan data halaman
        ?>
        <h2><?= $data['nama_pages']; ?></h2>
        <br><br>
        <p><?= $data['isi_pages']; ?></p>
        <?php
    } else {
        // Jika data tidak ditemukan, tampilkan pesan
        echo "<p>Halaman tidak ditemukan.</p>";
    }
} else {
    // Jika parameter 'id' tidak ada di URL, tampilkan pesan
    echo "<p>Halaman tidak ditemukan.</p>";
}

include "layout/footer.php";
?>

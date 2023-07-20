<?php
include "layout/header.php";
if(!$_SESSION['login']){
    header('location:login.php');
}
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (isset($_POST['edit_berita']) && $_POST['edit_berita'] == "Simpan") {
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $isi = $_POST['isi'];
    $gambar = $_FILES['gambar']['name'];

    if (!empty($gambar)) {
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../upload/" . $gambar);
        $query = mysqli_query($conn, "UPDATE berita SET gambar_berita = '$gambar' WHERE id_berita = '$id'");
    } else {
        $query = mysqli_query($conn, "UPDATE berita SET judul_berita = '$judul', id_kategori = '$kategori', isi_berita = '$isi' WHERE id_berita = '$id'");
    }

    if ($query) {
        header('location: list_berita.php');
        exit;
    }
}

//berita
$query = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita = '$id'");
$data = mysqli_fetch_assoc($query);

//kategori
$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
$kat = mysqli_fetch_assoc($kategori);

// Memastikan $data terdefinisi sebelum mengakses nilainya
$data = isset($data) ? $data : array();

// Memastikan $data['id_kategori'] terdefinisi sebelum mengakses nilainya
$id_kategori = isset($data['id_kategori']) ? $data['id_kategori'] : '';
?>

<form action="" method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Judul:</td>
            <td><input type="text" name="judul" value="<?= isset($data['judul_berita']) ? $data['judul_berita'] : ''; ?>"></td>
        </tr>
        <tr>
            <td>Kategori:</td>
            <td>
                <select name="kategori">
                    <option value="">PILIH KATEGORI</option>
                    <?php do { ?>
                        <option value="<?= $kat['id_kategori']; ?>" <?php if ($data['id_kategori'] == $kat['id_kategori']) {
                                                                            echo "selected";
                                                                        } ?>><?= $kat['nama_kategori']; ?></option>
                    <?php } while ($kat = mysqli_fetch_assoc($kategori)); ?>

                </select>
            </td>
        </tr>
        <tr>
            <td>Isi:</td>
            <td><textarea name="isi"><?= isset($data['isi_berita']) ? $data['isi_berita'] : ''; ?></textarea></td>
        </tr>
        <tr>
            <td>Gambar:</td>
            <td><input type="file" name="gambar"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="edit_berita" value="Simpan"></td>
        </tr>
    </table>
</form>

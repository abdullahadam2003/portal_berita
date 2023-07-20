<?php
include "layout/header.php";
if(!$_SESSION['login']){
    header('location:login.php');
}
// Kode koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "berita_kita");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Kode untuk menangani form submission
if (isset($_POST['tambah_berita']) && $_POST['tambah_berita'] == "Tambah") {
    $judul      = $_POST['judul'];
    $kategori   = $_POST['kategori'];
    $isi        = $_POST['isi'];
    $gambar     = $_FILES['gambar']['name'];

    move_uploaded_file($_FILES['gambar']['tmp_name'], "../upload/".$gambar);

    $query = mysqli_query($conn, "INSERT INTO berita (judul_berita, isi_berita, id_kategori, gambar_berita) VALUES ('$judul', '$isi', '$kategori', '$gambar')");

    if($query){
        header('location:list_berita.php');
    }
}
$query = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
$data = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label>JUDUL</label></td>
                <td>:</td>
                <td><input type="text" name="judul"></td>
            </tr>
            <tr>
                <td><label>KATEGORI</label></td>
                <td>:</td>
                <td>
                    <select name="kategori">
                        <option value="">---PILIH OPTION---</option>
                        <?php do { ?>   
                        <option value="<?=$data['id_kategori'];?>"><?=$data['nama_kategori'];?></option>
                        <?php } while($data = mysqli_fetch_assoc($query)); ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td><label>ISI BERITA</label></td>
                <td>:</td>
                <td><textarea name="isi"></textarea></td>
            </tr>
            <tr>
                <td><lable>GAMBAR</lable></td>
                <td>:</td>
                <td><input type="file" name="gambar"></td>
            </tr>
            <tr>
                <td colspan="3"><input type="submit" name="tambah_berita" value="Tambah"></td>
            </tr>
        </table>
    </form>
</body>
</html>

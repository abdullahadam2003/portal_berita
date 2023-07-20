<?php
// Menginisialisasi koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "berita_kita";

$conn = mysqli_connect($host, $user, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

include "layout/header.php";
if(!$_SESSION['login']){
    header('location:login.php');
}

if(isset($_POST['tambah_admin']) && $_POST['tambah_admin'] == "TAMBAH"){

    $nama=$_POST['nama'];
    $user=$_POST['user'];
    $pass=md5($_POST['pass']);

    $query = mysqli_query($conn, "INSERT into admin (nama_admin, user_admin, pass_admin) VALUES ('$nama', '$user', '$pass')");

    if($query){
        header('location:list_admin.php');
    }
}
?>

<form action="" method="post">
    <fieldset>
        <legend>Informasi Admin</legend>
    <table>
        <tr>
        <td><label for="nama">Nama Admin:</label></td>
        <td><input type="text" id="nama" name="nama" required></td>    
</tr>
<tr>       <td><label for="user">Username:</label></td>
        <td><input type="text" id="user" name="user" required></td>
</tr>
<tr>
        <td><label for="pass">Password:</label></td>
        <td><input type="password" id="pass" name="pass" required></td>
</tr>
    </table>
    </fieldset>

    <input type="submit" name="tambah_admin" value="TAMBAH">
</form>


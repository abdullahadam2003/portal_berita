<?php
include "layout/header.php";

if(!$_SESSION['login']){
    header('location:login.php');
}

$id = $_GET['id'];
if(isset($_POST['simpan_admin']) && $_POST['simpan_admin'] == "SIMPAN"){
    $cond = "";
    $nama = $_POST['nama'];
    $user = $_POST['user'];
    $cond .= "nama_admin = '$nama', user_admin = '$user'";

    if(!empty($_POST['pass'])){
        $pass = MD5($_POST['pass']);
        $cond .= ", pass_admin = '$pass'";
    }

    $query = mysqli_query($conn, "UPDATE admin SET $cond WHERE id_admin = '$id'");

    if($query){
        header('location:list_admin.php');
    }
}

$query = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = '$id'");
$data = mysqli_fetch_assoc($query);
?>

<form action="" method="post">
    <table>
        <tr>
            <td><label for="nama">Nama Admin:</label></td>
            <td><input type="text" name="nama" id="nama" value="<?=$data['nama_admin'];?>" required></td>
        </tr>
        <tr>
            <td><label for="user">Username:</label></td>
            <td><input type="text" name="user" id="user" value="<?=$data['user_admin'];?>" required></td>
        </tr>
        <tr>
            <td><label for="pass">Password:</label></td>
            <td><input type="password" name="pass" id="pass" required></td>
        </tr>
    </table>
    <input type="submit" name="simpan_admin" value="SIMPAN">
</form>


<?php
include "../config/db_connect.php";
$err ='';
if(isset($_POST['login']) && $_POST['login'] == "LOGIN"){

    $name = $_POST['user'];
    $pass = MD5($_POST['pass']);

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE user_admin ='$name' AND pass_admin ='$pass'");
    $data = mysqli_fetch_assoc($query);

    if(mysqli_num_rows($query) > 0){
        session_start();
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['login'] = true;
        header('location:index.php');
        exit; // Menambahkan exit untuk menghentikan eksekusi kode setelah melakukan redirect.
    }else{
        $err = "Username atau password salah !!";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-image:url(../assets/images/background.png)">
    <div class="login-page">
   
<form action="" method="POST">
    <h3><img src="../assets/images/logo.png" width="200px"></h3>
    <input type="text" name="user"><br>
    <input type="password" name="pass"><br>
    <input type="submit" name="login" value="LOGIN">
    <p><?= $err; ?></p>
 </form>
  <br>
</div>

</body>
</html>
 
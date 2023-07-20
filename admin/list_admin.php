<?php
include "layout/header.php";
if(!$_SESSION['login']){
    header('location:login.php');
}

$query = mysqli_query($conn, "SELECT * FROM admin ORDER BY id_admin DESC");
?>

<a class="btn add" href="tambah_admin.php">Tambah Admin</a>

<table border="1">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Admin</th>
            <th>Username</th>
            <th>Password</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $num = 0;
        while ($data = mysqli_fetch_assoc($query)) {
            $num++;
            ?>
            <tr>
                <td><?= $num; ?></td>
                <td><?= $data['nama_admin']; ?></td>
                <td><?= $data['user_admin']; ?></td>
                <td><?= $data['pass_admin']; ?></td>
                <td>
                    <a class="btn edit" href="edit_admin.php?id=<?= $data['id_admin']; ?>">EDIT</a>
                    <a class="btn delete" href="hapus_admin.php?id=<?= $data['id_admin']; ?>">HAPUS</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
session_start();

include '../db/index.php';

if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    if (empty($id)) {
        echo "<script>
                alert('ID user tidak ditemukan!');
                window.location.href = '../admin/users.php';
              </script>";
        exit();
    }

    $query = "DELETE FROM users WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('User berhasil dihapus!');
                window.location.href = '../admin/users.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menghapus user!');
                window.location.href = '../admin/users.php';
              </script>";
        exit();
    }

} else {
    echo "<script>
            alert('Akses tidak valid!');
            window.location.href = '../admin/users.php';
          </cript>";
    exit();
}
?>

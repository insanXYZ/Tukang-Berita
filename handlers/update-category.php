<?php
session_start();

include '../db/index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id       = $_POST['id'];
    $name     = mysqli_real_escape_string($koneksi, trim($_POST['name']));

    if (empty($id) || empty($name)) {
        echo "<script>
                alert('ID, dan nama email harus diisi!');
                window.location.href = '../admin/category.php';
              </script>";
        exit();
    }

    $query = "UPDATE categories 
                SET name = '$name'
                WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data kategori berhasil diupdate!');
                window.location.href = '../admin/category.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal mengupdate data kategori!');
                window.location.href = '../admin/category.php';
              </script>";
        exit();
    }

} else {
    header("Location: ../admin/category.php");
    exit();
}
?>

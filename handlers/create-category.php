<?php
session_start();

include '../db/index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name     = mysqli_real_escape_string($koneksi, trim($_POST['name']));

    if (empty($name)) {
        echo "<script>
                alert('Nama harus diisi!');
                window.location.href = '../admin/category/create.php';
              </script>";
        exit();
    }

    $check_query = "SELECT * FROM categories WHERE name = '$name'";
    $check_result = mysqli_query($koneksi, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Nama kategori sudah terdaftar, gunakan nama lain!');
                window.location.href = '../admin/category/create.php';
              </script>";
        exit();
    }

    $query = "INSERT INTO categories (name) 
              VALUES ('$name')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Nama kategori berhasil ditambahkan!');
                window.location.href = '../admin/category.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menambahkan nama kategori!');
                window.location.href = '../admin/category/create.php';
              </script>";
        exit();
    }

} else {
    header("Location: ../admin/category/create.php");
    exit();
}
?>

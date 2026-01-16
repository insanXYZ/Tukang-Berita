<?php
session_start();

include '../db/index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name     = mysqli_real_escape_string($koneksi, trim($_POST['name']));
    $email    = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $password = $_POST['password'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    if (empty($name) || empty($email) || empty($password)) {
        echo "<script>
                alert('Nama, email, dan password harus diisi!');
                window.location.href = '../admin/user/create.php';
              </script>";
        exit();
    }

    $hashed_password = md5($password);

    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $check_result = mysqli_query($koneksi, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Email sudah terdaftar, gunakan email lain!');
                window.location.href = '../admin/user/create.php';
              </script>";
        exit();
    }

    $query = "INSERT INTO users (name, email, password, is_admin) 
              VALUES ('$name', '$email', '$hashed_password', '$is_admin')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('User berhasil ditambahkan!');
                window.location.href = '../admin/users.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menambahkan user!');
                window.location.href = '../admin/user/create.php';
              </script>";
        exit();
    }

} else {
    header("Location: ../admin/user/create.php");
    exit();
}
?>

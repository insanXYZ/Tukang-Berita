<?php
session_start();

include '../db/index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id       = $_POST['id'];
    $name     = mysqli_real_escape_string($koneksi, trim($_POST['name']));
    $email    = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $password = $_POST['password'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    if (empty($id) || empty($name) || empty($email)) {
        echo "<script>
                alert('ID, nama, dan email harus diisi!');
                window.location.href = '../admin/users.php';
              </script>";
        exit();
    }

    if (!empty($password)) {
        $hashed_password = md5($password);
        $query = "UPDATE users 
                  SET name = '$name',
                      email = '$email',
                      password = '$hashed_password',
                      is_admin = '$is_admin'
                  WHERE id = '$id'";
    } 
    else {
        $query = "UPDATE users 
                  SET name = '$name',
                      email = '$email',
                      is_admin = '$is_admin'
                  WHERE id = '$id'";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data user berhasil diupdate!');
                window.location.href = '../admin/users.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal mengupdate data user!');
                window.location.href = '../admin/users.php';
              </script>";
        exit();
    }

} else {
    header("Location: ../admin/users.php");
    exit();
}
?>

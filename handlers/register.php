<?php
include '../db/index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = mysqli_real_escape_string($koneksi, trim($_POST['name']));
    $email = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $password_input = $_POST['password'];
    
    if (empty($name) || empty($email) || empty($password_input)) {
        echo "<script>
                alert('Semua field harus diisi!');
                window.location.href = '../register.php';
              </script>";
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Format email tidak valid!');
                window.location.href = '../register.php';
              </script>";
        exit();
    }
    
    $check_query = "SELECT id FROM users WHERE email = '$email'";
    $check_result = mysqli_query($koneksi, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Email sudah dipakai! Silakan gunakan email lain.');
                window.location.href = '../register.php';
              </script>";
        exit();
    }
    
    $hashed_password = md5($password_input);
    
    $insert_query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
    
    if (mysqli_query($koneksi, $insert_query)) {
        echo "<script>
                alert('Registrasi berhasil! Silakan login.');
                window.location.href = '../login.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Registrasi gagal! Silakan coba lagi.');
                window.location.href = '../register.php';
              </script>";
        exit();
    }
    
} else {
    header("Location: ../register.php");
    exit();
}
?>
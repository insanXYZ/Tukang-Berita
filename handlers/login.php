<?php
session_start();

include '../db/index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $password_input = $_POST['password'];
    
    if (empty($email) || empty($password_input)) {
        echo "<script>
                alert('Email dan password harus diisi!');
                window.location.href = '../login.php';
              </script>";
        exit();
    }
    
    $hashed_password = md5($password_input);
    
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$hashed_password'";
    $result = mysqli_query($koneksi, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['is_admin'] = $user['is_admin'];
        $_SESSION['is_logged_in'] = true;
        
        echo "<script>
                alert('Login berhasil! Selamat datang " . $user['name'] . "');
                window.location.href = '../index.php';
              </script>";
        exit();
        
    } else {
        echo "<script>
                alert('Email atau password salah!');
                window.location.href = '../login.php';
              </script>";
        exit();
    }
    
} else {
    header("Location: ../login.php");
    exit();
}
?>
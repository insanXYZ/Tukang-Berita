<?php
session_start();
include '../db/index.php';

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] != true) {
    echo "<script>
            alert('Silakan login terlebih dahulu!');
            window.location.href = '../login.php';
          </script>";
    exit();
}

if ($_SESSION['is_admin'] != 1) {
    echo "<script>
            alert('Anda tidak memiliki akses untuk menghapus komentar!');
            window.history.back();
          </script>";
    exit();
}

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID komentar tidak ditemukan!');
            window.history.back();
          </script>";
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$cek = mysqli_query($koneksi, "SELECT * FROM comments WHERE id = '$id'");
if (mysqli_num_rows($cek) == 0) {
    echo "<script>
            alert('Komentar tidak ditemukan!');
            window.history.back();
          </script>";
    exit();
}

// Hapus komentar
$query = "DELETE FROM comments WHERE id = '$id'";
if (mysqli_query($koneksi, $query)) {
    echo "<script>
            alert('Komentar berhasil dihapus!');
            window.location.href = '../admin/history/comment.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('Gagal menghapus komentar!');
            window.history.back();
          </script>";
    exit();
}
?>

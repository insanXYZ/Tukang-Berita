<?php
session_start();
include '../db/index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_SESSION['user_id'])) {
        echo "<script>
                alert('Silakan login terlebih dahulu untuk berkomentar!');
                window.location.href = '../login.php';
              </script>";
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $news_id = mysqli_real_escape_string($koneksi, $_POST['news_id']);
    $comment = mysqli_real_escape_string($koneksi, trim($_POST['comment']));

    if (empty($news_id) || empty($comment)) {
        echo "<script>
                alert('Komentar tidak boleh kosong!');
                window.history.back();
              </script>";
        exit();
    }

    $cekNews = mysqli_query($koneksi, "SELECT id FROM news WHERE id = '$news_id'");
    if (mysqli_num_rows($cekNews) == 0) {
        echo "<script>
                alert('Berita tidak ditemukan!');
                window.history.back();
              </script>";
        exit();
    }

    // Insert komentar
    $query = "INSERT INTO comments (user_id, news_id, comment) 
              VALUES ('$user_id', '$news_id', '$comment')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Komentar berhasil ditambahkan!');
                window.location.href = '../news.php?id=$news_id';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menambahkan komentar!');
                window.history.back();
              </script>";
        exit();
    }

} else {
    header("Location: ../index.php");
    exit();
}
?>

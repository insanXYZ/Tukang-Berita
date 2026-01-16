<?php
session_start();
include '../db/index.php';

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID berita tidak ditemukan!');
            window.location.href = '../admin/news.php';
          </script>";
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$query = "SELECT thumbnail FROM news WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('Berita tidak ditemukan!');
            window.location.href = '../admin/news.php';
          </script>";
    exit();
}

$news = mysqli_fetch_assoc($result);
$thumbnail = $news['thumbnail'];

$path = "../uploads/" . $thumbnail;
if (file_exists($path)) {
    unlink($path);
}

$delete = mysqli_query($koneksi, "DELETE FROM news WHERE id = '$id'");

if ($delete) {
    echo "<script>
            alert('Berita berhasil dihapus!');
            window.location.href = '../admin/news.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('Gagal menghapus berita!');
            window.location.href = '../admin/news.php';
          </script>";
    exit();
}
?>

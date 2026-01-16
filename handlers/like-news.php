<?php
session_start();
include '../db/index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_SESSION['user_id'])) {
        echo "<script>
                alert('Silakan login terlebih dahulu untuk menyukai berita!');
                window.location.href = '../login.php';
              </script>";
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $news_id = mysqli_real_escape_string($koneksi, $_POST['news_id']);

    if (empty($news_id)) {
        echo "<script>
                alert('ID berita tidak valid!');
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

    // Cek apakah user sudah like berita ini
    $cekLike = mysqli_query(
        $koneksi,
        "SELECT id FROM likes WHERE user_id = '$user_id' AND news_id = '$news_id'"
    );

    if (mysqli_num_rows($cekLike) > 0) {
        mysqli_query(
            $koneksi,
            "DELETE FROM likes WHERE user_id = '$user_id' AND news_id = '$news_id'"
        );

        echo "<script>
                alert('Suka dibatalkan!');
                window.location.href = '../news.php?id=$news_id';
              </script>";
        exit();
    } else {
        $query = "INSERT INTO likes (user_id, news_id) 
                  VALUES ('$user_id', '$news_id')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>
                    alert('Berita berhasil disukai!');
                    window.location.href = '../news.php?id=$news_id';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Gagal menyukai berita!');
                    window.history.back();
                  </script>";
            exit();
        }
    }

} else {
    header("Location: ../index.php");
    exit();
}
?>

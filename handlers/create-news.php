<?php
session_start();
include '../db/index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title       = mysqli_real_escape_string($koneksi, trim($_POST['title']));
    $category_id = mysqli_real_escape_string($koneksi, trim($_POST['category_id']));
    $content     = mysqli_real_escape_string($koneksi, trim($_POST['content']));

    if (empty($title) || empty($category_id) || empty($content)) {
        echo "<script>
                alert('Semua field wajib diisi!');
                window.location.href = '../admin/news/create.php';
              </script>";
        exit();
    }

    $cek_category = mysqli_query($koneksi, "SELECT id FROM categories WHERE id = '$category_id'");
    if (mysqli_num_rows($cek_category) == 0) {
        echo "<script>
                alert('Kategori tidak ditemukan!');
                window.location.href = '../admin/news/create.php';
              </script>";
        exit();
    }

    if (!isset($_FILES['thumbnail']) || $_FILES['thumbnail']['error'] != 0) {
        echo "<script>
                alert('Thumbnail wajib diupload!');
                window.location.href = '../admin/news/create.php';
              </script>";
        exit();
    }

    $file_name = $_FILES['thumbnail']['name'];
    $file_tmp  = $_FILES['thumbnail']['tmp_name'];
    $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $file_base = pathinfo($file_name, PATHINFO_FILENAME);

    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    if (!in_array($file_ext, $allowed)) {
        echo "<script>
                alert('Format gambar harus JPG, JPEG, PNG, atau WEBP!');
                window.location.href = '../admin/news/create.php';
              </script>";
        exit();
    }

    $time_now  = time();
    $new_name  = $file_base . "_" . $time_now . "." . $file_ext;
    $upload_dir = "../uploads/";
    $upload_path = $upload_dir . $new_name;

    // Upload gambar dulu
    if (!move_uploaded_file($file_tmp, $upload_path)) {
        echo "<script>
                alert('Upload gambar gagal!');
                window.location.href = '../admin/news/create.php';
              </script>";
        exit();
    }

    // Insert ke database
    $query = "INSERT INTO news (title, category_id, thumbnail, content)
              VALUES ('$title', '$category_id', '$new_name', '$content')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Berita berhasil ditambahkan!');
                window.location.href = '../admin/news.php';
              </script>";
        exit();
    } else {
        unlink($upload_path);

        echo "<script>
                alert('Gagal menyimpan berita!');
                window.location.href = '../admin/news/create.php';
              </script>";
        exit();
    }

} else {
    header("Location: ../admin/news/create.php");
    exit();
}
?>

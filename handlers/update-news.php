<?php
session_start();
include '../db/index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id          = mysqli_real_escape_string($koneksi, $_POST['id']);
    $title       = mysqli_real_escape_string($koneksi, trim($_POST['title']));
    $category_id = mysqli_real_escape_string($koneksi, trim($_POST['category_id']));
    $content     = mysqli_real_escape_string($koneksi, trim($_POST['content']));

    if (empty($id) || empty($title) || empty($category_id) || empty($content)) {
        echo "<script>
                alert('Semua field wajib diisi!');
                window.location.href = '../admin/news/edit.php?id=$id';
              </script>";
        exit();
    }

    $cek_category = mysqli_query($koneksi, "SELECT id FROM categories WHERE id = '$category_id'");
    if (mysqli_num_rows($cek_category) == 0) {
        echo "<script>
                alert('Kategori tidak ditemukan!');
                window.location.href = '../admin/news/edit.php?id=$id';
              </script>";
        exit();
    }

    $old_data = mysqli_query($koneksi, "SELECT thumbnail FROM news WHERE id = '$id'");
    if (mysqli_num_rows($old_data) == 0) {
        echo "<script>
                alert('Data berita tidak ditemukan!');
                window.location.href = '../admin/news/index.php';
              </script>";
        exit();
    }

    $old_news = mysqli_fetch_assoc($old_data);
    $old_thumbnail = $old_news['thumbnail'];

    $thumbnail_name = $old_thumbnail;

    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {

        $file_name = $_FILES['thumbnail']['name'];
        $file_tmp  = $_FILES['thumbnail']['tmp_name'];
        $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $file_base = pathinfo($file_name, PATHINFO_FILENAME);

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($file_ext, $allowed)) {
            echo "<script>
                    alert('Format gambar harus JPG, JPEG, PNG, atau WEBP!');
                    window.location.href = '../admin/news/edit.php?id=$id';
                  </script>";
            exit();
        }

        // Nama file baru: namafile_waktusekarang.ext
        $time_now  = time();
        $new_name  = $file_base . "_" . $time_now . "." . $file_ext;
        $upload_dir = "../uploads/";
        $upload_path = $upload_dir . $new_name;

        if (!move_uploaded_file($file_tmp, $upload_path)) {
            echo "<script>
                    alert('Upload gambar baru gagal!');
                    window.location.href = '../admin/news/edit.php?id=$id';
                  </script>";
            exit();
        }

        if (!empty($old_thumbnail) && file_exists($upload_dir . $old_thumbnail)) {
            unlink($upload_dir . $old_thumbnail);
        }

        $thumbnail_name = $new_name;
    }

    $query = "UPDATE news SET 
                title = '$title',
                category_id = '$category_id',
                thumbnail = '$thumbnail_name',
                content = '$content'
              WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Berita berhasil diperbarui!');
                window.location.href = '../admin/news.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal memperbarui berita!');
                window.location.href = '../admin/news/edit.php?id=$id';
              </script>";
        exit();
    }

} else {
    header("Location: ../admin/news/index.php");
    exit();
}
?>

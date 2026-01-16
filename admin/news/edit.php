<?php
include("../../layouts/header-admin.php");
include "../../db/index.php";

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID berita tidak ditemukan!');
            window.location.href = '../news.php';
          </script>";
    exit();
}

$id = $_GET['id'];

$query = "SELECT n.id, n.title, n.content, n.thumbnail, n.category_id, c.name FROM news n JOIN categories c ON c.id = n.category_id WHERE n.id = '$id'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>
    alert('Berita tidak ditemukan!');
            window.location.href = '../news.php';
            </script>";
    exit();
}

$news = mysqli_fetch_assoc($result);
$query = "SELECT * FROM categories";
$resultCategories = mysqli_query($koneksi, $query);
?>

<main class="app-main">
    <div class="app-content mt-5">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">Edit Berita</div>
                </div>
                <form method="post" action="../../handlers/update-news.php" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $news['id']; ?>" name="id" />
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" accept="image/*" id="thumbnail" name="thumbnail" />
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" value="<?= $news['title']; ?>" class="form-control" id="title"
                                name="title" />
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="category_id" required>
                                <option selected value="<?= $news['category_id']; ?>"><?= $news['name'] ?>
                                </option>
                                <?php
                                while ($row = mysqli_fetch_assoc($resultCategories)) {
                                    ?>
                                    <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                            <label for="konten" class="form-label">Konten</label>
                            <textarea class="form-control" id="content" name="content"
                                aria-label="With textarea"><?= $news['content']; ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="../news.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include("../../layouts/footer-admin.php"); ?>
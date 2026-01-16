<?php
include("../../layouts/header-admin.php");
include "../../db/index.php";

$query = "SELECT * FROM categories";
$result = mysqli_query($koneksi, $query);
?>
<main class="app-main">
    <div class="app-content mt-5">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">Tambah Berita</div>
                </div>
                <form method="post" action="../../handlers/create-news.php" enctype="multipart/form-data">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" accept="image/*" id="thumbnail" name="thumbnail" />
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="title"
                                name="title" />
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="category_id" required>
                                <option selected disabled value="">Pilih...</option>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                            <label for="konten" class="form-label">Konten</label>
                            <textarea class="form-control" id="content" name="content" aria-label="With textarea"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include("../../layouts/footer-admin.php"); ?>
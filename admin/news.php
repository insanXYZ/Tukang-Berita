<?php include("../layouts/header-admin.php"); ?>
<?php
include '../db/index.php';
$query = "SELECT n.id, n.thumbnail, n.title,n.views, n.created_at ,c.name FROM news n JOIN categories c ON n.category_id = c.id ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);
?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Berita</h3>
                </div>
                <div class="col-sm-6">
                    <ol class=" float-sm-end">
                        <a href="news/create.php" class="btn btn-primary">Tambah Berita</a>
                    </ol>
                </div>
            </div>

        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Thumbnail</th>
                        <th>Judul Berita</th>
                        <th>Kategori</th>
                        <th>Jumlah Pengunjung</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><img src="../uploads/<?= htmlspecialchars($row['thumbnail']); ?>" width="100px"></td>
                            <td><?= htmlspecialchars($row['title']); ?></td>
                            <td><span class="badge bg-success"><?= htmlspecialchars($row['name']); ?></span></td>
                            <td><?= $row['views']; ?></td>
                            <td><?= $row['created_at']; ?></td>
                            <td>
                                <a href="news/edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                <a href="../handlers/delete-news.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus berita ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</main>

<?php include("../layouts/footer-admin.php"); ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        new DataTable('#example');
    });
</script>
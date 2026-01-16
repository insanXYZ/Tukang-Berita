<?php include("../layouts/header-admin.php"); ?>
<?php
include '../db/index.php';
$query = "SELECT * FROM categories ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);
?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Kategori Berita</h3>
                </div>
                <div class="col-sm-6">
                    <ol class=" float-sm-end">
                        <a href="category/create.php" class="btn btn-primary">Tambah Kategori</a>
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
                        <th>Nama</th>
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
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= $row['created_at']; ?></td>
                            <td>
                                <a href="category/edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                <a href="../handlers/delete-category.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus user ini?')">
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
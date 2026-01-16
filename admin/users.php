<?php include("../layouts/header-admin.php"); ?>
<?php
include '../db/index.php';
$query = "SELECT * FROM users ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);
?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Pengguna</h3>
                </div>
                <div class="col-sm-6">
                    <ol class=" float-sm-end">
                        <a href="user/create.php" class="btn btn-primary">Tambah Pengguna</a>
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
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $role = $row['is_admin'] == 1 ? 'Admin' : 'User';
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td>
                                <?php if ($row['is_admin'] == 1): ?>
                                    <span class="badge bg-success">Admin</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">User</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $row['created_at']; ?></td>
                            <td>
                                <a href="user/edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                <a href="../handlers/delete-user.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
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
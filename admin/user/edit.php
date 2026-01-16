<?php 
include("../../layouts/header-admin.php");
include "../../db/index.php";

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID user tidak ditemukan!');
            window.location.href = '../users.php';
          </script>";
    exit();
}

$id = $_GET['id'];

$query = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('User tidak ditemukan!');
            window.location.href = '../users.php';
          </script>";
    exit();
}

$user = mysqli_fetch_assoc($result);
?>

<main class="app-main">
    <div class="app-content mt-5">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">Edit Pengguna</div>
                </div>
                <form method="post" action="../../handlers/update-user.php">
                    <input type="hidden" name="id" value="<?= $user['id']; ?>">

                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="name"
                                name="name"
                                value="<?= htmlspecialchars($user['name']); ?>"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="email"
                                name="email"
                                value="<?= htmlspecialchars($user['email']); ?>"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password <small>(kosongkan jika tidak ingin diubah)</small>
                            </label>
                            <input 
                                type="password" 
                                class="form-control" 
                                name="password" 
                                id="password"
                            />
                        </div>

                        <div class="mb-3 form-check">
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                name="is_admin" 
                                id="is_admin"
                                <?= ($user['is_admin'] == 1) ? 'checked' : ''; ?>
                            />
                            <label class="form-check-label" for="is_admin">Admin</label>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="../users.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include("../../layouts/footer-admin.php"); ?>

<?php 
include("../../layouts/header-admin.php");
include "../../db/index.php";

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID kaategori tidak ditemukan!');
            window.location.href = '../users.php';
          </script>";
    exit();
}

$id = $_GET['id'];

// Ambil data user
$query = "SELECT * FROM categories WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('Kategori tidak ditemukan!');
            window.location.href = '../category.php';
          </script>";
    exit();
}

$category = mysqli_fetch_assoc($result);
?>

<main class="app-main">
    <div class="app-content mt-5">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">Edit Kategori</div>
                </div>
                <form method="post" action="../../handlers/update-category.php">
                    <input type="hidden" name="id" value="<?= $category['id']; ?>">

                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="name"
                                name="name"
                                value="<?= htmlspecialchars($category['name']); ?>"
                                required
                            />
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="../category.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include("../../layouts/footer-admin.php"); ?>

<?php include("../../layouts/header-admin.php"); ?>
<?php
include '../../db/index.php';
$query = "
SELECT 
    comments.id,
    comments.comment,
    comments.created_at,
    users.name AS user_name,
    news.title,
    news.thumbnail
FROM comments
JOIN users ON users.id = comments.user_id
JOIN news ON news.id = comments.news_id
ORDER BY comments.id DESC
";
$result = mysqli_query($koneksi, $query);
?>
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Riwayat Komentar</h3>
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
            <th>Nama Pengguna</th>
            <th>Komentar</th>
            <th>Tanggal</th>
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

              <td>
                <img src="../../uploads/<?= htmlspecialchars($row['thumbnail']); ?>" width="80" class="rounded">
              </td>

              <td><?= htmlspecialchars($row['title']); ?></td>

              <td>
                <span class="badge bg-success">
                  <?= htmlspecialchars($row['user_name']); ?>
                </span>
              </td>

              <td><?= htmlspecialchars($row['comment']); ?></td>

              <td><?= date('d-m-Y H:i', strtotime($row['created_at'])); ?></td>

              <td>
                <a href="../../handlers/delete-comment.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                  onclick="return confirm('Yakin ingin menghapus komentar ini?')">
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

<?php include("../../layouts/footer-admin.php"); ?>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    new DataTable('#example');
  });
</script>
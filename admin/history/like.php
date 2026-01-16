<?php include("../../layouts/header-admin.php"); ?>
<?php
include '../../db/index.php';
$query = "
SELECT 
    l.id,
    l.created_at,
    u.name AS user_name,
    n.title,
    n.thumbnail
FROM likes l
JOIN users u ON u.id = l.user_id
JOIN news n ON n.id = l.news_id
ORDER BY l.id DESC
";
$result = mysqli_query($koneksi, $query);
?>
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Riwayat Suka</h3>
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
            <th>Tanggal</th>
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
                  <?= htmlspecialchars($row['user_name']); ?>
              </td>


              <td><?= date('d-m-Y H:i', strtotime($row['created_at'])); ?></td>
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
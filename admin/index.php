<?php 
include("../layouts/header-admin.php"); 
include("../db/index.php");

// Statistik
$newsCount    = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) AS total FROM news"));
$likeCount    = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) AS total FROM likes"));
$userCount    = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) AS total FROM users"));
$commentCount = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) AS total FROM comments"));

// Berita terbaru
$latestNews = mysqli_query($koneksi,"
  SELECT id,title,created_at 
  FROM news 
  ORDER BY created_at DESC 
  LIMIT 5
");

// Berita paling banyak like
$topLiked = mysqli_query($koneksi,"
  SELECT n.title, COUNT(l.id) AS total_like
  FROM news n
  LEFT JOIN likes l ON n.id = l.news_id
  GROUP BY n.id
  ORDER BY total_like DESC
  LIMIT 5
");

// Trending (berdasarkan views)
$trending = mysqli_query($koneksi,"
  SELECT title, views 
  FROM news 
  ORDER BY views DESC 
  LIMIT 5
");
?>

<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Dashboard Admin</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">

      <!-- BOX STATISTIK -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-primary">
            <div class="inner">
              <h3><?= $newsCount['total']; ?></h3>
              <p>Total Berita</p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-success">
            <div class="inner">
              <h3><?= $likeCount['total']; ?></h3>
              <p>Total Like</p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-warning">
            <div class="inner">
              <h3><?= $userCount['total']; ?></h3>
              <p>Total User</p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-danger">
            <div class="inner">
              <h3><?= $commentCount['total']; ?></h3>
              <p>Total Komentar</p>
            </div>
          </div>
        </div>
      </div>

      <!-- KONTEN -->
      <div class="row">

        <!-- KIRI -->
        <div class="col-lg-7">
          <!-- BERITA TERBARU -->
          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Berita Terbaru</h3>
            </div>
            <div class="card-body">
              <ul class="list-group">
                <?php while($n = mysqli_fetch_assoc($latestNews)): ?>
                <li class="list-group-item">
                  <?= $n['title']; ?>
                  <small class="text-muted float-end"><?= date("d M Y", strtotime($n['created_at'])); ?></small>
                </li>
                <?php endwhile; ?>
              </ul>
            </div>
          </div>

          <!-- BERITA PALING BANYAK LIKE -->
          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Berita Paling Banyak Disukai</h3>
            </div>
            <div class="card-body">
              <ul class="list-group">
                <?php while($l = mysqli_fetch_assoc($topLiked)): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <?= $l['title']; ?>
                  <span class="badge bg-success">
                    <i class="fas fa-thumbs-up"></i> <?= $l['total_like']; ?>
                  </span>
                </li>
                <?php endwhile; ?>
              </ul>
            </div>
          </div>
        </div>

        <!-- KANAN -->
        <div class="col-lg-5">
          <!-- TRENDING NEWS -->
          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Trending News</h3>
            </div>
            <div class="card-body">
              <ul class="list-group">
                <?php while($t = mysqli_fetch_assoc($trending)): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <?= $t['title']; ?>
                  <span class="badge bg-danger">
                    <i class="far fa-eye"></i> <?= $t['views']; ?>
                  </span>
                </li>
                <?php endwhile; ?>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</main>

<?php include("../layouts/footer-admin.php"); ?>

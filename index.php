<?php
session_start();
include 'db/index.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$isSearch = ($q != '');

$q_safe = mysqli_real_escape_string($koneksi, $q);

if (!$isSearch) {

    $headline = mysqli_query($koneksi, "
        SELECT n.*, c.name AS category_name 
        FROM news n 
        JOIN categories c ON c.id = n.category_id 
        ORDER BY n.created_at DESC 
        LIMIT 1
    ");
    $headlineNews = mysqli_fetch_assoc($headline);

    $latest = mysqli_query($koneksi, "
        SELECT n.*, c.name AS category_name 
        FROM news n 
        JOIN categories c ON c.id = n.category_id 
        ORDER BY n.created_at DESC 
        LIMIT 1,4
    ");

    $others = mysqli_query($koneksi, "
        SELECT n.*, c.name AS category_name 
        FROM news n 
        JOIN categories c ON c.id = n.category_id 
        ORDER BY n.created_at DESC 
        LIMIT 5,6
    ");
}

if ($isSearch) {
    $searchResult = mysqli_query($koneksi, "
        SELECT n.*, c.name AS category_name
        FROM news n
        JOIN categories c ON c.id = n.category_id
        WHERE n.title LIKE '%$q_safe%'
        ORDER BY n.created_at DESC
    ");
}

$trending = mysqli_query($koneksi, "
    SELECT n.*, c.name AS category_name 
    FROM news n 
    JOIN categories c ON c.id = n.category_id 
    ORDER BY n.views DESC 
    LIMIT 5
");
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Berita Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #c82333;
            --secondary-color: #2c3e50;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar-custom {
            background-color: var(--secondary-color);
        }

        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 8px 15px;
            margin: 0 5px;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .navbar-custom .nav-link.active {
            background-color: var(--primary-color);
            color: white !important;
        }

        .category-nav {
            background-color: var(--secondary-color);
            padding: 10px 0;
        }

        .category-nav a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            margin: 0 5px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }


        .headline-card {
            position: relative;
            height: 400px;
            overflow: hidden;
            border-radius: 8px;
        }

        .headline-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .headline-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: white;
            padding: 20px;
        }

        .news-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }

        .news-card img {
            height: 200px;
            object-fit: cover;
        }

        .badge-category {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1;
        }

        .sidebar-widget {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .trending-item {
            border-bottom: 1px solid #dee2e6;
            padding: 10px 0;
        }

        .trending-item:last-child {
            border-bottom: none;
        }

        footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 30px 0;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <!-- Logo di kiri -->
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-newspaper"></i> Tukang Berita
            </a>

            <!-- Button toggle untuk mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Semua yang kanan -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="d-flex ms-auto align-items-center">

                    <form class="d-flex me-3" method="GET" action="index.php">
                        <input class="form-control me-2" type="search" name="q" placeholder="Cari berita..."
                            aria-label="Search" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <!-- User / Login -->
                    <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true): ?>
                        <div class="dropdown">
                            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownUser"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> <?= $_SESSION['user_name']; ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                <?php if ($_SESSION['is_admin'] == 1): ?>
                                    <li>
                                        <a class="dropdown-item" href="admin/index.php">
                                            <i class="fas fa-cog"></i> Dashboard Admin
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="handlers/logout.php">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-danger">
                            <i class="fas fa-user"></i> Login
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-8">

                <?php if ($isSearch): ?>
                    <h4 class="mb-3 border-bottom pb-2">
                        <i class="fas fa-search"></i> Berita yang kamu cari:
                        <span class="text-danger"><?= htmlspecialchars($q); ?></span>
                    </h4>

                    <div class="list-group">
                        <?php if (mysqli_num_rows($searchResult) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($searchResult)): ?>
                                <a href="news.php?id=<?= $row['id']; ?>" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 align-items-center">
                                        <img src="uploads/<?= $row['thumbnail']; ?>" class="me-3 rounded"
                                            style="width:100px;height:80px;object-fit:cover;">
                                        <div class="flex-grow-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1"><?= htmlspecialchars($row['title']); ?></h6>
                                                <small class="text-muted">
                                                    <i class="far fa-clock"></i>
                                                    <?= date('d M Y', strtotime($row['created_at'])); ?>
                                                </small>
                                            </div>
                                            <p class="mb-1 text-muted">
                                                <?= substr(strip_tags($row['content']), 0, 120); ?>...
                                            </p>
                                            <small>
                                                <span class="badge bg-secondary">
                                                    <?= htmlspecialchars($row['category_name']); ?>
                                                </span>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                Tidak ada berita yang ditemukan dengan kata kunci
                                "<strong><?= htmlspecialchars($q); ?></strong>"
                            </div>
                        <?php endif; ?>
                    </div>

                <?php else: ?>
                    <div class="headline-card mb-4">
                        <span class="badge bg-danger badge-category">
                            <?= htmlspecialchars($headlineNews['category_name']); ?>
                        </span>
                        <img src="uploads/<?= $headlineNews['thumbnail']; ?>"
                            alt="<?= htmlspecialchars($headlineNews['title']); ?>">
                        <div class="headline-overlay">
                            <h2><?= htmlspecialchars($headlineNews['title']); ?></h2>
                            <p>
                                <i class="far fa-clock"></i>
                                <?= date('d M Y H:i', strtotime($headlineNews['created_at'])); ?>
                            </p>
                            <a href="news.php?id=<?= $headlineNews['id']; ?>" class="btn btn-sm btn-danger">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>

                    <h4 class="mb-3 border-bottom pb-2">
                        <i class="fas fa-bolt"></i> Berita Terkini
                    </h4>
                    <div class="row">
                        <?php while ($row = mysqli_fetch_assoc($latest)): ?>
                            <div class="col-md-6">
                                <div class="card news-card">
                                    <div style="position: relative;">
                                        <span class="badge bg-primary badge-category">
                                            <?= htmlspecialchars($row['category_name']); ?>
                                        </span>
                                        <img src="uploads/<?= $row['thumbnail']; ?>" class="card-img-top"
                                            alt="<?= htmlspecialchars($row['title']); ?>">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($row['title']); ?></h5>
                                        <p class="card-text text-muted">
                                            <?= substr(strip_tags($row['content']), 0, 40); ?>...
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="far fa-clock"></i>
                                                <?= date('d M Y', strtotime($row['created_at'])); ?>
                                            </small>
                                            <a href="news.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger">
                                                Baca Selengkapnya
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <h4 class="mb-3 mt-4 border-bottom pb-2">
                        <i class="fas fa-list"></i> Berita Lainnya
                    </h4>
                    <div class="list-group">
                        <?php while ($row = mysqli_fetch_assoc($others)): ?>
                            <a href="news.php?id=<?= $row['id']; ?>" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 align-items-center">
                                    <img src="uploads/<?= $row['thumbnail']; ?>" class="me-3 rounded"
                                        style="width:100px;height:80px;object-fit:cover;">
                                    <div class="flex-grow-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1"><?= htmlspecialchars($row['title']); ?></h6>
                                            <small class="text-muted">
                                                <i class="far fa-clock"></i>
                                                <?= date('d M Y', strtotime($row['created_at'])); ?>
                                            </small>
                                        </div>
                                        <p class="mb-1 text-muted">
                                            <?= substr(strip_tags($row['content']), 0, 80); ?>...
                                        </p>
                                        <small>
                                            <span class="badge bg-secondary">
                                                <?= htmlspecialchars($row['category_name']); ?>
                                            </span>
                                        </small>
                                    </div>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    </div>

                <?php endif; ?>

            </div>


            <div class="col-lg-4">
                <div class="sidebar-widget">
                    <h5 class="mb-3"><i class="fas fa-fire text-danger"></i> Berita Trending</h5>
                    <?php while ($row = mysqli_fetch_assoc($trending)): ?>
                        <div class="trending-item">
                            <h6>
                                <a href="news.php?id=<?= $row['id']; ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($row['title']); ?>
                                </a>
                            </h6>
                            <small class="text-muted">
                                <i class="far fa-eye"></i> <?= number_format($row['views']); ?> views
                            </small>
                        </div>
                    <?php endwhile; ?>
                </div>


            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-newspaper"></i> Tukang Berita</h5>
                    <p>Portal berita terpercaya untuk informasi terkini dan akurat.</p>
                </div>

            </div>
            <hr class="bg-light">
            <div class="text-center">
                <p>&copy; 2026 Tukang Berita. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
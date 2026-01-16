<?php
session_start();

include 'db/index.php';

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID berita tidak ada!');
            window.location.href = 'index.php';
          </script>";
    exit();
}

$id = $_GET["id"];

$query = "SELECT n.* , c.name  FROM news n JOIN categories c on n.category_id = c.id WHERE n.id = $id";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Berita tidak ditemukan!'); window.location.href='index.php';</script>";
    exit();
}

$berita = mysqli_fetch_assoc($result);

$update_views = "UPDATE news SET views = views + 1 WHERE id = $id";
mysqli_query($koneksi, $update_views);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $berita['title']; ?> - Portal Berita Indonesia</title>
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

        .navbar-custom .nav-link:hover {
            background-color: var(--primary-color);
            color: white !important;
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

        .category-nav a:hover {
            background-color: var(--primary-color);
        }

        .article-header {
            margin-bottom: 30px;
        }

        .article-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .article-meta {
            color: #6c757d;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #dee2e6;
        }

        .article-meta span {
            margin-right: 20px;
        }

        .article-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
            text-align: justify;
        }

        .article-content p {
            margin-bottom: 20px;
        }

        .share-buttons {
            margin: 30px 0;
            padding: 20px 0;
            border-top: 2px solid #dee2e6;
            border-bottom: 2px solid #dee2e6;
        }

        .sidebar-widget {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .related-news-item {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
        }

        .related-news-item:last-child {
            border-bottom: none;
        }

        .related-news-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 15px;
        }

        .related-news-item h6 {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 30px 0;
            margin-top: 50px;
        }

        .like-button {
            cursor: pointer;
            transition: all 0.3s;
        }

        .like-button:hover {
            transform: scale(1.1);
        }

        .like-button.liked {
            color: #c82333;
        }

        .comment-section {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            margin-top: 30px;
        }

        .comment-item {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 3px solid var(--primary-color);
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .comment-author {
            font-weight: bold;
            color: var(--secondary-color);
        }

        .comment-date {
            color: #6c757d;
            font-size: 0.85rem;
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
    </nav> <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Article Content -->
            <div class="col-lg-8">

                <!-- Article Header -->
                <div class="article-header">
                    <span class="badge bg-danger mb-2"><?= $berita['name']; ?></span>
                    <h1 class="article-title"><?= $berita['title']; ?></h1>
                    <div class="article-meta">
                        <span><i class="far fa-clock"></i> <?= date('d F Y, H:i', strtotime($berita['created_at'])); ?>
                            WIB</span>
                        <span><i class="far fa-eye"></i> <?= number_format($berita['views']); ?> views</span>
                    </div>
                </div>

                <!-- Article Image -->
                <img src="uploads/<?= $berita['thumbnail']; ?>" alt="<?= $berita['title']; ?>" class="article-image">

                <!-- Article Content -->
                <div class="article-content">
                    <?= nl2br($berita['content']); ?>
                </div>

                <!-- Like Button -->
                <div class="my-4">
                    <?php
                    // Cek apakah user sudah like berita ini
                    $user_liked = false;
                    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) {
                        $check_like = "SELECT * FROM likes WHERE news_id = $id AND user_id = " . $_SESSION['user_id'];
                        $like_result = mysqli_query($koneksi, $check_like);
                        $user_liked = mysqli_num_rows($like_result) > 0;
                    }

                    // Hitung total likes
                    $count_likes = "SELECT COUNT(*) as total FROM likes WHERE news_id = $id";
                    $count_result = mysqli_query($koneksi, $count_likes);
                    $total_likes = mysqli_fetch_assoc($count_result)['total'];
                    ?>

                    <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true): ?>
                        <form method="post" action="handlers/like-news.php">
                            <input type="hidden" name="news_id" value="<?= $id ?>">
                            <button class="btn btn-outline-danger like-button <?= $user_liked ? 'liked' : ''; ?>">
                                <i class="<?= $user_liked ? 'fas' : 'far'; ?> fa-heart"></i>
                                <span id="likeCount"><?= $total_likes; ?></span> Suka
                            </button>
                        </form>
                    <?php else: ?>
                        <button class="btn btn-outline-secondary"
                            onclick="alert('Silakan login terlebih dahulu untuk menyukai berita ini!'); window.location.href='login.php';">
                            <i class="far fa-heart"></i> <span><?= $total_likes; ?></span> Suka
                        </button>
                    <?php endif; ?>
                </div>

                <!-- Tags -->
                <?php if (!empty($berita['tags'])): ?>
                    <div class="mb-4">
                        <h5 class="mb-3">Tags:</h5>
                        <?php
                        $tags = explode(',', $berita['tags']);
                        foreach ($tags as $tag):
                            ?>
                            <a href="tag.php?tag=<?= trim($tag); ?>" class="badge bg-secondary text-decoration-none me-1 mb-1"
                                style="font-size: 0.9rem;">
                                <?= trim($tag); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Comments Section -->
                <div class="comment-section">
                    <h4 class="mb-4"><i class="fas fa-comments"></i> Komentar (<?php
                    $count_comments = "SELECT COUNT(*) as total FROM comments WHERE news_id = $id";
                    $comment_count = mysqli_query($koneksi, $count_comments);
                    echo mysqli_fetch_assoc($comment_count)['total'];
                    ?>)</h4>

                    <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true): ?>
                        <form action="handlers/comment-news.php" method="POST" class="mb-4">
                            <input type="hidden" name="news_id" value="<?= $id; ?>">
                            <div class="mb-3">
                                <textarea class="form-control" name="comment" rows="3" placeholder="Tulis komentar Anda..."
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-paper-plane"></i> Kirim Komentar
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle"></i> Anda harus <a href="login.php" class="alert-link">login</a>
                            terlebih dahulu untuk dapat memberikan komentar.
                        </div>
                    <?php endif; ?>

                    <!-- Daftar Komentar -->
                    <?php
                    $comments_query = "SELECT c.*, u.name as user_name 
                                      FROM comments c 
                                      JOIN users u ON c.user_id = u.id 
                                      WHERE c.news_id = $id 
                                      ORDER BY c.created_at DESC";
                    $comments_result = mysqli_query($koneksi, $comments_query);

                    if (mysqli_num_rows($comments_result) > 0):
                        while ($comment = mysqli_fetch_assoc($comments_result)):
                            ?>
                            <div class="comment-item">
                                <div class="comment-header">
                                    <div>
                                        <span class="comment-author">
                                            <i class="fas fa-user-circle"></i> <?= $comment['user_name']; ?>
                                        </span>
                                    </div>
                                    <span class="comment-date">
                                        <i class="far fa-clock"></i>
                                        <?= date('d M Y, H:i', strtotime($comment['created_at'])); ?>
                                    </span>
                                </div>
                                <p class="mb-0"><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>
                            </div>
                        <?php
                        endwhile;
                    else:
                        ?>
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-comment-slash fa-3x mb-3"></i>
                            <p>Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Related News -->
                <div class="sidebar-widget">
                    <h5 class="mb-3"><i class="fas fa-newspaper"></i> Berita Terkait</h5>

                    <?php
                    // Query berita terkait berdasarkan kategori yang sama
                    $related_query = "SELECT * FROM news WHERE category_id = '" . $berita['category_id'] . "' AND id != $id ORDER BY created_at DESC LIMIT 5";
                    $related_result = mysqli_query($koneksi, $related_query);

                    while ($related = mysqli_fetch_assoc($related_result)):
                        ?>
                        <div class="related-news-item">
                            <img src="uploads/<?= $related['thumbnail']; ?>" alt="<?= $related['title']; ?>">
                            <div>
                                <h6><a href="news.php?id=<?= $related['id']; ?>"
                                        class="text-decoration-none text-dark"><?= substr($related['title'], 0, 60); ?>...</a>
                                </h6>
                                <small class="text-muted"><i class="far fa-clock"></i>
                                    <?= date('d M Y', strtotime($related['created_at'])); ?></small>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="sidebar-widget">
                    <h5 class="mb-3"><i class="fas fa-fire text-danger"></i> Berita Populer</h5>

                    <?php
                    $popular_query = "SELECT * FROM news ORDER BY views DESC LIMIT 5";
                    $popular_result = mysqli_query($koneksi, $popular_query);

                    while ($popular = mysqli_fetch_assoc($popular_result)):
                        ?>
                        <div class="related-news-item">
                            <img src="uploads/<?= $popular['thumbnail']; ?>" alt="<?= $popular['title']; ?>">
                            <div>
                                <h6><a href="news.php?id=<?= $popular['id']; ?>"
                                        class="text-decoration-none text-dark"><?= substr($popular['title'], 0, 60); ?>...</a>
                                </h6>
                                <small class="text-muted"><i class="far fa-eye"></i>
                                    <?= number_format($popular['views']); ?> views</small>
                            </div>
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
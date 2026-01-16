<?php
session_start();

if (!isset($_SESSION['is_admin']) OR !$_SESSION["is_admin"]) {
  echo "<script>
      alert('Dilarang masuk!');
      window.location.href = '/Tukang-Berita/';
      </script>";
  exit();
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Tukang Berita</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <meta name="color-scheme" content="light dark" />
  <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
  <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
  <meta name="title" content="Tukang Berita" />
  <meta name="author" content="ColorlibHQ" />
  <meta name="description"
    content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
  <meta name="keywords"
    content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
  <meta name="supported-color-schemes" content="light dark" />
  <link rel="preload" href="/Tukang-Berita/css/adminlte.css" as="style" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
    onload="this.media='all'" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="/Tukang-Berita/css/adminlte.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
    integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
    integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
  <link href="https://cdn.datatables.net/v/bs5/dt-2.3.6/datatables.min.css" rel="stylesheet"
    integrity="sha384-Op52dEl5kUgSEZdHZBipbmlFw81qZygnw1QZv+p1KFhUsirA7OJQnkaHgcJmXCTj" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.bootstrap5.css">
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
  <div class="app-wrapper">
    <nav class="app-header navbar navbar-expand bg-body">
      <div class="container-fluid">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="bi bi-list"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <i class="bi bi-person-fill"></i>
              <span class="d-none d-md-inline"><?= $_SESSION['user_name'] ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <li class="user-footer">
                <i class="bi bi-box-arrow-right"></i> <a href="/Tukang-Berita/handlers/logout.php"
                  class="btn btn-default btn-flat">Keluar</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <div class="sidebar-brand">
        <a href="/Tukang-Berita/index.php" class="brand-link">
          <i class="bi bi-newspaper"></i>
          <span class="brand-text fw-light">Tukang Berita</span>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
            aria-label="Main navigation" data-accordion="false" id="navigation">
            <li class="nav-item">
              <a href="index.php" class="nav-link">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/Tukang-Berita/admin/users.php" class="nav-link">
                <i class="nav-icon bi bi-person-circle"></i>
                <p>Pengguna</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/Tukang-Berita/admin/news.php" class="nav-link">
                <i class="nav-icon bi bi-newspaper"></i>
                <p>Berita</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/Tukang-Berita/admin/category.php" class="nav-link">
                <i class="nav-icon bi bi-tag"></i>
                <p>Kategori Berita</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-clock-history"></i>
                <p>
                  Riwayat
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/Tukang-Berita/admin/history/comment.php" class="nav-link">
                    <i class="nav-icon bi bi-chat-dots"></i>
                    <p>Komentar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/Tukang-Berita/admin/history/like.php" class="nav-link">
                    <i class="nav-icon bi bi-hand-thumbs-up"></i>
                    <p>Suka</p>
                  </a>
                </li>
              </ul>
            </li>

          </ul>
        </nav>
      </div>
    </aside>
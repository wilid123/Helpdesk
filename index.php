<?php

session_start();

include "src/config/connect.php";

if (@$_GET['module'] == "") {
  echo "<script>
    document.location='authentication-login.php';
    </script>";
}

$level = $_SESSION['level'];
if ($level == "Masyarakat") {
  $nama = $_SESSION['nama'];
  $id_masyarakat = $_SESSION['id_masyarakat'];
} elseif ($level == "Admin" || $level == "Petugas") {
  $nama_petugas = $_SESSION['nama_petugas'];
  $id_petugas = $_SESSION['id_petugas'];
}
if (!isset($_SESSION["username"])) {
  header("Location: authentication-login.php");
  exit;
}

if ($level == "Masyarakat") {
  $query = mysqli_query($conn, "SELECT foto_masyarakat FROM masyarakat WHERE id_masyarakat  = '$id_masyarakat'");
  if (mysqli_num_rows($query) > 0) {
    // Baris yang cocok ditemukan
    while ($result = mysqli_fetch_array($query)) {
      $foto_masyarakat = $result['foto_masyarakat'];
    }
  }
} else if ($level == "Admin" || $level == "Petugas") {
  $query = mysqli_query($conn, "SELECT foto_petugas FROM petugas WHERE id_petugas = '$id_petugas'");
  if (mysqli_num_rows($query) > 0) {
    // Baris yang cocok ditemukan
    while ($result = mysqli_fetch_array($query)) {
      $foto_petugas = $result['foto_petugas'];
    }
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Help Desk</title>
  <link rel="shortcut icon" type="image/png" href="src/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="src/assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin3" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar shadow">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.php" class="text-nowrap logo-img">
            <img src="src/assets/images/logos/mfi.png" width="130" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
          
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <?php
            if ($level == "Admin")
              echo "<li class='sidebar-item'><a class='sidebar-link' href='?module=dashboard-admin' aria-expanded='false'><span><i class='ti ti-layout-dashboard'></i></span><span class='hide-menu'>Dashboard</span></a></li>";
            elseif ($level == "Masyarakat")
              echo "<li class='sidebar-item'><a class='sidebar-link' href='?module=dashboard-masyarakat' aria-expanded='false'><span><i class='ti ti-layout-dashboard'></i></span><span class='hide-menu'>Dashboard</span></a></li>";
            ?>

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">CONTENT</span>
            </li>
            <li class="sidebar-item">
              <div id="content">
                <?php include "menu.php"; ?>
              </div>
            </li>




          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->


    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header shadow">
        <div class="mt-2"></div>
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
              <?php if ($level == "Admin" || $level == "Petugas") : ?>
                            <li class="nav-item">
                              <a class="nav-link" href="?module=account">
                                <p>  <?=$nama_petugas?>, ( <?=$level?> ),</p>
                              </a>
                            </li>
               <?php endif; ?>
               <?php if ($level == "Masyarakat") : ?>
                            <li class="nav-item">
                              <a class="nav-link" href="?module=account">
                                <p>  <?=$nama?>, ( <?=$level?> )</p>
                              </a>
                            </li>
               <?php endif; ?>
            <li class="nav-item align-items-center text-dark">
              <a class="nav-item">
                <br><p class="fw-bold"> <?php  include "clock.php"?> </p>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php if ($level == "Admin" || $level == "Petugas") : ?>
                    <img src="src/account/img/<?= $foto_petugas ?>" alt="" width="35" height="35" class="rounded-circle">
                  <?php endif; ?>
                  <?php if ($level == "Masyarakat") : ?>
                    <img src="src/account/img/<?= $foto_masyarakat ?>" alt="" width="35" height="35" class="rounded-circle">
                  <?php endif; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="?module=account" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="./authentication-logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->

      <br>
      <div class="container-fluid">
        <div class="row">
          <div id="content">
            <?php include "content.php"; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="src/assets/js/sidebarmenu.js"></script>
  <script src="src/assets/js/app.min.js"></script>
  <script src="src/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="src/assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="src/assets/js/dashboard.js"></script>
</body>

</html>
<?php

session_start();
include_once("config.php");
require 'function.php';

if (isset($_POST['submit'])) {

    if (updatePemeriksa($_POST) > 0) {
        echo "<script>alert('Berhasil ubah data pemeriksa!')</script>";
    } else {
        echo mysqli_error($conn);
    }
}

//ambil id dari query string
$username = $_SESSION['username'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM akun WHERE username = '$username'";
$query = mysqli_query($conn, $sql);
$akun = mysqli_fetch_assoc($query);

?>

<!-- ======= Header ======= -->
<?php include "template/header.php"; ?>
<!-- End Header -->

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">Cek Kendaraan</span>
        </a>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <?php
                    if ($akun['photo'] == "") {
                    ?>
                        <img src="assets/img/karyawan.png" alt="Profile" class="rounded-circle">
                    <?php
                    } else {
                    ?>
                        <img src="assets/img/<?= $akun['photo'] ?>" alt="Profile" class="rounded-circle">
                    <?php
                    }
                    ?>
                    <?php
                    echo "<span class='d-none d-md-block dropdown-toggle ps-2'>" . $akun["username"] . "</span>";
                    ?>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?= $akun["username"] ?></h6>
                        <?php
                        if ($akun['jabatan'] == "") {
                        ?>
                            <span>Jabatan belum di isi</span>
                        <?php
                        } else {
                        ?>
                            <span><?= $akun['jabatan'] ?></span>
                        <?php
                        }
                        ?>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="profile.php">
                            <i class="bi bi-person"></i>
                            <span>Profil</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="tentang_app.php">
                            <i class="bi bi-gear"></i>
                            <span>Tentang Aplikasi</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="logout.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<?php include "template/sidebar.php"; ?>
<!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Cek Kendaraan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Halaman Utama</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns / isi dengan tampilan utama-->
            <div class="col-lg-13">
                <div class="row">

                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between;">
                                <h5 class="card-title">Tentang Aplikasi</h5>
                                <a href="pemeriksa.php" class="btn btn-success" style="height: 40px; margin-top:10px; font-weight:bold;">Kembali</a>
                            </div>
                            <div>
                                <img src="./assets/img/TENTANG APLIKASI.jpg" alt="">
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns / isi dengan tampilan tambahan jika ada-->
            <div class="col-lg-4">

            </div><!-- End Right side columns -->

        </div>
    </section>

</main><!-- End #main -->

<?php include "template/footer.php"; ?>
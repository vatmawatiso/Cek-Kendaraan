<?php

session_start();
include_once("config.php");
require 'function.php';

if (isset($_POST['submit'])) {

    if (insertPemeriksa($_POST) > 0) {
        echo "<script>alert('Berhasil menambahkan data pemeriksa!')</script>";
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
                        <img src="assets/img/karyawan.png" alt="Profile.php" class="rounded-circle">
                    <?php
                    } else {
                    ?>
                        <img src="assets/img/<?= $akun['photo'] ?>" alt="Profile.php" class="rounded-circle">
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

    <div class="pagetitle" style="display: flex; justify-content: space-between;">
        <h1 style="margin-top: 5px;">Profil Karyawan</h1>
        <a href="index.php" class="btn btn-success" style="height: 40px; font-weight:bold;">Kembali</a>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <?php
                        if ($akun['photo'] == "") {
                        ?>
                            <img src="assets/img/karyawan.png" alt="Profile" class="rounded-circle">
                        <?php
                        } else {
                        ?>
                            <img src="assets/img/<?= $akun['photo'] ?>" alt=" Profile" class="rounded-circle">
                        <?php
                        }
                        ?>

                        <h2><?= $akun["username"] ?></h2>
                        <?php
                        if ($akun['jabatan'] == "") {
                        ?>
                            <h3>Jabatan belum di isi</h3>
                        <?php
                        } else {
                        ?>
                            <h3><?= $akun['jabatan']; ?></h3>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profil</button>
                            </li>

                            <li class="nav-item">
                                <?php
                                $username = $_SESSION['username'];

                                $sql = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username' ");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                    <a href="edit_profile.php?id=$data[id_user]">
                                        <button class="nav-link" data-bs-toggle="tab">Edit Profil</button>
                                    </a>
                                <?php } ?>
                                <!-- <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil</button> -->
                            </li>

                            <!-- <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Kata Sandi</button>
                            </li> -->

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">Detail Profil</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8"><?= $akun["username"] ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Perusahaan</div>
                                    <?php
                                    if ($akun['perusahaan'] == "") {
                                    ?>
                                        <div class="col-lg-9 col-md-8">-</div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-lg-9 col-md-8"><?= $akun['perusahaan'] ?></div>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jabatan</div>
                                    <?php
                                    if ($akun['jabatan'] == "") {
                                    ?>
                                        <div class="col-lg-9 col-md-8">-</div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-lg-9 col-md-8"><?= $akun['jabatan'] ?></div>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                                    <?php
                                    if ($akun['alamat'] == "") {
                                    ?>
                                        <div class="col-lg-9 col-md-8">-</div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-lg-9 col-md-8"><?= $akun['alamat'] ?></div>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">WhatsApp</div>
                                    <?php
                                    if ($akun['no_hp'] == 0) {
                                    ?>
                                        <div class="col-lg-9 col-md-8">-</div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-lg-9 col-md-8"><?= $akun['no_hp'] ?></div>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Email</div>
                                    <div class="col-lg-9 col-md-8"><?= $akun["email"] ?></div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form method="POST" action="">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="assets/img/karyawan.png" alt="Profile">
                                            <div class="pt-2">
                                                <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <input name="id_user" type="hidden" class="form-control" value="<?= $data["id_user"] ?>">
                                    <div class="row mb-3">
                                        <?php
                                        $username = $_SESSION['username'];

                                        $sql = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username' ");
                                        while ($data = mysqli_fetch_array($sql)) {
                                        ?>
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="" type="text" class="form-control" id="fullName" value="<?= $data["username"] ?>">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Perusahaan</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="company" type="text" class="form-control" id="company" value="">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Jabatan</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="job" type="text" class="form-control" id="Job" value="">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="Address" value="">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">WhatsApp</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="Phone" value="">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <?php
                                        $username = $_SESSION['username'];

                                        $sql = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username' ");
                                        while ($data = mysqli_fetch_array($sql)) {
                                        ?>
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email" value="<?= $data["email"] ?>">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="update" value="update" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form>

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Kata Sandi Lama</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" id="currentPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Kata Sandi Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Masukkan Kata Sandi Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Ubah Kata Sandi</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php include "template/footer.php"; ?>
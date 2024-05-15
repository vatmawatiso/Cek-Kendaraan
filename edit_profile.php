<?php

session_start();
include_once("config.php");
require 'function.php';


include("config.php");
$_SESSION['username'];

// kalau tidak ada id di query string
if (!isset($_SESSION['username'])) {
    header('Location: profile.php');
}

//ambil id dari query string
$username = $_SESSION['username'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM akun WHERE username = '$username'";
$query = mysqli_query($conn, $sql);
$akun = mysqli_fetch_assoc($query);

// jika data yang di-edit tidak ditemukan
if (mysqli_num_rows($query) < 1) {
    die("data tidak ditemukan...");
}


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
                        <img src="assets/img/<?= $akun['photo']; ?>" alt="Profile" class="rounded-circle">
                    <?php
                    }
                    ?>

                    <?php
                    echo "<span class='d-none d-md-block dropdown-toggle ps-2'>" . $akun["username"] . "</span>";
                    ?>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php echo $akun["username"] ?></h6>
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
        <h1 style="margin-top: 5px;">Edit Profil</h1>
        <a style="font-weight: bold;" href="profile.php" class="btn btn-success">Kembali</a>
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
                            <img src="assets/img/<?= $akun['photo']; ?>" alt="Profile" class="rounded-circle">
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
                            <h3><?= $akun['jabatan'] ?></h3>
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

                        <!-- Profile Edit Form -->
                        <form method="post" enctype="multipart/form-data" action="">
                            <div class="row mb-3">
                                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                                <?php
                                if ($akun['photo'] == "") {
                                ?>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="card" style="width: 100px; height:110px;">
                                            <img src="assets/img/karyawan.png" alt="Profile">
                                            <a href="#" style="margin-top: 10px;" class="btn btn-sm" title="Upload new profile image">
                                                <input type="file" name="foto" required="required" id="foto" accept="image/*">
                                            </a>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="card" style="width: 100px; height:110px;">
                                            <img src="assets/img/<?= $akun['photo']; ?>" alt="Profile">
                                            <a href="#" style="margin-top: 10px;" class="btn btn-sm" title="Upload new profile image">
                                                <input type="file" name="foto" required="required" id="foto" accept="image/*">
                                            </a>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>

                            <div class="row mb-3">
                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="id_user" type="hidden" class="form-control" id="id_user" value="<?php echo $akun["id_user"]; ?>">
                                    <input name="username" type="text" class="form-control" id="username" value="<?php echo $akun["username"]; ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="perusahaan" class="col-md-4 col-lg-3 col-form-label">Perusahaan</label>
                                <div class="col-md-8 col-lg-9">
                                    <?php
                                    if ($akun['perusahaan'] == "") {
                                    ?>
                                        <input name="perusahaan" type="text" class="form-control" id="perusahaan" value="-">
                                    <?php
                                    } else {
                                    ?>
                                        <input name="perusahaan" type="text" class="form-control" id="perusahaan" value="<?php echo $akun['perusahaan']; ?>">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jabatan" class="col-md-4 col-lg-3 col-form-label">Jabatan</label>
                                <div class="col-md-8 col-lg-9">
                                    <?php
                                    if ($akun['jabatan'] == "") {
                                    ?>
                                        <input name="jabatan" type="text" class="form-control" id="jabatan" value="-">
                                    <?php
                                    } else {
                                    ?>
                                        <input name="jabatan" type="text" class="form-control" id="jabatan" value="<?php echo $akun['jabatan']; ?>">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                <div class="col-md-8 col-lg-9">
                                    <?php
                                    if ($akun['alamat'] == "") {
                                    ?>
                                        <input name="alamat" type="text" class="form-control" id="alamat" value="-">
                                    <?php
                                    } else {
                                    ?>
                                        <input name="alamat" type="text" class="form-control" id="alamat" value="<?php echo $akun['alamat']; ?>">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_hp" class="col-md-4 col-lg-3 col-form-label">WhatsApp</label>
                                <div class="col-md-8 col-lg-9">
                                    <?php
                                    if ($akun['no_hp'] == 0) {
                                    ?>
                                        <input name="no_hp" type="number" name="angka" class="form-control" id="no_hp" value="">
                                    <?php
                                    } else {
                                    ?>
                                        <input name="no_hp" type="number" name="angka" class="form-control" id="no_hp" value="<?php echo $akun['no_hp'] ?>">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="email" type="email" class="form-control" id="Email" value="<?php echo $akun["email"]; ?>">
                                </div>
                            </div>

                            <div class="text-center">
                                <button style="font-weight:bold;" type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form><!-- End Profile Edit Form -->

                        <?php
                        include_once("config.php");
                        // cek apakah tombol simpan sudah diklik atau blum?
                        if (isset($_POST['update'])) {

                            // ambil data dari formulir
                            $id_user = $_POST['id_user'];
                            $username = $_POST['username'];
                            $perusahaan = $_POST['perusahaan'];
                            $jabatan = $_POST['jabatan'];
                            $alamat = $_POST['alamat'];
                            $no_hp = $_POST['no_hp'];
                            $email = $_POST['email'];

                            // buat query update
                            $sql = "UPDATE akun SET username='$username', email='$email', perusahaan='$perusahaan', jabatan='$jabatan', alamat='$alamat', no_hp='$no_hp' WHERE id_user=$id_user";
                            $query = mysqli_query($conn, $sql);

                            // apakah query update berhasil?
                            if ($query) {
                                // kalau berhasil alihkan ke halaman list-siswa.php
                                echo "<script>alert('Berhaisl Ubah data profil'); window.location.href = 'profile.php';</script>";
                            } else {
                                // kalau gagal tampilkan pesan
                                die("Gagal menyimpan perubahan...");
                            }

                            // Upload dan perbarui foto jika dipilih
                            if ($_FILES["foto"]["name"] != "") {
                                $targetDir = "assets/img/";
                                $targetFile = $targetDir . basename($_FILES["foto"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                                // Periksa apakah file gambar
                                $check = getimagesize($_FILES["foto"]["tmp_name"]);
                                if ($check !== false) {
                                    // Periksa ukuran file
                                    if ($_FILES["foto"]["size"] > 500000) {
                                        echo "Maaf, file terlalu besar.";
                                        $uploadOk = 0;
                                    }

                                    // Periksa jenis file
                                    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
                                        echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
                                        $uploadOk = 0;
                                    }

                                    // Periksa jika $uploadOk bernilai 0
                                    if ($uploadOk == 0) {
                                        echo "Maaf, file tidak diunggah.";
                                    } else {
                                        // Jika semua kondisi terpenuhi, coba unggah file
                                        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
                                            // Perbarui path foto pengguna di database
                                            $fotoPath = basename($_FILES["foto"]["name"]);
                                            $conn->query("UPDATE akun SET photo='$fotoPath' WHERE id_user=$id_user");
                                            echo "Foto berhasil diunggah dan profil diperbarui.";
                                        } else {
                                            echo "Terjadi kesalahan saat mengunggah file.";
                                        }
                                    }
                                } else {
                                    echo "File bukan file gambar.";
                                }
                            }
                        }
                        ?>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
        </div>
    </section>

</main><!-- End #main -->


<?php include "template/footer.php"; ?>

<?php
// $photo = $_FILES['foto']['name'];
// $ukuran_file = $_FILES['foto']['size'];
// $tmp = $_FILES['foto']['tmp_name'];
// $type = $_FILES['foto']['type'];
// $tujuan = "./assets/img/" . $photo;

// if ($ukuran_file <= 1000) {
//     if ($type == "image/png" or $type == "image/jpg" or $type == "image/jpeg") {
//         if (move_uploaded_file($tmp, $tujuan)) {
//             // Akhir Upload Foto

//             // buat query update
//             $sql = "UPDATE akun SET username='$username', email='$email', perusahaan='$perusahaan', jabatan='$jabatan', alamat='$alamat', no_hp='$no_hp', photo='$photo' WHERE id_user=$id_user";
//             $query = mysqli_query($conn, $sql);

//             //jika query input sukses
//             if ($query) {

//                 echo "<script>alert('Berhaisl Ubah data profil'); window.location.href = 'profile.php';</script>";
//             } else {
//                 die("Gagal menyimpan perubahan...");
//             }
//         }
//     }
// }
?>
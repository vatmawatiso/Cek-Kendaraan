<?php
session_start();


include_once("config.php");
require "function.php";
require "session.php";

//QUERY SELECT data_check
$result = mysqli_query($conn, "SELECT * FROM data_check ORDER BY id_Pengecekan ASC");

//QUERY SELECT nama_pemeriksa dari akun_pemeriksa
$sql = mysqli_query($conn, "SELECT nama_pemeriksa FROM akun_pemeriksa");

//ambil id dari query string
$username = $_SESSION['username'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM akun WHERE username = '$username'";
$query = mysqli_query($conn, $sql);
$akun = mysqli_fetch_assoc($query);


// Cek apakah formulir telah disubmit
if (isset($_POST['pdf'])) {

  if (jadiPDF($_POST) > 0) {
    echo "<script>alert('Berhasil menampilkan menjadi PDF!')</script>";
  } else {
    echo mysqli_error($conn);
  }
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
              <h5 class="card-title">Form Pemeriksa</h5>
              <!-- Horizontal Form -->
              <form method="post" action="">
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pemeriksa</label>
                  <div class="col-sm-10">
                    <select name="nm_pemeriksa[]" class="form-select" aria-label="Default select example">
                      <?php
                      include "config.php";
                      //query menampilkan nama unit kerja ke dalam combobox
                      $query    = mysqli_query($conn, "SELECT * FROM akun_pemeriksa GROUP BY nm_pemeriksa ORDER BY nm_pemeriksa");
                      while ($data = mysqli_fetch_array($query)) {
                      ?>
                        <option value=" <?= $data['nm_pemeriksa']; ?>"><?php echo $data['nm_pemeriksa']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal</label>
                  <div class="col-sm-10">
                    <?php
                    // $tgl = date('l, d-F-Y'); //dalam bahasa inggris
                    setlocale(LC_TIME, 'id_ID.utf8'); //dalam bahasa indonesia

                    $hariIni = new DateTime();

                    ?>
                    <input class="form-control" name="tgl[]" value="<?php echo strftime('%A %d %B %Y', $hariIni->getTimestamp()); ?>" readonly>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Pengemudi</label>
                  <div class="col-sm-10">
                    <select name="nm_pengemudi[]" class="form-select" aria-label="Default select example">
                      <?php
                      include "config.php";
                      //query menampilkan nama unit kerja ke dalam combobox
                      $query    = mysqli_query($conn, "SELECT * FROM akun_pemeriksa GROUP BY nm_pengemudi ORDER BY nm_pengemudi");
                      while ($data = mysqli_fetch_array($query)) {
                      ?>
                        <option value=" <?= $data['nm_pengemudi']; ?>"><?php echo $data['nm_pengemudi']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Nomer Polisi</label>
                  <div class="col-sm-10">
                    <select name="no_polisi[]" class="form-select" aria-label="Default select example">
                      <?php
                      include "config.php";
                      //query menampilkan nama unit kerja ke dalam combobox
                      $query    = mysqli_query($conn, "SELECT * FROM akun_pemeriksa GROUP BY no_polisi ORDER BY no_polisi");
                      while ($data = mysqli_fetch_array($query)) {
                      ?>
                        <option value=" <?= $data['no_polisi']; ?>"><?php echo $data['no_polisi']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Kilometer</label>
                  <div class="col-sm-10">
                    <select name="kilometer[]" class="form-select" aria-label="Default select example">
                      <?php
                      include "config.php";
                      //query menampilkan nama unit kerja ke dalam combobox
                      $query    = mysqli_query($conn, "SELECT * FROM akun_pemeriksa GROUP BY kilometer ORDER BY kilometer");
                      while ($data = mysqli_fetch_array($query)) {
                      ?>
                        <option value=" <?= $data['kilometer']; ?>"><?php echo $data['kilometer']; ?> KM</option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Kendaraan</label>
                  <div class="col-sm-10">
                    <select name="jenis_kendaraan[]" class="form-select" aria-label="Default select example">
                      <?php
                      include "config.php";
                      //query menampilkan nama unit kerja ke dalam combobox
                      $query    = mysqli_query($conn, "SELECT * FROM akun_pemeriksa GROUP BY jenis_kendaraan ORDER BY jenis_kendaraan");
                      while ($data = mysqli_fetch_array($query)) {
                      ?>
                        <option value=" <?= $data['jenis_kendaraan']; ?>"><?php echo $data['jenis_kendaraan']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="text-center">
                  <a style="font-weight: bold;" href="tambah_pemeriksa.php" class="btn btn-primary" role="button">Tambah Pemeriksa</a>
                </div>

                <h5 class="card-title">Tabel Cek Kendaraan</h5>

                <!-- Table with stripped rows -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="text-align:center" scope="col">No</th>
                      <th scope="col">Pengecekan</th>
                      <th style="text-align:center" scope="col" colspan="3">Kondisi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (mysqli_num_rows($result) > 0) { ?>
                      <?php
                      $no = 1;
                      while ($data = mysqli_fetch_array($result)) {

                      ?>
                        <tr>
                          <td style="text-align:center">
                            <?php echo $no; ?>

                            <!-- Tambah Ini -->
                            <input type="hidden" name="id_pengecekan[]" value="<?= $data['id_pengecekan'] ?>" />
                          </td>

                          <td name="nm_pengecekan"><?php echo $data["nm_pengecekan"]; ?></td>
                          <td style="text-align:center" width="100px">
                            <label> <!-- Cek Type input, IF kondisi dan Name -->
                              <input type='radio' <?php if ($data['kondisi'] == "Baik") {
                                                    echo "checked";
                                                  } ?> name='kondisi<?= $data['id_pengecekan'] . '[]' ?>' value='Baik'> Baik
                            </label>
                          </td>

                          <td style="text-align:center" width="100px">
                            <label> <!-- Cek Type input, IF kondisi dan Name -->
                              <input type='radio' <?php if ($data['kondisi'] == "Jelek") {
                                                    echo "checked";
                                                  } ?> name='kondisi<?= $data['id_pengecekan'] . '[]' ?>' value='Jelek'> Jelek
                            </label>
                          </td>

                          <td style="text-align:center" width="150px">
                            <label> <!-- Cek Type input, IF kondisi dan Name -->
                              <input type='radio' <?php if ($data['kondisi'] == "Tidak Ada") {
                                                    echo "checked";
                                                  } ?> name='kondisi<?= $data['id_pengecekan'] . '[]' ?>' value='Tidak Ada'>
                              Tidak Ada
                            </label>
                          </td>

                        </tr>
                      <?php $no++;
                      } ?>
                    <?php } ?>
                  </tbody>
                </table>

                <!-- FUNGSI/KONDISI CATATAN -->
                <?php
                //query baik
                $query = mysqli_query($conn, "SELECT * FROM data_check WHERE kondisi = 'Baik'");
                $jum_baik = mysqli_num_rows($query);

                //query jelek
                $query1 = mysqli_query($conn, "SELECT * FROM data_check WHERE kondisi = 'Jelek'");
                $jum_jelek = mysqli_num_rows($query1);

                //query tidak ada
                $query2 = mysqli_query($conn, "SELECT * FROM data_check WHERE kondisi = 'Tidak Ada'");
                $jum_tdkada = mysqli_num_rows($query2);
                // echo $jum_baik;

                //buat variable untuk menyimpan hasil jumlah kondisi
                $baik = $jum_baik;
                $jelek = $jum_jelek;
                $tdkada = $jum_tdkada;
                // echo "Hasil " . $baik;

                //buat valiable untuk menampilkan hasil kondisi
                $good = "Tidak harus diservis";
                $bad = "Perlu diservis";
                $none = "Harus beli";
                ?>
                <!-- END FUNGSI/KONDISI CATATAN -->

                <?php
                if ($baik > $jelek && $baik > $tdkada) {
                ?>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" style="font-weight: bold;">Catatan</label>
                    <div class="col-sm-10">
                      <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"><?= $good; ?></textarea>
                        <label for="floatingTextarea">Masukkan catatan</label>
                      </div>
                    </div>
                  </div>
                <?php
                } else if ($jelek > $baik && $jelek > $tdkada) {
                ?>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" style="font-weight: bold;">Catatan</label>
                    <div class="col-sm-10">
                      <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"><?= $bad; ?></textarea>
                        <label for="floatingTextarea">Masukkan catatan</label>
                      </div>
                    </div>
                  </div>
                <?php
                } else {
                ?>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" style="font-weight: bold;">Catatan</label>
                    <div class="col-sm-10">
                      <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"><?= $none; ?></textarea>
                        <label for="floatingTextarea">Masukkan catatan</label>
                      </div>
                    </div>
                  </div>
                <?php
                }
                ?>


                <!-- End General Form Elements -->

                <!-- Advanced Form Elements -->
                <div class="text-center">
                  <button style="font-weight: bold;" type="submit" name="simpan" class="btn btn-primary">Simpan Pengecekan</button>
                  <button style="font-weight: bold;" type="submit" name="pdf" class="btn btn-primary">Download PDF</button>
                  <!-- <a href="cetak.php" class="btn btn-primary" role="button" target="_BLANK">Cetak Laporan</a> -->
                </div>
                <!-- End Table with stripped rows -->
              </form><!-- End Horizontal Form -->

            </div>
          </div>

        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns / isi dengan tampilan tambahan jika ada-->
      <div class="col-lg-4">

      </div><!-- End Right side columns -->

    </div>
  </section>


  <!-- FUNGSI UPDATE RADIO BUTTON -->
  <?php
  @session_start();

  //Update data
  if (isset($_POST['simpan'])) {
    $id      = $_POST['id_pengecekan'];

    //hitung jumlah id_pengecekan
    $jum_id  = count($id);

    //jadikan json
    $v_con   = json_encode($id);
    $v_con   = json_decode($v_con, true);

    //ambil masing masing kondisi
    for ($i = 0; $i < $jum_id; $i++) {
      $dynamic_condition = 'kondisi' . $v_con[$i];
      $kondisi = $_POST[$dynamic_condition];

      // query update
      //Ubah nama tabel dan WHERE id
      $result = mysqli_query($conn, "UPDATE data_check SET kondisi='$kondisi[0]' WHERE id_pengecekan=$v_con[$i]");
    }


    //tampilkan hasil
    if ($result == 1) {
      @$_SESSION['status'] = 'Checkbox values inserted successfully';
      // header("refresh: 2;");
      // header("location: index.php");
      echo "<script>alert('Data berhasil diupdate, klik ok untuk melanjutkan cetak laporan');</script>";
      echo @$_SESSION['status'];
      // @session_destroy();
    } else {
      echo "Any some data not updated.";
    }
  }

  ?>
  <!-- END FUNGSI UPDATE RADIO BUTTON -->

</main><!-- End #main -->


<?php include "template/footer.php"; ?>
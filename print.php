<?php
@session_start();
include_once("config.php");
require "function.php";
require "session.php";


//Ubah nama tabel dan WHERE id
$result = mysqli_query($conn, "SELECT * FROM data_check ORDER BY id_Pengecekan ASC");

$sql = mysqli_query($conn, "SELECT nama_pemeriksa FROM akun_pemeriksa");
echo $sql;


?>
<!DOCTYPE html>
<html>

<head>
    <title>Tabel Keseluruhan</title>
    <!-- ======= Header ======= -->
    <?php include "template_cetak/header.php"; ?>
    <!-- End Header -->

    <style type="text/css">
        /*--------------------------------------------------------------
# KOP SURAT CETAK
--------------------------------------------------------------*/

        h3,
        h6 {
            text-align: center;
            padding-left: 30px;

        }

        .kablogo {
            font-size: 35px;
            color: #6DB9EF;
            /* bottom: 100px; */
        }

        .alamatlogo {
            font-size: 12px;
            /* top: 100px; */
        }

        .garis1 {
            border-top: 3px solid black;
            height: 2px;
            border-bottom: 1px solid black;
        }

        #logo {
            margin: auto;
            margin-left: 3%;
            margin-right: auto;
        }
    </style>
</head>

<body>

    <div>
        <p><img src="assets/img/cv.png" alt="" style="float: left;" id="logo" width="70px" height="90px">
        <h3 class="kablogo">PT. BERSAMA BANGUN PANGAN</h3>
        <h6 class="alamatlogo">Blok Capar 3 RT 017 RW 009 Desa Sidawangi Kec. Sumber Kab. Cirebon 45611</h6>
        <h6 class="alamatlogo">Telp. 02318858881 HP. 0812 2170 3904 email : bangga.0322@gmail.com</h6>
        </p>

    </div>
    <hr class="garis1">

    <!-- Horizontal Form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Pemeriksa</label>
            <div class="col-sm-9">
                <select name="nm_pengemudi" class="form-select" aria-label="Default select example">
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
            <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal</label>
            <div class="col-sm-9">
                <select name="tgl" class="form-select" aria-label="Default select example">
                    <?php
                    include "config.php";
                    //query menampilkan nama unit kerja ke dalam combobox
                    $query    = mysqli_query($conn, "SELECT * FROM akun_pemeriksa GROUP BY tgl ORDER BY tgl");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <option value=" <?= $data['tgl']; ?>"><?php echo $data['tgl']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Nama Pengemudi</label>
            <div class="col-sm-9">
                <select name="nm_pengemudi" class="form-select" aria-label="Default select example">
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
            <label for="inputPassword3" class="col-sm-3 col-form-label">Nomer Polisi</label>
            <div class="col-sm-9">
                <select name="no_polisi" class="form-select" aria-label="Default select example">
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
            <label for="inputPassword3" class="col-sm-3 col-form-label">Kilometer</label>
            <div class="col-sm-9">
                <select name="kilometer" class="form-select" aria-label="Default select example">
                    <?php
                    include "config.php";
                    //query menampilkan nama unit kerja ke dalam combobox
                    $query    = mysqli_query($conn, "SELECT * FROM akun_pemeriksa GROUP BY kilometer ORDER BY kilometer");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <option value=" <?= $data['kilometer']; ?>"><?php echo $data['kilometer']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Jenis Kendaraan</label>
            <div class="col-sm-9">
                <select name="jenis_kendaraan" class="form-select" aria-label="Default select example">
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

        <!-- Table with stripped rows -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;" scope="col">No</th>
                    <th style="text-align: center;" scope="col">Pengecekan</th>
                    <th style="text-align: center;" scope="col" colspan="3">Kondisi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php
                    $no = 1;
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td style="text-align: center;">
                                <?php echo $no; ?>

                                <!-- Tambah Ini -->
                                <input type="hidden" name="id_pengecekan[]" value="<?= $data['id_pengecekan'] ?>" />
                            </td>

                            <td><?php echo $data["nm_pengecekan"]; ?></td>
                            <td width="90px">
                                <label> <!-- Cek Type input, IF kondisi dan Name -->
                                    <input type='radio' <?php if ($data['kondisi'] == "Baik") {
                                                            echo "checked";
                                                        } ?> name='kondisi<?= $data['id_pengecekan'] . '[]' ?>' value='Baik'>Baik
                                </label>
                            </td>

                            <td style="text-align: center;" width="90px">
                                <label> <!-- Cek Type input, IF kondisi dan Name -->
                                    <input type='radio' <?php if ($data['kondisi'] == "Jelek") {
                                                            echo "checked";
                                                        } ?> name='kondisi<?= $data['id_pengecekan'] . '[]' ?>' value='Jelek'>Jelek
                                </label>
                            </td>

                            <td style="text-align: center;" width="120px">
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

        <!-- Advanced Form Elements -->

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

        <?php
        if ($baik > $jelek && $tdkada) {
        ?>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Catatan</label>
                <div class="col-sm-10">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"><?= $good; ?></textarea>
                        <label class="floatingTextarea">Masukkan catatan</label>
                    </div>
                </div>
            </div>
        <?php
        } else if ($jelek > $baik && $tdkada) {
        ?>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Catatan</label>
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
                <label class="col-sm-2 col-form-label">Catatan</label>
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
        <div class="text-center">
            <button type="submit" name="pdf" class="btn btn-primary">Download PDF</button>
            <!-- <a href="cetak.php" class="btn btn-primary" role="button" target="_BLANK">Cetak Laporan</a> -->
        </div>

    </form><!-- End Horizontal Form -->

    <?php
    if (isset($_POST['pdf'])) {
        echo "<script>document.location='coba.php'</script>";
    } else {
        echo "error";
    }
    ?>


    <?php
    @session_start();

    //Update data
    if (isset($_POST['submit'])) {
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
            echo "<script>alert('Data berhasil diupdate');
    document.location='index.php'</script>";
            echo @$_SESSION['status'];
            @session_destroy();
        } else {
            echo "Any some data not updated.";
        }
    }
    ?>


    <script>
        window.print();
    </script>

</body>

</html>
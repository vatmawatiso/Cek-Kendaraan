<?php

//Mengaktifkan output buffering
ob_start();

@session_start();
include_once("config.php");
require "function.php";
require "session.php";


//Ubah nama tabel dan WHERE id
$result = mysqli_query($conn, "SELECT * FROM data_check ORDER BY id_Pengecekan ASC");

$sql = mysqli_query($conn, "SELECT nama_pemeriksa FROM akun_pemeriksa");
echo $sql;

// Ambil nilai dari sesi
// $selectedValues = $_SESSION["selectedValues"];
$pemeriksa = $_SESSION["pemeriksa"];
$tanggal = $_SESSION["tanggal"];
$pengemudi = $_SESSION["pengemudi"];
$nopolisi = $_SESSION["nopolisi"];
$kilometer = $_SESSION["kilometer"];
$jeniskendaraan = $_SESSION["jeniskendaraan"];

// Hapus nilai dari sesi (optional, tergantung pada kebutuhan)
unset($_SESSION["selectedValues"]);
?>

<!DOCTYPE html>
<html>

<head>
	<title>Tabel Keseluruhan</title>
	<!-- ======= Header ======= -->

	<style type="text/css">
		.kablogo {
			font-size: 47px;
			color: #6DB9EF;
			/* bottom: 100px; */
		}

		.alamatlogo {
			font-size: 15px;
			/* top: 100px; */
		}

		.garis1 {
			border-top: 3px solid black;
			height: 2px;
			border-bottom: 1px solid black;
		}

		#logo {
			/* background-color: pink; */
		}

		.txt {
			font-size: 20px;
			/* background-color: greenyellow; */
			width: 200px;
		}

		.container {
			text-align: center;
		}

		label {
			font-size: 5px;
			margin-bottom: 8px;
			display: block;
		}

		.hasil {
			font-size: 20px;
			/* background-color: #6DB9EF; */
		}
	</style>
</head>

<body>
	<table width="950px" align="left" cellpadding="4" cellspacing="2">
		<tr>

			<td width="100px">
				<img src="assets/img/cv.png" alt="" style="top: 100px;" id="logo" width="85px" height="90px">
			</td>
			<td align="center">
				<p>
				<h3 class="kablogo">PT. BERSAMA BANGUN PANGAN</h3>
				<h6 class="alamatlogo">Blok Capar 3 RT 017 RW 009 Desa Sidawangi Kec. Sumber Kab. Cirebon 45611</h6>
				<h6 class="alamatlogo">Telp. 02318858881 HP. 0812 2170 3904 email : licence.ptbangga@gmail.com</h6>
				</p>
			</td>
		</tr>
	</table>
	<hr class="garis1">

	<table width="950px" align="left" cellpadding="4" cellspacing="2">
		<tr>

			<td class="txt">
				<label align="left">Nama Pemeriksa</label><br>
			</td>
			<td class="hasil">
				<?php
				foreach ($pemeriksa as $index => $value) {
				?>
					: <?= $value ?><br>
				<?php
				}
				?>
			</td>
		</tr>

		<tr>
			<td class="txt">
				<label align="left">Tanggal</label><br>
			</td>
			<td class="hasil">

				<?php
				foreach ($tanggal as $index => $value) {
				?>
					: <?= $value ?><br>
					<!-- : <input class="select" type="text" value="<?= $value; ?>" readonly><br> -->
				<?php
				}
				?>
			</td>
		</tr>

		<tr>
			<td class="txt">
				<label align="left">Nama Pengemudi</label><br>
			</td>
			<td class="hasil">

				<?php
				foreach ($pengemudi as $index => $value) {
				?>
					: <?= $value ?><br>
					<!-- : <input class="select" type="text" value="<?= $value; ?>" readonly><br> -->
				<?php
				}
				?>
			</td>
		</tr>

		<tr>
			<td class="txt">
				<label align="left">Nomer Polisi</label><br>
			</td>
			<td class="hasil">

				<?php
				foreach ($nopolisi as $index => $value) {
				?>
					: <?= $value ?><br>
					<!-- : <input class="select" type="text" value="<?= $value; ?>" readonly><br> -->
				<?php
				}
				?>
			</td>
		</tr>

		<tr>
			<td class="txt">
				<label align="left">Kilometer</label><br>
			</td>
			<td class="hasil">

				<?php
				foreach ($kilometer as $index => $value) {
				?>
					: <?= $value ?><br>
					<!-- : <input class="select" type="text" value="<?= $value; ?>" readonly><br> -->
				<?php
				}
				?>
			</td>
		</tr>

		<tr>
			<td class="txt">
				<label align="left">Jenis Kendaraan</label><br>
			</td>
			<td class="hasil">

				<?php
				foreach ($jeniskendaraan as $index => $value) {
				?>
					: <?= $value ?><br>
					<!-- : <input class="select" type="text" value="<?= $value; ?>" readonly><br> -->
				<?php
				}
				?>
			</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>

	<!-- Table with stripped rows -->
	<table width="950" border="1" align="left" cellpadding="4" cellspacing="0">
		<thead>
			<tr>
				<th style="text-align: center; width: 50px; font-size: 20px;" scope="col">No</th>
				<th style="text-align: center; font-size: 20px;" scope="col">Pengecekan</th>
				<th style="text-align: center; width: 400px; font-size: 20px;" scope="col" colspan="3">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<?php if (mysqli_num_rows($result) > 0) { ?>
				<?php
				$no = 1;
				while ($data = mysqli_fetch_array($result)) {
				?>
					<tr>
						<td style="text-align: center; font-size: 20px;">
							<?php echo $no; ?>

							<!-- Tambah Ini -->
							<input style="font-size: 20px;" type="hidden" name="id_pengecekan[]" value="<?= $data['id_pengecekan'] ?>" />
						</td>

						<td style="font-size: 20px;"><?php echo $data["nm_pengecekan"]; ?></td>
						<td style="text-align: center; font-size: 20px;" width="90px">
							<label> <!-- Cek Type input, IF kondisi dan Name -->
								<input type="radio" name="kondisi" value="Baik" <?php echo ($data['kondisi'] == "Baik" ? 'checked="checked"' : ''); ?> /> Baik
							</label>
						</td>

						<td style="text-align: center; font-size: 20px;" width="90px">
							<label> <!-- Cek Type input, IF kondisi dan Name -->
								<input type="radio" name="kondisi" value="Jelek" <?php echo ($data['kondisi'] == "Jelek" ? 'checked="checked"' : ''); ?> /> Jelek
							</label>
						</td>

						<td style="text-align: center; font-size: 20px;" width="120px">
							<label> <!-- Cek Type input, IF kondisi dan Name -->
								<input type="radio" name="kondisi" value="Tidak Ada" <?php echo ($data['kondisi'] == "Tidak Ada" ? 'checked="checked"' : ''); ?> /> Tidak Ada
							</label>
						</td>

					</tr>
				<?php $no++;
				} ?>
			<?php } ?>
		</tbody>
	</table>

	<!-- Fungsi Catatan -->

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

		<div>
			<h4>Catatan</h4>
			<div>
				<div>
					<?php
					foreach ($jeniskendaraan as $index => $value) {
					?>
						<textarea cols="132" rows="3" id="komentar" style="height: 70px;">Kendaraan<?= $value ?> <?= $good; ?></textarea>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	<?php
	} else if ($jelek > $baik && $tdkada) {
	?>
		<div>
			<h4>Catatan</h4>
			<div>
				<div>
					<?php
					foreach ($jeniskendaraan as $index => $value) {
					?>
						<textarea cols="132" rows="3" id="komentar" style="height: 70px;">Kendaraan<?= $value ?> <?= $bad; ?></textarea>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	<?php
	} else {
	?>
		<div>
			<h4>Catatan</h4>
			<div>
				<div>
					<?php
					foreach ($jeniskendaraan as $index => $value) {
					?>
						<textarea cols="132" rows="3" id="komentar" style="height: 70px;">Kendaraan<?= $value ?> <?= $none; ?></textarea>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	<?php
	}
	?>

	</form><!-- End Horizontal Form -->


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
<!-- END Sintaks data tampilan yang akan dibuat pdf -->


<!-- Sintaks MPDF -->
<?php

//Meload library mPDF
require './mpdf_v8.0.3-master/vendor/autoload.php';

//Membuat inisialisasi objek mPDF
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'margin_top' => 10, 'margin_bottom' => 10, 'margin_left' => 10, 'margin_right' => 10]);

//Memasukkan output yang diambil dari output buffering ke variabel html
$html = ob_get_contents();

// //Menghapus isi output buffering
// ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));

//Membuat output file
$content = $mpdf->Output("Laporan Pengecekan Kendaraan.pdf", "D");

?>
<!-- END Sintaks MPDF -->
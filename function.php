<?php

// mmebuat koneksi ke db
$databaseHost = 'localhost';
$databaseName = 'cek_kendaraan';
$databaseUsername = 'root';
$databasePassword = '';

$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM akun WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Username sudah terdaftar!')</script>";

        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai')</script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // var_dump($password);
    // die;

    // return 1;
    //Tambahkan user ke database
    mysqli_query($conn, "INSERT INTO akun VALUES ('','$username','$email','$password')");

    return mysqli_affected_rows($conn);
}

function login($data)
{
    global $conn;

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM akun WHERE username='$username'");
    $count = mysqli_num_rows($query);

    if ($count > 0) {
        $data = mysqli_fetch_array($query);
        if (password_verify($password, $data['password'])) {
            //set session
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;

            header('Location: index.php');
        } else {
            echo '<script>alert("your password is invalid!")</script>';
        }
    } else {
        echo '<script>alert("Your account not exists!")</script>';
    }
}

//FUNGSI INSERT DATA PEMERIKSA
function insertPemeriksa()
{
    global $conn;

    $nm_pemeriksa = $_POST['nm_pemeriksa'];
    // $tgl = $_POST['tgl'];
    $nm_pengemudi = $_POST['nm_pengemudi'];
    $no_polisi = $_POST['no_polisi'];
    $kilometer = $_POST['kilometer'];
    $jenis_kendaraan = $_POST['jenis_kendaraan'];
    // $catatan = $_POST['catatan'];

    // include database connection file
    include_once("config.php");

    // Insert user data into table
    mysqli_query($conn, "INSERT INTO akun_pemeriksa(nm_pemeriksa,nm_pengemudi,no_polisi,kilometer, jenis_kendaraan) VALUES('$nm_pemeriksa','$nm_pengemudi','$no_polisi','$kilometer','$jenis_kendaraan')");

    // Show message when user added
    echo "<script>alert('Tambah data pemeriksa berhasil')</script>";
}

//FUNGSI MENGUBAH KE PDF
function jadiPDF()
{
    // Ambil nilai yang dipilih dari semua elemen select
    $pemeriksa = $_POST["nm_pemeriksa"];
    $tanggal = $_POST["tgl"];
    $pengemudi = $_POST["nm_pengemudi"];
    $nopolisi = $_POST["no_polisi"];
    $kilometer = $_POST["kilometer"];
    $jeniskendaraan = $_POST["jenis_kendaraan"];

    // Simpan nilai-nilai tersebut dalam sesi
    $_SESSION["pemeriksa"] = $pemeriksa;
    $_SESSION["tanggal"] = $tanggal;
    $_SESSION["pengemudi"] = $pengemudi;
    $_SESSION["nopolisi"] = $nopolisi;
    $_SESSION["kilometer"] = $kilometer;
    $_SESSION["jeniskendaraan"] = $jeniskendaraan;

    // Redirect ke halaman lain untuk menampilkan hasil
    header("Location: cetakPDF.php");
    exit();
}

//FUNGSI UPDATE DATA PEMERIKSA
function updatePemeriksa()
{

    global $conn;

    $id = $_POST['id_pemeriksa'];
    $nm_pemeriksa = $_POST['nm_pemeriksa'];
    $nm_pengemudi = $_POST['nm_pengemudi'];
    $no_polisi = $_POST['no_polisi'];
    $kilometer = $_POST['kilometer'];
    $jenis_kendaraan = $_POST['jenis_kendaraan'];

    $sql = "UPDATE akun_pemeriksa SET nm_pemeriksa='$nm_pemeriksa', nm_pengemudi='$nm_pengemudi', no_polisi='$no_polisi', kilometer='$kilometer', jenis_kendaraan='$jenis_kendaraan' WHERE id_pemeriksa='$id'";
    $query = mysqli_query($conn, $sql);
    // apakah query update berhasil?
    if ($query) {
        // kalau berhasil alihkan ke halaman list-siswa.php
        header("Location: pemeriksa.php");
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menyimpan perubahan...");
    }
}

//FUNGSI HAPUS DATA PEMERIKSA

function konfirmEmail()
{

    global $conn;

    $email = $_POST['email']; // Ambil email dari form

    $sql = "SELECT * FROM akun WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email sudah terdaftar dalam database
        $_SESSION['email'] = $email;

        echo "<script>alert('Email yang dimasukkan benar');window.location.href='ubah_sandi.php';</script>";
    } else {
        // Email belum terdaftar dalam database
        echo "<script>alert('Email yang dimasukkan salah')</script>";
    }

    // Tutup koneksi ke database
    $conn->close();
}

<?php

include 'config.php';

$id = $_GET['id'];
//query untuk delete data
$query = mysqli_query($conn, "DELETE FROM akun_pemeriksa WHERE id_pemeriksa='" . $id . "'");
//setelah data dihapus redirect ke halaman tampil.php
header("Location:pemeriksa.php");

// if (isset($_GET['id_pemeriksa'])) {

//     // ambil id dari query string
//     $id = $_GET['id_pemeriksa'];

//     // buat query hapus

//     $sql = "DELETE FROM akun_pemeriksa WHERE id_pemeriksa=$id";
//     $query = mysqli_query($conn, $sql);

//     // apakah query hapus berhasil?
//     if ($query) {
//         header('Location: pemeriksa.php');
//     } else {
//         die("gagal menghapus data pemeriksa...");
//     }
// } else {
//     die("akses dilarang...");
// }

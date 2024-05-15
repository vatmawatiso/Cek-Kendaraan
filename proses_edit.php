<?php

include "config.php";
$id = $_POST['id_user'];
$username = $_POST['username'];
$email = $_POST['email'];

mysqli_query($conn, "UPDATE akun SET username='$username', email='$email', WHERE id_user='$id' ");

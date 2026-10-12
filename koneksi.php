<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "db_satamart";
$koneksi = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$koneksi) {
    die("Koneksi dengan database gagal: " . mysqli_connect_errno() .
        " - " . mysqli_connect_error());
}
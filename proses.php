<?php
require "include/Connection.php";

session_start();
$id=$_GET['id'];
$pegawai =  $_SESSION['username'];
$sql = "UPDATE pesanan SET status_order = 'proses', nama_pegawai = '$pegawai' WHERE id_order='$id'";
if ($db->query($sql) === TRUE) {
    header('Location: pegawai.php'); // Redirect ke halaman selamat datang setelah login berhasil
    echo "Berhasil Proses Pesanan";
} else {
    echo "Error: " . $db->error;
}
<?php
require "include/Connection.php";
$id=$_GET['id'];
$sql = "UPDATE pesanan SET status_order = 'sudah terbayar' WHERE id_order='$id'";
if ($db->query($sql) === TRUE) {
    header('Location: orderansaya.php'); // Redirect ke halaman selamat datang setelah login berhasil
    echo "Berhasil Batalkan Pesanan";
} else {
    echo "Error: " . $db->error;
}
<?php
session_start();
require_once('include/Connection.php');

$username = $_SESSION['username'];
// echo $username;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // var_dump($_POST);
    // Retrieve form data
    // $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];
    // var_dump($_POST);
    // exit();
    // $no_hp = $_POST['no_hp'];
    // $password = md5($_POST['password'] == NULL ?  $_SESSION['password'] : $_POST['password']);

    // Update user profile in the database
    $query = "UPDATE user_login SET alamat='$alamat', lat='$lat', lon='$lon' WHERE username='$username'";
    // $result = $db->query($query);
    // var_dump($query);
    if ($db->query($query) === TRUE) {
        echo "Update berhasil";
        echo "<script>alert('Update berhasil');</script>";
        echo '<script>window.location.href = "target.php";</script>';
        
    } else {
        echo "Error updating record: " . $db->error;
    }

    // if ($db->affected_rows > 0) {
    //     // Baris terkena, pembaruan berhasil
    //     echo '<script>window.location.href = "welcome.php";</script>';
    // } else {
    //     // Tidak ada baris yang terkena, tidak ada perubahan
    //     echo 'Tidak ada perubahan yang dilakukan.';}
}
?>

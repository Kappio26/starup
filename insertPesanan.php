<?php

// Check if the form is submitted
session_start();

include 'include/Connection.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari formulir

    $username = $_SESSION['username'];

    $query="SELECT * FROM user_login WHERE username='$username'";
    $result = $db->query($query);
    $row = $result->fetch_assoc();

    

    $latUser = $row['lat'];
    $lonUser = $row['lon'];

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $jenispaket = $_POST['namapaket'];
    $harga = $_POST['harga'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $lat = $_POST['lat'];
    
    $lon = $_POST['lon'];
    // Set the default status to 'Pending'
    $status = 'Pending';

    $waktuOrder = $date.' '.$time ;

    // Waktu batas
    $batas_pagi = "08:00";
    $batas_sore = "16:00";
    $waktu_timestamp = strtotime($time);
    $batas_pagi_timestamp = strtotime($batas_pagi);
    $batas_sore_timestamp = strtotime($batas_sore);
    if ($waktu_timestamp < $batas_pagi_timestamp || $waktu_timestamp > $batas_sore_timestamp) {
        // echo "Status Order Anda Pending,Tunggu Konfirmasi Admin";
        echo "<script>alert('Anda Order Diluar Jam Kerja');</script>";
        echo '<script>window.location.href = "order.php";</script>';
         
    }else{

        // $query2="SELECT * FROM user_login WHERE level_user='pegawai'";
        // $result2 = $db->query($query2);
        // // $row2 = $result2->fetch_assoc();
        // $jarak = [];
        // $dataPegawai = [];
        // // if ($result2->num_rows > 0) {
        //     // Loop untuk mengambil semua baris hasil query
        //     while($row2 = $result2->fetch_assoc()) {
        //         $distance = haversineGreatCircleDistance($latUser, $lonUser, $row2['lat'], $row['lon']);
        //         // echo $row2['lat'];
        //         // echo '<br>';
        //         // echo $row['lon'];
        //         $jarak[] = intval($distance);
        //         $dataPegawai[] = $row2['id_user'];
        //     }
        

        // var_dump($jarak);
        // var_dump($dataPegawai);
        // exit();

    // Insert user data into the database with the status
    $userId = $row['id_user'];
    $sql = "INSERT INTO pesanan (id_user, username, no_telp, alamat, nama_paket, harga, waktu_order) 
            VALUES ('$userId', '$username', '$no_hp', '$alamat', '$jenispaket', '$harga', '$waktuOrder')";

    if ($db->query($sql)) {

        $sqlLokasi = "UPDATE user_login SET lat='$lat', lon='$lon', alamat='$alamat' WHERE username='$username'";
        $db->query($sqlLokasi);

        echo "<script>alert('Status Order Anda Pending,Tunggu Konfirmasi Admin');</script>";
        echo "<script>alert('Order berhasil');</script>";
        echo '<script>window.location.href = "order.php";</script>';    
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
    }

} ?>
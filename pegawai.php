<?php
        // Memulai sesi
        session_start();


        function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
            // convert from degrees to radians
            $latFrom = deg2rad((float)$latitudeFrom);
    $lonFrom = deg2rad((float)$longitudeFrom);
    $latTo = deg2rad((float)$latitudeTo);
    $lonTo = deg2rad((float)$longitudeTo);
          
            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;
          
            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
              cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            return $angle * $earthRadius;
          }
        $username = $_SESSION['username'];

        // Meng-include file koneksi
        include 'include/Connection.php';

        // Query SQL untuk mengambil data dari database
        $query="SELECT * FROM pesanan WHERE status_order = 'pembayaran terkonfirmasi' OR status_order = 'pending' OR status_order = 'selesai'";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        
    
        $pegawaiQuery = "SELECT * FROM user_login WHERE username='$username'";
        $resultPegawai = $db->query($pegawaiQuery);
        $dataPegawai = $resultPegawai->fetch_assoc();


        // var_dump($dataPegawai);

        $latPegawai = $dataPegawai['lat'];
        $lonPegawai = $dataPegawai['lon'];
        // exit();
        // $nama = $_POST['nama'];
        // $alamat = $_POST['alamat'];
        // $no_hp = $_POST['no_hp'];
        // $jenispaket = $_POST['namapaket'];
        // $harga = $_POST['harga'];
        // $date = $_POST['date'];
        // $time = $_POST['time'];
        // // Set the default status to 'Pending'
        // $status = 'Pending';


        // $db->close();
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Cuci Kendaraan Panggil Kerumah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/lightbox.css">
    <link type="text/css" rel="stylesheet" href="css/cm-overlay.css" />
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
    <link href="css/styleeee.css" rel="stylesheet" type="text/css" media="all" />
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Sintony:400,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Add the Google Fonts link for Pacifico -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- Sertakan Font Awesome -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
     <!-- Add the Google Fonts link for Pacifico -->
     <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">


     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
<link rel="stylesheet" href="dist/css/leaflet.extra-markers.min.css">
<script src="dist/js/leaflet.extra-markers.min.js"></script>

<style>
    #map {
        height: 300px;
        width: 100%;
    }
</style>
</head>

<body>
    <input type="hidden" name="latPegawai" id="latPegawai" value="<?= $latPegawai ?>">
    <input type="hidden" name="lonPegawai" id="lonPegawai" value="<?= $lonPegawai ?>">

    <div class="bg-image">
        <div class="overlay"></div>
        <nav class="navbar navbar-expand-lg navbar-light bg-teal">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Daftar Pesanan Pelanggan</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="pegawai.php">Cek Pesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="target.php">Update Lokasi</a>
          <li class="d-flex align-items-center">
    <button onclick="confirmLogout()" class="btn btn-link logout-button" style="color: white;">
        <i class="fas fa-sign-out-alt" style="color: white;"></i>
    </button>
    </li>
        </div>
    <script>
        function confirmLogout() {
            var confirmLogout = confirm("Apakah Anda ingin keluar?");
            if (confirmLogout) {
                window.location.href = "logout.php";
            }
        }
    </script>
  </div>
</nav>
</div>
<h1>Daftar Pesanan</h1>
    <table>
        <thead>
        <tr>
            <th>Nama Pelanggan</th>
            <th>Nama Paket</th>
            <th>Harga</th>
            <th>Waktu & tgl order</th>
            <th>Jarak</th>
            <th>Status</th>
            <th>Proses</th>
                <th>
                Selesai</th>
                <th>Detail</th>
            </tr>
        </thead>
       <tbody>
       <?php

if ($result->num_rows > 0) {
    // Output data dari setiap baris
    while ($row = $result->fetch_assoc()) {

        $userNamePelanggan = $row["username"];

        $userQuery = "SELECT * FROM user_login WHERE username='$userNamePelanggan'";
        $resultUser = $db->query($userQuery);
        $dataUser = $resultUser->fetch_assoc();

        // var_dump($dataUser);

        $lat = $dataUser['lat'];
        $lon = $dataUser['lon'];

        $distance = haversineGreatCircleDistance($latPegawai, $lonPegawai, $lat, $lon);

        $meter = intval($distance);

        // exit();

        echo "<tr>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["nama_paket"] . "</td>";
        echo "<td>" . $row["harga"] . "</td>";
        echo "<td>" . $row["waktu_order"] . "</td>";
        echo "<td><a href='https://www.google.com/maps?q=".$lat.",".$lon."' target='_blank'>" . $meter. " Meter</a> </td>";
        echo "<td>" . $row["status_order"] . "</td>";

        
        if($row['status_order'] == 'pembayaran terkonfirmasi'){
            echo "<td><a href='proses.php?id=" . $row['id_order'] . "' class='btn btn-sm btn-danger'>Proses</a></td>";
        }else{
            echo"<td></td>";
        }
        
        if($row['status_order'] == 'selesai' ){
            echo "<td><a href='selesai.php?id=" . $row['id_order'] . "' class='btn btn-sm btn-success'>Selesai</a></td>";
        } else {
            echo "<td></td>";
        }
        
        echo '<td>
        <button type="button" data-lat="'.$lat.'" data-lon="'.$lon.'" data-nama="'.$row["username"].'" data class="btn btn-sm btn-warning    btn-map" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Detail
</button>
        </td>';


        echo "</tr>";
    }
} else {
    echo "Tidak ada data yang ditemukan.";
}

 $db->close();

?>
       </tbody>

    </table>
    
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div id="map" class="mb-3"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script>

var elements = document.querySelectorAll('.btn-map');
var map = null;
elements.forEach(function(element) {
        element.addEventListener('click', function() {
            if(map) {
                map.remove(); 
            }
            // alert('Clicked ' + element.textContent);
            var lat = element.dataset.lat;
            var lon = element.dataset.lon;
            var nama = element.dataset.nama;

            var lon2 = document.getElementById('lonPegawai').value
            var lat2 = document.getElementById('latPegawai').value
            
            map = L.map('map').setView([lat, lon], 12); // Koordinat Makassar, Sulawesi Selatan

// Tambahkan tile layer ke peta
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var marker;

// Fungsi untuk mendapatkan alamat dari koordinat
function getAddress(lat, lon) {
    var url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data && data.display_name) {
                document.getElementById('alamat').value = data.display_name;
            } else {
                document.getElementById('alamat').value = 'Alamat tidak ditemukan';
            }
        })
        .catch(error => {
            console.error('Error fetching address:', error);
            document.getElementById('alamat').value = 'Error fetching address';
        });
}

// Event listener untuk klik pada peta

var redMarker = L.ExtraMarkers.icon({
    icon: 'fa-user',
    markerColor: 'red',
    shape: 'square',
    prefix: 'fa'
});

L.marker([lat, lon], {icon: redMarker}).addTo(map).bindPopup(nama);

L.marker([lat2, lon2]).addTo(map);

L.Routing.control({
    waypoints: [
        L.latLng(lat, lon),
        L.latLng(lat2, lon2)
    ],
    routeWhileDragging: true,
    createMarker: function(i, waypoint, n) {
        // Use custom icons for the markers
        // var icon = (i === 0) ? redIcon : blueIcon;
        // return L.marker(waypoint.latLng, { icon: icon }).bindPopup((i === 0) ? 'I am a red marker.' : 'I am a blue marker.');
    },
    lineOptions: {
        styles: [{color: 'blue', opacity: 1, weight: 5}]
    }
}).addTo(map);
setTimeout(() => {
    map.invalidateSize();

}, 500);
        });
    });


</script>

<style>
<style>
    body {
        font-family: 'Open Sans', sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    h1 {
        text-align: center;
        color: #008B8B;
        margin-bottom: 20px;
    }

    table {
        border-collapse: collapse;
        width: 80%;
        margin-top: 20px;
        font-size: 14px;
        margin-left: auto;
        margin-right: auto;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 12px;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .navbar {
        background-color: #008080;
        height: 70px;
        position: relative;
        z-index: 1;
    }

    .navbar-nav .nav-link {
        color: white !important;
        font-weight: bold;
    }

    .navbar-brand {
        font-family: "Verdana";
        font-weight: bold;
        color: white;
        font-size: 20px;
    }

    .btn-primary {
        background-color: #008B8B;
        border-color: #008B8B;
        font-size: 1.2rem;
    }

    .btn-primary:hover {
        background-color: #c0392b;
        border-color: #c0392b;
    }

    .card {
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .card:hover {
        transform: scale(1.05);
    }

    @keyframes slideIn {
        from {
            transform: translateX(-100%);
        }

        to {
            transform: translateX(0);
        }
    }

    @-webkit-keyframes slideIn {
        from {
            -webkit-transform: translateX(-100%);
        }

        to {
            -webkit-transform: translateX(0);
        }
    }
</style>
</body>
</html>
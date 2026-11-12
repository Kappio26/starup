<?php
        // Memulai sesi
        session_start();

        $username = $_SESSION['username'];

        // Meng-include file koneksi
        include 'include/Connection.php';

        // Query SQL untuk mengambil data dari database
        $query="SELECT * FROM pesanan WHERE status_order = 'pembayaran terkonfirmasi' OR status_order = 'proses' OR status_order = 'selesai'";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $totalTarget = 0;
        $totalCucianHariIni = 0;
        $statusTargetTercapai = "Belum Tercapai";
        $totalCucian = 0;
        
        $db->close();
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
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> -->
  


    <!-- Add the Google Fonts link for Pacifico -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- Sertakan Font Awesome -->
    <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->
</head>

<body>

    <div class="bg-image">
        <div class="overlay"></div>
        <nav class="navbar navbar-expand-lg navbar-light bg-teal">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Cek Target Pegawai</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="pegawai.php">Cek Order</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="target.php">Cek Target</a>
        </li>
        <li class="d-flex align-items-center">
          <button onclick="confirmLogout()" class="btn btn-link logout-button" style="color: white;">KELUAR</button>
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
    </table>
    <form method="post" action="updateAlamat.php">

    <div class="row">
        <div class="col-md-6 mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= $row["alamat"] ?></textarea>
          <div id="map"></div>
          <input type="hidden" class="" name="lat" id="lat">
          <input type="hidden" class="" name="lon" id="lon">
        </div>
      </div>
      <button class="btn btn-primary">Simpan</button>
    </form>
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
      <!-- <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> -->
      <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([-5.147665, 119.432732], 10); // Koordinat Makassar, Sulawesi Selatan

        // Tambahkan tile layer ke peta
        // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        // }).addTo(map);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
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
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lon = e.latlng.lng;

            var latDom = document.getElementById('lat').value = lat
            var lonDom = document.getElementById('lon').value = lon

            // Jika marker sudah ada, hapus terlebih dahulu
            if (marker) {
                map.removeLayer(marker);
            }

            // Tambahkan marker baru pada posisi yang diklik
            marker = L.marker([lat, lon]).addTo(map);

            // Dapatkan alamat dari koordinat dan tampilkan di text field
            getAddress(lat, lon);
        });
    </script>

<style>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Adjust the height as needed */
            margin: 0;
            font-family: 'Open Sans', sans-serif;
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
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .navbar-nav .nav-link i {
        font-size: 20px;
        color: white;
        }

        .navbar-nav .nav-item:last-child .nav-link i {
        color: #008080;
        }

        .navbar-nav .nav-item:last-child .logout-button {
        border: none;
        padding: 0;
        font-size: 16px;
        color: white;
        background-color: #008080;
        cursor: pointer;
        }
        body {
            font-family: 'Roboto Condensed', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
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
            font-family: "Courier New", Courier, monospace;
            color: white !important;
            font-size: 24px;
        }
        .btn-primary {
            background-color: #008B8B;
            border-color: #008B8B;
        }

        .btn-primary:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        /* Additional styles for card */
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        /* Styles for button */
        .btn-primary {
            font-size: 1.2rem;
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
<style>
      #map{
        height: 300px;
        width: 100%;
      }
    </style>
</body>
</html>
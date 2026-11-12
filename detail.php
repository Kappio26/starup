<?php
session_start();
require_once('include/Connection.php');

$id = $_GET['id'];

$query = "SELECT *
FROM pesanan
JOIN user_login ON pesanan.id_user = user_login.id_user
WHERE id_order = '$id'";
$result = $db->query($query);
$row = $result->fetch_assoc();

$username = $_SESSION['username'];

$query2="SELECT * FROM user_login WHERE username='$username'";
$result2 = $db->query($query2);
$row2 = $result2->fetch_assoc();

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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    <!-- Add the Google Fonts link for Pacifico -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- Sertakan Font Awesome -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
      #map{
        height: 600px;
        width: 100%;
      }
    </style>
    <link rel="stylesheet" href="dist/css/leaflet.extra-markers.min.css">

</head>

<body>
<input type="hidden" id="lat" name="lat" value="<?= $row['lat'] ?>"/>
<input type="hidden" id="lon" name="lon" value="<?= $row['lon'] ?>"/>
<input type="hidden" id="nama" name="nama" value="<?= $row['nama'] ?>"/>


<input type="hidden" id="lat2" name="lat" value="<?= $row2['lat'] ?>"/>
<input type="hidden" id="lon2" name="lon" value="<?= $row2['lon'] ?>"/>
    <div class="bg-image">
        <div class="overlay"></div>
        <nav class="navbar navbar-expand-lg navbar-light bg-teal">
        <div class="container-fluid">
    <a class="navbar-brand" href="#">Detail Pengguna</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="pegawai.php">Cek Pesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="target.php">Update Lokasi </a>
          <li class="d-flex align-items-center">
  <button onclick="confirmLogout()" class="btn btn-link logout-button">
    <i class="fas fa-sign-out-alt"></i>
  </button>
</li>

    </div>
  </div>
</nav>
  </div>
  <script>
        function confirmLogout() {
            var confirmLogout = confirm("Apakah Anda ingin keluar?");
            if (confirmLogout) {
                window.location.href = "logout.php";
            }
        }
    </script>
   
    <!-- Tambahkan konten setting akun di sini -->
    <div class="container mt-5">
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

   

      
    </form>
  </div>
    <?php
                            
                            ?>

    <!-- <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> -->
    <script src="dist/js/leaflet.extra-markers.min.js"></script>

    <script>

        var lon = document.getElementById('lon').value
        var lat = document.getElementById('lat').value
        var nama = document.getElementById('nama').value

        var lon2 = document.getElementById('lon2').value
        var lat2 = document.getElementById('lat2').value

        // Inisialisasi peta
        var map = L.map('map').setView([lat, lon], 12); // Koordinat Makassar, Sulawesi Selatan

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
                var icon = (i === 0) ? redIcon : blueIcon;
                return L.marker(waypoint.latLng, { icon: icon }).bindPopup((i === 0) ? 'I am a red marker.' : 'I am a blue marker.');
            },
            lineOptions: {
                styles: [{color: 'blue', opacity: 1, weight: 5}]
            }
        }).addTo(map);
    </script>
</body>

</html>
<style>

.welcome-text h1 {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    white-space: nowrap; /* Prevent text from wrapping to the next line */
    overflow: hidden; /* Hide overflowed content */
    font-size: 3rem; /* Adjust the font size as needed */
    font-family: 'Roboto', sans-serif; /* Optional: Use a specific font family */
    font-weight: bold; /* Optional: Add font weight if desired */
    color: #ffffff; /* Set the text color (white in this example) */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8); /* Optional: Add a text shadow */
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
            font-family: "Verdana";
            color: white ;
            font-size: 20px;
        }

      .btn-primary {
          background-color: #008B8B; /* Change the button background color to your desired color */
          border-color: #008B8B; /* Change the button border color to your desired color */
      }

      .btn-primary:hover {
          background-color: #c0392b; /* Change the button background color on hover to your desired color */
          border-color: #c0392b; /* Change the button border color on hover to your desired color */
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

      /* Styles for card title and description */
      .card-title {
          font-size: 1.5rem;
          font-weight: bold;
      }

      .card-text {
          font-size: 1.2rem;
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

.welcome-text h1 {
    animation: slideIn 59s ease-in-out;
    -webkit-animation: slideIn 20s ease-in-out;
}

      
  </style>
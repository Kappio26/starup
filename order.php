<?php
session_start();
require_once('include/Connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Cuci Motor & Mobil Panggil Kerumah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/lightbox.css">
    <link type="text/css" rel="stylesheet" href="css/cm-overlay.css" />
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
    <link href="css/styleeee.css" rel="stylesheet" type="text/css" media="all" />
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Sintony:400,700&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/7.png" type="image/x-icon">


    <!-- Add the Google Fonts link for Pacifico -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- Sertakan Font Awesome -->
    <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        #map {
            height: 300px;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="bg-image">
        <div class="overlay"></div>
        <nav class="navbar navbar-expand-lg navbar-light bg-teal">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
    <i class="fas fa-clipboard-list"></i> BUAT PESANAN
</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
      <li class="nav-item">
    <a class="nav-link" href="welcome.php">
        <i class="fas fa-home"></i> Beranda
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="order.php">
        <i class="fas fa-shopping-cart"></i> Order
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="orderansaya.php">
        <i class="fas fa-clipboard-check"></i> Cek Pesanan
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="gantipass.php">
        <i class="fas fa-pencil-alt"></i> Edit Profil
    </a>
</li>
        <li class="d-flex align-items-center">
    <a onclick="confirmLogout()" class="btn btn-link logout-button" style="color: white;"><i class="fas fa-sign-out-alt"></i></a>
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
<!-- Card 1 -->
<div class="container mt-3">
    <div class="row justify-content-center" style="margin-top: 100px; margin-bottom: 100px">
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card">
                    <img src="images/mobil.jpg" class="card-img-top" alt="..." style="width: 500px; height: auto; border-radius:10px">

                    <div class="card-body">
                        <h5 class="card-title">CUCI MOBIL</h5>
                        <p class="card-text">Paket Cuci Mobil untuk Tampilan Optimal!</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="cuciMobil">
                       Pesan Sekarang
                        </button>

                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-sm-6">
                <div class="card">
                    <img src="images/motor.jpg" class="card-img-top" alt="..." style="width: 500px; height: auto; border-radius:10px">
                    <div class="card-body">
                        <h5 class="card-title">CUCI MOTOR</h5>
                        <p class="card-text">Paket Cuci Motor untuk Tampilan Optimal!</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="cuciMotor">
                       Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
            <?php
                $username = $_SESSION['username'];

                $query="SELECT * FROM user_login WHERE username='$username'";
                $result = $db->query($query);
                $row = $result->fetch_assoc()
            ?>
            <input type="hidden" name="lat" value="<?= $row['lat'] ?>" id="latHide">
            <input value="<?= $row['lon'] ?>" type="hidden" name="lon" id="lonHide">
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pesan Sekarang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            <div id="map" class="mb-3"></div>
                <!-- Form inside the modal body -->
                <form method='post' action="insertPesanan.php">
                <div>
                <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= $row["alamat"] ?></textarea>
                    <div id="map"></div>
                   
                </div>
                <input type="hidden" class="" name="lat" id="lat">
                <input type="hidden" class="" name="lon" id="lon">
                    <div class="mb-3" style="margin-top:-300px;">
                        <label for="name" class="form-label">Nama</label>
                        <input type="textfield" class="form-control" id="name" placeholder="Masukkan nama Anda "name="nama" value="<?= $row["nama"]?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor HP</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Masukkan nomor HP Anda" name="no_hp" value="<?= $row["no_hp"]?>">
                    </div>
                    <div class="mb-3">
                        <label for="package" class="form-label">Jenis Paket Cuci</label>
                        <!-- <select class="form-select" id="package">
                            <option value="mobil">Cuci Mobil</option>
                            <option value="motor">Cuci Motor</option>
                        </select> -->
                        <input type="textfield" class="form-control" id="cuci" placeholder="" name="namapaket" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="textfield" class="form-control" id="price" placeholder=""name="harga" readonly>
                    </div>
                                        <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Jam Order 08.00 - 16:00 (Setiap Hari)</label>
                        <input type="time" class="form-control" value="<?=  date('H:i') ?>" name="time">
                    </div>

                    <!-- Add other form fields as needed -->

                    <!-- Buttons to close and submit the form -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" onclick="submitForm()">Pesan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
                            
                            ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script>
        // Initialize the map
        
        var lonHide = document.getElementById('lonHide').value
        var latHide = document.getElementById('latHide').value
        // -5.140386934187952, 119.41857373941184
        if(lonHide == '') {
            lonHide = 119.41857373941184
            latHide = -5.140386934187952
        }
        var map = L.map('map').setView([latHide, lonHide], 13);


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

            getAddress(latHide,lonHide)
        

        // Add a tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        var marker = L.marker([latHide, lonHide]).addTo(map);
        // Add a marker
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
        

        // Invalidate map size when the modal is shown
        $('#exampleModal').on('shown.bs.modal', function () {
            map.invalidateSize();
            
            // $('#map').hide();
            setTimeout(() => {
                // $('#map').css('display', 'none');

            },3000);
        });
    </script>
<script>
var currentDate = new Date().toISOString().split('T')[0];
        var currentTime = new Date().toTimeString();
        document.getElementById('date').value = currentDate;
        // document.getElementById('time').value = currentTime;

        var buttonMobil = document.getElementById('cuciMobil');
        var buttonMotor = document.getElementById('cuciMotor');
        var textField = document.getElementById('cuci');
        var harga = document.getElementById('price');

    // Menambahkan event listener untuk menanggapi klik tombol
        buttonMobil.addEventListener('click', function() {
        // Mengubah nilai input teks
        textField.value = 'Cuci Mobil';
        harga.value = '50.000'
    });

    buttonMotor.addEventListener('click', function() {
        // Mengubah nilai input teks
        textField.value = 'Cuci Motor';
        harga.value = '25.000'
    });
</script>
</body>
<style>
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
            font-weight: bold;
            color: white ;
            font-size: 20px;
        }
        .btn-primary {
    background-color: #008080; /* Warna Teal */
    border-color: #008080; /* Warna Teal */
    font-size: 1.6rem;
}

.btn-primary:hover {
    background-color: #006666; /* Warna Teal yang lebih gelap */
    border-color: #006666; /* Warna Teal yang lebih gelap */
}
.card-title {
    font-size: 2rem;
    font-weight: bold;
    color: #008080; /* Warna Teal */
}

.card-text {
    font-size: 1.6rem;
}


    .card-img-top {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .bg-teal {
        background-color: #008080; /* Teal color code */
    }
    .card {
    display: grid;
    place-items: center;
    text-align: center;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
    padding: 20px;
}

    
</style>

</html>
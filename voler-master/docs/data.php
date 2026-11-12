    <?php
    session_start();
    include(__DIR__ . '/../../include/Connection.php');
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <title>ADMIN</title>
        
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

        <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
        <link rel="stylesheet" href="assets/css/app.css">
        <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <style>
            #map{
                height: 400px;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <div id="sidebar" class='active'>
                <div class="sidebar-wrapper active">
        <div class="sidebar-menu">
            <ul class="menu">
                
                
                    <li class='sidebar-title'>Menu</li>

                    <li class="sidebar-item active ">
                        <a href="index.php" class='sidebar-link'>
                            <i data-feather="home" width="20"></i> 
                            <span>Dashboard</span>
                        </a>
                        
                    </li>
                    <li class='sidebar-title'>Tabel</li>
                
                
                
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i data-feather="file-text" width="20"></i> 
                            <span>Tabel Data Pegawai</span>
                        </a>
                        
                        <ul class="submenu ">

                            <li>
                                <a href="data.php">Data pegawai</a>
                                <a href="statistik.php">Statistik pegawai</a>
                            </li>

                        </ul>
                    <li class="sidebar-item  ">
                        <a href="pesanan.php" class='sidebar-link'>
                            <i data-feather="file-plus" width="20"></i> 
                            <span>Pesanan</span>
                        </a>
                        
                    </li>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
            <div id="main">
                <nav class="navbar navbar-header navbar-expand navbar-light">
                    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                    <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                            <li class="dropdown nav-icon">
                                <a href="#" data-toggle="dropdown" class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                                    <div class="d-lg-inline-block">
                                        <i data-feather="bell"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-large">
                                    <h6 class='py-2 px-4'>Notifications</h6>
                                    <ul class="list-group rounded-none">
                                        <li class="list-group-item border-0 align-items-start">
                                            <div class="avatar bg-success mr-3">
                                                <span class="avatar-content"><i data-feather="shopping-cart"></i></span>
                                            </div>
                                            <div>
                                                <h6 class='text-bold'>New Order</h6>
                                                <p class='text-xs'>
                                                    An order made by Ahmad Saugi for product Samsung Galaxy S69
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown nav-icon mr-2">
                                <a href="#" data-toggle="dropdown" class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                                    <div class="d-lg-inline-block">
                                        <i data-feather="mail"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                    <a class="dropdown-item active" href="#"><i data-feather="mail"></i> Messages</a>
                                    <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i data-feather="log-out"></i> Logout</a>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                    <div class="avatar mr-1">
                                        <img src="assets/images/avatar/avatar-s-1.png" alt="" srcset="">
                                    </div>
                                    <div class="d-none d-md-block d-lg-inline-block">Hi, Saugi</div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                    <a class="dropdown-item active" href="#"><i data-feather="mail"></i> Messages</a>
                                    <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i data-feather="log-out"></i> Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Pegawai</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Datatable</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>Nama Pegawai</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPegawaiModal">
                            Tambah Pegawai
                        </button>
                        <div class="modal fade" id="tambahPegawaiModal" tabindex="-1" role="dialog" aria-labelledby="tambahPegawaiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPegawaiModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="tambahPegawaiForm">
                        <div class="form-group">
                            <label for="namaPegawai">Nama Pegawai:</label>
                            <input type="text" class="form-control" id="namaPegawai" name="nama_pegawai" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                            
                        </div>
                        <div id="map"></div>
                        <div class="form-group">
                            <label for="noTelp">Nomor Telepon:</label>
                            <input type="tel" class="form-control" id="noTelp" name="no_telp" required>
                        </div>
                        <!-- Add other fields as needed -->

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
                        <?php
                    // Memulai sesi

                    // Meng-include file koneksi

                    // Query SQL untuk mengambil data dari database
                    $sql="SELECT * FROM pesanan WHERE status_order = 'selesai'";
                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nama_pegawai"] . "</td>";
                        echo "<td>" . $row["alamat"] . "</td>";
                        echo "<td>" . $row["no_telp"] . "</td>";
                    }
                    }
                    ?>
                        
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>

                <footer>    
                    </div>
                </footer>
            </div>
        </div>
        <script src="assets/js/feather-icons/feather.min.js"></script>
        <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="assets/js/app.js"></script>
        
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/js/vendors.js"></script>

        <script src="assets/js/main.js"></script>
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            // Inisialisasi peta
            var map = L.map('map').setView([-5.147665, 119.432732], 10); // Koordinat Makassar, Sulawesi Selatan

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
            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lon = e.latlng.lng;

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
    </body>
    </html>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuci Motor & Mobil Panggil Kerumah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/lightbox.css">
  <link rel="stylesheet" href="css/cm-overlay.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Sintony:400,700&amp;subset=latin-ext" rel="stylesheet">
  <link rel="shortcut icon" href="images/7.png" type="image/x-icon">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <style>
    /* Custom styles */
    .bg-teal {
      background-color: #008080 !important;
    }

    .navbar {
      background-color: #008080;
      height: 70px;
    }

    .navbar-nav .nav-link {
      color: white !important;
      font-weight: bold;
    }

    .navbar-brand {
      font-family: "Verdana";
      font-weight: bold;
      color: white;
      font-size: 28px; /* Ubah ukuran font logo */
    }

    .navbar-brand img {
      width: 100px; /* Ubah lebar gambar logo */
      height: 100px; /* Ubah tinggi gambar logo */
      margin-right: 10px; /* Tambah margin kanan untuk memberi ruang antara logo dan teks */
    }

    .navbar-brand span {
      font-size: 24px; /* Ubah ukuran font teks */
      margin-left: 10px; /* Tambah margin kiri untuk memisahkan teks dari logo */
    }

    .bg-image {
      background-image: url('images/4.jpg');
      background-position: center;
      background-size: cover;
      position: relative;
      z-index: 0;
      height: 100vh;
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: -1;
    }

    .welcome-text {
      color: white;
      font-size: 48px;
      font-weight: bold;
      margin-top: 20vh;
      text-align: center;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    }

    /* Tambahkan gaya untuk navbar agar mencapai sudut kiri dan kanan */
    .container {
      padding-right: 15px;
      padding-left: 15px;
      margin-right: auto;
      margin-left: auto;
    }

    .navbar {
      border-radius: 0;
    }

    .navbar-toggler {
      color: rgba(255, 255, 255, 0.5);
      border-color: rgba(255, 255, 255, 0.1);
    }

    .navbar-nav .nav-link {
      padding-right: 20px;
      padding-left: 20px;
    }

    .navbar-brand {
      padding-right: 0;
      margin-right: 0;
    }
  </style>
</head>

<body>
  <div class="bg-image">
    <div class="overlay"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-teal">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="images/lgo.png" width="100" height="100" class="d-inline-block align" alt="Logo">
          <span>Cuci Motor & Mobil Panggil Kerumah</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="welcome.php"><i class="fas fa-home"></i> Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="order.php"><i class="fas fa-shopping-cart"></i> Pesan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="orderansaya.php"><i class="fas fa-clipboard-check"></i> Cek Pesanan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="gantipass.php"><i class="fas fa-pencil-alt"></i> Edit Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Keluar</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <h2 class="welcome-text">Selamat Datang</h2>
    </div>
  </div>

  <script>
    function confirmLogout() {
      var confirmLogout = confirm("Apakah Anda ingin keluar?");
      if (confirmLogout) {
        window.location.href = "logout.php";
      }
    }
  </script>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
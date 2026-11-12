<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Cuci Kendaraan Panggil Kerumah</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/styleeee.css" rel="stylesheet" type="text/css" media="all">
    <!-- Google Fonts -->
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Sintony:400,700&amp;subset=latin-ext" rel="stylesheet">
    <!-- Lightbox CSS -->
    <link rel="stylesheet" href="css/lightbox.css">
    <!-- Overlay CSS -->
    <link type="text/css" rel="stylesheet" href="css/cm-overlay.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/7.png" type="image/x-icon">
    <!-- Bootstrap JS (with Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-eUH5DokL/CZWWKN62sO5djPJVc7xoo8j1IpguTr/uF5+5qQSpRIID8W7C5K4lEv" crossorigin="anonymous"></script>
    <!-- Google Fonts for Pacifico -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <style>
        /* General */
        body {
            font-family: 'Roboto Condensed', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Navbar */
        .navbar {
            background-color: #008080;
            height: 70px;
        }

        .navbar-brand {
            color: white;
            font-family: 'Verdana', cursive;
            font-weight: bold;
            font-size: 24px;
        }

        .navbar-toggler-icon {
            background-color: white;
        }

        .navbar-nav .nav-link {
            color: white;
            font-weight: bold;
        }

        /* Home Section */
        #home {
            background: url('images/gambar1.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 300px 0;
        }

        .welcome-text {
            font-family: 'Cambria';
            color: black;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            white-space: nowrap;
            overflow: hidden;
        }

        .motto-text {
            font-family: 'Roboto Condensed', sans-serif;
            color: white;
            font-size: 24px;
            margin-top: 10px;
            text-align: center;
            text-shadow: 2px 2px 4px black;
        }

        /* About Section */
        .about {
            margin-top: 50px;
            padding: 50px 0;
        }

        .about h3 {
            text-align: center;
        }

        /* Services Section */
        .services {
            margin-top: 50px;
            padding: 50px 0;
        }

        .layanan h3 {
            text-align: center;
            margin-bottom: 50px;
        }

        .layanan .row {
            justify-content: center;
        }

        .col-md-6 {
            text-align: center;
            margin-bottom: 50px;
        }

        .img-fluid {
            width: 200px; /* Sesuaikan lebar gambar */
            height: 200px; /* Sesuaikan tinggi gambar */
            border-radius: 50%;
        }

        /* Contact Section */
        .contact {
            background-color: #f8f9fa;
            padding: 80px 0;
        }

        .contact h3 {
            color: #343a40;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 50px;
            text-align: center;
        }

        .contact-detail {
            margin-bottom: 30px;
            display: flex;
            text-align: center;
        }

        .contact-detail i {
            font-size: 24px;
            color: #008080;
            margin-right: 10px;
        }

        .contact-detail p {
            font-size: 18px;
            color: #343a40;
            margin: 0;
        }

        /* Footer */
        footer {
            padding: 10px;
            background-color: #f8f9fa;
            text-align: center;
        }

        .watermark {
            font-size: 12px;
            color: #808080; /* Warna abu-abu muda, dapat disesuaikan dengan preferensi Anda */
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-teal sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="font-weight: bold;">
                <i class="fas fa-car"></i> APLIKASI CUCI MOTOR & MOBIL
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">
                            <i class="fas fa-home"></i> <span class="icon-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <i class="fas fa-key"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">
                            <i class="fas fa-book"></i> Tentang Kami
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">
                            <i class="fas fa-cogs"></i> Layanan Kami
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">
                            <i class="fas fa-envelope"></i> Kontak
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="home">
        <div class="container">
            <h2 class="welcome-text">SELAMAT DATANG</h2>
            <p class="motto-text">Nikmati Kemudahan Cuci Motor & Mobil Tanpa Harus Keluar Rumah Bersama Kami.</p>
        </div>
    </div>

    <div id="about" class="about">
        <div class="features" id="features">
            <div class="container">
                <h3>Tentang Kami</h3>
                <div class="tittle_head_w3layouts">
                    <p>Aplikasi cuci kendaraan adalah sebuah platform digital yang dirancang untuk memudahkan pemilik kendaraan dalam mencari dan memesan layanan cuci kendaraan dengan lebih praktis.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="services" class="services">
        <div class="container">
            <div class="layanan" id="layanan">
                <h3 class="text-center mb-5">Layanan Kami</h3>
                <div class="row">
                    <div class="col-md-6 text-center mb-5">
                        <div class="mb-4">
                            <img src="images/mobil.jpg" class="img-fluid rounded-circle" alt="Layanan 1">
                            <p class="mt-2"><strong>Cuci Mobil</strong></p>
                        </div>
                        <p>
                            Layanan cuci mobil kami memberikan perawatan khusus untuk kendaraan roda empat Anda.
                            Dengan menggunakan produk pembersih berkualitas tinggi, kami menjamin mobil Anda bersih dan kinclong.
                        </p>
                    </div>
                    <div class="col-md-6 text-center mb-5">
                        <div class="mb-4">
                            <img src="images/motor.jpg" class="img-fluid rounded-circle" alt="Layanan 2">
                            <p class="mt-2"><strong>Cuci Motor</strong></p>
                        </div>
                        <p>
                            Layanan cuci motor kami dirancang untuk merawat dan membersihkan sepeda motor Anda dengan teliti.
                            Tim kami yang ahli akan memberikan perawatan maksimal untuk menjaga penampilan sepeda motor Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="contact" class="contact">
        <div class="container">
            <h3 class="text-center mb-5">Kontak Kami</h3>
            <div class="row">
                <div class="col-md-6">
                    <!-- Contact details -->
                    <div class="contact-detail">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Alamat Kami<br>Jl. Poros Kariango No. 100, Maros</p>
                    </div>
                    <div class="contact-detail">
                        <i class="fas fa-phone"></i>
                        <p>Nomor Telepon<br>+6281242803805</p>
                    </div>
                    <div class="contact-detail">
                        <i class="fas fa-envelope"></i>
                        <p>Email<br>ZulQahfi26@Gmail.com</p>
                    </div>
                    <div class="contact-detail">
                        <i class="fab fa-instagram"></i>
                        <p>Instagram<br>@kappii26</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- You can keep this space for additional content or any other information -->
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="watermark">
            <p>@ Dibuat oleh ZulQahfi Japil 215030</p>
        </div>
    </footer>

</body>

</html>
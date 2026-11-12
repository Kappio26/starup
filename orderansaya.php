<?php
session_start();
include 'include/Connection.php';

// Cek apakah session username sudah ada atau belum
if (!isset($_SESSION['username'])) {
    // Jika tidak ada session username, bisa diarahkan ke halaman login atau tampil pesan kesalahan
    // Contoh: header("Location: login.php");
    echo "Session username not set. Redirect or show error message.";
    exit;
}

// Mengambil nilai entries_per_page dari URL
$entriesPerPage = isset($_GET['entries_per_page']) ? intval($_GET['entries_per_page']) : 10; // Nilai default: 10

// Prepared statement untuk menghitung jumlah total entri
$username = $_SESSION['username'];
$queryTotalEntries = "SELECT COUNT(*) as total FROM pesanan WHERE username=?";
$stmt = $db->prepare($queryTotalEntries);
$stmt->bind_param("s", $username);
$stmt->execute();
$totalEntriesResult = $stmt->get_result();
$totalEntriesRow = $totalEntriesResult->fetch_assoc();
$totalEntries = $totalEntriesRow['total'];

// Menghitung jumlah halaman
$totalPages = ceil($totalEntries / $entriesPerPage);

// Mengambil nomor halaman dari URL
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Menghitung offset untuk query
$offset = ($currentPage - 1) * $entriesPerPage;

// Prepared statement untuk mengambil data pesanan dari database
$query = "SELECT * FROM pesanan WHERE username=? LIMIT ? OFFSET ?";
$stmt = $db->prepare($query);
$stmt->bind_param("sii", $username, $entriesPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Cuci Motor & Mobil Panggil Kerumah</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/lightbox.css">
    <link type="text/css" rel="stylesheet" href="css/cm-overlay.css" />
    <link href="css/styleeee.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="images/7.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <!-- JavaScript -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-wV8ihJwCx7ZcCFBt6LqfSFJ6Bbo4fJ9ZqL/JnqjCLvIc8y9OinrP2AUKR6R7ff2"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-c13zDrhrWY9Jlr5KBEu89/J6e9R+AdBcO6oFp2lViUhSe3B62n0pHbhG6a9WGOoS"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"
        integrity="sha512-NBy2htO8b7+U3GCYXotRm32RIBgkg6oMBGt4Xa9cZrDxunB1/s/C+bHci6Z6Mn49zW5Lfs0t6/t3Hu6bWIS4ew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-uQIvXZf6j/2q61tjvx+62J5xFTdNlLvYfai8FdtTp4M=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="bg-image">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-teal">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-clipboard-check"></i> CEK PESANAN
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                            <a onclick="confirmLogout()" class="btn btn-link logout-button"
                                style="color: white;"><i class="fas fa-sign-out-alt"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        <!-- Dropdown untuk jumlah entri per halaman -->
        <label for="entriesPerPage">Entri Per Halaman:</label>
        <select id="entriesPerPage" onchange="changeEntriesPerPage()">
            <option value="5" <?php if ($entriesPerPage == 5) echo 'selected'; ?>>5</option>
            <option value="10" <?php if ($entriesPerPage == 10) echo 'selected'; ?>>10</option>
            <option value="20" <?php if ($entriesPerPage == 20) echo 'selected'; ?>>20</option>
            <!-- Tambahkan nilai-nilai lain sesuai kebutuhan Anda -->
        </select>

        <!-- Tabel untuk menampilkan pesanan -->
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Waktu & Tanggal Order</th>
                    <th>Status</th>
                    <th>Nama Pegawai</th>
                    <th>Batal</th>
                    <th>Bayar</th>
                    <th>Cetak Struk</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Output data dari setiap baris
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["nama_paket"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["harga"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["waktu_order"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["status_order"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["nama_pegawai"]) . "</td>";

                    if ($row['status_order'] == 'pending') {
                        echo "<td><a href='batal.php?id=" . $row['id_order'] . "' onclick='return confirmBatal()' class='btn btn-sm btn-danger'>Batal</a></td>";
                        echo "<td><a href='bayar.php?id=" . $row['id_order'] . "' onclick='return confirmBayar()' class='btn btn-sm btn-success'>Bayar</a></td>";
                    } else {
                        echo "<td></td>";
                        echo "<td></td>";
                    }

                    if ($row['status_order'] == 'selesai') {
                        echo "<td><button onclick=\"showCetakStrukModal(" . $row['id_order'] . ", '" . htmlspecialchars($row['username']) . "', '" . htmlspecialchars($row['nama_paket']) . "', '" . htmlspecialchars($row['harga']) . "', '" . htmlspecialchars($row['waktu_order']) . "', '" . htmlspecialchars($row['status_order']) . "', '" . htmlspecialchars($row['nama_pegawai']) . "')\" class='btn btn-sm btn-info'>Cetak Struk</button></td>";
                    } else {
                        echo "<td></td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class='pagination'>
            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='orderansaya.php?page=$i&entries_per_page=$entriesPerPage'>$i</a> ";
            }
            ?>
        </div>
    </div>

    <!-- Modal untuk cetak struk -->
    <div class="modal fade" id="cetakStrukModal" tabindex="-1" aria-labelledby="cetakStrukModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cetakStrukModalLabel">Detail Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="modalUsername" class="form-label">Username:</label>
                        <span id="modalUsername"></span>
                    </div>
                    <div class="mb-3">
                        <label for="modalNamaPaket" class="form-label">Nama Paket:</label>
                        <span id="modalNamaPaket"></span>
                    </div>
                    <div class="mb-3">
                        <label for="modalHarga" class="form-label">Harga:</label>
                        <span id="modalHarga"></span>
                    </div>
                    <div class="mb-3">
                        <label for="modalWaktuOrder" class="form-label">Waktu & Tanggal Order:</label>
                        <span id="modalWaktuOrder"></span>
                    </div>
                    <div class="mb-3">
                        <label for="modalStatus" class="form-label">Status:</label>
                        <span id="modalStatus"></span>
                    </div>
                    <div class="mb-3">
                        <label for="modalNamaPegawai" class="form-label">Nama Pegawai:</label>
                        <span id="modalNamaPegawai"></span>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="cetakStruk()">Cetak</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showCetakStrukModal(idOrder, username, namaPaket, harga, waktuOrder, statusOrder, namaPegawai) {
            document.getElementById('modalUsername').textContent = username;
            document.getElementById('modalNamaPaket').textContent = namaPaket;
            document.getElementById('modalHarga').textContent = harga;
            document.getElementById('modalWaktuOrder').textContent = waktuOrder;
            document.getElementById('modalStatus').textContent = statusOrder;
            document.getElementById('modalNamaPegawai').textContent = namaPegawai;

            // Set idOrder pada input hidden di modal
            document.getElementById('idOrder').value = idOrder;

            $('#cetakStrukModal').modal('show');
        }

        function cetakStruk() {
            // Ambil idOrder dari input hidden
            var idOrder = document.getElementById('idOrder').value;

            // Implementasi cetak struk (contoh: redirect ke halaman cetak)
            window.location.href = 'cetak_struk.php?id=' + idOrder;
        }

        function changeEntriesPerPage() {
            var entriesPerPage = document.getElementById('entriesPerPage').value;
            window.location.href = 'orderansaya.php?page=1&entries_per_page=' + entriesPerPage;
        }
    </script>
</body>

</html>

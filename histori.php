<?php
session_start();

// Memulai sesi

// Include file koneksi
include 'include/Connection.php';

// Ambil username dari session
$username = $_SESSION['username'];

// Query SQL untuk mengambil data pesanan yang status_order-nya 'selesai'
$query = "SELECT * FROM pesanan WHERE status_order = 'selesai'";
$result = $db->query($query);
?>
<h1>Riwayat Pesanan Selesai</h1>
<table>
    <thead>
        <tr>
            <th>Nama Pelanggan</th>
            <th>Nama Paket</th>
            <th>Harga</th>
            <th>Waktu & Tanggal Order</th>
            <!-- Tambahkan kolom lain sesuai kebutuhan -->
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["nama_paket"] . "</td>";
                echo "<td>" . $row["harga"] . "</td>";
                echo "<td>" . $row["waktu_order"] . "</td>";
                // Tambahkan kolom lain sesuai kebutuhan
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada pesanan selesai.</td></tr>";
        }
        ?>
    </tbody>
</table>
<?php
// Include the database connection file
include 'include/Connection.php';

// Retrieve order details based on the provided order ID
if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    $query = "SELECT * FROM pesanan WHERE id_order = $orderId";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Get relevant information from the order
        $username = $row["username"];
        $namaPaket = $row["nama_paket"];
        $harga = $row["harga"];
        $waktuOrder = $row["waktu_order"];
        $statusOrder = $row["status_order"];
        $namaPegawai = $row["nama_pegawai"];

        // Close the database connection
        $db->close();
    } else {
        // Redirect or handle the case where the order is not found
        header('Location: orderansaya.php');
        exit();
    }
} else {
    // Redirect or handle the case where order ID is not provided
    header('Location: orderansaya.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .receipt {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        h2 {
            text-align: center;
        }

        .receipt-info {
            margin-top: 10px;
        }

        .receipt-info p {
            margin: 5px 0;
        }

        .print-button {
            text-align: center;
            margin-top: 20px;
        }

        .print-button button,
        .back-button button {
            padding: 10px;
            background-color: #008B8B;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .back-button {
            text-align: center;
            margin-top: 10px;
        }.btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-primary,
        .btn-secondary {
            width: 48%; /* Adjust the width as needed */
        }
        
    </style>
</head>
<body>
    <div class="receipt">
        <h2>Kuitansi</h2>
        <div class="receipt-info">
            <p><strong>Nama Pelanggan:</strong> <?php echo $username; ?></p>
            <p><strong>Nama Paket:</strong> <?php echo $namaPaket; ?></p>
            <p><strong>Harga:</strong> <?php echo $harga; ?></p>
            <p><strong>Waktu & Tanggal Order:</strong> <?php echo $waktuOrder; ?></p>
            <p><strong>Status Order:</strong> <?php echo $statusOrder; ?></p>
            <p><strong>Nama Pegawai:</strong> <?php echo $namaPegawai; ?></p>
        </div>
        <div class="btn-container">
    <button onclick="printReceipt()" class="btn btn-sm btn-info btn-primary">Print Struk</button>
    <button onclick="goBack()" class="btn btn-sm btn-default btn-secondary">Kembali</button>
</div>
    </div>

<script>
    function printReceipt() {
        window.print();
    }

    function goBack() {
        window.location.href = 'orderansaya.php';
    }
</script>
</body>
</html>

<?php
session_start();

include 'include/Connection.php';

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Update status to 'selesai' in the database
    $updateQuery = "UPDATE pesanan SET status_order = 'selesai' WHERE id_order = $orderId";
    $result = $db->query($updateQuery);

    if ($result) {
        // Success message or redirect to prevent re-submission
        header('Location: pegawai.php');
        exit();
    } else {
        // Handle update failure
        echo "Update failed: " . $db->error;
    }
} else {
    echo "Order ID not specified.";
}

$db->close();
?>

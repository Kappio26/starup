<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session.
    session_destroy();

    // Redirect to the login page
    header("location:index.php");
    exit(); // Ensure that no further code is executed after the redirect
} else {
    // If the user is not logged in, you may want to handle it accordingly
    echo '<script>alert("You are not logged in.");</script>';
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your head content -->
</head>

<body>
    <!-- Your HTML content -->

 
    
    <!-- Optionally, you can have a button or link to trigger the logout -->

</body>

</html>

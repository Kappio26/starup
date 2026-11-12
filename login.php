<?php
session_start();
include 'include/Connection.php';
error_reporting(0);

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Check if the username exists
    $check_user = "SELECT * FROM user_login WHERE username='$username'";
    $user_result = $db->query($check_user);

    if ($user_result && $user_result->num_rows > 0) {
        // If username exists, check for correct password
        $sql = "SELECT * FROM user_login WHERE username='$username' AND password='$password'";
        $result = $db->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['level'] = $row['level_user'];

            // Tentukan URL pengalihan berdasarkan level pengguna
            $redirect_url = '';
            if ($row['level_user'] == 'user') {
                $redirect_url = 'welcome.php';
            } elseif ($row['level_user'] == 'admin') {
                $redirect_url = 'voler-master/docs/index.php';
            } elseif ($row['level_user'] == 'pegawai') {
                $redirect_url = 'pegawai.php';
            }

            // Tampilkan alert dan redirect menggunakan JavaScript
            echo "<script>
                    alert('Anda berhasil login');
                    window.location.href = '$redirect_url';
                  </script>";
            exit();
        } else {
            echo "<script>alert('Woops! Email atau Password anda salah.');</script>";
        }
    } else {
        echo "<script>alert('Anda belum mempunyai akun, silahkan registrasi terlebih dahulu.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="stylee.css">

    <title>Login</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="text" placeholder="username" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="password" name="password" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Belum punya akun? <a href="register.php">Buat Akun</a>.</p>
            <p class="login-register-text"><a href="index.php">Kembali ke home</a>.</p>
        </form>
    </div>

</body>
</html>

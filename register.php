<?php

include 'include/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari formulir
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengubah password menjadi MD5
    $password = md5($password);

    // Menyimpan data ke database
    $sql = "INSERT INTO user_login (nama, alamat, no_hp, username, Password,level_user)
            VALUES ('$nama', '$alamat', '$no_hp', '$username', '$password','user')";

    if ($db->query($sql) === TRUE) {
        echo "<script>alert('Pendaftaran Berhasil !');</script>";
        // header('Location: login.php');
        echo '<script>window.location.href = "login.php";</script>';
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    $db->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="stylee.css">

	<title>Register</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Nama Anda" name="nama" required>
			</div>
            <div class="input-group">
				<input type="text" placeholder="Alamat Anda" name="alamat" required>
			</div>
            <div class="input-group">
				<input type="text" placeholder="Nomor Handphone " name="no_hp" required>
			</div>
            <div class="input-group">
				<input type="text" placeholder="Username" name="username" required>
			</div>
            <div class="input-group">
				<input type="password" placeholder="Password anda" name="password"  required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Sudah punya akun? <a href="login.php">Login</a>.</p>
            <p class="login-register-text"><a href="index.php">Kembali ke home</a>.</p>
		</form>
	</div>
</body>
</html>

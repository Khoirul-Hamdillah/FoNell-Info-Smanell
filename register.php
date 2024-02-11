<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $nama_lengkap = $_POST["nama_lengkap"];
    $nisn = $_POST["nisn"];
    $kelas = $_POST["kelas"];
    $nomor_hp = $_POST["nomor_hp"];

    $stmt = $conn->prepare("INSERT INTO users (username, password, nama_lengkap, nisn, kelas, nomor_hp) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $username, $password, $nama_lengkap, $nisn, $kelas, $nomor_hp);
    $stmt->execute();
    $stmt->close();

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Registrasi</title>
</head>
<body>
    <h2>Daftar Siswa</h2>
<div class="container"> 
    <form method="post" action="register.php">       
        <input type="text" placeholder="Username" name="username" required>
        <br>
        <input type="password" placeholder="Password" name="password" required>
        <br>
        <input type="text" placeholder="Nama Lengkap" name="nama_lengkap" required>
        <br>
        <input type="number" placeholder="NISN" name="nisn" required>
        <br>
        <input type="text" placeholder="Kelas (Ex : XII MIPA 6)" name="kelas">
        <br>
        <input type="number" placeholder="Nomor HP" name="nomor_hp">
        <br>
        <button type="submit" name="register" value="Daftar">Daftar</button>
    </form>
</div>
</body>
</html>

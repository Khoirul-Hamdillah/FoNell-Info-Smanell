<?php
include 'koneksi.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $dbUsername, $dbPassword);

    if ($stmt->fetch() && password_verify($password, $dbPassword)) {
        $_SESSION["user_id"] = $id;
        $_SESSION["username"] = $dbUsername;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Login gagal. Periksa kembali username dan password.')</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <div class="container">
    <form method="post" action="login.php">
        <input type="text" placeholder="Username" name="username" required>
        <br>
        <input type="password" placeholder="Password" name="password" required>
        <br>
        <button type="submit" name="login" value="Login">Login</button>
    </div>    
</form>
</body>
</html>

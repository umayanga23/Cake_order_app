<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'cakee';
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = mysqli_real_escape_string($conn, $_POST['loginEmail']);
$password = mysqli_real_escape_string($conn, $_POST['loginPassword']);
$remember = isset($_POST['remember']) ? $_POST['remember'] : '';

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        header("Location: home.html");
        exit();
    } else {
        echo "Invalid email or password";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

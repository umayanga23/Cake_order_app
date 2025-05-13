<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'cakee';
$conn = mysqli_connect($host, $username, $password, $database);

if ($conn) {
    echo("Connected");



    @$email = $_POST['email'];
    @$password = $_POST['password'];
    @$confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match";
        exit();
    }

    // Check if the email is already registered
    $check_sql = "SELECT * FROM users WHERE email='$email'";
    

    if ($check_sql === $email) {
        echo "Email is already registered";
        exit();
    }

    // Insert the new user into the database
    $insert_sql = "INSERT INTO `users` (`email`, `password`) VALUES ('$email', '$password')";
    $insert_resul = mysqli_query($conn,$insert_sql);

    if ($insert_resul) {
        echo "User registered successfully";
        // Redirect to home page or any other page
        header("Location: index.html");
        exit();
    } else {
        echo "Error registering user";
    }
}
else {
    echo "";
    echo "---Error connection---";
}

$conn->close();
?>
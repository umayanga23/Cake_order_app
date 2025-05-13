<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'cakee';

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn) {
    echo "Connected to the database "; // Added semicolon at the end

    @$name=$_POST['name'];
    @$email=$_POST['email'];
    @$massege=$_POST['message'];
 
    $insert="INSERT INTO `contact`(`name`, `email`, `message`) VALUES ('$name','$email','$massege')";
    $result = mysqli_query($conn, $insert);

    if ($result) {
        echo "---Record Added---";
    } else {
        echo "";
        echo "---Record Not Added---";
    }
} else {
    echo "";
    echo "---Error connection---";
}

mysqli_close($conn);
?>
<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'cakee';
$con = mysqli_connect($host, $username, $password, $database);

if ($con) {
    echo "Connected to the database "; // Added semicolon at the end

    $item = isset($_POST['item']) ? $_POST['item'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $fullName = $_POST['fullName'];
    $address = $_POST['address'];
    $contactNumber = $_POST['contactNumber'];
    $size = $_POST['size'];
    $paymentMethod = $_POST['paymentMethod'];
    $deliveryDate = $_POST['deliveryDate'];

    // Fixed variable typo here, changed $ietm to $item
    $insert = "INSERT INTO `orderr`(`item`, `price`, `fullName`, `address`, `contactNumber`, `size`, `paymentMethod`, `deliveryDate`) VALUES ('$item','$price','$fullName','$address','$contactNumber','$size','$paymentMethod','$deliveryDate')";

    $result = mysqli_query($con, $insert);

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
?>

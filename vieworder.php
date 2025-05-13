<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'cakee';

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle Delete Operation
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $stmt = $conn->prepare("DELETE FROM orderr WHERE item = ?");
        $stmt->execute([$id]);
        header("Location: vieworder.php?msg=Order deleted successfully");
        exit();
    }

    // Handle Update Operation
    if(isset($_POST['update'])) {
        $item = $_POST['item'];
        $fullName = $_POST['fullName'];
        $price = $_POST['price'];
        $address = $_POST['address'];
        $contactNumber = $_POST['contactNumber'];
        $size = $_POST['size'];
        $paymentMethod = $_POST['paymentMethod'];
        $deliveryDate = $_POST['deliveryDate'];

        $stmt = $conn->prepare("UPDATE orderr SET fullName = ?, price = ?, address = ?, 
            contactNumber = ?, size = ?, paymentMethod = ?, deliveryDate = ? WHERE item = ?");
        $stmt->execute([$fullName, $price, $address, $contactNumber, $size, $paymentMethod, $deliveryDate, $item]);
        header("Location: vieworder.php?msg=Order updated successfully");
        exit();
    }

    // Fetch Orders
    $stmt = $conn->query("SELECT * FROM orderr ORDER BY deliveryDate DESC");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="style.css">
    <!-- Add boxicons link for social media icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
    /* Container for the table */
    .container {
        width: 95%;
        /* Increased from default */
        max-width: 1800px;
        /* Increased max-width */
        margin: 0 auto;
        padding: 20px;
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        table-layout: fixed;
    }

    .orders-table th,
    .orders-table td {
        padding: 20px;
        border: 1px solid #ddd;
        text-align: left;
        word-wrap: break-word;
        overflow: hidden;
        height: 60px;
        font-size: 14px;
        vertical-align: middle;
    }

    .orders-table th {
        background-color: #f4f4f4;
        font-weight: bold;
        text-transform: uppercase;
        height: 60px;
    }

    /* Set equal widths for all columns */
    .orders-table th,
    .orders-table td {
        width: 180px;
    }

    /* Action buttons container */
    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: center;
        align-items: center;
        height: 100%;
        padding: 0 5px;
    }

    /* Button styles */
    .edit-btn,
    .delete-btn {
        padding: 6px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        min-width: 70px;
        height: 30px;
        font-weight: bold;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .edit-btn {
        background-color: #4CAF50;
        color: white;
    }

    .delete-btn {
        background-color: #f44336;
        color: white;
    }

    .edit-btn:hover {
        background-color: #45a049;
        transform: scale(1.05);
        transition: all 0.2s;
    }

    .delete-btn:hover {
        background-color: #da190b;
        transform: scale(1.05);
        transition: all 0.2s;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        width: 70%;
        max-width: 500px;
    }

    .success-message {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        margin: 10px 0;
        border-radius: 4px;
    }

    .orders-table th:last-child,
    .orders-table td:last-child {
        width: 180px;
    }

    .orders-table th:not(:last-child),
    .orders-table td:not(:last-child) {
        width: calc((100% - 200px) / 8);
    }
    </style>
</head>

<body>
    <!-- Add header with navigation -->
    <header class="header">
        <nav class="nav">
            <ul class="nav_items">
                <li class="nav_item">
                    <a href="home.html" class="nav_link">HOME</a>
                    <a href="cakes.html" class="nav_link">CAKES</a>
                    <a href="about.html" class="nav_link">ABOUT US</a>
                    <a href="order.html" class="nav_link">ORDER NOW</a>
                    <a href="blogs.html" class="nav_link">OUR BLOGS</a>
                    <a href="contact.html" class="nav_link">CONTACT US</a>
                    <a href="vieworder.php" class="nav_link">view order</a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Order Management</h1>

        <?php if(isset($_GET['msg'])): ?>
        <div class="success-message">
            <?php echo htmlspecialchars($_GET['msg']); ?>
        </div>
        <?php endif; ?>

        <div class="table-wrapper">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Customer Name</th>
                        <th>Price</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Size</th>
                        <th>Payment Method</th>
                        <th>Delivery Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['item']); ?></td>
                        <td><?php echo htmlspecialchars($order['fullName']); ?></td>
                        <td><?php echo htmlspecialchars($order['price']); ?></td>
                        <td><?php echo htmlspecialchars($order['address']); ?></td>
                        <td><?php echo htmlspecialchars($order['contactNumber']); ?></td>
                        <td><?php echo htmlspecialchars($order['size']); ?></td>
                        <td><?php echo htmlspecialchars($order['paymentMethod']); ?></td>
                        <td><?php echo htmlspecialchars($order['deliveryDate']); ?></td>
                        <td class="action-buttons">
                            <button class="edit-btn"
                                onclick="openEditModal(<?php echo htmlspecialchars(json_encode($order)); ?>)">
                                EDIT
                            </button>
                            <button class="delete-btn"
                                onclick="deleteOrder('<?php echo htmlspecialchars($order['item']); ?>')">
                                DELETE
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <h2>Edit Order</h2>
                <form id="editForm" method="POST">
                    <input type="hidden" name="item" id="edit_item">

                    <div>
                        <label for="fullName">Customer Name:</label>
                        <input type="text" name="fullName" id="edit_fullName" required>
                    </div>

                    <div>
                        <label for="price">Price:</label>
                        <input type="number" name="price" id="edit_price" required>
                    </div>

                    <div>
                        <label for="address">Address:</label>
                        <input type="text" name="address" id="edit_address" required>
                    </div>

                    <div>
                        <label for="contactNumber">Contact Number:</label>
                        <input type="number" name="contactNumber" id="edit_contactNumber" required>
                    </div>

                    <div>
                        <label for="size">Size:</label>
                        <input type="number" name="size" id="edit_size" required>
                    </div>

                    <div>
                        <label for="paymentMethod">Payment Method:</label>
                        <input type="text" name="paymentMethod" id="edit_paymentMethod" required>
                    </div>

                    <div>
                        <label for="deliveryDate">Delivery Date:</label>
                        <input type="date" name="deliveryDate" id="edit_deliveryDate" required>
                    </div>

                    <button type="submit" name="update">Update Order</button>
                    <button type="button" onclick="closeEditModal()">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add footer -->
    <section class="footer">
        <div class="footer-container container">
            <div class="footer-box">
                <a href="" class="footer-logo">AmRaWa Cakes</a>
                <div class="social">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-youtube'></i></a>
                </div>
            </div>
            <div class="footer-box">
                <h3>Page</h3>
                <a href="home.html">Home</a>
                <a href="cakes.html">Cakes</a>
                <a href="about.html">About Us</a>
                <a href="order.html">Order Now</a>
                <a href="blogs.html">Our Blogs</a>
                <a href="contact.html">Contact</a>
            </div>
            <div class="footer-box">
                <h3>Legal</h3>
                <a href="#">Privacy</a>
                <a href="#">Refund Policy</a>
                <a href="#">Cookies Policy</a>
            </div>
            <div class="footer-box">
                <h3>Contact</h3>
                <p>Phone: 011-767-6564-7676</p>
                <p>Address: 4671 Sugar Camp Road,
                <p>Owatonna, Minnesota,</p>
                <p>55060</p>
                </p>
                <p>Email: amrawa579@gmail.com</p>
            </div>
        </div>
    </section>

    <!-- Copyright -->
    <div class="copyright">
        <p>&#169; CarpoolsVenom All Right Reserved</p>
    </div>

    <script>
    let header = document.querySelector('header');
    window.addEventListener('scroll', () => {
        header.classList.toggle('shadow', window.scrollY > 0);
    });

    function openEditModal(order) {
        document.getElementById('editModal').style.display = 'block';
        document.getElementById('edit_item').value = order.item;
        document.getElementById('edit_fullName').value = order.fullName;
        document.getElementById('edit_price').value = order.price;
        document.getElementById('edit_address').value = order.address;
        document.getElementById('edit_contactNumber').value = order.contactNumber;
        document.getElementById('edit_size').value = order.size;
        document.getElementById('edit_paymentMethod').value = order.paymentMethod;
        document.getElementById('edit_deliveryDate').value = order.deliveryDate;
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function deleteOrder(id) {
        if (confirm('Are you sure you want to delete this order?')) {
            window.location.href = `vieworder.php?delete=${id}`;
        }
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target == document.getElementById('editModal')) {
            closeEditModal();
        }
    }
    </script>
</body>

</html>
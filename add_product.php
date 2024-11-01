<?php
session_start();
$loggedIn = isset($_SESSION['user_id']);

if (!$loggedIn) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DragonBall Store - Forge New Artifact</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif; 
            background-image: url('img/goku.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            text-align: center;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            overflow: hidden;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav a {
            position: relative;
            font-size: 1.1em;
            color: #333;
            text-decoration: none;
            padding: 6px 20px;
            transition: .5s;
        }

        nav a:hover {
            color: #0ef;
        }

        nav a span {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            border-bottom: 2px solid #0ef;
            border-radius: 15px;
            transform: scale(0) translateY(50px);
            opacity: 0;
            transition: .5s;
        }

        nav a:hover span {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        .form-container {
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }

        footer {
            padding: 20px;
            text-align: center;
            margin-top: auto;
            color: #131313;; 
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="start.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="clients.php" class="active">Legendary Fans</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="add_product.php">Add Product</a></li>
            <li><a href="add_customer.php">Add Legendary Fan</a></li>
            <li><a href="place_order.php">Create Battle Plan</a></li>
            <li style="float:right;"><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <header>
        <h1>Welcome to DragonBall Store</h1>
        <h3>Forge New Legendary Artifact</h3>
    </header>

    <div class="form-container">
        <h2>Forge New Legendary Artifact</h2>
        <form action="add_product.php" method="post">
            <label for="productName">Artifact Name:</label>
            <input type="text" id="productName" name="productName" required>

            <label for="productPrice">Artifact Price:</label>
            <input type="number" id="productPrice" step="0.01" name="productPrice" required>

            <input type="submit" name="submitProduct" value="Forge Artifact">
        </form>

        <?php
            include 'php/database.php'; 

            if (isset($_POST['submitProduct'])) {
                $productName = $_POST['productName'];
                $productPrice = $_POST['productPrice'];

                $query = "INSERT INTO products (product_name, price) VALUES ('$productName', $productPrice)";
                
                if (mysqli_query($conn, $query)) {
                    echo '<p class="success-message">Legendary Artifact forged successfully!</p>';
                } else {
                    echo '<p class="error-message">Error forging Legendary Artifact: ' . mysqli_error($conn) . '</p>';
                }
            }
        ?>
    </div>

    <footer>
        <h6>&copy; <?php echo date("Y"); ?> DragonBall Store</h6>
    </footer>
</body>
</html>
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
    <title>DragonBall Store - Summon Shenron</title>
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
        <h3>Summon Shenron</h3>
    </header>
    <div class="form-container">
        <h2>Summon Shenron</h2>
        <form action="place_order.php" method="post">
            <label for="clientName">Legendary Fan:</label>
            <select id="clientName" name="clientName" required>
                <?php
                    include 'php/database.php';
                    $clientQuery = "SELECT fan_id, full_name FROM fans";
                    $clientResult = mysqli_query($conn, $clientQuery);
                    while ($row = mysqli_fetch_assoc($clientResult)) {
                        echo "<option value='{$row['fan_id']}'>{$row['full_name']}</option>";
                    }
                ?>
            </select>

            <label for="productName">Artifact:</label>
            <select id="productName" name="productName" required>
                <?php
                    $productQuery = "SELECT product_id, product_name FROM products";
                    $productResult = mysqli_query($conn, $productQuery);
                    while ($row = mysqli_fetch_assoc($productResult)) {
                        echo "<option value='{$row['product_id']}'>{$row['product_name']}</option>";
                    }
                ?>
            </select>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>

            <input type="submit" name="submitOrder" value="Summon Shenron">
        </form>

        <?php
            if (isset($_POST['submitOrder'])) {
                $clientId = $_POST['clientName'];
                $productId = $_POST['productName'];
                $quantity = $_POST['quantity'];
            
                // Fetch client and product names based on IDs
                $getClientNameQuery = "SELECT full_name FROM fans WHERE fan_id = $clientId";
                $getProductNameQuery = "SELECT product_name FROM products WHERE product_id = $productId";
                $clientNameResult = mysqli_query($conn, $getClientNameQuery);
                $productNameResult = mysqli_query($conn, $getProductNameQuery);
            
                $clientRow = mysqli_fetch_assoc($clientNameResult);
                $productNameRow = mysqli_fetch_assoc($productNameResult);
            
                $clientFullName = $clientRow['full_name'];
                $productName = $productNameRow['product_name'];
            
                // Get product price
                $getProductPriceQuery = "SELECT price FROM products WHERE product_id = $productId";
                $productPriceResult = mysqli_query($conn, $getProductPriceQuery);
                $productPriceRow = mysqli_fetch_assoc($productPriceResult);
                $productPrice = $productPriceRow['price'];
            
                // Calculate total price
                $totalPrice = $quantity * $productPrice;
            
                // Insert order into orders table
                $insertOrderQuery = "INSERT INTO orders (fan_id, product_id, quantity, total_price) VALUES ($clientId, $productId, $quantity, $totalPrice)";
                $insertOrderResult = mysqli_query($conn, $insertOrderQuery);
            
                if ($insertOrderResult) {
                    echo '<p>Artifact summoned successfully!</p>';
                } else {
                    echo '<p>Error summoning the artifact.</p>';
                    echo mysqli_error($conn);
                }
            }            
        ?>
    </div>

    <footer>
        <br>
        <h6>&copy; <?php echo date("Y"); ?> DragonBall Store</h6>
    </footer>
</body>
</html>

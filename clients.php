<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DragonBall Store - Legendary Fans</title>
    <meta charset="UTF-8">
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

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 20px; 
            margin-bottom: 50px; 
        }


        header {
            margin-bottom: 30px; 
            color: white;
        }

        footer {
            padding: 20px;
            text-align: center;
            margin-top: auto;
            color: #131313;; 
        } 

        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .product-table th,
        .product-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            color: black;
        }

        .product-table th {
            background-color: #95A5A6;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .product-table td {
            background-color: #ffffff;
            box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
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

    <div class="container">
        <header>
            <h1 style="color: red;">Meet Legendary Fans</h1>
            <?php
                include 'php/database.php'; 
                $queryFans = "SELECT * FROM fans";
                $resultFans = $conn->query($queryFans);
                $numFans = $resultFans->num_rows;

                if ($numFans > 0) {
                    echo "<h3>Total Legendary Fans: $numFans</h3>";
                } else {
                    echo "<p>No Legendary Fans found. Universe awaits!</p>";
                }
            ?>
        </header>

        <?php
            if ($numFans > 0) {
                echo "<table class='product-table'>";
                echo "<tr><th>Fan ID</th><th>Username</th><th>Full Name</th><th>Address</th></tr>";
                include 'php/tableFan.php';
                echo "</table>";
            }
            $resultFans->free_result();
        ?>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> DragonBall Store
    </footer>

</body>
</html>

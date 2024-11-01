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


        article {
            margin-bottom: 30px; 
        }

        footer {
            padding: 20px;
            text-align: center;
            margin-top: auto;
            color: #131313;; 
        } 

        .social-media {
            margin-top: 20px;
        }

        .social-icon {
            font-size: 24px;
            margin: 0 10px;
            color: blueviolet;
            transition: transform 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.2);
        }
        
        /* Responsive Table Styles */
        .responsive-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        
        .responsive-table th,
        .responsive-table td {
            padding: 25px 30px;
            border-bottom: 1px solid #ddd;
        }
        
        .responsive-table th {
            background-color: #95A5A6;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: black;
        }
        
        .responsive-table td {
            background-color: #ffffff;
            box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
        }
        
        @media all and (max-width: 767px) {
            .responsive-table th {
                display: none;
            }
        
            .responsive-table td {
                display: block;
                text-align: left;
            }
        
            .responsive-table td:before {
                color: #6C7A89;
                padding-right: 10px;
                content: attr(data-label);
            }
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
    <?php
    include 'php/database.php'; 
    $queryProducts = "SELECT * FROM products";
    $resultProducts = $conn->query($queryProducts);
    $numProducts = $resultProducts->num_rows;

    if ($numProducts > 0) {
        echo "<h2>Our Available Products</h2>";
        echo "<h3>Number of Products: $numProducts</h3>";
        echo "<table class='responsive-table'>";
        echo "<tr><th>ID</th><th>Name</th><th>Price</th></tr>";

        while ($row = $resultProducts->fetch_assoc()) {
            echo "<tr>";
            echo "<td data-label='ID'>" . $row['product_id'] . "</td>";
            echo "<td data-label='Name'>" . $row['product_name'] . "</td>";
            echo "<td data-label='Price'>" . $row['price'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No products found.</p>";
    }

    $resultProducts->free_result();
    ?>

    <footer>
        <?php include 'php/footer.php'; ?>
    </footer>
</body>
</html>

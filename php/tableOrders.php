<?php
$i = 0;
while ($i < $numOrders) {
    $resultOrders->data_seek($i);
    $rowOrders = $resultOrders->fetch_assoc();

    $queryOrderDetails = "
        SELECT fans.full_name AS fan_name, products.product_name
        FROM orders
        LEFT JOIN fans ON orders.fan_id = fans.fan_id
        LEFT JOIN products ON orders.product_id = products.product_id
        WHERE orders.order_id = " . $rowOrders["order_id"];

    $resultOrderDetails = $conn->query($queryOrderDetails);
    $rowOrderDetails = $resultOrderDetails->fetch_assoc();

    echo "<tr>";
    echo "<td>".$rowOrders["order_id"]."</td>";
    echo "<td>".$rowOrderDetails["fan_name"]."</td>";
    echo "<td>".$rowOrderDetails["product_name"]."</td>";
    echo "<td>".$rowOrders["quantity"]."</td>";
    echo "<td>".$rowOrders["total_price"]."</td>";
    echo "</tr>";

    $i++;
}
?>

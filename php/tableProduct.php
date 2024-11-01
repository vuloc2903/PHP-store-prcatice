<?php
    $i = 0;
    while ($i < $numProducts) {
        $resultProducts->data_seek($i);
        $rowProducts = $resultProducts->fetch_assoc();
        echo "<tr>";
        echo "<td>".$rowProducts["product_id"]."</td>";
        echo "<td>".$rowProducts["product_name"]."</td>";
        echo "<td>".$rowProducts["price"]."</td>"; 
        echo "</tr>";
        $i++;
    }
?>

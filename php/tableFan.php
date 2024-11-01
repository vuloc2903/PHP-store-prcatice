<?php
    while ($rowFans = $resultFans->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $rowFans['fan_id'] . "</td>";
        echo "<td>" . $rowFans['username'] . "</td>";
        echo "<td>" . $rowFans['full_name'] . "</td>";
        echo "<td>" . $rowFans['address'] . "</td>";
        echo "</tr>";
    }
?>

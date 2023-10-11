<?php
require("config/db.php");
$connection = Database::getConnection();
echo $ID_user = $_GET['ID_user'];
$clear = "DELETE FROM cart WHERE ID_user = '$ID_user'";
$statement = $connection->prepare($clear);
$statement->execute();
echo "<meta http-equiv='refresh' content='0'>";
header("Location: shop-cart.php");
?>
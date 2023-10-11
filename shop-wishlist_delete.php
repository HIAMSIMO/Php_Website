<?php
require("config/db.php");
$connection = Database::getConnection();
$reference = $_GET['reference'];
$sql = "DELETE FROM `wishlist` WHERE reference = $reference";
$statement = $connection->prepare($sql);
$statement->execute();
header("Location: shop-wishlist.php");
?>
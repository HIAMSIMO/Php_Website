<?php
require("config/db.php");
$connection = Database::getConnection();
$reference = $_GET['reference'];
$sql = "DELETE FROM cart WHERE reference = '$reference'";
$statement = $connection->prepare($sql);    
$statement->execute();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
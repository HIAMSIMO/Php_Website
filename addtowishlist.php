<?php
require("config/db.php");
$connection = Database::getConnection();
echo $ID_user = $_GET['ID_user'];
echo $reference = $_GET['reference'];
$date_added = date("Y-m-d H:i:s");
$sql2 = "INSERT INTO wishlist(ID_user, reference, date_added) VALUES (:ID_user, :reference, :date_added)";
$statement = $connection->prepare($sql2);
$statement->bindParam(':ID_user', $ID_user);
$statement->bindParam(':reference', $reference);
$statement->bindParam(':date_added', $date_added);
$statement->execute();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
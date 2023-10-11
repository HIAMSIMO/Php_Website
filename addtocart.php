<?php
require("config/db.php");
$connection = Database::getConnection();
echo $ID_user = $_GET['ID_user'];
echo $reference = $_GET['reference'];
echo $price = $_GET['price'];
echo $quantity = $_GET['quantity'];
$sql2 = "INSERT INTO cart(ID_user, reference, price, quantity) VALUES (:ID_user, :reference, :price, :quantity)";
$statement = $connection->prepare($sql2);
$statement->bindParam(':ID_user', $ID_user);
$statement->bindParam(':reference', $reference);
$statement->bindParam(':price', $price);
$statement->bindParam(':quantity', $quantity);
$statement->execute();

//It goes back to the last page visited
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>

<!-- ADD TO CART  -->
<!-- <a class="btn btn-cart" href="addtocart.php?reference=<?php //echo $add['reference']?>&ID_user=<?php //echo $add['ID_user']?>&price=<?php //echo $add['price']?>&quantity=1">Add to cart</a> -->

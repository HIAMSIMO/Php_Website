<?php
    require("../config/db.php");
        echo $reference = $_GET['reference'];
        $connection = Database::getConnection();
        $statement = $connection->prepare("DELETE FROM `product` WHERE reference= $reference");
        $statement->execute();
        header('product-list.php');
?>
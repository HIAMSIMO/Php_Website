<?php
require('config/db.php');
require_once('tcpdf/tcpdf.php');
session_start();
@$ID_user = $_SESSION['ID_user'];
$connection = Database::getConnection();
$sql = "SELECT * FROM users WHERE ID_user = '$ID_user'";
$statement = $connection->prepare($sql);
$statement->execute();
$client = $statement->fetchAll();

$sql3 = "SELECT * FROM orders INNER JOIN product ON orders.reference = product.reference WHERE ID_user = '$ID_user' AND date_commande >= NOW() - INTERVAL 62 MINUTE";
$statement = $connection->prepare($sql3);
$statement->execute();
$ordered = $statement->fetchall();

$total=0;
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="css/invoice.css">
	</head>
	<body>
		<header>
            <img class="imgg" alt="Ecom" src="fonts/logo.svg">
			<h4><strong><u>Recipient</u></strong></h4>
			<address >
				<?php foreach($client as $clt){  ?>
				<p><?php echo $clt['firstname'].' '.$clt['lastname'] ?></p>
				<p><?php echo $clt['address']?></p>
				<p><?php echo $clt['email']?></p>
				<p><?php echo $clt['telephone']?></p>
				<?php } ?>
			</address>
		</header>
		<article>
			
			<address >
				<p>Market-Tech Company<br></p>
			</address>
			<table class="meta">
				<tr>
					<th><span >Invoice #</span></th>
					<td><span ><?php foreach($ordered as $order) { echo $order['ID_cmd'];}?></span></td>
				</tr>
				<tr>
					<th><span  >Date & Hour</span></th>
					<td><span  ><?php echo $order['date_commande'] ?></span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span>Brand</span></th>
						<th><span>Description</span></th>
						<th><span>Unit price</span></th>
						<th><span>Quantity</span></th>
						<th><span>Subtotal</span></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($ordered as $order) { ?>
					<tr>
						<td><span><?php echo $order['brand'] ?></span></td>
						<td><span><?php echo $order['Tittle'] ?></span></td>
						<td><span><?php echo $order['price'] ?> MAD</span></td>
						<td><span><?php echo $order['quantity']?></span></td>
						<?php $total_prod = $order['quantity'] * $order['price'];
								$total = $total += $total_prod;
						?>
						<td><span><?php echo $total_prod ?> MAD</span></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
			<table class="balance">
				<tr>
					<th><span  >Total</span></th>
					<td><span><?php echo $total ?></span> MAD</td>
				</tr>
				<tr>
					<th><span  >Payment method</span></th>
					<td><span><?php echo $order['payement_method'] ?></span></td>
				</tr>
				<button style="padding:10px 10px 10px 10px; background-color: #425a8b; color: white; font-size:20px; border-radius:15px;" id="print-button" onclick="print()">Print</button><br><br>
			</table>
		</article>

		<aside>
			<h1><span  >Additional Notes</span></h1>
			<div  >
				<p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
			</div>
		</aside>
	</body>
  
</html>

<script>
     print(){window.print();}
</script> 
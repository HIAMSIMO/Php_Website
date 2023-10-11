<?php
require "config/db.php";
session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
  header("Location: page-login.php");
  exit();
}
$ID_user = $_SESSION["ID_user"];
$connection = Database::getConnection();
$sql = "SELECT * FROM users WHERE ID_user = '$ID_user'";
$statement = $connection->prepare($sql);
$statement->execute();
$clients = $statement->fetchAll();

$sql1 = "SELECT * FROM cart INNER JOIN product ON cart.reference=product.reference WHERE ID_user = '$ID_user'";
$statement = $connection->prepare($sql1);
$statement->execute();
$orders = $statement->fetchAll();
$cart_counter = $statement->rowcount();
$totalin_cart = 0;
$total_price = 0;

$sql="SELECT * FROM wishlist WHERE ID_user = '$ID_user'";
$statement = $connection->prepare($sql);
$statement->execute();
$wishlist = $statement->fetchAll();
$wish_counter = $statement->rowcount();

if(isset($_POST['order_place'])){
  if(empty($_POST['pay_method'])){
    $alert = 'Please choose one payment method';
  }else{

    $method = $_POST['pay_method'];
    $connection = Database::getConnection();
    
    $sql581 = "SELECT * FROM cart INNER JOIN product ON cart.reference=product.reference WHERE ID_user = '$ID_user'";
    $statement = $connection->prepare($sql581);
    $statement->execute();
    $tests = $statement->fetchAll();
    
    foreach ($tests as $test) { 
    $reference_selected = $test["reference"];
    $sql9 = "SELECT stock_quantity FROM product WHERE reference = '$reference_selected'";
    $statement = $connection->prepare($sql9);
    $statement->execute();
    $quantity = $statement->fetch();
    $stock = $quantity['stock_quantity'];
    $quantity_left  = $stock - $test["quantity"];
    $sql10 = "UPDATE product SET stock_quantity = :stock_quantity WHERE reference = '$reference_selected'";
    $statement = $connection->prepare($sql10);
    $statement->bindParam(":stock_quantity", $quantity_left);
    $statement->execute();
    }

    $qery22 = "INSERT INTO orders(ID_user, reference, quantity, date_commande, price, payement_method) VALUES (:ID_user, :reference, :quantity, :date_commande, :price, :payement_method)";
    $statement = $connection->prepare($qery22);
    $date = date("Y-m-d H:i:s");
    foreach ($tests as $test) { 
    $statement->bindParam(':ID_user', $ID_user);
    $statement->bindParam(':reference', $test["reference"]);
    $statement->bindParam(':date_commande', $date);
    $statement->bindParam(':quantity', $test["quantity"]);
    $statement->bindParam(':price', $test["price"]);
    $statement->bindParam(':payement_method', $method);
    $statement->execute();
    }
    header('Location: order_placed.php');

    $delete = "DELETE FROM cart WHERE ID_user = '$ID_user'";
    $statement = $connection->prepare($delete);
    $statement->execute();
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#0E0E0E">
    <meta name="template-color" content="#0E0E0E">
    <meta name="description" content="Index page">
    <meta name="keywords" content="index, page">
    <meta name="author" content>
    <link rel="shortcut icon" type="image/x-icon" href="fonts/favicon.svg">
    <link href="css/style.css" rel="stylesheet">
    <title>Checkout - Ecom Marketplace Template</title>
  </head>
  <body>
    <div id="preloader-active">
      <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
          <div class="text-center"><img class="mb-10" src="fonts/favicon.svg" alt="Ecom">
            <div class="preloader-dots"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="topbar">
      <div class="container-topbar">
        <div class="menu-topbar-left d-none d-xl-block">
          <ul class="nav-small">
            <?php
              if(isset($_SESSION['ID_user']))
              {
                echo '<span>Welcome </span><a class="session1" href="page-account.html"><strong>'.$_SESSION['fullName'].'</strong></a>';
              }else{
                echo'<li><a class="font-xs" href="page-about-us.php">About Us</a></li>
                     <li><a class="font-xs" href="page-register.php">Register</a></li><li><a class="font-xs" href="page-login.php">Login</a></li>';
              }
            ?>
          </ul>
        </div>
        <div class="info-topbar text-center d-none d-xl-block"><span class="font-xs color-brand-3">Free shipping for all orders over</span><span class="font-sm-bold color-success"> 1000.00 MAD</span><span class="font-xs color-brand-3"> on your first order</span></div>
        <div class="menu-topbar-right"><span class="font-xs color-brand-3">Need help? Call Us:</span><span class="font-sm-bold color-success"> (212)612 345 678</span>
        </div>
      </div>
    </div>
    <header class="header sticky-bar">
      <div class="container">
        <div class="main-header">
          <div class="header-left">
            <div class="header-logo"><a class="d-flex" href="index.php"><img alt="Ecom" src="fonts/logo.svg"></a></div>
            <div class="header-search">
              <div class="box-header-search">
                <form class="form-search" method="post" action="#">
                  <div class="box-category">
                    <select class="select-active select2-hidden-accessible">
                      <option>All categories</option>
                      <option value="Laptop">Laptop</option>
                      <option value="Computers Accessories">Computers Accessories</option>
                    </select>
                  </div>
                  <div class="box-keysearch">
                    <input class="form-control font-xs" type="text" value placeholder="Search for items">
                  </div>
                </form>
              </div>
            </div>
            <div class="header-nav">
              <nav class="nav-main-menu d-none d-xl-block">
                <ul class="main-menu">
                  <li><a class="active" href="index.php">Home</a>
                  </li>
                   
                  <li><a href="shop-grid.php">Shop</a></li>
                  <li><a href="page-about-us.php">About us</a></li>
                </ul>
              </nav>
              <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
            </div>
            <div class="header-shop">
              <div class="d-inline-block box-dropdown-cart"><span class="font-lg icon-list icon-account"><span>Account</span></span>
                <div class="dropdown-account">
                  <ul>
                    <li><a href="page-account.php">My Account</a></li>
 
 
 
                    <li><a href="logout.php">Sign out</a></li>
                  </ul>
                </div>
              </div><a class="font-lg icon-list icon-wishlist" href="shop-wishlist.php"><span>Wishlist</span><?php if($wish_counter > 0) {echo '<span class="number-item font-xs">'.$wish_counter.'</span>'; }?></span></a>
              <div class="d-inline-block box-dropdown-cart"><span class="font-lg icon-list icon-cart"><span>Cart</span><?php if($cart_counter > 0) {echo '<span class="number-item font-xs">'.$cart_counter.'</span>'; }?></span>
                <div class="dropdown-cart">
                  <?php foreach($orders as $order){ ?>
                  <div class="item-cart mb-20">
                    <div class="cart-image"><img src="product/<?php echo $order['photo']?>" alt="Ecom"></div>
                    <div class="cart-info"><a class="font-sm-bold color-brand-3" href="shop-single-product.php?=<?php echo $order['reference']?>"><?php echo $order['Tittle']?></a>
                    <?php $subtotal = $order['quantity'] * $order['price']; $totalin_cart += $subtotal; ?>
                      <p><span class="color-brand-2 font-sm-bold"><?php echo $order['quantity']?> x <?php echo $order ['price']?> MAD</span></p>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="border-bottom pt-0 mb-15"></div>
                  <div class="cart-total">
                    <div class="row">
                      <div class="col-6 text-start"><span class="font-md-bold color-brand-3">Total</span></div>
                      <div class="col-6"><span class="font-md-bold color-brand-1"><?php echo $totalin_cart?> MAD</span></div>
                    </div>
                    <div class="row mt-15">
                      <div class="col-6 text-start"><a class="btn btn-cart w-auto" href="shop-cart.php">View cart</a></div>
                      <div class="col-6"><a class="btn btn-buy w-auto" href="shop-checkout.php">Checkout</a></div>
                    </div>
                  </div>
                </div>
               
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="sidebar-left"><a class="btn btn-open" href="#"></a>
      <ul class="menu-icons hidden">
        <li><a href="javascript:void(0)"><img src="fonts/monitor.svg" alt="Ecom"></a></li>
        <li><a href="javascript:void(0)"><img src="fonts/mobile.svg" alt="Ecom"></a></li>
        <li><a href="#"><img src="fonts/game.svg" alt="Ecom"></a></li>
        <li><a href="#"><img src="fonts/clock.svg" alt="Ecom"></a></li>
        <li><a href="#"><img src="fonts/airpod.svg" alt="Ecom"></a></li>
        <li><a href="#"><img src="fonts/airpods.svg" alt="Ecom"></a></li>
        <li><a href="#"><img src="fonts/mouse.svg" alt="Ecom"></a></li>
        <li><a href="#"><img src="fonts/music-play.svg" alt="Ecom"></a></li>
        <li><a href="#"><img src="fonts/bluetooth.svg" alt="Ecom"></a></li>
        <li><a href="#"><img src="fonts/clound.svg" alt="Ecom"></a></li>
        <li><a href="#"><img src="fonts/electricity.svg" alt="Ecom"></a></li>
        <li><a href="#"><img src="fonts/cpu.svg" alt="Ecom"></a></li>
        <li><a href="#"><img src="fonts/devices.svg" alt="Ecom"></a></li>
        <li><a href="#"><img src="fonts/driver.svg" alt="Ecom"></a></li>
        <li><a href="#"><img src="fonts/lamp.svg" alt="Ecom"></a></li>
      </ul>
      <ul class="menu-texts menu-close">
        <li class="has-children"><a href="#"><span class="img-link"><img src="fonts/monitor.svg" alt="Ecom"></span><span class="text-link">Laptop</span></a>
          <ul class="sub-menu">
            <li><a href="shop-grid.html">Laptop</a></li>
          </ul>
        </li>
        <li class="has-children"><a href="#"><span class="img-link"><img src="fonts/driver.svg" alt="Ecom"></span><span class="text-link">Accessories</span></a>
          <ul class="sub-menu">
            <li><a href="shop-grid.html">Computer Accessories</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <main class="main">
      <div class="section-box">
        <div class="breadcrumbs-div">
        </div>
      </div>
      <section class="section-box shop-template">
        <form method="post">
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <?php foreach ($clients as $client) { ?>
                <div class="box-border">
                  <div class="row">
                    <div class="col-lg-12">
                      <h5 class="font-md-bold color-brand-3 mt-15 mb-20">Informations</h5>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input class="form-control font-sm" type="text" placeholder="First name*" value="<?php echo $client[
                            "firstname"
                        ]; ?>" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input class="form-control font-sm" type="text" placeholder="Last name*" value="<?php echo $client[
                            "lastname"
                        ]; ?>" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <input class="form-control font-sm" type="text" placeholder="Address*" value="<?php echo $client[
                            "address"
                        ]; ?>" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <input class="form-control font-sm" type="text" placeholder="City*" value="<?php echo $client[
                            "city"
                        ]; ?>" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input class="form-control font-sm" type="text" placeholder="Postal code /zip*" value="<?php echo $client[
                            "postalcode"
                        ]; ?>" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input class="form-control font-sm" type="text" placeholder="Phone*" value="<?php echo $client[
                            "telephone"
                        ]; ?>" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <input class="form-control font-sm" type="text" placeholder="E-mail" value="<?php echo $client[
                            "email"
                        ]; ?>" readonly="readonly">
                      </div>
                    </div>
                  </div>
                  <div class="box-border">
                    <li>
                      <label class="cb-container">
                        <input type="radio" name="pay_method" value="Cash on Delivery" onclick="hideDiv()"><span class="text-small">Cash on Delivery</span><span class="checkmark" required="required"></span>
                      </label>
                      <label class="cb-container">
                        <input type="radio" name="pay_method" value="Online payement" onclick="showDiv()"><span class="text-small">Pay with credit card</span><span class="checkmark" required="required"></span>
                      </label>
                      <div class="errorMessage"><?php if(!empty($alert)){ echo '<img src="images/warning-red.png" style="width: 15px;">'.$alert; }?></div>
                      <div id="myDiv" style="display:none;"  class="container">
                        <div >
                          <h4>Credit Card Payment Gateway</h4>
                        </div>

                        <!-- Credit Card Payment Form - START -->
                        <div  class="container">
                          <div class="row">
                            <div class="col-xs-12 col-md-6 col-md-offset-4">
                              <div class="panel panel-default">
                                <div class="panel-heading">
                                  <div class="row">
                                    <h5 class="text-center">Payment Details</h5>
                                    <div class="inlineimage"><img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Mastercard-Curved.png"><img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Discover-Curved.png"><img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Paypal-Curved.png"><img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/American-Express-Curved.png"></div>
                                  </div>
                                </div>
                                <div class="panel-body">
                                  <form role="form">
                                    <div class="row">
                                      <div class="col-xs-12">
                                        <div class="form-group"> <label>CARD NUMBER</label>
                                          <div class="input-group"> <input type="tel" class="form-control" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="16" placeholder="xxxx xxxx xxxx xxxx" /> <span class="input-group-addon"><span class="fa fa-credit-card"></span></span> </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-xs-7 col-md-7">
                                        <div class="form-group"> <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label> <input type="tel" class="form-control" placeholder="MM / YY" maxlength="5"/> </div>
                                      </div>
                                      <div class="col-xs-5 col-md-5 pull-right">
                                        <div class="form-group"> <label>CV CODE</label> <input type="tel" class="form-control" placeholder="CVC" maxlength="3"/> </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-xs-12">
                                        <div class="form-group"> <label>CARD OWNER</label> <input type="text" class="form-control" placeholder="Card Owner Name" /> </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                                <div class="panel-footer">
                                  <div class="row">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <script>
                      function showDiv() {
                      var x = document.getElementById("myDiv");
                        x.style.display = "block";
                        
                      }
                      function hideDiv() {
                        var x = document.getElementById("myDiv");
                        x.style.display = "none";
                      }
                    </script>
                    </li>
                  </div>
                </div>
                <div class="row mt-20">
                  <div class="col-lg-6 col-5 mb-20"><a class="btn font-sm-bold color-brand-1 arrow-back-1" href="shop-cart.php">Return to Cart</a></div>
                  
                </div>
                <?php } ?>
              </div>
              <style>
                  .inlineimage {
                    max-width: 470px;
                    margin-right: 8px;
                    margin-left: 10px
                  }
                  .images {
                    display: inline-block;
                    max-width: 98%;
                    height: auto;
                    width: 22%;
                    margin: 1%;
                    left: 20px;
                    text-align: center
                  }
                </style>
              <div class="col-lg-6">
                <div class="box-border">
                  <h5 class="font-md-bold mb-20">Your Order</h5>
                  <div class="listCheckout">
                    <?php foreach ($orders as $order) { ?>
                    <div class="item-wishlist">
                      <div class="wishlist-product">
                        <div class="product-wishlist">
                          <div class="product-image"><a href="shop-single-product.php?reference=<?php echo $order[
                              "reference"
                          ]; ?>"><img src="product/<?php echo $order[
                              "photo"
                          ]; ?>" alt="Ecom"></a></div>
                          <div class="product-info"><a href="shop-single-product.php?reference=<?php echo $order[
                              "reference"
                          ]; ?>">
                              <h6 class="color-brand-3"><?php echo $order[
                                  "Tittle"
                              ]; ?></h6>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="wishlist-status">
                        <h5 class="color-gray-500">x<?php echo $order[
                            "quantity"
                        ]; ?></h5>
                      </div>
                      <div class="wishlist-price">
                        <h4 class="color-brand-3 font-lg-bold"><?php echo $order[
                            "price"
                        ]; ?> MAD</h4>
                      </div>
                    </div>
                    <?php
                    $sub_total = $order["quantity"] * $order["price"];
                    $total_price += $sub_total;
                    } 
                    ?>
                  </div>
                  <div class="form-group mb-0">
                    <div class="row mb-10">
                      <div class="col-lg-6 col-6"><span class="font-md-bold color-brand-3">Subtotal</span></div>
                      <div class="col-lg-6 col-6 text-end"><span class="font-lg-bold color-brand-3"><?php echo $total_price; ?> MAD</span></div>
                    </div>
                    <div class="border-bottom mb-10 pb-5">
                      <div class="row">
                        <div class="col-lg-6 col-6"><span class="font-md-bold color-brand-3">Shipping</span></div>
                        <div class="col-lg-6 col-6 text-end"><span class="font-lg-bold color-brand-3">Free</span></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-6"><span class="font-md-bold color-brand-3">Total</span></div>
                      <div class="col-lg-6 col-6 text-end"><span class="font-lg-bold color-brand-3"><?php echo $total_price; ?> MAD</span></div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-7 mb-20 text-end"><input style="margin-top: 38px; margin-left: 378px;" class="btn btn-buy w-auto arrow-next" type="submit" name="order_place" value="Place an Order"></div>
              </div>
            </div>
          </div>
        </form>
        <?php

        ?>
      </section>
      <section class="section-box mt-90 mb-50">
        <div class="container">
          <ul class="list-col-5">
            <li>
              <div class="item-list">
                <div class="icon-left"><img src="fonts/delivery.svg" alt="Ecom"></div>
                <div class="info-right">
                  <h5 class="font-lg-bold color-gray-100">Free Delivery</h5>
                  <p class="font-sm color-gray-500">From all orders over $10</p>
                </div>
              </div>
            </li>
            <li>
              <div class="item-list">
                <div class="icon-left"><img src="fonts/support.svg" alt="Ecom"></div>
                <div class="info-right">
                  <h5 class="font-lg-bold color-gray-100">Support 24/7</h5>
                  <p class="font-sm color-gray-500">Shop with an expert</p>
                </div>
              </div>
            </li>
            <li>
              <div class="item-list">
                <div class="icon-left"><img src="fonts/voucher.svg" alt="Ecom"></div>
                <div class="info-right">
                  <h5 class="font-lg-bold color-gray-100">Gift voucher</h5>
                  <p class="font-sm color-gray-500">Refer a friend</p>
                </div>
              </div>
            </li>
            <li>
              <div class="item-list">
                <div class="icon-left"><img src="fonts/return.svg" alt="Ecom"></div>
                <div class="info-right">
                  <h5 class="font-lg-bold color-gray-100">Return &amp; Refund</h5>
                  <p class="font-sm color-gray-500">Free return over $200</p>
                </div>
              </div>
            </li>
            <li>
              <div class="item-list">
                <div class="icon-left"><img src="fonts/secure.svg" alt="Ecom"></div>
                <div class="info-right">
                  <h5 class="font-lg-bold color-gray-100">Secure payment</h5>
                  <p class="font-sm color-gray-500">100% Protected</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </section>
      <section class="section-box box-newsletter">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-7 col-sm-12">
              <h3 class="color-white">Subscrible &amp; Get <span class="color-warning">10%</span> Discount</h3>
              <p class="font-lg color-white">Get E-mail updates about our latest shop and <span class="font-lg-bold">special offers.</span></p>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12">
              <div class="box-form-newsletter mt-15">
                <form class="form-newsletter">
                  <input class="input-newsletter font-xs" value placeholder="Your email Address">
                  <button class="btn btn-brand-2">Sign Up</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="modal fade" id="ModalFiltersForm" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
          <div class="modal-content apply-job-form">
            <div class="modal-header">
              <h5 class="modal-title color-gray-1000 filters-icon">Addvance Fillters</h5>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-30">
              <div class="row">
                <div class="col-w-1">
                  <h6 class="color-gray-900 mb-0">Brands</h6>
                  <ul class="list-checkbox">
                    <li>
                      <label class="cb-container">
                        <input type="checkbox" checked="checked"><span class="text-small">Apple</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Samsung</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Baseus</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Remax</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Handtown</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Elecom</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Razer</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Auto Focus</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Nillkin</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Logitech</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">ChromeBook</span><span class="checkmark"></span>
                      </label>
                    </li>
                  </ul>
                </div>
                <div class="col-w-1">
                  <h6 class="color-gray-900 mb-0">Special offers</h6>
                  <ul class="list-checkbox">
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">On sale</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox" checked="checked"><span class="text-small">FREE shipping</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Big deals</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Shop Mall</span><span class="checkmark"></span>
                      </label>
                    </li>
                  </ul>
                  <h6 class="color-gray-900 mb-0 mt-40">Ready to ship in</h6>
                  <ul class="list-checkbox">
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">1 business day</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox" checked="checked"><span class="text-small">1&ndash;3 business days</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">in 1 week</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Shipping now</span><span class="checkmark"></span>
                      </label>
                    </li>
                  </ul>
                </div>
                <div class="col-w-1">
                  <h6 class="color-gray-900 mb-0">Ordering options</h6>
                  <ul class="list-checkbox">
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Accepts gift cards</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Customizable</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox" checked="checked"><span class="text-small">Can be gift-wrapped</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Installment 0%</span><span class="checkmark"></span>
                      </label>
                    </li>
                  </ul>
                  <h6 class="color-gray-900 mb-0 mt-40">Rating</h6>
                  <ul class="list-checkbox">
                    <li class="mb-5"><a href="#"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><span class="ml-10 font-xs color-gray-500 d-inline-block align-top">(5 stars)</span></a></li>
                    <li class="mb-5"><a href="#"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star-gray.svg" alt="Ecom"><span class="ml-10 font-xs color-gray-500 d-inline-block align-top">(4 stars)</span></a></li>
                    <li class="mb-5"><a href="#"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star-gray.svg" alt="Ecom"><img src="fonts/star-gray.svg" alt="Ecom"><span class="ml-10 font-xs color-gray-500 d-inline-block align-top">(3 stars)</span></a></li>
                    <li class="mb-5"><a href="#"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star-gray.svg" alt="Ecom"><img src="fonts/star-gray.svg" alt="Ecom"><img src="fonts/star-gray.svg" alt="Ecom"><span class="ml-10 font-xs color-gray-500 d-inline-block align-top">(2 stars)</span></a></li>
                    <li class="mb-5"><a href="#"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star-gray.svg" alt="Ecom"><img src="fonts/star-gray.svg" alt="Ecom"><img src="fonts/star-gray.svg" alt="Ecom"><img src="fonts/star-gray.svg" alt="Ecom"><span class="ml-10 font-xs color-gray-500 d-inline-block align-top">(1 star)</span></a></li>
                  </ul>
                </div>
                <div class="col-w-2">
                  <h6 class="color-gray-900 mb-0">Material</h6>
                  <ul class="list-checkbox">
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Nylon (8)</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Tempered Glass (5)</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox" checked="checked"><span class="text-small">Liquid Silicone Rubber (5)</span><span class="checkmark"></span>
                      </label>
                    </li>
                    <li>
                      <label class="cb-container">
                        <input type="checkbox"><span class="text-small">Aluminium Alloy (3)</span><span class="checkmark"></span>
                      </label>
                    </li>
                  </ul>
                  <h6 class="color-gray-900 mb-20 mt-40">Product tags</h6>
                  <div><a class="btn btn-border mr-5" href="#">Games</a><a class="btn btn-border mr-5" href="#">Electronics</a><a class="btn btn-border mr-5" href="#">Video</a><a class="btn btn-border mr-5" href="#">Cellphone</a><a class="btn btn-border mr-5" href="#">Indoor</a><a class="btn btn-border mr-5" href="#">VGA Card</a><a class="btn btn-border mr-5" href="#">USB</a><a class="btn btn-border mr-5" href="#">Lightning</a><a class="btn btn-border mr-5" href="#">Camera</a></div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-start pl-30"><a class="btn btn-buy w-auto" href="#">Apply Fillter</a><a class="btn font-sm-bold color-gray-500" href="#">Reset Fillter</a></div>
          </div>
        </div>
      </div>
    </main>
    <footer class="footer">
      <div class="footer-1">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 width-25 mb-30">
              <h4 class="mb-30 color-gray-1000">Contact</h4>
              <div class="font-md mb-20 color-gray-900"><strong class="font-md-bold">Address:</strong> 502 New Design Str, Melbourne, San Francisco, CA 94110, United States</div>
              <div class="font-md mb-20 color-gray-900"><strong class="font-md-bold">Phone:</strong> (+01) 123-456-789</div>
              <div class="font-md mb-20 color-gray-900"><strong class="font-md-bold">E-mail:</strong> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a7c4c8c9d3c6c4d3e7c2c4c8ca8acac6d5ccc2d389c4c8ca">[email&#160;protected]</a></div>
              <div class="font-md mb-20 color-gray-900"><strong class="font-md-bold">Hours:</strong> 8:00 - 17:00, Mon - Sat</div>
              <div class="mt-30"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a><a class="icon-socials icon-linkedin" href="#"></a></div>
            </div>
            <div class="col-lg-3 width-20 mb-30">
              <h4 class="mb-30 color-gray-1000">Make Money with Us</h4>
              <ul class="menu-footer">
                <li><a href="page-about-us.html">Mission &amp; Vision</a></li>
                <li><a href="page-about-us.html">Our Team</a></li>
                <li><a href="page-careers.html">Careers</a></li>
                <li><a href="#">Press &amp; Media</a></li>
                <li><a href="#">Advertising</a></li>
                <li><a href="#">Testimonials</a></li>
              </ul>
            </div>
            <div class="col-lg-3 width-16 mb-30">
              <h4 class="mb-30 color-gray-1000">Company</h4>
              <ul class="menu-footer">
                <li><a href="blog-2.html">Our Blog</a></li>
                <li><a href="#">Plans &amp; Pricing</a></li>
                <li><a href="#">Knowledge Base</a></li>
                <li><a href="#">Cookie Policy</a></li>
                <li><a href="#">Office Center</a></li>
                <li><a href="blog.html">News &amp; Events</a></li>
              </ul>
            </div>
            <div class="col-lg-3 width-16 mb-30">
              <h4 class="mb-30 color-gray-1000">My account</h4>
              <ul class="menu-footer">
                <li><a href="#">FAQs</a></li>
                <li><a href="#">Editor Help</a></li>
                <li><a href="#">Community</a></li>
                <li><a href="#">Live Chatting</a></li>
                <li><a href="page-contact.html">Contact Us</a></li>
                <li><a href="#">Support Center</a></li>
              </ul>
            </div>
            <div class="col-lg-3 width-23">
              <h4 class="mb-30 color-gray-1000">App &amp; Payment</h4>
              <div>
                <p class="font-md color-gray-900">Download our Apps and get extra 15% Discount on your first Order&mldr;!</p>
                <div class="mt-20"><a class="mr-10" href="#"><img src="images/appstore.png" alt="Ecom"></a><a href="#"><img src="images/google-play.png" alt="Ecom"></a></div>
                <p class="font-md color-gray-900 mt-20 mb-10">Secured Payment Gateways</p><img src="images/payment-method.png" alt="Ecom">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-2">
        <div class="footer-bottom-1">
          <div class="container">
            <div class="footer-2-top mb-20"><a href="index.html"><img alt="Ecom" src="fonts/logo-2.svg"></a><a class="font-xs color-gray-1000" href="#">EcomMarket.com</a><a class="font-xs color-gray-1000" href="#">Ecom Partners</a><a class="font-xs color-gray-1000" href="#">Ecom Bussiness</a><a class="font-xs color-gray-1000" href="#">Ecom Factory</a></div>
            <div class="footer-2-bottom">
              <div class="head-left-footer">
                <h6 class="color-gray-1000">Electronic:</h6>
              </div>
              <div class="tags-footer"><a href="shop-fullwidth.html">Cell Phones</a><a href="shop-grid.html">Headphones</a><a href="shop-grid-2.html">Television &amp; Video</a><a href="shop-list.html">Game Controller</a><a href="shop-list-2.html">Apple Watch</a><a href="shop-grid.html">HTC</a><a href="shop-grid.html">Ipad</a><a href="shop-grid.html">Keyboard</a><a href="shop-grid.html">Samsung</a><a href="shop-grid.html">Wireless Speaker</a><a href="shop-grid.html">Samsung Galaxy</a><a href="shop-grid.html">Gaming Mouse</a><a href="shop-grid.html">eBook Readers</a><a href="shop-grid.html">Service Plans</a><a href="shop-grid.html">Home Audio</a><a href="shop-grid.html">Office Electronics</a><a href="shop-grid.html">Lenovo</a><a href="shop-grid.html">Mackbook Pro M1</a><a href="shop-grid.html">HD Videos Player</a></div>
            </div>
            <div class="footer-2-bottom">
              <div class="head-left-footer">
                <h6 class="color-gray-1000">Furniture:</h6>
              </div>
              <div class="tags-footer"><a href="shop-grid.html">Sofa</a><a href="shop-grid.html">Chair</a><a href="shop-grid.html">Dining Table</a><a href="shop-grid.html">Living Room</a><a href="shop-grid.html">Table Lamp</a><a href="shop-grid.html">Night Stand</a><a href="shop-grid.html">Computer Desk</a><a href="shop-grid.html">Bar Table</a><a href="shop-grid.html">Pillow</a><a href="shop-grid.html">Radio</a><a href="shop-grid.html">Clock</a><a href="shop-grid.html">Bad Room</a><a href="shop-grid.html">Stool</a><a href="shop-grid.html">Television</a><a href="shop-grid.html">wardrobe</a><a href="shop-grid.html">Living Room Tables</a><a href="shop-grid.html">Dressers</a><a href="shop-grid.html">Patio Sofas</a><a href="shop-grid.html">Nursery</a><a href="shop-grid.html">Kitchen</a><a href="shop-grid.html">Accent Furniture</a><a href="shop-grid.html">Replacement Parts</a></div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="footer-bottom mt-20">
            <div class="row">
              <div class="col-lg-6 col-md-12 text-center text-lg-start"><span class="color-gray-900 font-sm">Copyright &copy; 2022 Ecom Market. All rights reserved.</span></div>
              <div class="col-lg-6 col-md-12 text-center text-lg-end">
                <ul class="menu-bottom">
                  <li><a class="font-sm color-gray-900" href="page-term.html">Conditions of Use</a></li>
                  <li><a class="font-sm color-gray-900" href="page-term.html">Privacy Notice</a></li>
                  <li><a class="font-sm color-gray-900" href="page-careers.html">Interest-Based Ads</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script data-cfasync="false" src="js/email-decode.min.js"></script>
    <script src="js/modernizr-3.6.0.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery-migrate-3.3.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/waypoints.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/magnific-popup.js"></script>
    <script src="js/perfect-scrollbar.min.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/isotope.js"></script>
    <script src="js/scrollup.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/noUISlider.js"></script>
    <script src="js/slider.js"></script>

    <!-- Count down-->
    <script src="js/counterup.js"></script>
    <script src="js/jquery.countdown.min.js"></script>

    <!-- Count down-->
    <script src="js/jquery.elevatezoom.js"></script>
    <script src="js/slick.js"></script>
    <script src="js/main.js"></script>
    <script src="js/shop.js"></script>
  </body>
</html>
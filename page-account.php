<?php
  require('config/db.php');
  session_start();
  if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
    header("Location: page-login.php");
    exit();
  }
  $ID_user = $_SESSION['ID_user'];
  $connection = Database::getConnection();
  $sql="SELECT * FROM wishlist INNER JOIN product ON wishlist.reference = product.reference INNER JOIN users ON wishlist.ID_user = users.ID_user WHERE users.ID_user = '$ID_user'";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $wishlist = $statement->fetchAll();
  $wish_counter = $statement->rowcount();

  $sql1="SELECT * FROM cart INNER JOIN product ON cart.reference=product.reference WHERE ID_user = '$ID_user'";
  $statement = $connection->prepare($sql1);
  $statement->execute();
  $carts = $statement->fetchAll();
  $cart_counter = $statement->rowcount();
  $total = 0;

  $sql2="SELECT * FROM users WHERE ID_user = '$ID_user'";
  $statement = $connection->prepare($sql2);
  $statement->execute();
  $clients = $statement->fetchAll();

  $sql3 ="SELECT date_commande FROM orders INNER JOIN users ON orders.ID_user=users.ID_user WHERE users.ID_user = '$ID_user' GROUP BY date_commande ORDER BY date_commande DESC";
  $statement = $connection->prepare($sql3);
  $statement->execute();
  $row = $statement->fetchAll();

  $cltquery = "SELECT * FROM users WHERE ID_user = '$ID_user' and type = 'client'";
  $statement = $connection->prepare($cltquery);
  $statement->execute();
  $clients = $statement->fetchAll();

  if (isset($_POST["update"])) {
    $firstname = $_REQUEST["firstname"];
    $lastname = $_REQUEST["lastname"];
    $address = $_REQUEST["address"];
    $city = $_REQUEST["city"];
    $postalcode = $_REQUEST["postalcode"];
    $telephone = $_REQUEST["telephone"];
    $email = $_REQUEST["email"];
    $updat = "UPDATE users SET firstname = :firstname, lastname = :lastname, address = :address, city = :city, postalcode = :postalcode, telephone = :telephone, email = :email WHERE ID_user = '$ID_user'";
    $statement = $connection->prepare($updat);
    $statement->bindParam(":firstname", $firstname);
    $statement->bindParam(":lastname", $lastname);
    $statement->bindParam(":address", $address);
    $statement->bindParam(":city", $city);
    $statement->bindParam(":postalcode", $postalcode);
    $statement->bindParam(":telephone", $telephone);
    $statement->bindParam(":email", $email);
    $statement->execute();
    echo "<meta http-equiv='refresh' content='0'>";

  }

  if(isset($_POST['change'])){
    $sql1 = "SELECT password FROM users WHERE id_user = :id_user";
    $newpassword = stripslashes($_REQUEST['newpassword']);
    $confirmpassword = stripslashes($_REQUEST['confirmpassword']);
    if($newpassword != $confirmpassword) {
        $message = "Password incorrect";
    } else{
        $changeq = "UPDATE users SET password = :password WHERE ID_user = '$ID_user'";
        $statement = $connection->prepare($changeq);
        $statement->bindValue(':password', hash('sha256', $confirmpassword));
        $statement->execute();
        $success = "The password has been changed";
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
    <title>Account - Ecom Marketplace Template</title>
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
                  <?php foreach($carts as $cart){ ?>
                  <div class="item-cart mb-20">
                    <div class="cart-image"><img src="product/<?php echo $cart['photo']?>" alt="Ecom"></div>
                    <div class="cart-info"><a class="font-sm-bold color-brand-3" href="shop-single-product.php?=<?php echo $cart['reference']?>"><?php echo $cart['Tittle']?></a>
                    <?php $sub_total = $cart['quantity'] * $cart['price']; $total += $sub_total; ?>
                      <p><span class="color-brand-2 font-sm-bold"><?php echo $cart['quantity']?> x <?php echo $cart['price']?> MAD</span></p>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="border-bottom pt-0 mb-15"></div>
                  <div class="cart-total">
                    <div class="row">
                      <div class="col-6 text-start"><span class="font-md-bold color-brand-3">Total</span></div>
                      <div class="col-6"><span class="font-md-bold color-brand-1"><?php echo $total?> MAD</span></div>
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
      <ul class="menu-texts menu-close">
        <li class="has-children"><a href="shop-grid.php?category=Laptop"><span class="img-link"><img src="fonts/monitor.svg" alt="Ecom"></span><span class="text-link">Laptop</span></a>
          <ul class="sub-menu">
            <li><a href="shop-grid.php?category=Laptop">Laptop</a></li>
          </ul>
        </li>
        <li class="has-children"><a href="shop-grid.php?category=Accessories"><span class="img-link"><img src="fonts/driver.svg" alt="Ecom"></span><span class="text-link">Accessories</span></a>
          <ul class="sub-menu">
            <li><a href="shop-grid.php?category=Accessories">Accessories</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <main class="main">
      <section class="section-box shop-template mt-30">
        <div class="container box-account-template">
          <h3>Hello <?php echo $_SESSION['fullName']; ?></h3>
          <p class="font-md color-gray-500">From your account dashboard. you can easily check & view your recent orders,<br class="d-none d-lg-block">manage your shipping and billing addresses and edit your password and account details.</p>
          <div class="box-tabs mb-100">
            <ul class="nav nav-tabs nav-tabs-account" role="tablist">
              <li><a class="active" href="#tab-wishlist" data-bs-toggle="tab" role="tab" aria-controls="tab-wishlist" aria-selected="true">Wishlist</a></li>
              <li><a href="#tab-orders" data-bs-toggle="tab" role="tab" aria-controls="tab-orders" aria-selected="true">Orders</a></li>
              <li><a href="#tab-setting" data-bs-toggle="tab" role="tab" aria-controls="tab-setting" aria-selected="true">Setting</a></li>
            </ul>
            <div class="border-bottom mt-20 mb-40"></div>
            <div class="tab-content mt-30">
              <div class="tab-pane fade active show" id="tab-wishlist" role="tabpanel" aria-labelledby="tab-wishlist">
                <div class="box-wishlist">
                  <div class="head-wishlist">
                    <div class="item-wishlist">
                      <div class="wishlist-cb">
                        <input class="cb-layout cb-all" type="checkbox">
                      </div>
                      <div class="wishlist-product"><span class="font-md-bold color-brand-3">Product</span></div>
                      <div class="wishlist-price"><span class="font-md-bold color-brand-3">Price</span></div>
                      <div class="wishlist-status"><span class="font-md-bold color-brand-3">Stock status</span></div>
                      <div class="wishlist-action"><span class="font-md-bold color-brand-3">Action</span></div>
                      <div class="wishlist-remove"><span class="font-md-bold color-brand-3">Remove</span></div>
                    </div>
                  </div>
                  <div class="content-wishlist">
                    <?php foreach($wishlist as $wish) { ?>
                      <div class="item-wishlist">
                        <div class="wishlist-cb">
                          <input class="cb-layout cb-select" type="checkbox">
                        </div>
                        <div class="wishlist-product">
                          <div class="product-wishlist">
                            <div class="product-image"><a href="shop-single-product.php?reference=<?php echo $wish['reference']?>"><img src="product/<?php echo $wish['photo']?>" alt="Ecom"></a></div>
                            <div class="product-info"><a href="shop-single-product.php?reference=<?php echo $wish['reference']?>">
                                <h6 class="color-brand-3"><?php echo $wish['Tittle']?></h6></a>
                            </div>
                          </div>
                        </div>
                        <div class="wishlist-price">
                          <h4 class="color-brand-3"><?php echo $wish['price']?> MAD</h4>
                        </div>
                        <div class="wishlist-status"><span class="btn btn-gray font-md-bold color-brand-3"><?php  if($wish['stock_quantity'] != 0) {echo "In Stock";} else{echo "Out of Stock";}?></span></div>
                        <div class="wishlist-action"><a class="btn btn-cart" href="addtocart.php?reference=<?php echo $wish['reference']?>&ID_user=<?php echo $wish['ID_user']?>&price=<?php echo $wish['price']?>&quantity=1">Add to cart</a></div>
                        <div class="wishlist-remove"><a class="btn btn-delete" href="shop-wishlist_delete.php?reference=<?php echo $wish['reference']?>"></a></div>  
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders">
                <?php  ?>
                <?php foreach($row as $date){ ?>
                  <div class="box-orders">
                    <div class="head-orders">
                      <div class="head-left">
                        <h5 class="mr-20">Order ID: #<?php $date_commande =  $date['date_commande']; $query ="SELECT ID_cmd FROM orders WHERE ID_user = '$ID_user' AND date_commande = '$date_commande'"; $statement = $connection->prepare($query); $statement->execute(); $cmds = $statement->fetchAll(); foreach($cmds as $cmd) { echo $cmd['ID_cmd'];}?></h5><span class="font-md color-brand-3 mr-20">Date: <?php echo $date['date_commande'] ?></span>
                      </div>
                    </div>
                    <div class="body-orders">
                      <div class="list-orders">
                        <?php
                          $date_commande =  $date['date_commande'];
                          $sql4 ="SELECT * FROM orders INNER JOIN product ON orders.reference=product.reference INNER JOIN users ON orders.ID_user=users.ID_user WHERE users.ID_user = '$ID_user' AND date_commande = '$date_commande'";
                          $statement = $connection->prepare($sql4);
                          $statement->execute();
                          $orders = $statement->fetchAll();
                          foreach ($orders as $order) {
                        ?>
                        <div class="item-orders">
                          <div class="image-orders"><img src="product/<?php echo $order['photo'] ?>" alt="Ecom"></div>
                          <div class="info-orders">
                            <h5><?php echo $order['Tittle'] ?></h5>
                          </div>
                          <div class="quantity-orders">
                            <h5>Quantity: <?php echo $order['quantity'] ?></h5>
                          </div>
                          <div class="price-orders">
                            <h4><?php echo $order['price'] ?> MAD</h4>
                          </div>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <div class="tab-pane fade" id="tab-setting" role="tabpanel" aria-labelledby="tab-setting">
                <div class="row">
                  <div class="col-lg-6 mb-20">
                    <form action="#" method="post">
                      <div class="row">
                        <div class="col-lg-12">
                          <h5 class="font-md-bold color-brand-3 mt-15 mb-20">Shipping address</h5>
                        </div>
                        <?php foreach($clients as $client) { ?>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input class="form-control font-sm" type="text" name="firstname" placeholder="First name*" value="<?php echo $client['firstname'] ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input class="form-control font-sm" type="text" name="lastname" placeholder="Last name*" value="<?php echo $client['lastname'] ?>">
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <input class="form-control font-sm" type="text" name="address" placeholder="Address 1*" value="<?php echo $client['address'] ?>">
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <input class="form-control font-sm" type="text" name="city"  placeholder="City*" value="<?php echo $client['city'] ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input class="form-control font-sm" type="text" name="postalcode"  placeholder="PostCode / ZIP*" value="<?php echo $client['postalcode'] ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input class="form-control font-sm" type="text" name="telephone"  placeholder="Phone*" value="<?php echo $client['telephone'] ?>">
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <input class="form-control font-sm" type="text" name="email"  placeholder="Email*" value="<?php echo $client['email'] ?>">
                          </div>
                        </div>
                        <?php } ?>
                        <div class="col-lg-12">
                          <div class="form-group mt-20">
                            <input class="btn btn-buy w-auto h54 font-md-bold" value="Save change" type="submit" name="update">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-lg-1 mb-20"></div>
                  <div class="col-lg-5 mb-20">
                    <div class="col-lg-6 mb-20">
                    <form action="#" method="post">
                      <div class="row">
                        <div class="col-lg-12">
                          <h5 class="font-md-bold color-brand-3 mt-15 mb-20">Change Password</h5>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <input class="form-control font-sm" type="password" placeholder="New password*" name="newpassword">
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <input class="form-control font-sm" type="password" placeholder="Confirm password*" name="confirmpassword">
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group mt-20">
                          <div class="errorMessage"><?php if(!empty($message)){ echo '<img src="images/warning-red.png" style="width: 15px;">'.$message; }?></div>                          
                            <input class="btn btn-buy w-auto h54 font-md-bold" type="submit" name="change">
                          </div>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
      <div class="modal fade" id="ModalQuickview" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
          <div class="modal-content apply-job-form">
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-30">
              <div class="row">
                <div class="col-lg-6">
                  <div class="gallery-image">
                    <div class="galleries-2">
                      <div class="detail-gallery">
                        <div class="product-image-slider-2">
                          <figure class="border-radius-10"><img src="images/img-gallery-1.jpg" alt="product image"></figure>
                          <figure class="border-radius-10"><img src="images/img-gallery-2.jpg" alt="product image"></figure>
                          <figure class="border-radius-10"><img src="images/img-gallery-3.jpg" alt="product image"></figure>
                          <figure class="border-radius-10"><img src="images/img-gallery-4.jpg" alt="product image"></figure>
                          <figure class="border-radius-10"><img src="images/img-gallery-5.jpg" alt="product image"></figure>
                          <figure class="border-radius-10"><img src="images/img-gallery-6.jpg" alt="product image"></figure>
                          <figure class="border-radius-10"><img src="images/img-gallery-7.jpg" alt="product image"></figure>
                        </div>
                      </div>
                      <div class="slider-nav-thumbnails-2">
                        <div>
                          <div class="item-thumb"><img src="images/img-gallery-1.jpg" alt="product image"></div>
                        </div>
                        <div>
                          <div class="item-thumb"><img src="images/img-gallery-2.jpg" alt="product image"></div>
                        </div>
                        <div>
                          <div class="item-thumb"><img src="images/img-gallery-3.jpg" alt="product image"></div>
                        </div>
                        <div>
                          <div class="item-thumb"><img src="images/img-gallery-4.jpg" alt="product image"></div>
                        </div>
                        <div>
                          <div class="item-thumb"><img src="images/img-gallery-5.jpg" alt="product image"></div>
                        </div>
                        <div>
                          <div class="item-thumb"><img src="images/img-gallery-6.jpg" alt="product image"></div>
                        </div>
                        <div>
                          <div class="item-thumb"><img src="images/img-gallery-7.jpg" alt="product image"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-tags">
                    <div class="d-inline-block mr-25"><span class="font-sm font-medium color-gray-900">Category:</span><a class="link" href="#">Smartphones</a></div>
                    <div class="d-inline-block"><span class="font-sm font-medium color-gray-900">Tags:</span><a class="link" href="#">Blue</a>,<a class="link" href="#">Smartphone</a></div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="product-info">
                    <h5 class="mb-15">SAMSUNG Galaxy S22 Ultra, 8K Camera & Video, Brightest Display Screen, S Pen Pro</h5>
                    <div class="info-by"><span class="bytext color-gray-500 font-xs font-medium">by</span><a class="byAUthor color-gray-900 font-xs font-medium" href="shop-vendor-list.html"> Ecom Tech</a>
                      <div class="rating d-inline-block"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><img src="fonts/star.svg" alt="Ecom"><span class="font-xs color-gray-500 font-medium"> (65 reviews)</span></div>
                    </div>
                    <div class="border-bottom pt-10 mb-20"></div>
                    <div class="box-product-price">
                      <h3 class="color-brand-3 price-main d-inline-block mr-10">$2856.3</h3><span class="color-gray-500 price-line font-xl line-througt">$3225.6</span>
                    </div>
                    <div class="product-description mt-10 color-gray-900">
                      <ul class="list-dot">
                        <li>8k super steady video</li>
                        <li>Nightography plus portait mode</li>
                        <li>50mp photo resolution plus bright display</li>
                        <li>Adaptive color contrast</li>
                        <li>premium design & craftmanship</li>
                        <li>Long lasting battery plus fast charging</li>
                      </ul>
                    </div>
                    <div class="box-product-color mt-10">
                      <p class="font-sm color-gray-900">Color:<span class="color-brand-2 nameColor">Pink Gold</span></p>
                      <ul class="list-colors">
                        <li class="disabled"><img src="images/img-gallery-1.jpg" alt="Ecom" title="Pink"></li>
                        <li><img src="images/img-gallery-2.jpg" alt="Ecom" title="Gold"></li>
                        <li><img src="images/img-gallery-3.jpg" alt="Ecom" title="Pink Gold"></li>
                        <li><img src="images/img-gallery-4.jpg" alt="Ecom" title="Silver"></li>
                        <li class="active"><img src="images/img-gallery-5.jpg" alt="Ecom" title="Pink Gold"></li>
                        <li class="disabled"><img src="images/img-gallery-6.jpg" alt="Ecom" title="Black"></li>
                        <li class="disabled"><img src="images/img-gallery-7.jpg" alt="Ecom" title="Red"></li>
                      </ul>
                    </div>
                    <div class="box-product-style-size mt-10">
                      <div class="row">
                        <div class="col-lg-12 mb-10">
                          <p class="font-sm color-gray-900">Style:<span class="color-brand-2 nameStyle">S22</span></p>
                          <ul class="list-styles">
                            <li class="disabled" title="S22 Ultra">S22 Ultra</li>
                            <li class="active" title="S22">S22</li>
                            <li title="S22 + Standing Cover">S22 + Standing Cover</li>
                          </ul>
                        </div>
                        <div class="col-lg-12 mb-10">
                          <p class="font-sm color-gray-900">Size:<span class="color-brand-2 nameSize">512GB</span></p>
                          <ul class="list-sizes">
                            <li class="disabled" title="1GB">1GB</li>
                            <li class="active" title="512 GB">512 GB</li>
                            <li title="256 GB">256 GB</li>
                            <li title="128 GB">128 GB</li>
                            <li class="disabled" title="64GB">64GB</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="buy-product mt-5">
                      <p class="font-sm mb-10">Quantity</p>
                      <div class="box-quantity">
                        <div class="input-quantity">
                          <input class="font-xl color-brand-3" type="text" value="1"><span class="minus-cart"></span><span class="plus-cart"></span>
                        </div>
                        <div class="button-buy"><a class="btn btn-cart" href="shop-cart.html">Add to cart</a><a class="btn btn-buy" href="shop-checkout.html">Buy now</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
              <div class="font-md mb-20 color-gray-900"><strong class="font-md-bold">Address:</strong> Campus Universiapolis Bab Al Madina, Quartier Tillila, Agadir 80000</div>
              <div class="font-md mb-20 color-gray-900"><strong class="font-md-bold">Phone:</strong> (212)612 345 678</div>
              <div class="font-md mb-20 color-gray-900"><strong class="font-md-bold">E-mail:</strong> Mehdi.Oumaima@Marketech.com</div>
              <!-- <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="b0d3dfdec4d1d3c4f0d5d3dfdd9dddd1c2dbd5c49ed3dfdd">[email&#160;protected]</a> -->
              <div class="font-md mb-20 color-gray-900"><strong class="font-md-bold">Hours:</strong> 8:00 - 17:00, Mon - Sat</div>
              <div class="mt-30"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a><a class="icon-socials icon-linkedin" href="#"></a></div>
            </div>
            <div class="col-lg-3 width-16 mb-30">
              <h4 class="mb-30 color-gray-1000">Company</h4>
              <ul class="menu-footer">
                <li><a href="#">Our Blog</a></li>
                <li><a href="#">Plans &amp; Pricing</a></li>
                <li><a href="#">Knowledge Base</a></li>
                <li><a href="#">Cookie Policy</a></li>
                <li><a href="#">Office Center</a></li>
                <li><a href="#">News &amp; Events</a></li>
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
              <h4 class="mb-30 color-gray-1000">Payment</h4>
              <div>
                <p class="font-md color-gray-900 mt-20 mb-10">Secured Payment Gateways</p><img src="images/payment-method.png" alt="Ecom">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-2">
        <div class="footer-bottom-1">
          <div class="container">
            <div class="footer-2-top mb-20"><a href="index.php"><img alt="Ecom" src="fonts/logo.svg" width="150px"></a><a class="font-xs color-gray-1000" href="#">Market-tech.com</a></div>
            <div class="footer-2-bottom">
              <div class="head-left-footer">
                <h6 class="color-gray-1000">Electronic:</h6>
              </div>
              <div class="tags-footer"><a href="shop-grid.php">Headphones</a><a href="shop-list-2.html">Apple Watch</a><a href="shop-grid.php">HTC</a><a href="shop-grid.php">Ipad</a><a href="shop-grid.php">Keyboard</a><a href="shop-grid.php">Samsung</a><a href="shop-grid.php">Wireless Speaker</a><a href="shop-grid.php">Samsung Galaxy</a><a href="shop-grid.php">Gaming Mouse</a><a href="shop-grid.php">eBook Readers</a><a href="shop-grid.php">Service Plans</a><a href="shop-grid.php">Home Audio</a><a href="shop-grid.php">Office Electronics</a><a href="shop-grid.php">Lenovo</a><a href="shop-grid.php">Mackbook Pro M1</a><a href="shop-grid.php">HD Videos Player</a></div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="footer-bottom mt-20">
            <div class="row">
              <div class="col-lg-6 col-md-12 text-center text-lg-start"><span class="color-gray-900 font-sm">Copyright &copy; 2023 Ecom Market. All rights reserved.</span></div>
              <div class="col-lg-6 col-md-12 text-center text-lg-end">
                <ul class="menu-bottom">
                  <li><a class="font-sm color-gray-900" href="page-term.html">Conditions of Use</a></li>
                  <li><a class="font-sm color-gray-900" href="page-term.html">Privacy Notice</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script data-cfasync="false" src="js/email-decode.min.js"></script><script src="js/modernizr-3.6.0.min.js"></script>
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
    <!-- Count down--><script src="js/jquery.elevatezoom.js"></script>
<script src="js/slick.js"></script>
    <script src="js/main.js"></script>
    <script src="js/shop.js"></script>
  </body>
</html>
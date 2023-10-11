<?php
  require("config/db.php");
  session_start();
  @$ID_user = $_SESSION['ID_user'];
  if (!empty($_GET['reference'])) 
	{
		$reference = $_GET['reference'];
	}else{
    header("Location: page-404.html");
  }

  $connection = Database::getConnection();
  $sql = "SELECT * FROM product INNER JOIN categorie ON product.ID_cat=categorie.ID_cat  WHERE reference='$reference'";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $products = $statement->fetchAll();

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
    <title></title>
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
                      <option value="Computers Accessories">Computers Accessories.</option>
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
                    <li><a href="page-account.html">My Account</a></li>
                    <li><a href="page-account.html#tab-order-tracking">Order Tracking</a></li>
                    <li><a href="page-account.html#tab-orders">My Orders</a></li>
                    <li><a href="page-account.html">My Wishlist</a></li>
                    <li><a href="page-account.html#tab-setting">Setting</a></li>
                    <li><a href="logout.php">Sign out</a></li>
                  </ul>
                </div>
              </div><a class="font-lg icon-list icon-wishlist" href="shop-wishlist.html"><span>Wishlist</span><span class="number-item font-xs">5</span></a>
              <div class="d-inline-block box-dropdown-cart"><span class="font-lg icon-list icon-cart"><span>Cart</span><span class="number-item font-xs">2</span></span>
                <div class="dropdown-cart">
                  <div class="item-cart mb-20">
                    <div class="cart-image"><img src="images/imgsp5.png" alt="Ecom"></div>
                    <div class="cart-info"><a class="font-sm-bold color-brand-3" href="shop-single-product.html">2022 Apple iMac with Retina 5K Display 8GB RAM, 256GB SSD</a>
                      <p><span class="color-brand-2 font-sm-bold">1 x $2856.4</span></p>
                    </div>
                  </div>
                  <div class="item-cart mb-20">
                    <div class="cart-image"><img src="images/imgsp4.png" alt="Ecom"></div>
                    <div class="cart-info"><a class="font-sm-bold color-brand-3" href="shop-single-product-2.html">2022 Apple iMac with Retina 5K Display 8GB RAM, 256GB SSD</a>
                      <p><span class="color-brand-2 font-sm-bold">1 x $2856.4</span></p>
                    </div>
                  </div>
                  <div class="border-bottom pt-0 mb-15"></div>
                  <div class="cart-total">  
                    <div class="row">
                      <div class="col-6 text-start"><span class="font-md-bold color-brand-3">Total</span></div>
                      <div class="col-6"><span class="font-md-bold color-brand-1">$2586.3</span></div>
                    </div>
                    <div class="row mt-15">
                      <div class="col-6 text-start"><a class="btn btn-cart w-auto" href="shop-cart.html">View cart</a></div>
                      <div class="col-6"><a class="btn btn-buy w-auto" href="shop-checkout.html">Checkout</a></div>
                    </div>
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
        <div class="breadcrumbs-div"></div>
      <?php foreach($products as $product){?>
      <section class="section-box shop-template"> 
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="gallery-image">
                <div class="galleries">
                  <div class="detail-gallery">  
                    <div class="product-image-slider">
                      <figure class="border-radius-10"><img src="product/<?php echo $product['photo'];?>" alt="product image"></figure>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
                <h4 class="color-brand-3 mb-25"><?php echo $product['Tittle'];?></h4>
                <div class="border-bottom pt-20 mb-40"></div>
                <div class="box-product-price">
                  <h3 class="color-brand-3 price-main d-inline-block mr-10"><?php echo $product['price']; ?> MAD</h3>
                </div>
                <div class="product-description mt-20 color-gray-900">
                    <p><strong>Specification:</strong></p><br>
                    &ndash; <?php echo $product['minor_detail1'];?><br>
                    &ndash; <?php echo $product['minor_detail2'];?><br>
                    &ndash; <?php echo $product['minor_detail3'];?><br>
                </div>
                <div class="buy-product mt-20">
                  <p class="font-sm mb-20">Quantity</p>
                  <form method="post">
                    <div class="box-quantity">
                      <div class="input-quantity">
                        <input class="font-xl color-brand-3" type="text" name="quantity" value="1"><span class="minus-cart"></span><span class="plus-cart"></span>
                      </div>
                      <div style="margin-left:50px;" class="button-buy"><input class="btn btn-cart" type="submit" name="add_to_cart" value="Add to cart"></div>
                    </div>
                  </form>
                  <?php
                    if(isset($_POST['add_to_cart'])){
                      echo $reference = $product['reference'];
                      echo $price = $product['price'];
                      echo $ID_user = $_SESSION['ID_user'];
                      echo $quantity = $_REQUEST['quantity'];
                      $sql1 = "INSERT INTO cart(ID_user, reference, price, quantity) VALUES (:ID_user, :reference, :price, :quantity)";
                      $statement = $connection->prepare($sql1);
                      $statement->bindParam(':ID_user', $ID_user);
                      $statement->bindParam(':reference', $reference);
                      $statement->bindParam(':price', $price);
                      $statement->bindParam(':quantity', $quantity);
                      $statement->execute();
                      echo "<meta http-equiv='refresh' content='0'>";
                  }
                  ?>
                </div>
                <div class="border-bottom pt-30 mb-20"></div>
                <div class="info-product mt-20 font-md color-gray-900">Category: <?php echo $product['name'];?></div>
            </div>
          </div>
          <div class="border-bottom pt-30 mb-10"></div>
        </div>
      </section>
      <section class="section-box shop-template">
        <div class="container">
          <div class="pt-30 mb-10">
            <ul class="nav nav-tabs nav-tabs-product" role="tablist">
              <li><a class="active" href="#tab-description" data-bs-toggle="tab" role="tab" aria-controls="tab-description" aria-selected="true">Description</a></li>
              </ul>
            <div class="tab-content">
            <div class="tab-pane fade active show" id="tab-description" role="tabpanel" aria-labelledby="tab-description">
                <div class="display-text-short">
                  <p><?php echo $product['description_para1'];?></p>
                  <p><?php echo $product['description_para2'];?></p>
                  <p>
                    <img style="margin-right: 80px;" src="product\description\<?php echo $product['description_photo2'];?>" alt="IMAGE DESCRIPTION" width="45%">
                    <img src="product\description\<?php echo $product['description_photo3'];?>" alt="IMAGE DESCRIPTION" width="45%">
                  </p>
                  <p><?php echo $product['description_para3'];?></p>
                  <p>
                    <img src="product\description\<?php echo $product['description_photo1'];?>" alt="IMAGE DESCRIPTION">
                  </p>
                  <p><?php echo $product['description_para4'];?></p>
                </div>
                <div class="mt-20 text-center">
                  <a class="btn btn-border font-sm-bold pl-80 pr-80 btn-expand-more">More Details</a>
                </div>
            </div>
              <?php } ?>
              <div class="border-bottom pt-20 mb-40"></div>
              <h4 class="color-brand-3">You may also like</h4>
              <div class="list-products-5 mt-20 mb-40">
            <?php
                $connection = Database::getConnection();
                $sql1 = "SELECT * FROM product INNER JOIN categorie ON product.ID_cat=categorie.ID_cat ORDER BY RAND() LIMIT 5";
                $tst1 = $connection->prepare($sql1);
                $tst1->execute();
                $products = $tst1->fetchAll();
                foreach($products as $product){ ?>
            <div class="card-grid-style-3">
                <div class="card-grid-inner">
                <div class="tools"><a class="btn btn-wishlist btn-tooltip mb-10" href="addtowishlist.php?reference=<?php echo $product['reference']?>&ID_user=<?php echo $ID_user?>" aria-label="Add To Wishlist"></a></div>
                  <div class="image-box"><a href="shop-single-product.php?reference=<?php echo $product['reference'] ?>"><img src="product/<?php echo $product['photo'] ?>" alt="Ecom"></a></div>
                  <div class="info-right"><?php echo $product['brand'] ?></a><br><a class="color-brand-3 font-sm-bold" href="shop-single-product.php?reference=<?php echo $product['reference'] ?>"><?php echo $product['Tittle'] ?></a>
                    <div class="price-info"><strong class="font-lg-bold color-brand-3 price-main"><?php echo $product['price'] ?> MAD</strong></div>
                    <div class="mt-20 box-btn-cart"><a class="btn btn-cart" href="shop-cart.php">Add To Cart</a></div>
                    <ul class="list-features">
                      <li><?php echo $product['minor_detail1'] ?></li>
                      <li><?php echo $product['minor_detail2'] ?></li>
                      <li><?php echo $product['minor_detail3'] ?></li>
                    </ul>
                  </div>
                </div>
            </div>
            <?php } ?>
          </div>
              <div class="border-bottom pt-20 mb-40"></div>
            </div>
          </div>
        </div>
      </section>
      <section class="section-box mt-90 mb-50">
        <div class="container">
          <ul class="list-col-5">
            <li>
              <div class="item-list">
                <div class="icon-left"><img src="fonts/delivery.svg" alt="Ecom"></div>
                <div class="info-right">
                  <h5 class="font-lg-bold color-gray-100">Free Delivery</h5>
                  <p class="font-sm color-gray-500">From all orders over 5000 MAD</p>
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
                  <p class="font-sm color-gray-500">Free return over 2000 MAD</p>
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
            <div class="footer-2-top mb-20"><a href="index.html"><img alt="Ecom" src="fonts/logo.svg" width="150px"></a><a class="font-xs color-gray-1000" href="#">Market-tech.com</a></div>
            <div class="footer-2-bottom">
              <div class="head-left-footer">
                <h6 class="color-gray-1000">Electronic:</h6>
              </div>
              <div class="tags-footer"><a href="shop-grid.html">Headphones</a><a href="shop-list-2.html">Apple Watch</a><a href="shop-grid.html">HTC</a><a href="shop-grid.html">Ipad</a><a href="shop-grid.html">Keyboard</a><a href="shop-grid.html">Samsung</a><a href="shop-grid.html">Wireless Speaker</a><a href="shop-grid.html">Samsung Galaxy</a><a href="shop-grid.html">Gaming Mouse</a><a href="shop-grid.html">eBook Readers</a><a href="shop-grid.html">Service Plans</a><a href="shop-grid.html">Home Audio</a><a href="shop-grid.html">Office Electronics</a><a href="shop-grid.html">Lenovo</a><a href="shop-grid.html">Mackbook Pro M1</a><a href="shop-grid.html">HD Videos Player</a></div>
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
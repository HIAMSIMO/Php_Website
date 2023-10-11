<?php
  require("config/db.php");
  session_start();
  @$ID_user = $_SESSION['ID_user'];
  $connection = Database::getConnection();
  if(isset($_GET['submit']) ){
    if(isset($_REQUEST['brandchecked'])){
        $min_price = $_REQUEST['MIN'];
        $max_price = $_REQUEST['MAX'];
        $brand = $_REQUEST['brandchecked'];
      $sql = "SELECT * FROM product INNER JOIN categorie ON product.ID_cat=categorie.ID_cat  WHERE brand = '$brand' AND price BETWEEN $min_price AND $max_price ORDER BY `product`.`minor_detail1` ASC";
    }else{
      $min_price = $_REQUEST['MIN'];
      $max_price = $_REQUEST['MAX'];

      $sql = "SELECT * FROM product INNER JOIN categorie ON product.ID_cat=categorie.ID_cat AND price BETWEEN $min_price AND $max_price ORDER BY `product`.`minor_detail1` ASC";
    }
    
  }else if(isset($_GET['category'])){
    $name = $_GET['category'];
    $sql = "SELECT * FROM product INNER JOIN categorie ON product.ID_cat=categorie.ID_cat WHERE name = '$name' ORDER BY `product`.`minor_detail1` ASC";
    
}else{
  $sql = "SELECT * FROM product INNER JOIN categorie ON product.ID_cat=categorie.ID_cat ORDER BY `product`.`minor_detail1` ASC";
}
  $statement = $connection->prepare($sql);
  $statement->execute();
  $products = $statement->fetchAll();

  $sqlcat = "SELECT * FROM categorie";
  $statement = $connection->prepare($sqlcat);
  $statement->execute();
  $categories = $statement->fetchAll();

  $carty="SELECT * FROM cart INNER JOIN product ON cart.reference=product.reference WHERE ID_user = '$ID_user'";
  $statement = $connection->prepare($carty);
  $statement->execute();
  $carts = $statement->fetchAll();
  $cart_counter = $statement->rowcount();
  $total = 0;

  $sql="SELECT * FROM wishlist WHERE ID_user = '$ID_user'";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $wishlist = $statement->fetchAll();
  $wish_counter = $statement->rowcount();
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
    <title>Shop Grid - Ecom Marketplace Template</title>
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
              if(isset($_SESSION['fullName']))
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
    <div class="sidebar-left"><a class="btn btn-open" href="shop-grid.php?category=Laptop"></a>
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
      <div class="section-box">
        <div class="breadcrumbs-div">
        </div>
      </div>
      <div class="section-box shop-template mt-30">
        <div class="container">
          <div class="row">
            <div class="col-lg-9 order-first order-lg-last">
              <div class="row mt-20">
                <?php foreach($products as $product){ ?>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                
                  <div class="card-grid-style-3">
                    <div class="card-grid-inner">
                    <div class="tools"><a class="btn btn-wishlist btn-tooltip mb-10" href="addtowishlist.php?reference=<?php echo $product['reference']?>&ID_user=<?php echo $ID_user?>"" aria-label="Add To Wishlist"></a></div>
                      <div class="image-box"><a href="shop-single-product.php?reference=<?php echo $product['reference'] ?>"><img src="product/<?php echo $product['photo'] ?>" alt="Ecom"></a></div>
                      <div class="info-right"><?php echo $product['brand'] ?></a><br><a class="color-brand-3 font-sm-bold" href="shop-single-product.php?reference=<?php echo $product['reference'] ?>"><?php echo $product['Tittle'] ?></a>
                        <div class="price-info"><strong class="font-lg-bold color-brand-3 price-main"><?php echo $product['price'] ?> MAD</strong></div>
                        <div class="mt-20 box-btn-cart"><a class="btn btn-cart" href="addtocart.php?reference=<?php echo $product['reference']?>&ID_user=<?php echo $ID_user?>&price=<?php echo $product['price']?>&quantity=1">Add To Cart</a></div>
                        <ul class="list-features">
                          <li><?php echo $product['minor_detail1'] ?></li>
                          <li><?php echo $product['minor_detail2'] ?></li>
                          <li><?php echo $product['minor_detail3'] ?></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <?php  } ?>
              </div>
            </div>
            <div class="col-lg-3 order-last order-lg-first">
              <div class="sidebar-border mb-0">
                <div class="sidebar-head">
                  <h6 class="color-gray-900">Product Categories</h6>
                </div>
                <div class="sidebar-content">
                  <ul class="list-nav-arrow">
                    <?php foreach($categories as $category){ ?>
                      <form method="get">
                    <li><a href="shop-grid.php?category=<?php echo $category['name'] ?>"><?php echo $category['name']?></a></li>
                    
                    </form>
                    <?php } ?>
                  </ul>
                  <div>
                  </div>
                </div>
              </div>
              <div class="sidebar-border mb-40">
                <div class="sidebar-head">
                  <h6 class="color-gray-900">Products Filter</h6>
                </div>
                <div class="sidebar-content">
                <form method="get">
                  <h6 class="color-gray-900 mt-10 mb-10">Price</h6>
                  <div class="box-slider-range mt-20 mb-15">
                    <div class="row mb-20">
                      <div class="col-sm-12">
                        <div id="slider-range"></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <label class="lb-slider font-sm color-gray-500">Price Range:</label><span class="min-value-money font-sm color-gray-1000"></span>
                        <label class="lb-slider font-sm font-medium color-gray-1000">MAD</label>-
                        <span class="max-value-money font-sm font-medium color-gray-1000"></span>
                        <label class="lb-slider font-sm font-medium color-gray-1000">MAD</label>
                      </div>
                      
                      <div class="col-lg-12">
                          <input class="form-control min-value" type="hidden" name="MIN">
                          <input class="form-control max-value" type="hidden" name="MAX">
                      </div>
                        
                      
                    </div>
                  </div>
                  <h6 class="color-gray-900 mt-20 mb-10">Brands</h6>
                  <ul class="list-checkbox">
                  <?php
                  $connection = Database::getConnection();
                  $sql1 = "SELECT DISTINCT brand FROM product INNER JOIN categorie ON product.ID_cat=categorie.ID_cat ORDER BY `brand` ASC";
                  $statement = $connection->prepare($sql1); 
                  $statement->execute();
                  $brands = $statement->fetchAll();
                  $count = $statement->rowCount();

                  foreach($brands as $brand){ ?>
                    <li>
                      <label class="cb-container">
                        <input type="radio" name ="brandchecked" value="<?php echo $brand['brand'] ?>"><span class="text-small"><?php echo $brand['brand'] ?></span><span class="checkmark"></span>
                      </label>
                    </li>
                    
                    <?php }?>
                  </ul>
                  <input class="btn btn-brand-2" type="submit" name="submit" value="Valid">
                  </form>
                </div>
              </div>
              <div class="box-slider-item mb-30"> 
              <div class="banner-right h-500 text-center mb-30"><span class="text-no font-11">No.9</span>
                <h5 class="font-23 mt-20">Sensitive Touch<br class="d-none d-lg-block">without fingerprint</h5>
                <p class="text-desc font-16 mt-15">Smooth handle and accurate click</p>
              </div>
            </div>
          </div>
        </div>
      </div>
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
            <!-- <div class="col-lg-3 width-20 mb-30">
              <h4 class="mb-30 color-gray-1000">Make Money with Us</h4>
              <ul class="menu-footer">
                <li><a href="page-about-us.html">Mission &amp; Vision</a></li>
                <li><a href="page-about-us.html">Our Team</a></li>
                <li><a href="page-careers.html">Careers</a></li>
                <li><a href="#">Press &amp; Media</a></li>
                <li><a href="#">Advertising</a></li>
                <li><a href="#">Testimonials</a></li>
              </ul>
            </div> -->
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
              <div class="tags-footer"><a href="shop-grid.html">Headphones</a><a href="shop-list-2.html">Apple Watch</a><a href="shop-grid.html">HTC</a><a href="shop-grid.html">Ipad</a><a href="shop-grid.html">Keyboard</a><a href="shop-grid.html">Samsung</a><a href="shop-grid.html">Wireless Speaker</a><a href="shop-grid.html">Samsung Galaxy</a><a href="shop-grid.html">Gaming Mouse</a><a href="shop-grid.html">eBook Readers</a><a href="shop-grid.html">Service Plans</a><a href="shop-grid.html">Home Audio</a><a href="shop-grid.html">Office Electronics</a><a href="shop-grid.html">Lenovo</a><a href="shop-grid.html">Mackbook Pro M1</a><a href="shop-grid.html">HD Videos Player</a></div>
            </div>
            <!-- <div class="footer-2-bottom">
              <div class="head-left-footer">
                <h6 class="color-gray-1000">Furniture:</h6>
              </div>
              <div class="tags-footer"><a href="shop-grid.html">Sofa</a><a href="shop-grid.html">Chair</a><a href="shop-grid.html">Dining Table</a><a href="shop-grid.html">Living Room</a><a href="shop-grid.html">Table Lamp</a><a href="shop-grid.html">Night Stand</a><a href="shop-grid.html">Computer Desk</a><a href="shop-grid.html">Bar Table</a><a href="shop-grid.html">Pillow</a><a href="shop-grid.html">Radio</a><a href="shop-grid.html">Clock</a><a href="shop-grid.html">Bad Room</a><a href="shop-grid.html">Stool</a><a href="shop-grid.html">Television</a><a href="shop-grid.html">wardrobe</a><a href="shop-grid.html">Living Room Tables</a><a href="shop-grid.html">Dressers</a><a href="shop-grid.html">Patio Sofas</a><a href="shop-grid.html">Nursery</a><a href="shop-grid.html">Kitchen</a><a href="shop-grid.html">Accent Furniture</a><a href="shop-grid.html">Replacement Parts</a></div>
            </div> -->
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
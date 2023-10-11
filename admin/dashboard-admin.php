<?php
require "../config/db.php";
session_start();

$connection = Database::getConnection();
$sql = "SELECT * FROM `users` WHERE `type`='client'";
$statement = $connection->prepare($sql);
$statement->execute();
$nbr_clients = $statement->rowcount();

$sql1 = "SELECT * FROM `orders`";
$statement = $connection->prepare($sql1);
$statement->execute();
$nbr_orders = $statement->rowcount();
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
    <title>Ecom - Ecom Marketplace Template</title>
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
            <?php if (isset($_SESSION["ID_user"])) {
                echo '<span>Welcome Admin </span><a class="session1" href="page-account.html">' .
                    $_SESSION["fullName"] .
                    "</a>";
            } ?>
          </ul>
        </div>
        </div>
      </div>
    </div>
    <header class="header sticky-bar">
      <div class="container">
        <div class="main-header">
          <div class="header-left">
            <div class="header-logo"><a class="d-flex" href="dashboard-admin.php"><img alt="Ecom" src="fonts/logo.svg"></a></div>
            <div class="header-search">
            </div>
            <div class="header-nav">
              <nav class="nav-main-menu d-none d-xl-block">
                <ul class="main-menu">
                  <li class="has-children"><a class="active" href="dashboard-admin.php">Dashboard</a></li>
                  <li class="has-children"><a class="active" href="logout.php">Sign out</a></li>  
                </ul>
              </nav>
              <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="sidebar-left"><a class="btn btn-open" href="#"></a>
      <ul class="menu-texts menu-close">
        <li class="has-children"><a href="#"><span class="img-link"><img src="fonts/list.svg" alt="Ecom"></span><span class="text-link">List</span></a>
          <ul class="sub-menu">
            <li><a href="product-list.php">Product list</a></li>
            <li><a href="order-list.php">Order list</a></li>
            <li><a href="cat-list.php">Category list</a></li>
            <li><a href="client-list.php">Client list</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <main class="main">
      <section class="section-box">
        <div class="banner-hero banner-1">
          <div class="container">
            <div class="row">
              <div style="margin-right:30%;" class="col-lg-4">
                <div class="row">
                  <div class="col-lg-12 col-md-6 col-sm-12">
                    <div class="banner-small client bg-13">
                      <h4 class="mb-10"><?php echo $nbr_clients; ?></h4>
                      <p class="color-brand-3 font-desc">Registered<br class="d-none d-lg-block"> Client</p>
                      <div class="mt-20"><a class="btn btn-brand-3 btn-arrow-right" href="client-list.php">Details</a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="row">
                  <div class="col-lg-12 col-md-6 col-sm-12">
                    <div class="banner-small orders bg-13">
                      <h4 class="mb-10"><?php echo $nbr_orders; ?></h4>
                      <p class="color-brand-3 font-desc">Total<br>Orders</p>
                      <div class="mt-20"><a class="btn btn-brand-3 btn-arrow-right" href="order-list.php">Details</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <footer class="footer">
      <div class="footer-2">
        <div class="footer-bottom-1">
          <div class="container">
            <div class="footer-2-top mb-20"><a href="dashboard-admin.html"><img alt="Ecom" src="fonts/logo.svg" width="150px"></a><a class="font-xs color-gray-1000" href="#">Market-tech.com</a></div>
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
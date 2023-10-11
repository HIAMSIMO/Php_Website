<?php
require "../config/db.php";
session_start();
$connection = Database::getConnection();
$sql ="SELECT * FROM orders INNER JOIN product ON orders.reference=product.reference INNER JOIN users ON orders.ID_user=users.ID_user ORDER BY date_commande DESC";
$statement = $connection->prepare($sql);
$statement->execute();
$orders = $statement->fetchAll();

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
            <h3>Orders list</h3><br>
            <div class="row">
              <table>
                <thead>
                  <tr>
                  <th class="list">Full name client</th>
                    <th class="list">Photo</th>
                    <th class="list">Brand</th>
                    <th class="list">Tittle</th>
                    <th class="list">Quantity</th>
                    <th class="list">Date & Heure</th>
                    <th class="list">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($orders as $order) {
                    $fullname = $order['firstname']." ".$order['lastname'];
                    ?>
                  <tr>
                    <td><br><br><?php echo $fullname; ?></td>
                    <td><div class="td1"><br><img class="img" src="../product/<?php echo $order[
                        "photo"
                    ]; ?>" ></div></td>
                    <td class="text"><br><br><?php echo $order[
                        "brand"
                    ]; ?></td>
                    <td><br><br><?php echo $order["Tittle"]; ?></td>
                    <td><br><br><?php echo $order["quantity"]; ?></td>
                    <td><br><br><?php echo $order["date_commande"]; ?></td>
                    <td><br><br>&nbsp;&nbsp;<a class="btn btn-outline-danger" href="order-list.php?ID_cmd=<?php echo $order[
                        "ID_cmd"
                    ]; ?>">Delete</a>
                    <?php if (isset($_GET["ID_cmd"])) {
                        $ID_cmd = $_GET["ID_cmd"];
                        $connection = Database::getConnection();
                        $statement = $connection->prepare(
                            "DELETE FROM `orders` WHERE ID_cmd= '$ID_cmd'"

                            
                        );
                        $statement->execute();
                     
                        

                        
                    } ?>
                      
                    </td>

                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <div class="border-bottom pt-60 mb-60"></div>
        </div>
      </section>
    </main>
    <div class="border-bottom pt-30 mb-10"></div>
    <footer class="footer">
      <div class="footer-2">
        <div class="footer-bottom-1">
          <div class="container">
            <div class="footer-2-top mb-20"><a href="dashboard-admin.php"><img alt="Ecom" src="fonts/logo.svg" width="150px"></a><a class="font-xs color-gray-1000" href="#">Market-tech.com</a></div>
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
    <style>
      .list{
        font-size:22px;
        text-align: center;
        border: 1px solid #425a8b;
        padding: 10px;
      }
      td{
        font-size:18px;
        align-content: center;
        text-align:center;
        border: 1px solid #425a8b;
        padding-bottom:  15px;
      }
      .td1{
        padding-top: 20px;
      }
      .img{
        width: 100px;
      }
      .text{
        padding-bottom:50px;
      }
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
  
        input[type=number] {
            -moz-appearance: textfield;
        }
        #num1{
          margin-left: 7%;
        }
        #num2{
          margin-left: 7px;
        }
    </style>
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
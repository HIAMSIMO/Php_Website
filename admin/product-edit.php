<?php
require "../config/db.php";
session_start();
if (isset($_GET["reference"])) {
    $reference = $_GET["reference"];
    $connection = Database::getConnection();
    $sql = "SELECT * FROM product INNER JOIN categorie ON product.ID_cat=categorie.ID_cat WHERE reference='$reference'";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $products = $statement->fetchAll();
}

if (isset($_POST["submit"])) {
    $brand = stripslashes($_REQUEST["brand"]);
    echo $brand;
    $model = $_REQUEST["model"];
    $Tittle = $_REQUEST["Tittle"];
    $minor_detail1 = $_REQUEST["minor_detail1"];
    $minor_detail2 = $_REQUEST["minor_detail2"];
    $minor_detail3 = $_REQUEST["minor_detail3"];
    $description_para1 = $_REQUEST["description_para1"];
    $description_para2 = $_REQUEST["description_para2"];
    $description_para3 = $_REQUEST["description_para3"];
    $description_para4 = $_REQUEST["description_para4"];
    $price = stripslashes($_REQUEST["price"]);
    $stock_quantity = stripslashes($_REQUEST["stock_quantity"]);
    $connection = Database::getConnection();
    $sql1 = "UPDATE product SET brand = :brand, model = :model, Tittle = :Tittle, minor_detail1 = :minor_detail1, minor_detail2 = :minor_detail2, 
                              minor_detail3 = :minor_detail3, description_para1 = :description_para1, description_para2 = :description_para2, description_para3 = :description_para3,
                              description_para4 = :description_para4, price = :price, stock_quantity = :stock_quantity WHERE reference = '$reference'";
    $statement = $connection->prepare($sql1);
    $statement->bindParam(":brand", $brand);
    $statement->bindParam(":model", $model);
    $statement->bindParam(":Tittle", $Tittle);
    $statement->bindParam(":minor_detail1", $minor_detail1);
    $statement->bindParam(":minor_detail2", $minor_detail2);
    $statement->bindParam(":minor_detail3", $minor_detail3);
    $statement->bindParam(":description_para1", $description_para1);
    $statement->bindParam(":description_para2", $description_para2);
    $statement->bindParam(":description_para3", $description_para3);
    $statement->bindParam(":description_para4", $description_para4);
    $statement->bindParam(":price", $price);
    $statement->bindParam(":stock_quantity", $stock_quantity);
    $statement->execute();
    header("Refresh:0");
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
              echo '<span>Welcome Admin </span><a class="session1" href="page-account.html">' .$_SESSION["fullName"]."</a>";
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
            <li><a href="order-list.html">Order list</a></li>
            <li><a href="cat-list.html">Category list</a></li>
            <li><a href="client-list.html">Client list</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <main class="main">
      <section class="section-box">
        <div class="banner-hero banner-1">
          <div class="container">
          <h3>Edit product</h3><br>
              <div class="border-bottom pt-1 mb-4"></div>

          <div class="row">
          <?php foreach ($products as $product) { ?>
            <form method="post" action="product-edit.php?reference=<?php echo $product['reference']?>">
                
                  <p><b>brand:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="input" type="text" name="brand" value="<?php echo $product[
                    "brand"
                ]; ?>"><br><br>

                Model:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="input" type="text" name="model"  value="<?php echo $product[
                    "model"
                ]; ?>" required><br><br>
                Tittle:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="input" type="text" name="Tittle" value="<?php echo $product[
                    "Tittle"
                ]; ?>" required><br><br>
                Category:&nbsp;&nbsp;</label><input class="input" type="text" name="categorie" placeholder="category" value="<?php echo $product[
                    "name"
                ]; ?>" readonly="readonly"><br><br>
                Specification:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="minor_detail1" style="width: 30%;" value="<?php echo $product[
                    "minor_detail1"
                ]; ?>" required>&nbsp;
                                   <input type="text" name="minor_detail2"  style="width: 28%;" value="<?php echo $product[
                                       "minor_detail2"
                                   ]; ?>" required>&nbsp;
                                   <input type="text" name="minor_detail3"  style="width: 28%;" value="<?php echo $product[
                                       "minor_detail3"
                                   ]; ?>" required>&nbsp;<br><br>
                S.quantity:<input class="input" type="text" name="stock_quantity" placeholder="stock_quantity" value="<?php echo $product[
                    "stock_quantity"
                ]; ?>"><br><br>
                <label>Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input class="input" type="text" name="price" placeholder="Price" value="<?php echo $product[
                    "price"
                ]; ?>" required> DH*<br><br>
               <label>Description :</label><br><br><textarea name="description_para1" cols="35" rows="5" placeholder="Description 1" required><?php echo $product[
                   "description_para1"
               ]; ?></textarea>&nbsp;
                                  <textarea  name="description_para2" cols="35" rows="5" placeholder="Description 2" rows="4" cols="50" required><?php echo $product[
                                      "description_para2"
                                  ]; ?></textarea>&nbsp;
                                  <textarea name="description_para3" cols="35" rows="5" placeholder="Description 3" required><?php echo $product[
                                      "description_para3"
                                  ]; ?></textarea>&nbsp;
                                  <textarea name="description_para4" cols="35" rows="5" placeholder="Description 4" required><?php echo $product[
                                      "description_para4"
                                  ]; ?></textarea><br><br><br>
                <div class="border-bottom pt-1 mb-4"></div>
                <label>Existing Featured Photo</label><br><br><img src="../product/<?php echo $product[
                    "photo"
                ]; ?>" title="existingimg" style="width: 25%; margin-left: 6%;"><br><br><br>
                <label>Other Photos:</label><br><br><img src="../product/description/<?php echo $product[
                    "description_photo2"
                ]; ?>" title="existingimg" style="width: 25%;">&nbsp;&nbsp;&nbsp;
                                            <img src="../product/description/<?php echo $product[
                                                "description_photo3"
                                            ]; ?>" title="existingimg" style="width: 25%;">&nbsp;&nbsp;&nbsp;
                                            <img src="../product/description/<?php echo $product[
                                                "description_photo1"
                                            ]; ?>" title="existingimg" style="width: 25%;"><br><br><br>
                <div class="border-bottom pt-1 mb-4"></div>
                <input class="btn btn-outline-success" type="submit" name="submit" value="Update">
                <?php }?>

            </form>
          </div>
        </div>
      </section>
    </main>
    <div class="border-bottom pt-30 mb-10"></div>
    <footer class="footer">
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
    <style>
      body{
        font-weight : bold;
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
  <style>label{font-size: 1.3em;}</style>
</html>
<?php
require "../config/db.php";
session_start();
$connection = Database::getConnection();
$sql ="SELECT * FROM product INNER JOIN categorie ON product.ID_cat=categorie.ID_cat";
$statement = $connection->prepare($sql);
$statement->execute();
$products = $statement->fetchAll();

$query = "SELECT * FROM categorie";
$statement = $connection->prepare($query);
$statement->execute();
$cats = $statement->fetchAll();

if (isset($_POST['submit'])){
  $brand = $_REQUEST['brand'];
  $model = $_REQUEST['model'];
  $ID_cat = $_REQUEST['ID_cat'];
  $Tittle = $_REQUEST['Tittle'];
  $minor_detail1 = $_REQUEST['minor_detail1'];
  $minor_detail2 = $_REQUEST['minor_detail2'];
  $minor_detail3 = $_REQUEST['minor_detail3'];
  $description_para1 = $_REQUEST['description_para1'];
  $description_para2 = $_REQUEST['description_para2'];
  $description_para3 = $_REQUEST['description_para3'];
  $description_para4 = $_REQUEST['description_para4'];
  $price = stripslashes($_REQUEST['price']);
  $stock_quantity = stripslashes($_REQUEST['stock_quantity']);

  //Main photo
  $uploaddir = '../product/';
  $fileName = $_FILES['photo']['name'];
  $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
  echo $uploadfile;

  //Other photos
  $uploaddir1 = '../product/description/';
  $fileName1 = $_FILES['description_photo1']['name'];
  $uploadfile1 = $uploaddir1 . basename($_FILES['description_photo1']['name']);
  echo $uploadfile1;

  $uploaddir1 = '../product/description/';
  $fileName2 = $_FILES['description_photo2']['name'];
  $uploadfile2 = $uploaddir1 . basename($_FILES['description_photo2']['name']);
  echo $uploadfile2;

  $uploaddir1 = '../product/description/';
  $fileName3 = $_FILES['description_photo3']['name'];
  $uploadfile3 = $uploaddir1 . basename($_FILES['description_photo3']['name']);
  echo $uploadfile3;
  $connection = Database::getConnection();
  $sql0 = "INSERT INTO product(brand, model, ID_cat, Tittle, minor_detail1, minor_detail2, minor_detail3, description_para1, description_para2, description_para3, description_para4, price, stock_quantity, photo, description_photo1, description_photo2, description_photo3) 
           VALUES (:brand, :model, :ID_cat, :Tittle, :minor_detail1, :minor_detail2, :minor_detail3, :description_para1, :description_para2, :description_para3, :description_para4, :price, :stock_quantity, :photo, :description_photo1, :description_photo2, :description_photo3)";
  if(move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)){
    if(move_uploaded_file($_FILES['description_photo1']['tmp_name'], $uploadfile1)){
      if(move_uploaded_file($_FILES['description_photo2']['tmp_name'], $uploadfile2)){
        if(move_uploaded_file($_FILES['description_photo3']['tmp_name'], $uploadfile3)){
          $statement = $connection->prepare($sql0);
          $statement->bindParam(':brand', $brand);
          $statement->bindParam(':model', $model);
          $statement->bindParam(':ID_cat', $ID_cat);
          $statement->bindParam(':Tittle', $Tittle);
          $statement->bindParam(':minor_detail1', $minor_detail1);
          $statement->bindParam(':minor_detail2', $minor_detail2);
          $statement->bindParam(':minor_detail3', $minor_detail3);
          $statement->bindParam(':description_para1', $description_para1);
          $statement->bindParam(':description_para2', $description_para2);
          $statement->bindParam(':description_para3', $description_para3);
          $statement->bindParam(':description_para4', $description_para4);
          $statement->bindParam(':price', $price);
          $statement->bindParam(':stock_quantity', $stock_quantity);
          $statement->bindParam(':photo', $fileName);
          $statement->bindParam(':description_photo1', $fileName1);
          $statement->bindParam(':description_photo2', $fileName2);
          $statement->bindParam(':description_photo3', $fileName3);
          $statement->execute();
          header("Refresh:0");
  }}}}
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
            <h3>Product list</h3><br>
            <div class="row">
              <table>
                <thead>
                  <tr>
                    <th class="list">Photo</th>
                    <th class="list">Brand</th>
                    <th class="list">Tittle</th>
                    <th class="list">Quantity</th>
                    <th class="list">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($products as $product) { ?>
                  <tr>
                    <td><div class="td1"><br><img class="img" src="../product/<?php echo $product[
                        "photo"
                    ]; ?>" ></div></td>
                    <td class="text"><br><br><?php echo $product[
                        "brand"
                    ]; ?></td>
                    <td><br><br><?php echo $product["Tittle"]; ?></td>
                    <td><br><br><?php echo $product["stock_quantity"]; ?></td>
                    <td><br><a class="btn btn-outline-primary" href="product-edit.php?reference=<?php echo $product[
                        "reference"
                    ]; ?>">Edit</a><br>&nbsp;&nbsp;<a class="btn btn-outline-danger" href="product-list.php?reference=<?php echo $product[
                        "reference"
                    ]; ?>">Delete</a>
                    <?php if (isset($_GET["reference"])) {
                        $reference = $_GET["reference"];
                        $connection = Database::getConnection();
                        $statement = $connection->prepare(
                            "DELETE FROM `product` WHERE reference= '$reference'"
                            
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
          <h3>Add Product</h3><br>
          <div class="row">
            <form method="post" action="product-list.php" enctype="multipart/form-data">
                Brand:<input type="text" name="brand" placeholder="brand" style="margin-left:6%; width: 20%;" required><br><br>
                Model<input type="text" name="model" placeholder="model" style="margin-left:6%; width: 20%;" required><br><br>
                Tittle:<input type="text" name="Tittle" placeholder="tittle" style="margin-left:6%; width: 20%;" required><br><br>
                Category:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select style="width: 20%;" name="ID_cat" required>
                <option value="">Select category</option>
                <?php foreach ($cats as $cat) {
                echo "<option value='"  .$cat["ID_cat"]."'>" .$cat["name"] ."</option>";
                } ?>
                </select><br><br>
                Specification:&nbsp;&nbsp;&nbsp;&nbsp;<input style="width: 28%;" type="text" name="minor_detail1" placeholder="spec1" required>&nbsp;&nbsp;
                                   <input style="width: 28%;" type="text" name="minor_detail2" placeholder="spec2" required>&nbsp;&nbsp;
                                   <input style="width: 28%;" type="text" name="minor_detail3" placeholder="spec3" required>&nbsp;&nbsp;<br><br>
                Description : <br><textarea name="description_para1" rows="5" cols="35" placeholder="Description 1" required></textarea>&nbsp;
                                  <textarea name="description_para2" rows="5" cols="35" placeholder="Description 2" required></textarea>&nbsp;
                                  <textarea name="description_para3" rows="5" cols="35" placeholder="Description 3" required></textarea>&nbsp;
                                  <textarea name="description_para4" rows="5" cols="35" placeholder="Description 4" required></textarea><br><br>
                Price :<input id="num1" type="text" name="price">DH*<br><br>
                Stock_quantity : <input id="num2" type="text" name="stock_quantity"><br><br> 
                 Main photo*: <input type="file" name="photo" id="photo" ><br><br>
                Photo1*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="description_photo1" ><br><br>
                Photo2*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="description_photo2" ><br><br>
                Photo3*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="description_photo3" ><br> 
                *ONLY (*.jpg/*.jpeg/*.png) files<br><br>
                <input class="btn btn-outline-success" type="submit" name="submit" value="Add">
                <?php
                //$target_dir = "product/";
                //$target_file = $tar get_dir . basename($_FILES["photo"]["name"]);
                //$photo = basename()
                //$uploadOk = 1;
                ?>
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
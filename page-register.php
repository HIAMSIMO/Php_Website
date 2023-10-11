<?php
  require('config/db.php');
  session_start();

  if(isset($_POST['submit'])){
    $firstname = stripslashes($_REQUEST['fname']);
    $lastname = stripslashes($_REQUEST['lname']);
    $telephone = stripslashes($_REQUEST['tel']);
    $email = stripslashes($_REQUEST['email']);
    $address = stripslashes($_REQUEST['address']);
    $postalcode = stripslashes($_REQUEST['zip']);
    $city = stripslashes($_REQUEST['city']);
    $password = stripslashes($_REQUEST['password']);
    $repassword = stripslashes($_REQUEST['repassword']);
    if($password != $repassword)
    {
      $message = "Password incorrect";
    }
    else{
      $connection = Database::getConnection();
      $sql = "INSERT INTO users(firstname, lastname, telephone, email, address, city, postalcode, type, password) 
              VALUES (:firstname, :lastname, :telephone, :email, :address, :city, :postalcode, :type, :password)";
      $statement = $connection->prepare($sql);
      $type = 'client';
      $statement->bindParam(':firstname', $firstname);
      $statement->bindParam(':lastname', $lastname);
      $statement->bindParam(':telephone', $telephone);
      $statement->bindParam(':email', $email);
      $statement->bindParam(':address', $address);
      $statement->bindParam(':city', $city);
      $statement->bindParam(':postalcode', $postalcode);
      $statement->bindParam(':type', $type);
      $statement->bindParam(':password', hash('sha256', $password));
      $statement->execute();
      header("Location: page-login.php");
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
    <title>Register - Ecom Marketplace Template</title>
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
            <li><a class="font-xs" href="page-about-us.php">About Us</a></li>
            <li><a class="font-xs" href="page-register.php">Register</a></li>
            <li><a class="font-xs" href="page-login.php">Login</a></li>
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
                  <li class="has-children"><a class="active" href="index.php">Home</a></li>
                   
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
                    <li><a href="logout.php">Sign out</a></li>
                  </ul>
                </div>
              <div class="d-inline-block box-dropdown-cart"><span class="font-lg icon-list icon-cart"><span>Cart</span></span>
                <div class="dropdown-cart">
                  <div class="item-cart mb-20">

                  </div>

                    <div class="row mt-15">
                      <div class="col-6 text-start"><a class="btn btn-cart w-auto" href="shop-cart.php">View cart</a></div>
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
      <section class="section-box shop-template mt-60">
        <form method="post">
        <div class="container">
          <div class="row mb-100">
            <div class="col-lg-1"></div>
            <div class="col-lg-5">
              <h3>Create an account</h3>
              <p class="font-md color-gray-500">Access to all features. No credit card required.</p>
              <div class="form-register mt-30 mb-30">
                <div class="form-group">
                  <label class="mb-5 font-sm color-gray-700">First Name *</label>
                  <input class="form-control" type="text" placeholder="Steven" name="fname">
                </div>
                <div class="form-group">
                  <label class="mb-5 font-sm color-gray-700">Telephone *</label>
                  <input class="form-control" type="tel" placeholder="0612346789" name="tel">
                </div>
                <div class="form-group">
                  <label class="mb-5 font-sm color-gray-700">Address *</label>
                  <input class="form-control" type="text" placeholder="Lionel Messi street" name="address">
                </div>
                <div class="form-group">
                  <label class="mb-5 font-sm color-gray-700">City *</label>
                  <input class="form-control" type="text" placeholder="Agadir" name="city">
                </div>
                <div class="form-group">
                  <label class="mb-5 font-sm color-gray-700">Password *</label>
                  <input class="form-control" type="password" placeholder="******************" name="password">
                </div>
                <div class="form-group">
                  <label class="mb-5 font-sm color-gray-700">Re-Password *</label>
                  <input class="form-control" type="password" placeholder="******************" name="repassword">
                </div>
                <div class="form-group">
                  <label>
                    <input class="checkagree" type="checkbox" required>By clicking Register button, you agree our terms and policy,
                  </label>
                </div>
                <style>
                 .errorMessage {
                 font-size: 13px;
                 text-align: left;
                 color: red;
                 font-weight: 600;
                  }
                </style>
                <div class="form-group">
                  <input class="font-md-bold btn btn-buy" type="submit" value="Sign Up" name="submit">
                  <?php if (! empty($message)) { ?>
                            <p class="errorMessage"><?php echo $message; ?></p>
                        <?php } ?>
                </div>
                <div class="mt-20"><span class="font-xs color-gray-500 font-medium">Already have an account?</span><a class="font-xs color-brand-3 font-medium" href="page-login.php"> Sign In</a></div>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="box-login-social pt-65 pl-50">
                <div class="form-register mt-30 mb-30">
                  <div class="form-group">
                    <label class="mb-5 font-sm color-gray-700">Last Name *</label>
                    <input class="form-control" type="text" placeholder="job" name="lname">
                  </div>
                  <div class="form-group">
                    <label class="mb-5 font-sm color-gray-700">Email *</label>
                    <input class="form-control" type="email" placeholder="mai@email.com" name="email">
                  </div>
                  <div class="form-group">
                    <label class="mb-5 font-sm color-gray-700">Postal code *</label>
                    <input class="form-control" type="number" placeholder="-----" name="zip">
                    <style>
                      input::-webkit-inner-spin-button {
                        -webkit-appearance: none;
                        margin: 0;
                      }
                      </style>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
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
<?php
    require('config/db.php');
    session_start();
    
    if(isset($_SESSION["email"]) && isset($_SESSION["type"]) && $_SESSION["type"] == "admin")
    {
        header("Location: admin/dashboard-admin.php");
        exit(); 
    }else if(isset($_SESSION["email"]) && isset($_SESSION["type"]) && $_SESSION["type"] == "client")
    {
        header("Location: index.php");
        exit();
    }

    if(isset($_POST['submit']))
    {
        $email = stripslashes($_REQUEST['email']);
        $password = stripslashes($_REQUEST['password']);
        $connection = Database::getConnection();
        $sql = "SELECT ID_user, firstname, lastname, email, type FROM users WHERE email = :email and password = :password";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', hash('sha256', $password));
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if($user)
        {   $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['ID_user'] = $user['ID_user'];
            $_SESSION['fullName'] = $user['firstname'].' '.$user['lastname'];
            header("Location: index.php");
            if ($user['type'] == 'admin') {
              $_SESSION['type'] = 'admin';
              header('location: admin/dashboard-admin.php');	  
            }else{
              $_SESSION['type'] = 'client';
              header('location: index.php');
          }
        }else if($email == NULL && $password == NULL){
          $message = "Please enter your email and your password";
        }
        else{
          $message = "Email or password are incorrect";
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
    <title>Login - Ecom Marketplace Template</title>
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
      <section class="section-box shop-template mt-60">
        <div class="container">
          <div class="row mb-100">
            <div class="col-lg-1"></div>
            <div class="col-lg-5">
              <h3>User Login</h3>
              <p class="font-md color-gray-500">Welcome back!</p>
              <div class="form-register mt-30 mb-30">
              <form method="post" name="login" action="">
                  <div class="form-group">
                    <label class="mb-5 font-sm color-gray-700">Email*</label>
                    <input class="form-control" type="email" placeholder="stevenjob@gmail.com" name="email">
                  </div>
                  <div class="form-group">
                    <label class="mb-5 font-sm color-gray-700">Password *</label>
                    <input class="form-control" type="password" placeholder="******************" name="password">
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
  
                    </div>
                    <div class="col-lg-6 text-end">
                      <div class="form-group" id="forgor"><a class="font-xs color-gray-500" href="#">Forgot your password?</a></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <input class="font-md-bold btn btn-buy" type="submit" value="Log in" name="submit">
                    <?php if (! empty($message)) { ?>
                      <p class="errorMessage"><?php echo $message; ?></p>
                    <?php } ?>
                    <style>
                      .errorMessage {
                        font-size: 13px;
                        text-align: left;
                        color: red;
                        font-weight: 600;
                       }
                    </style>
                  </div>
                  <div class="mt-20"><span class="font-xs color-gray-500 font-medium">Have not an account?</span><a class="font-xs color-brand-3 font-medium" href="page-register.php">Sign Up</a></div>
                </form>
              </div>
            </div>
            <div class="col-lg-5"></div>
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
            <div class="footer-2-top mb-20"><a href="index.html"><img alt="Ecom" src="fonts/logo.svg" width="150px"></a><a class="font-xs color-gray-1000" href="#">Market-tech.com</a></div>
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
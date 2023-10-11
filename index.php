<?php
  require('config/db.php');
  session_start();
  @$ID_user = $_SESSION['ID_user'];
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
    <title>Market-tech - Welcome</title>
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
            <div class="header-logo"><a class="d-flex" href="dashboard-admin.php"><img alt="Ecom" src="fonts/logo.svg"></a></div>
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
      <section class="section-box">
        <div class="banner-hero banner-1">
          <div class="container">
            <div class="row">
              <div class="col-lg-8">
                <div class="box-swiper">
                  <div class="swiper-container swiper-group-1">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                        <div class="banner-big bg-11-2" style="background-image: url(images/banner-hero-2.png)"><span class="font-sm text-uppercase">Trending Now</span>
                          <h2 class="mt-10">Big Sale 25%</h2>
                          <h1>Laptop</h1>
                          <div class="row">
                            <div class="col-lg-5 col-md-7 col-sm-12">
                              <p class="font-sm color-brand-3">Best laptop deals. Shop for On Sale Laptops at Market Tech. Find low everyday prices and buy online for delivery or in-store pick-up.</p>
                            </div>
                          </div>
                          <div class="mt-30"><a class="btn btn-brand-2" href="shop-grid.php">Shop now</a></div>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="banner-big bg-11-3" style="background-image: url(images/banner-hero-3.png)"><span class="font-sm text-uppercase">Top Sale This Month</span>
                          <h2 class="mt-10">Hot Collection</h2>
                          <h1>Virtual glasses</h1>
                          <div class="row">
                            <div class="col-lg-5 col-md-7 col-sm-12">
                              <p class="font-sm color-brand-3">Curabitur id lectus in felis hendrerit efficitur quis quis lectus. Donec sollicitudin elit eu ipsum maximus blandit. Curabitur blandit tempus consectetur.</p>
                            </div>
                          </div>
                          <div class="mt-30"><a class="btn btn-brand-2" href="shop-grid.php?category=Laptop ">Shop now</a></div>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-pagination swiper-pagination-1"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="row">
                  <div class="col-lg-12 col-md-6 col-sm-12">
                    <div class="banner-small banner-small-1 bg-13"><span class="color-danger text-uppercase font-sm-lh32">10%<span class="color-brand-3">Sale Off</span></span>
                      <h4 class="mb-10">Best trending Accessories</h4>
                      <p class="color-brand-3 font-desc">Don&apos;t miss the last<br class="d-none d-lg-block"> opportunity.</p>
                      <div class="mt-20"><a class="btn btn-brand-3 btn-arrow-right" href="shop-grid.php?category=Accessories">Shop now</a></div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-6 col-sm-12">
                    <div class="banner-small banner-small-2 bg-14"><span class="color-danger text-uppercase font-sm-lh32">LATEST COLLECTION</span>
                      <h4 class="mb-10">Computer Accessories</h4>
                      <p class="color-brand-3 font-md">Don&apos;t miss the last<br class="d-none d-lg-block"> opportunity.</p>
                      <div class="mt-20"><a class="btn btn-brand-2 btn-arrow-right" href="shop-grid.php?category=Accessories">Shop now</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section-box">
        <div class="container">
          <div class="row">
            <div class="col-lg-4">
              <h3>Featured Categories</h3>
              <!-- <p class="font-base">Choose your necessary products from this feature categories.</p> -->
            </div>
            <div class="col-lg-7">
              <div class="list-brands">
                <div class="box-swiper">
                  <div class="swiper-container swiper-group-7">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide"><a href="shop-grid.php"><img src="fonts/acer.svg" alt="Ecom"></a></div>
                      <div class="swiper-slide"><a href="shop-grid.php"><img src="fonts/keibn.svg" alt="Ecom"></a></div>
                      <div class="swiper-slide"><a href="shop-grid.php"><img src="fonts/assus.svg" alt="Ecom"></a></div>
                      <div class="swiper-slide"><a href="shop-grid.php"><img src="fonts/casio.svg" alt="Ecom"></a></div>
                      <div class="swiper-slide"><a href="shop-grid.php"><img src="fonts/dell.svg" alt="Ecom"></a></div>
                      <div class="swiper-slide"><a href="shop-grid.php"><img src="fonts/panasonic.svg" alt="Ecom"></a></div>
                      <div class="swiper-slide"><a href="shop-grid.php"><img src="fonts/vaio.svg" alt="Ecom"></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-50">
            <div class="row">
            </div>
          </div>
        </div>
      </section>
      <section class="section-box pt-50">
        <div class="container">
        </div>
      </section>
      <section class="section-box mt-50">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-12">
              <div class="banner-2 bg-xbox"><span class="color-danger text-uppercase">Flat 20% off</span>
                <h3 class="font-30">Microsoft</h3>
                <h4 class="font-59">Xbox</h4>
                <h5 class="font-55 mb-15">Series S</h5><span class="font-16">COMMING SOON!! </span>
              </div>
            </div>
            <div class="col-xl-8 col-lg-12">
              <div class="image-gallery">
                <div class="image-big">
                  <div class="banner-img-left bg-controller">
                    <h3 class="font-33 mb-10">Xbox Core Wireless Controller</h3>
                    <p class="font-18">Aqua Shift Special Edition</p>
                    <div class="mt-25"><a class="btn btn-info btn-arrow-right">Soon at the shop page</a></div>
                  </div>
                </div>
                <div class="image-small">
                  <div class="bg-metaverse">
                    <h3 class="mb-10 font-32">Metaverse</h3>
                    <p class="font-16">The Future of<br class="d-none d-lg-block"> Creativity</p>
                    <div class="mt-15"><a class="btn btn-link-brand-2 btn-arrow-brand-2" href="shop-fullwidth.html">learn more</a></div>
                  </div>
                </div>
              </div>
              <div class="image-gallery">
                <div class="image-small">
                  <div class="bg-electronic">
                    <h3 class="font-32">Electronic</h3>
                    <p class="font-16 color-brand-3">Hot devices, Latest trending</p>
                  </div>
                </div>
                <div class="image-big">
                  <div class="bg-phone">
                    <h3 class="font-33 mb-15">Super discount for your first purchase</h3>
                    <p class="font-18">Use discount code in checkout page.</p>
                    <div class="mt-25"><a class="btn btn-brand-2 btn-arrow-right">Shop Now</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section-box mt-50">
        <div class="container">
          <div class="head-main">
            <h3 class="mb-5">Latest News &amp; Events</h3>
            <p class="font-base color-gray-500">From our blog, forum</p>
            <div class="box-button-slider">
              <div class="swiper-button-next swiper-button-next-group-4"></div>
              <div class="swiper-button-prev swiper-button-prev-group-4"></div>
            </div>
          </div>
        </div>
        <div class="container mt-10">
          <div class="box-swiper">
            <div class="swiper-container swiper-group-4">
              <div class="swiper-wrapper pt-5">
                <div class="swiper-slide">
                  <div class="card-grid-style-1">
                    <div class="image-box"><a href="blog-single-2.html"></a><img src="images/blog-1.jpg" alt="Ecom"></div><a class="tag-dot font-xs" href="blog-list.html">Technology</a><a class="color-gray-1100" href="blog-single-2.html">
                      <h4>The latest technologies to be used for VR in 2022</h4></a>
                    <div class="mt-20"><span class="color-gray-500 font-xs mr-30">September 02, 2022</span><span class="color-gray-500 font-xs">4<span> Mins read</span></span></div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="card-grid-style-1">
                    <div class="image-box"><a href="blog-single.html"></a><img src="images/blog-2.jpg" alt="Ecom"></div><a class="tag-dot font-xs" href="blog-list.html">Technology</a><a class="color-gray-1100" href="blog-single.html">
                      <h4>How can Web 3.0 Bring Changes to the Gaming?</h4></a>
                    <div class="mt-20"><span class="color-gray-500 font-xs mr-30">August 30, 2022</span><span class="color-gray-500 font-xs">5<span> Mins read</span></span></div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="card-grid-style-1">
                    <div class="image-box"><a href="blog-single-3.html"></a><img src="images/blog-3.jpg" alt="Ecom"></div><a class="tag-dot font-xs" href="blog-list.html">Gaming</a><a class="color-gray-1100" href="blog-single-3.html">
                      <h4>NFT Blockchain Games That Might Take Off</h4></a>
                    <div class="mt-20"><span class="color-gray-500 font-xs mr-30">August 25, 2022</span><span class="color-gray-500 font-xs">3<span> Mins read</span></span></div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="card-grid-style-1">
                    <div class="image-box"><a href="blog-single-2.html"></a><img src="images/blog-4.jpg" alt="Ecom"></div><a class="tag-dot font-xs" href="blog-list.html">Blockchain</a><a class="color-gray-1100" href="blog-single-2.html">
                      <h4>Blockchain Gaming And Its Three Challenges</h4></a>
                    <div class="mt-20"><span class="color-gray-500 font-xs mr-30">August 15, 2022</span><span class="color-gray-500 font-xs">7<span> Mins read</span></span></div>
                  </div>
                </div>
              </div>
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
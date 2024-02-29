<?php

include ('config/database.php');

?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6"> <![endif]-->
<!--[if IE 7]>    <html class="ie7"> <![endif]-->
<!--[if IE 8]>    <html class="ie8"> <![endif]-->
<!--[if IE 9]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class=""><!--<![endif]-->
  <head>
    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shopping Cart | ELECKTRONIC GIFT VOUCHERS LTD</title>
    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon" href="images//favicon.ico" />
    <!-- For iPhone 4 Retina display: -->
    <link
      rel="apple-touch-icon-precomposed"
      sizes="114x114"
      href="images//apple-touch-icon-114x114-precomposed.png"
    />
    <!-- For iPad: -->
    <link
      rel="apple-touch-icon-precomposed"
      sizes="72x72"
      href="images//apple-touch-icon-72x72-precomposed.png"
    />
    <!-- For iPhone: -->
    <link
      rel="apple-touch-icon-precomposed"
      href="images//apple-touch-icon-57x57-precomposed.png"
    />
    <!-- Library - Bootstrap v3.3.5 -->
    <link rel="stylesheet" type="text/css" href="libraries/lib.css" />

    <!-- StrockGap Icon Fonts -->
    <link
      rel="stylesheet"
      type="text/css"
      href="libraries/strokegapicon/stroke-gap-icon.css"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Hind:400,500,600"
      rel="stylesheet"
      type="text/css"
    />

    <!-- Custom - Theme CSS -->
    <link rel="stylesheet" type="text/css" href="style.css" />

    <!--[if lt IE 9]>
      <script src="js/html5/respond.min.js"></script>
    <![endif]-->
  </head>

  <body data-offset="200" data-spy="scroll" data-target=".ow-navigation">
    <!-- LOADER -->
    <div id="site-loader" class="load-complete">
      <div class="loader">
        <div class="loader-inner ball-triangle-path">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    </div>
    <!-- Loader /- -->

    <!-- Header -->
    <?php include ('includes/header.php'); ?>
    <!-- Header /- -->
    <!-- PageBanner -->
    <div class="container-fluid pagebanner register no-padding">
      <div class="container">
        <div class="banner-content-block">
          <div class="banner-content">
            <h3>Checkout</h3>
            <ol class="breadcrumb">
              <li><a href="index.html" title="Home">Home</a></li>
              <li class="active">Checkout</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- PageBanner /- -->
    <!-- Browse Category -->
    <div class="container-fluid no-padding browsecategory">
      <div class="container">
        <div class="row">
          <div class="col-md-9 col-sm-8 col-xs-12">
            <div class="input-group">
              <input
                type="text"
                class="form-control"
                placeholder="Search for Deals"
              />
              <span class="input-group-btn">
                <button class="btn" title="Search" type="button">Search</button>
              </span>
            </div>
          </div>
          <div class="col-md-3 col-sm-4 col-xs-12">
            <a href="coupon-categories.html" title="Browse Categories"
              ><i class="fa fa-bars" aria-hidden="true"></i> Browse
              Categories</a
            >
          </div>
        </div>
      </div>
    </div>
    <!-- Browse Category /- -->

    <!-- Featured SignUp -->
    <div class="container featuredsignup">
      <div class="row">
        <div class="col-md-12">
          <div class="container">
            <h1 class="cart-main-title">Checkout <em><?= isset($_GET['total']) ? '(Pay $'.$_GET['total'].')' : ''; ?></em></h1>
            <form
              action="payment-confirmation.php?amount=<?= $_GET['total'] ?? 0; ?>"
              method="post"
              class="checkout-form"
            >
              <label for="name">Fullname:</label>
              <input type="text" id="name" name="name" required />

              <label for="email">Email:</label>
              <input type="email" id="email" name="email" required />

              <label for="card-number">Card Number:</label>
              <input type="text" id="card-number" name="card-number" required />

              <label for="expiry-date">Expiry Date:</label>
              <input
                type="text"
                id="expiry-date"
                name="expiry-date"
                placeholder="MM/YYYY"
                required
              />

              <label for="cvv">CVV:</label>
              <input type="text" id="cvv" name="cvv" required />

              <input type="submit" value="Pay Now" />
            </form>
          </div>
        </div>
      </div>
      <div class="section-padding"></div>
    </div>
    <!-- Featured SignUp /- -->
    <!-- GetOffers -->
    <!-- GetOffers /- -->
    <!-- Footer Main -->
    <footer class="footer-main container-fluid no-padding">
      <div class="footer-main-block">
        <!-- Container -->
        <div class="container">
          <div class="row">
            <!-- Support Center -->
            <aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget widget_support">
              <h3 class="widget-title">Policies</h3>
              <ul>
                <li>
                  <a
                    title="Terms and Conditions"
                    href="./terms-and-conditions.html"
                    >Terms and Conditions</a
                  >
                </li>
                <li>
                  <a title="Cookie Policy" href="./cookie-policy.html"
                    >Cookie Policy</a
                  >
                </li>
              </ul>
            </aside>
            <!-- Support Center /- -->

            <!-- ContactUs -->
            <aside
              class="col-md-5 col-sm-6 col-xs-6 ftr-widget widget_contactus"
            >
              <h3 class="widget-title">Contact Us</h3>
              <div class="contactinfo-box">
                <i class="fa fa-map-marker"></i>
                <p>
                  Eaton Place, 2nd Floor, United Nations Crescent, P.O Box
                  63946-00619 Muthaiga, Nairobi, Kenya
                </p>
              </div>
              <div class="contactinfo-box">
                <i class="fa fa-phone"></i>
                <p>
                  <a title="63946-00619" href="tel:+63946-00619">63946-00619</a>
                  <a title="0112355689" href="tel:+0112355689"> </a>
                </p>
              </div>
              <div class="contactinfo-box">
                <i class="fa fa-map-marker"></i>
                <p>
                  <a
                    href="mailto:info@e-vouchergift.com"
                    title="info@e-vouchergift.com"
                    >info@e-vouchergift.com</a
                  >
                  <a href="mailto:info@e-vouchergift.com" title=" "> </a>
                </p>
              </div>
            </aside>
            <!-- ContactUs /- -->

            <!-- NewsLetter Widget -->
            <aside
              class="col-md-4 col-sm-6 col-xs-6 ftr-widget widget_newsletter"
            >
              <h3 class="widget-title">Subscribe</h3>
              <p>
                Got a dream and we just know now we're gonna make our dream come
                true
              </p>
              <div class="input-group">
                <input
                  type="text"
                  placeholder="Enter Address"
                  class="form-control"
                />
                <span class="input-group-btn">
                  <button type="button" title="Subscribe" class="btn">
                    Go
                  </button>
                </span>
              </div>
            </aside>
            <!-- NewsLetter Widget /- -->
          </div>
          <!-- Footer Bottom -->
          <div class="footer-bottom">
            <div class="footer-menu">
              <nav class="navbar ow-navigation">
                <div class="navbar-header">
                  <button
                    type="button"
                    class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#navbar2"
                    aria-expanded="false"
                    aria-controls="navbar"
                  >
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
              </nav>
            </div>
            <div class="footer-about">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 ftr-about">
                  <h3 class="widget-title">About Us</h3>
                  <p>
                    ELECKTRONIC GIFT VOUCHERS is a trading name of ELECKTRONIC
                    GIFT VOUCHERS LTD © 2023 All Rights Reserved. ELECKTRONIC
                    GIFT VOUCHERS LTD is registered in Kenya under number
                    00402152. Our registered office is Eaton Place, 2nd Floor,
                    <br />
                    United Nations Crescent, <br />
                    P.O Box 63946-00619 <br />
                    Muthaiga, Nairobi, <br />
                    Kenya <br />

                    What are Gift Cards? <br />
                    Gift cards are credit card sized plastic cards that have a
                    stored value of money pre-loaded on to them. There are two
                    main types of gift card; single branded gift cards can be
                    spent in only one chain of stores and multi retail gift
                    cards can be spent in multiple participating stores. Some
                    gift cards can also be redeemed online using a code printed
                    on the card. Gift cards are a popular gift in the Kenya due
                    to the ease of use and the choice they give to the user.
                    <br />

                    What are Gift Vouchers? <br />
                    Gift vouchers (sometimes known as gift tokens) are printed
                    paper gifts available in pre-determined values that can be
                    spent in specific stores. They can be single brand gift
                    vouchers or multi-retailer gift vouchers. Multi-retailer
                    gift vouchers have the additional benefit of being
                    redeemable in more than one store or brand. Gift vouchers
                    and multi-retailer Gift vouchers can be used as full or part
                    payment of items at the checkout of participating stores and
                    are often used as an alternative to cash. <br />

                    If you're a non-Kenya resident looking to buy gifts for a
                    friend or relative in the Kenya, you can choose from our
                    range of gift vouchers and gift cards and have them
                    delivered direct. This includes a free personalised
                    greetings card, so the recipient knows who to thank.
                  </p>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 ftr-social">
                  <h3 class="widget-title">Connect with us</h3>
                  <ul>
                    <li>
                      <a title="Facebook" data-toggle="tooltip" href="#"
                        ><i class="fa fa-facebook"></i
                      ></a>
                    </li>
                    <li>
                      <a title="Twitter" data-toggle="tooltip" href="#"
                        ><i class="fa fa-twitter"></i
                      ></a>
                    </li>
                    <li>
                      <a title="Google Plus" data-toggle="tooltip" href="#"
                        ><i class="fa fa-google-plus"></i
                      ></a>
                    </li>
                    <li>
                      <a title="Linkedin" data-toggle="tooltip" href="#"
                        ><i class="fa fa-linkedin"></i
                      ></a>
                    </li>
                    <li>
                      <a title="Dribbble" data-toggle="tooltip" href="#"
                        ><i class="fa fa-dribbble"></i
                      ></a>
                    </li>
                    <li>
                      <a title="Pinterest" data-toggle="tooltip" href="#"
                        ><i class="fa fa-pinterest-p"></i
                      ></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!--  Footer Bottom /- -->
        </div>
        <!-- Container /- -->
      </div>
      <div class="copyright">
        <div class="container">
          <p>Copyright &copy; 2023 - All Rights Reserved</p>
        </div>
      </div>
    </footer>
    <!-- Footer /- -->

    <!-- JQuery v1.11.3 -->
    <script src="js/jquery.min.js"></script>
    <!--script src="js/jquery.knob.js"></script-->

    <!-- Library - Js -->
    <script src="libraries/lib.js"></script>
    <!-- Bootstrap JS File v3.3.5 -->

    <!-- Library - Google Map API -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

    <!-- Library - Theme JS -->
    <script src="js/functions.js"></script>
  </body>
</html>

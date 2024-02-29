<?php

ob_start();
include ('config/database.php');

$query = $dbh->prepare("SHOW TABLES LIKE :users");
$query->execute([':users' => 'users']);

if (!($query->rowCount() > 0)) {
  $sql = "CREATE TABLE `users` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `fullname` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
    `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
    `username` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
    `password` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
    `status` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
    PRIMARY KEY (`id`)
  )";
  $dbh->exec($sql);
}

$username = $email = $fullname = '';
$success_message = $error_message = '';

// Function to sanitize user input
function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the submitted username and password
  $username = isset($_POST['username']) ? $_POST['username'] : null;
  $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : null;
  $password = isset($_POST['password']) ? $_POST['password'] : null;
  $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;
  $email = isset($_POST['email']) ? $_POST['email'] : null;
  $email = isset($_POST['email']) ? $_POST['email'] : null;

  // Validate the username and password
  $error = false;

  if (empty($fullname)) {
    $error = true;
    $error_message = "Fullname is required";
  }

  if (empty($username)) {
    $error = true;
    $error_message = "Username is required";
  } else {
    $username = sanitize_input($username);
    // Check if name contains only letters
    if (!preg_match("/^[a-zA-Z]*$/", $username)) {
      $error = true;
      $error_message = "Only letters allowed. No white space allowed";
    }

    $query = $dbh->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
    $query->execute(['username' => $username]);
    $row = $query->rowCount();
    if($row) {
      $error = true;
      $error_message = "Username already exists";
    }
  }

  // Validate email
  if (empty($email)) {
    $error = true;
    $error_message = "Email is required";
  } else {
    $email = sanitize_input($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = true;
      $error_message = "Invalid email format";
    }
    $query = $dbh->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $query->execute(['email' => $email]);
    $row = $query->rowCount();
    if($row) {
      $error = true;
      $error_message = "Email already exists";
    }
  }

  if (empty($password)) {
    $error = true;
    $error_message = "Password is required";
  }

  if (empty($confirm_password) || $password !== $confirm_password) {
    $error = true;
    $error_message = "Password and Confirm password must match.";
  }

  // If there are no validation errors
  if (empty($error)) {
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = $dbh->prepare("INSERT INTO users (email, username, password, status) VALUES (:email, :username, :password, :status)");
    $query->execute(['email' => $email, 'username' => $username, 'password' => $password, 'status' => 'active']);
    $count = $query->rowCount();

    if(!$count) {
      $error = true;
      $error_message = 'Signup failed. Try again later.';
    }else {
      $success_message = 'Signup successfull';
      header('Location: login.php?signup=1');
      exit;
    }
  }
}

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
    <title>Register ELECKTRONIC GIFT VOUCHERS LTD</title>
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
            <h3>Join with Us</h3>
            <ol class="breadcrumb">
              <li><a href="<?= BASE_URL; ?>/" title="Home">Home</a></li>
              <li class="active">Register</li>
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
      <div class="section-padding"></div>
      <div class="row">
        <div class="col-md-7">
          <div class="featured-section">
            <div class="section-header">
              <h3>Advantages of being our member</h3>
              <p>Today's hot deals handpicked by our Team up!</p>
            </div>
            <div class="featuredbox">
              <h3>More than 300+ trust worthy online stores</h3>
              <p>
                <span class="icon icon-ShoppingCart"></span>Just sit right back
                and you will hear a tale a tale of a fateful trip that started
                from this tropic port aboard this tiny ship in a freak mishap
                ranger and its pilot captain william buck rogers are blown out
                of their trajectory.
              </p>
            </div>
            <div class="featuredbox">
              <h3>24 / 7 Online support for all your queries</h3>
              <p>
                <span class="icon icon-Headset"></span>Well the first thing you
                know old jeds a millionaire kinfolk said jed move away from
                there come and dance on our floor take a step that is new we
                have a loveable space that needs your face threes and company.
              </p>
            </div>
            <div class="featuredbox">
              <h3>100% Verified online product vendors</h3>
              <p>
                <span class="icon icon-ClosedLock"></span>Five passengers set
                sail that day for a three hour tour a three hour tour believe it
                or not I am walking on air I never thought I could feel so free
                just two good old boys would not change if they could fighting
                system.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="featured-section">
            <div class="section-header">
              <h3>Get benifits by Joining with us</h3>
              <p>Today's hot deals handpicked by our Team up!</p>
            </div>

            <form class="signupform" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-6">
                  <div
                    style="
                      display: flex;
                      align-items: center;
                      gap: 1rem;
                      margin-bottom: 2rem;
                      margin-top: -2rem;
                    "
                  >
                    <p style="margin-bottom: 0">
                      Do you already have an account?
                    </p>
                    <a href="<?= BASE_URL; ?>/login.php" title="Login" style="top: 0"
                      >Sign in</a
                    >
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-6">
                  <?php if(!empty($error_message)): ?>
                    <div class="alert alert-danger">
                      <?= $error_message; ?>
                    </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <input
                      type="text"
                      required=""
                      class="form-control"
                      id="input_name"
                      placeholder="Your Full NAme*"
                      name="fullname"
                      value="<?= $fullname; ?>"
                    />
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-6">
                  <div class="form-group">
                    <input
                      type="email"
                      required=""
                      class="form-control"
                      id="input_email"
                      placeholder="Email Address*"
                      name="email"
                      value="<?= $email; ?>"
                    />
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-6">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      id="input_unm"
                      placeholder="Select Your User Name"
                      name="username"
                      value="<?= $username; ?>"
                    />
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-6">
                  <div class="form-group">
                    <input
                      type="password"
                      class="form-control"
                      id="input_pwd"
                      placeholder="Password"
                      name="password"
                    />
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-6">
                  <div class="form-group">
                    <input
                      type="password"
                      class="form-control"
                      id="input_cfmpwd"
                      placeholder="Confirm Password"
                      name="confirm_password"
                    />
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-6">
                  <button class="btn-success p-4 mt-4" type="submit">Signup</button>
                  <!-- <div class="form-group">
                    <input
                      type="submit"
                      value="Sign Up!"
                      id="btn_submit"
                      title="SignUp"
                    />
                  </div> -->
                </div>
              </div>
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

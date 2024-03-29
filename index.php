<?php

include ('config/database.php');
$coupons = [
  [
    'img' => 'https://www.voucherexpress.co.uk/volatile/productimagelarge/gc%20(1).png',
    'description' => 'Discover over 150 brands with the VEX Gift Card. Gift a Card, gift a choice',
    'expiry' => '27-12-2024',
    'percentage_off' => '15%',
    'name' => 'VEX Gift Card',
    'code' => '12xjuox',
  ],
  [
    'img' => 'https://www.voucherexpress.co.uk/volatile/productimagelarge/asda-gift-card-lrg%20prod%20img.jpg',
    'description' => 'ASDA is one of Britain\'s biggest supermarkets and part of the Wal-Mart family',
    'expiry' => '26-12-2024',
    'percentage_off' => '10%',
    'name' => 'Extra Upto 5% Cashback',
    'code' => '12xjuox'
  ],
  [
    'img' => 'https://www.voucherexpress.co.uk/volatile/productimagelarge/asos-lrg-prod-img.png',
    'description' => 'ASOS is a global fashion destination for 20-somethings',
    'expiry' => '04-09-2024',
    'percentage_off' => '08%',
    'name' => 'Extra Upto 2% Cashback',
    'code' => '12xjuox'
  ],
  [
    'img' => 'https://www.voucherexpress.co.uk/volatile/productimagelarge/sainsburys_fullrangepage_largeproductimage.png',
    'description' => 'Flat $ 100 OFF on Minimum Shopping of $ 200 - Sitewide',
    'expiry' => '27-04-2024',
    'percentage_off' => '12%',
    'name' => 'Extra Upto 3% Cashback',
    'code' => '12xjuox'
  ],
  [
    'img' => 'https://www.voucherexpress.co.uk/volatile/productimagelarge/time-inc-lrg-prod-img.png',
    'description' => 'Happy Hours - Get Extra $ 500 OFF on Order of $ 2499 or Above',
    'expiry' => '13-07-2024',
    'percentage_off' => '8%',
    'name' => 'Extra Upto 2% Cashback',
    'code' => '12xjuox'
  ],
  [
    'img' => 'https://www.voucherexpress.co.uk/volatile/productimagelarge/currys-large-product-image.png',
    'description' => 'The UK\'s leading electronics and computer superstores.',
    'expiry' => '26-07-2024',
    'percentage_off' => '10%',
    'name' => 'Extra Upto 2% Cashback',
    'code' => '12xjuox'
  ]
];

ob_start();
include ('config/database.php');

$query = $dbh->prepare("SHOW TABLES LIKE :coupons");
$query->execute([':coupons' => 'coupons']);

if (!($query->rowCount() > 0)) {
    $sql = "CREATE TABLE `coupons` (
        `id` int unsigned NOT NULL AUTO_INCREMENT,
        `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
        `description` text CHARACTER SET utf8mb4 DEFAULT NULL,
        `expiry` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
        `price` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
        `img` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
        `code` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
        `percentage_off` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
        PRIMARY KEY (`id`)
    )";
    $dbh->exec($sql);
}

foreach($coupons as $coupon) {
  $img = $coupon['img'];
  $query = $dbh->prepare("SELECT * FROM coupons WHERE img = :img LIMIT 1");
  $query->execute(['img' => $img]);
  $row = $query->fetch(PDO::FETCH_ASSOC);

  if(!$row) {
    $query = $dbh->prepare("INSERT INTO coupons (name, description, percentage_off, code, expiry, img, price) VALUES (:name, :description, :percentage_off, :code, :expiry, :img, :price)");

    $query->execute([
      'name' => $coupon['name'],
      'description' => $coupon['description'],
      'percentage_off' => $coupon['percentage_off'],
      'img' => $img,
      'expiry' => $coupon['expiry'],
      'code' => $coupon['code'],
      'price' => rand(10, 67),
    ]);
  }
}

$sql = "SELECT * FROM coupons";
$query = $dbh->prepare($sql);
$query->execute();

$coupons = $query->fetchAll(PDO::FETCH_ASSOC);

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
    <title>ELECKTRONIC GIFT VOUCHERS LTD</title>
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
    <!-- Photobanner -->
    <div class="container-fluid no-padding photobanner">
      <div id="home-slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img
              src="images/photoslider1.jpg"
              alt="slide1"
              width="1920"
              height="901"
            />
          </div>
          <div class="item">
            <img
              src="images/photoslider1.jpg"
              alt="slide1"
              width="1920"
              height="901"
            />
          </div>
        </div>
      </div>
      <div class="container">
        <div class="photobanner-content">
          <h3>Our Full Range of Gift Cards and Vouchers</h3>
          <p>
            The gift vouchers and gift cards below cover Gift Cards and Vouchers
            for every interest, every passion and everyone. All gift vouchers
            are presented in a gift card of your choice.
          </p>
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
      </div>
    </div>
    <!-- Photobanner /- -->

    <!-- Deal Section -->
    <div id="deal-section" class="container deal-section">
      <div class="section-padding"></div>
      <div class="section-header">
        <h3>Hot Deals & Discount Coupons + Extra Cashback Offers</h3>
        <p>
          Today's hot deals handpicked by our Team. Hurry up before they run
          out!
        </p>
      </div>
      <?php if(empty($coupons)): ?>
        <div class="alert alert-info">No coupons found.</div>
      <?php else: ?>
        <div class="row">
          <?php $i = 1; ?>
          <?php foreach($coupons as $coupon): ?>
            <?php $i++; ?>
            <div class="col-md-4 col-sm-6 col-xs-6">
              <div class="dealbox">
                <div class="deal-thmbimg">
                  <img
                    src="<?= $coupon['img']; ?>"
                    width="370"
                    height="247"
                    alt="deal<?= $i; ?>"
                  />
                  <p>
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i
                    ><span><?= $coupon['percentage_off']; ?></span>
                  </p>
                </div>
                <div class="deal-content">
                  <h3><?= $coupon['name']; ?></h3>
                  <p>
                    <?= $coupon['description']; ?>
                  </p>
                  <a href="<?= BASE_URL; ?>/shopping-cart.php?coupon_id=<?= $coupon['id']; ?>" title="Buy" class="getdeal-btn">
                    <span class="get-coupencode"><?= $coupon['code']; ?></span>
                    <span class="getdeal">Buy</span>
                  </a>
                  <div class="expire"><span>Expire :</span> <?= $coupon['expiry']; ?></div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      <div class="section-padding"></div>
    </div>
    <!-- Deal Section /- -->

    <!-- Shoping Brands -->
    <div id="shopingbrands" class="container-fluid no-padding shopingbrands">
      <div class="section-padding"></div>
      <div class="container">
        <div class="section-header">
          <h3>Shop At Your Favourite Stores & Earn Cashback</h3>
          <p>All popular Stores listed, covering all Shopping needs.</p>
        </div>
        <div class="row">
          <div class="col-md-2 col-sm-3 col-xs-3">
            <div class="brandbox">
              <img
                src="images/brand1.jpg"
                alt="brand1"
                width="178"
                height="100"
              />
              <a href="#" title="Walmart" class="brand-content"
                ><span>Earn upto</span><span class="off-per">3.7%</span
                ><span>cashback</span></a
              >
            </div>
          </div>
          <div class="col-md-2 col-sm-3 col-xs-3">
            <div class="brandbox">
              <img
                src="images/brand2.jpg"
                alt="brand2"
                width="178"
                height="100"
              />
              <a href="#" title="Amazon" class="brand-content"
                ><span>Earn upto</span><span class="off-per">3.7%</span
                ><span>cashback</span></a
              >
            </div>
          </div>
          <div class="col-md-2 col-sm-3 col-xs-3">
            <div class="brandbox">
              <img
                src="images/brand3.jpg"
                alt="brand3"
                width="178"
                height="100"
              />
              <a href="#" title="JcPenney" class="brand-content"
                ><span>Earn upto</span><span class="off-per">3.7%</span
                ><span>cashback</span></a
              >
            </div>
          </div>
          <div class="col-md-2 col-sm-3 col-xs-3">
            <div class="brandbox">
              <img
                src="images/brand4.jpg"
                alt="brand4"
                width="178"
                height="100"
              />
              <a href="#" title="ebay" class="brand-content"
                ><span>Earn upto</span><span class="off-per">3.7%</span
                ><span>cashback</span></a
              >
            </div>
          </div>
          <div class="col-md-2 col-sm-3 col-xs-3">
            <div class="brandbox">
              <img
                src="images/brand5.jpg"
                alt="brand5"
                width="178"
                height="100"
              />
              <a href="#" title="BestBuy" class="brand-content"
                ><span>Earn upto</span><span class="off-per">3.7%</span
                ><span>cashback</span></a
              >
            </div>
          </div>
          <div class="col-md-2 col-sm-3 col-xs-3">
            <div class="brandbox">
              <img
                src="images/brand6.jpg"
                alt="brand6"
                width="178"
                height="100"
              />
              <a href="#" title="Target" class="brand-content"
                ><span>Earn upto</span><span class="off-per">3.7%</span
                ><span>cashback</span></a
              >
            </div>
          </div>
          <div class="col-md-2 col-sm-3 col-xs-3">
            <div class="brandbox">
              <img
                src="images/brand7.jpg"
                alt="brand7"
                width="178"
                height="100"
              />
              <a href="#" title="Puma" class="brand-content"
                ><span>Earn upto</span><span class="off-per">3.7%</span
                ><span>cashback</span></a
              >
            </div>
          </div>
          <div class="col-md-2 col-sm-3 col-xs-3">
            <div class="brandbox">
              <img
                src="images/brand8.jpg"
                alt="brand8"
                width="178"
                height="100"
              />
              <a href="#" title="Esprit" class="brand-content"
                ><span>Earn upto</span><span class="off-per">3.7%</span
                ><span>cashback</span></a
              >
            </div>
          </div>
          <div class="col-md-2 col-sm-3 col-xs-3">
            <div class="brandbox">
              <img
                src="images/brand9.jpg"
                alt="brand9"
                width="178"
                height="100"
              />
              <a href="#" title="Lacoste" class="brand-content"
                ><span>Earn upto</span><span class="off-per">3.7%</span
                ><span>cashback</span></a
              >
            </div>
          </div>
          <div class="col-md-2 col-sm-3 col-xs-3">
            <div class="brandbox">
              <img
                src="images/brand10.jpg"
                alt="brand10"
                width="178"
                height="100"
              />
              <a href="#" title="Mexx" class="brand-content"
                ><span>Earn upto</span><span class="off-per">3.7%</span
                ><span>cashback</span></a
              >
            </div>
          </div>
          <div class="col-md-2 col-sm-3 col-xs-3">
            <div class="brandbox">
              <img
                src="images/brand11.jpg"
                alt="brand11"
                width="178"
                height="100"
              />
              <a href="#" title="Tommey Hilfiger" class="brand-content"
                ><span>Earn upto</span><span class="off-per">3.7%</span
                ><span>cashback</span></a
              >
            </div>
          </div>
          <div class="col-md-2 col-sm-3 col-xs-3">
            <div class="brandbox">
              <img
                src="images/brand1.jpg"
                alt="brand1"
                width="178"
                height="100"
              />
              <a href="#" title="Walmart" class="brand-content"
                ><span>Earn upto</span><span class="off-per">3.7%</span
                ><span>cashback</span></a
              >
            </div>
          </div>
        </div>
      </div>
      <div class="section-padding"></div>
    </div>
    <!-- Shoping Brands /- -->

    <!-- PopularCategory -->
    <div class="container popularcategory">
      <div class="section-padding"></div>
      <div class="section-header">
        <h3>Browse By Popular Categories</h3>
        <p>Want more?Start by Exploring the categories</p>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-6">
          <div class="categorybox">
            <div class="category-img">
              <img
                src="images/categories1.jpg"
                alt="categories1"
                width="270"
                height="211"
              />
            </div>
            <div class="category-content">
              <span class="icon icon-Espresso"></span>
              <a href="#" title="Kitchen Item">kitchen items</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
          <div class="categorybox">
            <div class="category-img">
              <img
                src="images/categories2.jpg"
                alt="categories2"
                width="270"
                height="211"
              />
            </div>
            <div class="category-content">
              <span class="icon icon-Phone"></span>
              <a href="#" title="Mobile & Tablets">Mobile & Tablets</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
          <div class="categorybox">
            <div class="category-img">
              <img
                src="images/categories3.jpg"
                alt="categories3"
                width="270"
                height="211"
              />
            </div>
            <div class="category-content">
              <span class="icon icon-Tshirt"></span>
              <a href="#" title="Fashion">Fashion</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
          <div class="categorybox">
            <div class="category-img">
              <img
                src="images/categories4.jpg"
                alt="categories4"
                width="270"
                height="211"
              />
            </div>
            <div class="category-content">
              <span class="icon icon-Pizza"></span>
              <a href="#" title="Food & Dining">Food & Dining</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
          <div class="categorybox">
            <div class="category-img">
              <img
                src="images/categories5.jpg"
                alt="categories5"
                width="270"
                height="211"
              />
            </div>
            <div class="category-content">
              <span class="icon icon-DesktopMonitor"></span>
              <a href="#" title="Computers">Computers</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
          <div class="categorybox">
            <div class="category-img">
              <img
                src="images/categories6.jpg"
                alt="categories6"
                width="270"
                height="211"
              />
            </div>
            <div class="category-content">
              <span class="icon icon-House"></span>
              <a href="#" title="Furniture & Decor">furniture & Decor</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
          <div class="categorybox">
            <div class="category-img">
              <img
                src="images/categories7.jpg"
                alt="categories7"
                width="270"
                height="211"
              />
            </div>
            <div class="category-content">
              <span class="icon icon-Plaine"></span>
              <a href="#" title="Travel">Travel</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
          <div class="categorybox">
            <div class="category-img">
              <img
                src="images/categories8.jpg"
                alt="categories8"
                width="270"
                height="211"
              />
            </div>
            <div class="category-content">
              <span class="icon icon-Pulse"></span>
              <a href="#" title="Beauty & Health">Beauty & Health</a>
            </div>
          </div>
        </div>
      </div>
      <div class="section-padding"></div>
    </div>
    <!-- PopularCategory /- -->

    <!-- ShopTrading -->
    <div class="container-fluid no-padding shoptrading">
      <div class="section-padding"></div>
      <div class="container">
        <div class="section-header">
          <h3>Shop today's trending deals and save big</h3>
          <p>Save big with our recommended deals in all categories</p>
        </div>
        <div id="shoptrading-carousel" class="shoptrading-carousel">
          <div class="tradingbox">
            <img
              src="images/shoptrading1.jpg"
              alt="shoptrading1"
              width="230"
              height="110"
            />
            <p>Flat $ 500 Off on a Minimum Bill of $ 1,000</p>
            <a href="#" title="view this offer">view this offer</a>
          </div>
          <div class="tradingbox">
            <img
              src="images/shoptrading2.jpg"
              alt="shoptrading2"
              width="230"
              height="110"
            />
            <p>Flat 10% Off on Purchase Worth $ 500</p>
            <a href="#" title="view this offer">view this offer</a>
          </div>
          <div class="tradingbox">
            <img
              src="images/shoptrading3.jpg"
              alt="shoptrading3"
              width="230"
              height="110"
            />
            <p>$ 350 Off on $ 999 (New Customer)</p>
            <a href="#" title="view this offer">view this offer</a>
          </div>
          <div class="tradingbox">
            <img
              src="images/shoptrading4.jpg"
              alt="shoptrading4"
              width="230"
              height="110"
            />
            <p>Additional 20% OFF on Men's Clothing</p>
            <a href="#" title="view this offer">view this offer</a>
          </div>
        </div>
      </div>
      <div class="section-padding"></div>
    </div>
    <!-- ShopTrading /- -->

    <!-- LatestBlog -->
    <div class="container latestblog">
      <div class="section-padding"></div>
      <div class="section-header">
        <h3>latest updates of coupons</h3>
        <p>Recent News from our blog</p>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-6">
          <article class="type-post">
            <div class="entry-cover">
              <a href="blogpost.html" title="Entry Cover"
                ><img
                  src="https://www.highstreetvouchers.com/COMMON/themes/hsv-laf/images/homepage/hsv_hp_cards_johnlewis.webp"
                  alt="latestblog1"
                  width="370"
                  height="310"
              /></a>
              <div class="entrycover-shape"></div>
              <span class="icon icon-Picture"></span>
            </div>
            <div class="entrycontent-block">
              <div class="entry-meta">
                <div class="post-date">27 November 2023</div>
              </div>
              <h3 class="entry-title">
                <a title="John Lewis Gift Card" href="blogpost.html"
                  >John Lewis Gift Card</a
                >
              </h3>
              <div class="entry-content">
                <p>
                  John lewis Gift Cards can be spent in all 50 John Lewis and
                  Waitrose stores across the UK as well as online at
                  johnlewis.com
                </p>
              </div>
            </div>
          </article>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
          <article class="type-post">
            <div class="entry-cover">
              <a href="blogpost.html" title="Entry Cover"
                ><img
                  src="https://www.highstreetvouchers.com/COMMON/themes/hsv-laf/images/homepage/hsv_hp_cards_just-eat.webp"
                  alt="latestblog2"
                  width="370"
                  height="310"
              /></a>
              <div class="entrycover-shape"></div>
              <span class="icon icon-Picture"></span>
            </div>
            <div class="entrycontent-block">
              <div class="entry-meta">
                <div class="post-date">27 November 2023</div>
              </div>
              <h3 class="entry-title">
                <a title="Just Eat e-Gift Card" href="blogpost.html"
                  >Just Eat e-Gift Card</a
                >
              </h3>
              <div class="entry-content">
                <p>
                  Just Eat e-Gift Cards are a delight for anyone to receive!
                  Giving the user the choice of nearly 30,000 takeaways and
                  restaurants in the UK.
                </p>
              </div>
            </div>
          </article>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
          <article class="type-post">
            <div class="entry-cover">
              <a href="blogpost.html" title="Entry Cover"
                ><img
                  src="https://www.highstreetvouchers.com/COMMON/themes/hsv-laf/images/homepage/l2s-gift-card.webp"
                  alt="latestblog3"
                  width="370"
                  height="310"
              /></a>
              <div class="entrycover-shape"></div>
              <span class="icon icon-Picture"></span>
            </div>
            <div class="entrycontent-block">
              <div class="entry-meta">
                <div class="post-date">27 November 2023</div>
              </div>
              <h3 class="entry-title">
                <a title="Love2shop Gift Card" href="blogpost.html"
                  >Love2shop Gift Card</a
                >
              </h3>
              <div class="entry-content">
                <p>
                  Our most popular gift card, with the option to shop in-store
                  at over 90 brands including M&S, Argos, TK Maxx and more.
                </p>
              </div>
            </div>
          </article>
        </div>
      </div>
      <div class="section-padding"></div>
    </div>
    <!-- LatestBlog /- -->

    <!-- GetOffers -->
    <!-- GetOffers /- -->
    <!-- Counter Section -->
    <div class="container-fluid no-padding counter-section">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-6">
            <img
              src="images/coutner1.png"
              alt="coutner1"
              width="53"
              height="36"
            />
            <div class="statistics-content">
              <span data-statistics_percent="1234567" id="statistics_count-1"
                >1234567</span
              >
            </div>
            <p>Coupons Used Last Month</p>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <img
              src="images/coutner2.png"
              alt="coutner2"
              width="44"
              height="33"
            />
            <div class="statistics-content">
              <span data-statistics_percent="9876" id="statistics_count-2"
                >9876</span
              >
            </div>
            <p>Coupons Used Last Month</p>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <img
              src="images/coutner3.png"
              alt="coutner3"
              width="44"
              height="35"
            />
            <div class="statistics-content">
              <span>24 Hours</span>
            </div>
            <p>Coupons Used Last Month</p>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <img
              src="images/coutner4.png"
              alt="coutner4"
              width="45"
              height="44"
            />
            <div class="statistics-content">
              <span data-statistics_percent="960125" id="statistics_count-3"
                >960125</span
              >
            </div>
            <p>Coupons Used Last Month</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Counter Section /- -->
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

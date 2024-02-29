<?php

?>

<header class="header-main container-fluid no-padding">
      <div class="menu-block">
        <div class="menu-left-bg"></div>
        <div class="container">
          <!-- Navigation -->
          <nav class="navbar ow-navigation">
            <div class="col-md-3 no-padding">
              <div class="navbar-header">
                <button
                  aria-controls="navbar"
                  aria-expanded="false"
                  data-target="#navbar"
                  data-toggle="collapse"
                  class="navbar-toggle collapsed"
                  type="button"
                >
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a title="Logo" href="<?= BASE_URL; ?>/" class="navbar-brand"
                  ><img
                    src="images/logo.png"
                    alt="logo"
                    width="43"
                    height="51"
                  /><span>E-Vouchergift</span></a
                >
                <a href="<?= BASE_URL; ?>/" class="mobile-logo" title="Logo"
                  ><h3>E-Vouchergift</h3></a
                >
              </div>
            </div>
            <div class="col-md-9 menuinner no-padding">
              <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav menubar">
                  <li><a title="Home" href="<?= BASE_URL; ?>/">Home</a></li>
                  <li>
                    <a title="Deals" href="<?= BASE_URL; ?>/#deal-section">Deals</a>
                  </li>
                  <li>
                    <a title="Shops" href="<?= BASE_URL; ?>/#shopingbrands">Shops</a>
                  </li>
                  <li>
                    <a title="Categories" href="coupon-categories.html"
                      >Coupon Categories</a
                    >
                  </li>
                  <li>
                    <a title="Coupons" href="coupons.html"
                      >Coupons</a
                    >
                  </li>
                  <li class="dropdown">
                    <a
                      aria-expanded="false"
                      aria-haspopup="true"
                      role="button"
                      class="dropdown-toggle"
                      title="Latest News"
                      href="blog.html"
                      >Blogs</a
                    >
                    <i class="ddl-switch fa fa-angle-down"></i>
                    <ul class="dropdown-menu">
                      <li>
                        <a title="Blog Single" href="blogpost.html"
                          >Blog Single</a
                        >
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a title="Contact Us" href="contact.html">Contact Us</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <!-- Navigation /- -->
          <div class="user-cart">
            <a href="<?= BASE_URL; ?>/login.php" title="User"
              ><i class="fa fa-user" aria-hidden="true"></i
            ></a>
            <a href="<?= BASE_URL; ?>/shopping-cart.php" title="Your Cart"
              ><i class="fa fa-shopping-cart" aria-hidden="true"></i
            ></a>
          </div>
        </div>
      </div>
    </header>
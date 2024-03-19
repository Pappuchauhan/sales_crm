<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Package Booking</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" />
    <link rel="stylesheet" href="assets/css/front.min.css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" />
  </head>

  <body>
    <div class="page-wrapper">
      <!-- Top Header -->
      <div class="top-header">
        <div class="block">
          <div class="logo"><a href="#"><img src="assets/img/black-logo.png" alt="logo" /></a></div>
          <nav>
            <ul>
              <li><a href="agent_query_generate.php">Query Generate</a></li>
              <li><a href="agent_booking.php">My Booking</a></li>
              <li><a href="agent_query.php">Queries</a></li>
              <li><a href="agent_invoice.php">Invoices</a></li>
              <li><a href="#">Business Analysis</a></li>
              <li><a class="profile-icon" href="profile.php"><img src="assets/img/avatars/1.png" alt="Profile" /></a></li>
            </ul>
          </nav>
        </div>
      </div>

      <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
          <!-- Menu -->
  
          <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="menu-inner-shadow"></div>
  
            <ul class="menu-inner py-1 bg-dark pt-3">
              <!-- Forms -->
              <li class="menu-item active open">
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="agent_query_generate.php" class="menu-link">
                      <div data-i18n="Basic Inputs">Query Generate</div>
                    </a>
                  </li>
                  <li class="menu-item active">
                    <a href="edit-profile.html" class="menu-link">
                      <div data-i18n="Basic Inputs">Edit Profile</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="agent_booking.php" class="menu-link">
                      <div data-i18n="Input groups">Booking Summary</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="agent_query.php" class="menu-link">
                      <div data-i18n="Input groups">Query Summary</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="agent_invoice.php" class="menu-link">
                      <div data-i18n="Input groups">Invoice</div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </aside>
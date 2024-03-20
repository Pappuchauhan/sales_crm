<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>CRM for sales management</title>
  <meta name="description" content="" />
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="assets/vendor/css/core.css" />
  <link rel="stylesheet" href="assets/css/style.min.css" />
  <link rel="stylesheet" href="assets/vendor/css/theme-default.css" />
</head>
<?php
$current_url =  $_SERVER['REQUEST_URI'];
$filename = basename($current_url);
?>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo bg-dark">
          <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img src="assets/img/logo.png" alt="logo" />
            </span>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>
        <ul class="menu-inner py-1 bg-dark pt-3">
          <!-- Forms -->
          <li class="menu-item active open">
            <ul class="menu-sub">
              
              <li class="menu-item <?php echo $filename == 'package.php' ? 'active' : '' ?>">
                <a href="package.php" class="menu-link">
                  <div data-i18n="Basic Inputs">View Package</div>
                </a>
              </li>
              <li class="menu-item <?php echo $filename == 'booking.php' ? 'active' : '' ?>">
                <a href="booking.php" class="menu-link">
                  <div data-i18n="Input groups">All Booking Summary</div>
                </a>
              </li>
              <li class="menu-item <?php echo $filename == 'query.php' ? 'active' : '' ?>">
                <a href="query.php" class="menu-link">
                  <div data-i18n="Input groups">All Query Summary</div>
                </a>
              </li>
              <li class="menu-item <?php echo $filename == 'invoice.php' ? 'active' : '' ?>">
                <a href="invoice.php" class="menu-link">
                  <div data-i18n="Input groups">All Invoices</div>
                </a>
              </li>
              <li class="menu-item <?php echo $filename == 'agent.php' ? 'active' : '' ?>">
                <a href="agent.php" class="menu-link">
                  <div data-i18n="Input groups">Agent Information</div>
                </a>
              </li>
              
              <li class="menu-item <?php echo $filename == 'hotel.php' ? 'active' : '' ?>">
                <a href="hotel.php" class="menu-link">
                  <div data-i18n="Input groups">View Hotel Information</div>
                </a>
              </li> 
              <li class="menu-item <?php echo $filename == 'vehicle.php' ? 'active' : '' ?>">
                <a href="vehicle.php" class="menu-link">
                  <div data-i18n="Input groups">View vehicle details</div>
                </a>
              </li>
               
              <li class="menu-item <?php echo $filename == 'guide.php' ? 'active' : '' ?>">
                <a href="guide.php" class="menu-link">
                  <div data-i18n="Input groups">View Guide details</div>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </aside>
      <!-- / Menu -->
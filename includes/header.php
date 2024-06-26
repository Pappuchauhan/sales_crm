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
  <link rel="stylesheet" href="assets/css/front.min.css" />
  <link rel="stylesheet" href="assets/vendor/css/theme-default.css" />
</head>
<?php
$current_url =  $_SERVER['REQUEST_URI'];
$filename = basename($current_url);
is_admin_login();
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
              
              <li class="menu-item <?php echo  stripos($filename, 'package.php') !== false ? 'active' : '' ?>">
                <a href="package.php" class="menu-link">
                  <div data-i18n="Basic Inputs">View Package</div>
                </a>
              </li>
              <li class="menu-item <?php echo strpos($filename, 'booking.php') !== false ? 'active' : '' ?>">
                <a href="booking.php" class="menu-link">
                  <div data-i18n="Input groups">All Booking Summary</div>
                </a>
              </li>
              <li class="menu-item <?php echo  strpos($filename, 'query.php') !== false ? 'active' : '' ?>">
                <a href="query.php" class="menu-link">
                  <div data-i18n="Input groups">All Query Summary</div>
                </a>
              </li>
              <li class="menu-item <?php echo  strpos($filename, 'invoice.php') !== false ? 'active' : '' ?>">
                <a href="invoice.php" class="menu-link">
                  <div data-i18n="Input groups">All Invoices</div>
                </a>
              </li>
              <li class="menu-item <?php echo  strpos($filename, 'agent.php') !== false ? 'active' : '' ?>">
                <a href="agent.php" class="menu-link">
                  <div data-i18n="Input groups">Agent Information</div>
                </a>
              </li>
              
              <li class="menu-item <?php echo  strpos($filename, 'hotel.php') !== false ? 'active' : '' ?>">
                <a href="hotel.php" class="menu-link">
                  <div data-i18n="Input groups">View Hotel Information</div>
                </a>
              </li> 
              <li class="menu-item <?php echo  strpos($filename, 'vehicle.php') !== false ? 'active' : '' ?>">
                <a href="vehicle.php" class="menu-link">
                  <div data-i18n="Input groups">View Vehicle Details</div>
                </a>
              </li>
               
              <li class="menu-item <?php echo  strpos($filename, 'guide.php') !== false ? 'active' : '' ?>">
                <a href="guide.php" class="menu-link">
                  <div data-i18n="Input groups">View Guide details</div>
                </a>
              </li>
              <li class="menu-item <?php echo strpos($filename, 'service.php') !== false ? 'active' : '' ?>">
                <a href="service.php" class="menu-link">
                  <div data-i18n="Input groups">View Service details</div>
                </a>
              </li>

              <li class="menu-item">
                <a href="logout.php" class="menu-link">
                  <div data-i18n="Input groups">Logout</div>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </aside>
      <!-- / Menu -->
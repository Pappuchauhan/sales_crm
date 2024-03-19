<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

//serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = array_filter($_POST);
    //print_r($data_to_store); die;
    $db = getDbInstance();
    $data_to_store['password'] = password_hash($data_to_store['password'], PASSWORD_DEFAULT);
    $last_id = $db->insert('agents', $data_to_store);

    if ($last_id) {
        $_SESSION['success'] = "Agent successfully registered!";
        header('location: login.php');
        exit();
    } else {
        echo 'insert failed: ' . $db->getLastError();
        exit();
    }
}

//We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Agent Register</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" />
    <link rel="stylesheet" href="assets/css/login-register.min.css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" />
</head>

<body>
    <div class="login-page-wrapper">
        <form action="" method="post" id="guide_form" enctype="multipart/form-data">
            <div class="block">
                <div class="logo-area"><img src="assets/img/black-logo.png" alt="logo" /></div>
                <div class="login-form">
                    <div class="row mb-3">
                        <div class="col-md text-center login-head">Create an Account</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <label class="form-label" for="basic-default-phone">Email id</label>
                            <input type="text" id="basic-default-phone" name="email_id" class="form-control phone-mask" placeholder="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <label class="form-label" for="basic-default-phone">Full Name</label>
                            <input type="text" id="basic-default-phone" name="full_name" class="form-control phone-mask" placeholder="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <label class="form-label" for="basic-default-phone">Username</label>
                            <input type="text" id="basic-default-phone" name="user_name" class="form-control phone-mask" placeholder="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <label class="form-label" for="basic-default-phone">Password</label>
                            <input type="password" id="basic-default-phone" name="password" class="form-control phone-mask" placeholder="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <label class="form-label" for="basic-default-phone">Mobile No.</label>
                            <input type="text" id="basic-default-phone" name="mobile" class="form-control phone-mask" placeholder="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <label class="form-label" for="basic-default-phone">Please Enter OTP</label>
                            <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="">
                            <div class="text-end mt-2"><a href="#">Regenerte OTP</a></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md custom-login-btn">
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

</body>

</html>
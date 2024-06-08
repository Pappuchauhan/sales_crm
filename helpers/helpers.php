<?php

/**
 * Function to generate random string.
 */
require 'vendor/autoload.php';
function randomString($n)
{

    $generated_string = "";

    $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

    $len = strlen($domain);

    // Loop to create random string
    for ($i = 0; $i < $n; $i++) {
        // Generate a random index to pick characters
        $index = rand(0, $len - 1);

        // Concatenating the character
        // in resultant string
        $generated_string = $generated_string . $domain[$index];
    }

    return $generated_string;
}

/**
 *
 */
function getSecureRandomToken()
{
    $token = bin2hex(openssl_random_pseudo_bytes(16));
    return $token;
}

/**
 * Clear Auth Cookie
 */
function clearAuthCookie()
{

    unset($_COOKIE['series_id']);
    unset($_COOKIE['remember_token']);
    setcookie('series_id', null, -1, '/');
    setcookie('remember_token', null, -1, '/');
}
/**
 *
 */
function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function paginationLinks($current_page, $total_pages, $base_url)
{

    if ($total_pages <= 1) {
        return false;
    }

    $html = '';

    if (!empty($_GET)) {
        // We must unset $_GET['page'] if previously built by http_build_query function
        unset($_GET['page']);
        // To keep the query string parameters intact while navigating to next/prev page,
        $http_query = "?" . http_build_query($_GET);
    } else {
        $http_query = "?";
    }

    $html .= '<ul class="pagination text-right">';

    if ($current_page == 1) {
        $html .= '<li class="page-item disabled"><span class="page-link">First</span></li>';
    } else {
        $html .= '<li class="page-item"><a class="page-link" href="' . $base_url . $http_query . '&page=1">First</a></li>';
    }

    // Show pagination links

    if ($current_page > 5) {
        $i = $current_page - 4;
    } else {
        $i = 1;
    }

    for (; $i <= ($current_page + 4) && ($i <= $total_pages); $i++) {
        $li_class = ($current_page == $i) ? ' active' : '';

        $link = $base_url . $http_query . '&page=' . $i;

        $html .= '<li class="page-item' . $li_class . '"><a class="page-link" href="' . $link . '">' . $i . '</a></li>';

        if ($i == $current_page + 4 && $i < $total_pages) {
            $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
    }

    if ($current_page == $total_pages) {
        $html .= '<li class="page-item disabled"><span class="page-link">Last</span></li>';
    } else {
        $html .= '<li class="page-item"><a class="page-link" href="' . $base_url . $http_query . '&page=' . $total_pages . '">Last</a></li>';
    }

    $html .= '</ul>';

    return $html;
}


/**
 * to prevent xss
 */
function xss_clean($string)
{
    return !empty($string) ? htmlspecialchars($string, ENT_QUOTES, 'UTF-8') : "";
}

// Function to encrypt data
function encryptId($id)
{
    return base64_encode($id);
}

// Function to decrypt data
function decryptId($id)
{
    return base64_decode($id);
}

function getCategories()
{
    return array("Budget", "Standard", "Deluxe", "Super Deluxe", "Luxury", "Luxury Plus", "Premium", "Premium Plus");
}

function generateOTP()
{
    $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    return $otp;
    //return '123456';

}

function sendOTPMessage($otp, $mobile)
{
    $url = 'https://api.interakt.ai/v1/public/message/';
    $authorizationHeader = 'Authorization: Basic THY3QlBYcHhFTUg4eS1kc1NWWFoxWksxdlN0ZlhNQm5YTlZoSjdtUk5pWTo=';
    $contentTypeHeader = 'Content-Type: application/json';
    $data = array(
        'countryCode' => '+91',
        'phoneNumber' => $mobile,
        'callbackData' => 'some text here',
        'type' => 'Template',
        'template' => array(
            'name' => 'verification_otp',
            'languageCode' => 'en',
            'bodyValues' => array(
                "$otp"
            )
        )
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorizationHeader, $contentTypeHeader));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $error = curl_error($ch);

    curl_close($ch);

    if ($error) {
        return "Error: $error";
    } else {
        return $response;
    }
}

function sendEmail($otp, $to)
{

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->isHTML(true);
    $mail->Username = 'agent@go2ladakh.in';
    $mail->Password = 'uyxh thzu huwg sleq';

    // Set sender and recipient
    $mail->setFrom('agent@go2ladakh.in', "Ladakh DMC");
    $mail->addAddress($to);

    // Set email subject and body
    $mail->Subject = 'Your One-Time Password (OTP) for Verification';
    $mail->Body = "<p>Dear Agent,</p>

    <p>Your One-Time Password (OTP) for verification is: $otp.</p>
    
    <p>Please use this OTP to proceed with your verification.</p>
    
    <p>Thank you,</p>
    <p>Ladakh DMC</p>";

    return $mail->send();
}

function addOneDay($date)
{
    //$date = "2021-06-18";
    $timestamp = strtotime($date);
    $timestamp_plus_one_day = strtotime("+1 day", $timestamp);
    return  date("d-m-Y", $timestamp_plus_one_day);
}

function setTransportation()
{
    return ["COACH" => "25", "TEMPO" => "12", "CRYISTA" => "5", "INNOVA" => "5", "ZYALO / ERTIGA" => "5", "ECO" => "5", "LARGE COACH" => "30"];
    //return ["Tempo"=>"12","Cryista"=>"5","Innova"=>"5","Zylo"=>"5","Scorpeior"=>"5","Coach"=>"25","Large Coach"=>"30"];
}
function is_agent_login(){
    if($_SESSION['admin_type'] == 'Admin'){
        header('Location:index.php');
    } 
}

function is_admin_login(){
    if($_SESSION['admin_type']!=='Admin'){
        header('Location:agent_query_generate.php');
    } 
}


define("Bike", 2000);
define("Mechanic", 500);
define("Marshal", 500);
define("Fuel", 500);
define("Backup", 500);

define("PAGE_LIMIT", 15);
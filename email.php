<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
//require_once 'includes/constants.php';

define('Host', 'localhost');
define('dbUser', 'id15346480_admin');
define('dbPassword', 'Adwebpanel2021-');
define('dbName', 'id15346480_adminpanel');


function sendVerificationEmail($userEmail, $token)
{

if (isset($_POST['signup-btn']))
{
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repeatpassword = $_POST["repeatpassword"];

try {

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'invoicenest@gmail.com';                     // SMTP username
    $mail->Password   = 'softengwebsite';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients //sender
    $mail->setFrom('invoicenest@gmail.com', 'Autobuy');

    //reciever
    $mail->addAddress($userEmail);   // Add a recipient

    $body = '<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
        <title>VERIFICATION</title>
        </head>
    <body>
        <div class="wrapper">
            <p>Thank you for signing up! Please click the link below to verify your email.</p>
            <a href="http://localhost/website/account.php?token=' . $token . '">Verify Email Address</a>
        </div>
    </body>
    </html>';

    // Content
    $mail->isHTML(true);                      // Set email format to HTML
    $mail->Subject = 'VERIFICATION';

    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    echo 'Congrats, your account has been verified';
    } 
    catch (Exception $e) 
    {
    echo "Email could not be verified please try again. Mailer Error: {$mail->ErrorInfo}";
    }
}
}

function sendPasswordResetLink($userEmail, $token)
{
   
if (isset($_POST['forgotpassword']))
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatpassword = $_POST["repeatpassword"];

try {

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'invoicenest@gmail.com';                     // SMTP username
    $mail->Password   = 'softengwebsite';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients //sender
    $mail->setFrom('invoicenest@gmail.com', 'Autobuy');

    //reciever
    $mail->addAddress($userEmail);   // Add a recipient

    $body = '<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
        <title>VERIFICATION</title>
        </head>
    <body>
        <div class="wrapper">
            <p>Hello there, please click the link below to reset your password!</p>
            <a href="http://localhost/website/resetpassword.php?password-token=' . $token . '">Reset your password</a>
        </div>
    </body>
    </html>';

    // Content
    $mail->isHTML(true);                      // Set email format to HTML
    $mail->Subject = 'PASSWORD RECOVERY';

    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    echo 'Your password has been recovered';
    } 
    catch (Exception $e) 
    {
    echo "Email is invalid please try again. Mailer Error: {$mail->ErrorInfo}";
    }
} 
}
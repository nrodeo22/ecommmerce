
<?php 
  include'includes/headers.php';
?>
      <!-- navbar-->
        <?php
          include 'includes/navbar.php'
        ?>



    <?php
    use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
//require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
//require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';
    if (isset($_POST['btnSubmitcc'])){
 



$cfullname = $_POST["cfullname"];
$cemail=$_POST["cemail"];
$csubject = $_POST["csubject"];
$cmessage = $_POST["cmessage"];
$ccmessage = "Email: $cemail <br/> Fullname: $cfullname <br> Message: $cmessage";



$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is deprecated
$mail->SMTPAuth = true;
$mail->Username = 'thehackerist2021@gmail.com'; // email
$mail->Password = 'th3hack3rist'; // password
$mail->setFrom('thehackerist2021@gmail.com', 'The Hackerists'); // From email and name
$mail->addAddress("thehackerist2021@gmail.com", ''); // to email and name
$mail->Subject = "User Message: $csubject ";
$mail->msgHTML("$ccmessage"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
$errors['otp-error'] = "Failed while sending message";
                header('location: contactus.php');
}else{
    $info = "Message Sent";
                header('location: contactus.php');
                exit();
}
}
?>


<div class="page-holder">

    <div class="container contact-form">
         
            <form method="post">
                <h3>Drop Us a Message</h3>

               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" type="text" class="form-control" name="cfullname" placeholder="Full Name" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" class="form-control" name="cemail" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" class="form-control" name="csubject" placeholder="Subject" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSubmitcc" class="btnContact" value="Send Message" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" class="form-control" rows="3" name="cmessage" placeholder="Your Message" style="width: 100%; height: 150px;"></textarea>
                        </div>
                    </div>
                </div>
            </form>
      </div>


       <?php
          include 'team.php'
      ?>
        

</div>
    <?php
          include 'includes/footers.php'
      ?>

      <!-- JavaScript files-->
      <?php
          include 'jsfile.php'
      ?>
      
    </div>
  </body>
</html>
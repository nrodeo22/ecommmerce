<?php 
session_start();
if (isset($_POST["csubmit"])) {
	$name 		= $_POST['cfullname'];
	$mailFrom	= $_POST['cemail'];
	$subject 	= "Contact Information: ".$_POST['csubject'];
	$message 	= "Name: ".$_POST['cfullname']."\nEmail: ".$_POST['cemail']."\nSubject: ".$_POST['csubject']."\nMessage: ".$_POST['cmessage'];
	$emailTo    = "hackerist.org@gmail.com";
	$headers    = 'From: '.$_POST['cemail'];

	if(!filter_var($mailFrom, FILTER_VALIDATE_EMAIL)){
		header("Location:../index.php?error=invalidEmail");
		exit();
	}
    if(mail($emailTo,$subject,$message,$headers)){
        header("Location:../index.php?mailSent");
    }else{
        header("Location:../index.php?error=unknownError");
        exit();
  }
}


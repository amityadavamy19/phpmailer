<?php

ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);
extract($_POST);

 use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;


require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';

require '../PHPMailer/src/SMTP.php';

// Load Composer's autoloader


extract($_POST);


            
 $msg ="<b><font size='+2' >Visa Application Status</font></b><br><br>";

	

$email = new PHPMailer(true);
 $email->SMTPDebug = 0;
  $email->CharSet = 'UTF-8';
  $email->isSMTP();
  $email->SMTPAuth   = true;
  $email->Host   = "demo.naviratravels.com";
  $email->Port       = 465;
  $email->Username   = 'test@demo.naviratravels.com';
  $email->Password   = "mHq4G%5Cx!Vp";
  $email->SMTPSecure = "ssl";
 $email->isHTML();
$email->setFrom('test@demo.naviratravels.com', 'Amit Kr'); //Name is optional
$email->Subject   = 'Testting mail';
$email->Body      = $msg;
$email->addAddress( 'amityadavamy19@gmail.com' );

$file_to_attach = '../mail-js/howtoincrease.pdf';

$email->AddAttachment( $file_to_attach , 'howtoincrease.pdf' );


if($email->Send()){
    
    
    echo '<script>alert("Sent Mail Successfully!");</script>';
}else{
    
    echo '<script>alert("Error please try again");</script>';
}

















?>




<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--<script>-->
<!--    function pageRedirect() {-->
<!--        window.location.replace("https://demo.naviratravels.com/admin/dashboard.php?search=0&l=shivketo");-->
<!--    }      -->
<!--    setTimeout("pageRedirect()", 01);-->
<!--</script>-->
        







































<?php

function sendVerificationEmail($email, $token)
{
    $body = '
        Thanks for sign up in our application
        Click the following link in order to complete your signup process:
      http://localhost:8080/camagru/admin/verificationEmail.php?token=' . $token . '';
    // $headers = "From: Admin\r\n";
    // Send the message
    // if (mail($email, "Verify your email", $body, $headers)) {
    //     echo '<script type="text/JavaScript">  
    //     alert("A confirmation email has been sent to your email"); 
    //     </script>';
    // } else {
    //     echo "Message Error";
    // }
    require_once "Mail.php";

    $from = 'mahmudul.jhony@gmail.com'; //change this to your email address
    $to = $email; // change to address
    $subject = 'Insert subject here'; // subject of mail
    // $body = "Hello world! this is the content of the email"; //content of mail

    $headers = array(
        'From' => $from,
        'To' => $to,
        'Subject' => $subject
    );

    $smtp = Mail::factory('smtp', array(
            'host' => 'smtp.gmail.com',
            'port' => 465,
            'auth' => true,
            'username' => 'jhony.mbstu@gmail.com', //your gmail account
            'password' => '01722904691' // your password
        ));

    // Send the mail
    $mail = $smtp->send($to, $headers, $body);

    //check mail sent or not
    if (PEAR::isError($mail)) {
        echo '<p>'.$mail->getMessage().'</p>';
    } else {
        echo '<p>Message successfully sent!</p>';
    }

}


function sendResetMail($userEmail, $token)
{
    $body = '
        Please click on the link below to reset your password:.
      <a href="http://localhost:8080/camagru/admin/newPassword.php?token=' . $token . '"> Click me </a>';
    $headers = "From: Admin\r\n";
    if (mail($userEmail, "Reset your password", $body, $headers)) {
        echo "Message Sent";
    } else {
        echo "Message Error";
    }
}

function commentEmail($userEmail, $imageId)
{
    $body = '
        Someone commented on your photo:.
      <a href="http://localhost:8080/camagru/controller/likes.php?imageid=' . $imageId . '"> Click me </a>';
    $headers = "From: Admin\r\n";
    if (mail($userEmail, "Comment on your photo", $body, $headers)) {
        echo "Email on comment";
    } else {
        echo "Message Error";
    }
}

?>
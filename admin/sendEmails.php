<?php

require("../sendgrid-php/sendgrid-php.php");

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



    $from = new SendGrid\Email(null, "admin@example.com");
    $subject = "Verify email!";
    $to = new SendGrid\Email(null, $email);
    $content = new SendGrid\Content("text/plain", $body);
    $mail = new SendGrid\Mail($from, $subject, $to, $content);

    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);

    $response = $sg->client->mail()->send()->post($mail);
    echo $response->statusCode();
    echo $response->headers();
    echo $response->body();
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
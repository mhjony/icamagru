<?php

function sendVerificationEmail($email, $token)
{
    echo $email;
    echo $token;
    $body = '
        Thanks for sign up in our application
        Click the following link in order to complete your signup process:
      http://localhost:8080/camagru/admin/verificationEmail.php?token=' . $token . '';
    $headers = "From: Admin\r\n";
    // Send the message
    if (mail($email, "Verify your email", $body, $headers)) {
        echo '<script type="text/JavaScript">  
        alert("A confirmation email has been sent to your email"); 
        </script>';
    } else {
        echo "Message Error";
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
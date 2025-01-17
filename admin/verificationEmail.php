<?php
session_start();
$errors = [];

include 'dbConnectionNew.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $sql = "SELECT * FROM users WHERE token=? LIMIT 1";
    $stmt = $con->prepare($sql);
    $stmt->execute([$token]);
    $user = $stmt->fetch();
    if ($user) {
        $query = "UPDATE users SET verified=1 WHERE token=?";
		$stmt = $con->prepare($query);
		$res = $stmt->execute([$token]);

        if ($res) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = true;
            $_SESSION['message'] = "Your email address has been verified successfully";
            header('location: ../login_page.php');
            exit(0);
        }
    } else {
        echo "User not found!";
    }
} else {
    echo "No token provided!";
}
<?php
require 'config.php';

// var_dump($_GET);

// check if email and code exists
if (isset($_GET['email'], $_GET['code'])) {
    if ($stmt = $con->prepare('SELECT * FROM accounts WHERE email = ? AND activation_code = ?')) {
        $stmt->bind_param('ss', $_GET['email'], $_GET['code']);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0) {
            //account exists with the requested email and code
            if($stmt = $con->prepare('UPDATE accounts SET activation_code = ? WHERE email = ? AND activation_code = ?')) {
                $newcode = 'activated';
                $stmt->bind_param('sss', $newcode, $_GET['email'], $_GET['code']);
                $stmt->execute();
                echo 'Your account has been activated!';
            } else {
                echo 'This account has already been activated or does not exist.';
            }
        }
    }

    header("location: login.php");
}

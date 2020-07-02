<?php

namespace Phppot;

use \Phppot\Member;

if (!empty($_POST["login"])) {
    session_start();
    $username = filter_var($_POST["user_name_register"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password_register"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email_register"], FILTER_SANITIZE_STRING);
    require_once(__DIR__ . "./class/Member.php");
    
    require("db.php");

    $mysqli = new \mysqli($ip, $un, $psw, $db);
    
    if ($mysqli->connect_error) {
        $_SESSION["errorMessage"] = "Can't connect to database!";
        header("Location: index.php");
        exit('Error connecting to database');
    }

    $sql = "select * FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if (!($stmt->num_rows === 0)) {
        $_SESSION["errorMessage"] = "Username is already taken!";
        header("Location: index.php");
        exit();
    }

    $sql = "select * FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if (!($stmt->num_rows === 0)) {
        $_SESSION["errorMessage"] = "Email is already in use!";
        header("Location: index.php");
        exit();
    }

    $salt = rand_string(20);

    $passwordHash = sha1($salt . $password);

    $sql = "insert into users (username, email, password, salt) values ( ?,?,?,?);";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $passwordHash, $salt);
    $stmt->execute();

    $member = new Member();
    $isLoggedIn = $member->processLogin($username, $password);

    if (!$isLoggedIn) {
        $_SESSION["errorMessage"] = "Invalid Credentials";
        header("Location: ./register.php");
        exit();
    }
    header("Location: ./index.php");
    exit();
}

function rand_string($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!"#$%&()*+,-./:;<=>?@[\]^_`{|}~';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

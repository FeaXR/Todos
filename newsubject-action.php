<?php
session_start();

if (!isset($_SESSION["userId"])) {
    header('Location: index.php');
    exit;
}

if (!empty($_POST["name"])) {
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $short = filter_var($_POST["short"], FILTER_SANITIZE_STRING);

    require("db.php");

    $mysqli = new \mysqli($ip, $un, $psw, $db);

    if ($mysqli->connect_error) {
        $_SESSION["errorMessage"] = "Can't connect to database!";
        header("Location: ./register.php");
        exit('Error connecting to database');
    }

    $sql = "select * FROM subjects WHERE user_id = ? AND name = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("is", $_SESSION["userId"], $name);
    $stmt->execute();
    $stmt->store_result();

    if (!($stmt->num_rows === 0)) {
        $_SESSION["errorMessage"] = "Subject already exists!";
        header("Location: ./dashboard.php");
        exit();
    }

    $sql = "insert into subjects (name, short, user_id) values (?,?,?);";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssi", $name, $short, $_SESSION["userId"]);
    $stmt->execute();

    $_SESSION["errorMessage"] = "SUCCESS!";
    header("Location: ./dashboard.php");
    exit();
}
$_SESSION["errorMessage"] = "Invalid input!";
header("Location: ./dashboard.php");
exit();
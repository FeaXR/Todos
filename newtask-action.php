<?php
session_start();

if (!isset($_SESSION["userId"])) {
    header('Location: index.php');
    exit;
}

if (!empty($_POST["submit"])) {
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $subject= filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
    $deadline = filter_var($_POST["datetime"], FILTER_SANITIZE_STRING);
    $priority = filter_var($_POST["priority"], FILTER_SANITIZE_STRING);
    $type = filter_var($_POST["type"], FILTER_SANITIZE_STRING);

    $deadline = date("Y-m-d H:i:s", strtotime($deadline));

    require("db.php");

    $mysqli = new \mysqli($ip, $un, $psw, $db);

    if ($mysqli->connect_error) {
        $_SESSION["errorMessage"] = "Can't connect to database!";
        header("Location: ./dashboard.php");
        exit('Error connecting to database');
    }

    $sql = "insert into tasks (name, priority, user_id, deadline, subject_id, type) values (?,?,?,?,?,?);";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("siisis", $name, $priority, $_SESSION["userId"], $deadline, $subject, $type);
    
    $stmt->execute();

    $_SESSION["errorMessage"] = "";
    header("Location: ./dashboard.php");
    exit();
}

$_SESSION["errorMessage"] = "Invalid input!";
header("Location: ./newsubject.php");
exit();
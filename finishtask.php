<?php
session_start();

if (!isset($_SESSION["userId"])) {
    header('Location: index.php');
    exit();
}

if(!isset($_GET["id"]))
{
    header('Location: dashboard.php');
    exit();
}

$id = filter_var($_GET["id"], FILTER_SANITIZE_STRING);

require("db.php");

$mysqli = new \mysqli($ip, $un, $psw, $db);

if ($mysqli->connect_error) {
    $_SESSION["errorMessage"] = "Can't connect to database!";
    header("Location: ./dashboard.php");
    exit('Error connecting to database');
}
$sql = "UPDATE `todos`.`tasks` SET `done` = '1' WHERE (id = ? AND user_id = ?);";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $id, $_SESSION["userId"]);

$stmt->execute();

$_SESSION["errorMessage"] = "";
header("Location: ./dashboard.php");
exit();

<?php

namespace Phppot;

use \Phppot\DataSource;

class Member
{

    function getMemberById($memberId)
    {
        require("./db.php");
        $mysqli = new \mysqli($ip, $un, $psw, $db);

        if ($mysqli->connect_error) {
            exit('Error connecting to database');
        }

        $sql = "select * FROM users WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $memberId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        if (!empty($resultset)) {
            return $resultset;
        }
    }

    public function processLogin($username, $password)
    {
        require("./db.php");

        $mysqli = new \mysqli($ip, $un, $psw, $db);
        if ($mysqli->connect_error) {
            exit('Error connecting to database');
        }

        $stmt = $mysqli->prepare("select * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (!$arr) {
            return false;
        }
        foreach ($arr as &$row) {
            if (($row["username"] == $username || $row["email"] == $username) && $row["password"] == sha1($row["salt"] . $password)) {
                session_start();
                $_SESSION["userId"] = $row["id"];
                $username = $row["username"];

                return true;
            }
        }
    }
}

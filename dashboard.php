<?php

namespace Phppot;

use \Phppot\Member;

session_start();

if (!isset($_SESSION["userId"])) {

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Tasks</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">

</head>

<body style="
        background-image: url('img/wood2.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;">
    <!-- Navbar -->
    <?php
    require_once "fragments/mainNavbar.php";
    ?>
    <!-- New Task Form -->
    <?php
    require_once "fragments/newtaskform.php";
    ?>
    <!-- New Subject Form -->
    <?php
    require_once "fragments/newsubjectform.php";
    ?>

    <div class="container mt-3" style="padding-top: 100px; padding-bottom: 100px;">

        <?php
        require("db.php");

        $mysqli = new \mysqli($ip, $un, $psw, $db);

        if ($mysqli->connect_error) {
            $_SESSION["errorMessage"] = "Can't connect to database!";
            header("Location: dashboard.php");
            exit('Error connecting to database');
        }
        $sql = "select subjects.name as subjectname, deadline, done, priority, type, tasks.id, tasks.name as taskname from (tasks inner join subjects on tasks.subject_id = subjects.id) where tasks.user_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $_SESSION["userId"]);
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (!$arr) {
            echo '  <div style="height: 80vh; text-align:center;">
                                <h1 style=" font-weight: bold;">NO TASKS YET!</h1>
                            </div>';
        } else {
            echo "<div style='padding-bottom: 50px;'>";
            echo '<button type="button" onclick="sortByPriority()" class="btn btn-primary">Sort by priority</button>';
            echo '<button type="button" onclick="sortByDate()" class="btn btn-primary">Sort by date</button>';
            echo "</div>";
        }
        echo ' <div class="row">
                <div class="card-deck" id="card-deck">';
        foreach ($arr as &$row) {
            $date1 = strtotime('now');
            $date2 = strtotime($row["deadline"]);
            $diff = $date2 - $date1;

            echo ' <div class="card mb-4" style="min-width: 18rem; max-width: 18rem;';
            if ($row["done"] == true) {
                echo "opacity: 0.6;";
            }
            echo '">
                                        <img class="card-img-top" width="280" height="140" style="background-color: ';
            if ($row["done"] == true) {
                echo "green";
            } else {
                if ($diff < 0) {
                    echo "red";
                } else if ($diff < (3 * 24 * 60 * 60) || $row["priority"] == 5) {
                    echo "yellow";
                } else {
                    echo "green";
                }
            }
            echo ';';
            echo '">
                <div class="card-body">
                    <h5 class="card-title">' . $row["taskname"] . '</h5>
                    <p class="card-title">Priority: ' . $row["priority"] . '/5</p>
                    <p class="card-text">' . $row["subjectname"] . ' ' .  $row["type"] . '</p>
                    <p class="card-text"><small class="text-muted">' . $row["deadline"] . '</small></p>
                </div>';
            if (!$row["done"] == true) {
                echo '<div class="nav-item" style="width: 100%;"> <a style="width: 100%; text-align:center; background-color: LawnGreen; color: black;" class="nav-link waves-effect" href="finishtask.php?id=' . $row["id"] . '">Finish</a></div>';
            }
            echo '</div>';
        }
        ?>
    </div>
    </div>
    </div>
    <script>
        function sortByPriority() {
            var switching, i, x, y, shouldSwitch;
            var cards = document.getElementsByClassName("card");
            switching = true;
            /* Make a loop that will continue until
            no switching has been done: */
            while (switching) {
                switching = false;
                for (i = 0; i < (cards.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                    one from current row and one from the next: */
                    x = cards[i].getElementsByTagName("p")[0];
                    y = cards[i + 1].getElementsByTagName("p")[0];
                    // Check if the two rows should switch place:
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        switching = true;
                        cards[i + 1].after(cards[i]);
                        break;
                    }
                }
            }
        }

        function sortByDate() {
            var switching, i, x, y, shouldSwitch;
            var cards = document.getElementsByClassName("card");
            switching = true;
            /* Make a loop that will continue until
            no switching has been done: */
            while (switching) {
                switching = false;
                for (i = 0; i < (cards.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                    one from current row and one from the next: */
                    x = cards[i].getElementsByTagName("p")[2];
                    y = cards[i + 1].getElementsByTagName("p")[2];
                    // Check if the two rows should switch place:
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        switching = true;
                        cards[i + 1].after(cards[i]);
                        break;
                    }
                }
            }
        }
    </script>

    <!-- FOOTER -->
    <?php
    require_once "fragments/footer.php";
    ?>

</body>

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Initializations -->
<script type="text/javascript">
    // Animations initialization
    new WOW().init();
</script>
<?php
if (isset($_SESSION["errorMessage"]) && $_SESSION["errorMessage"] != "") {
    echo '<script>$("#newSubjectForm").modal("toggle");</script>';
    $_SESSION["errorMessage"] = "";
}
?>

</html>
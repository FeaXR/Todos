<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="icon" href="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-4/256/Shopping-bag-blue-icon.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="./css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="./css/style.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<div id="newtaskForm" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Task</h4>
            </div>
            <div class="modal-body" style="text-align: center;">
                <form action="newtask-action.php" method="post" id="frmNewTask" onSubmit="return validateNewTask();">
                    <div class="form-group">
                        <div>
                            <label for="username">Name</label>
                            <span id="name_info" class="error-info"></span>
                        </div>
                        <input type="text" class="form-control error-info" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="date">Deadline</label>
                            <span id="date_info" class="error-info"></span>
                        </div>
                        <input type="datetime-local" name="datetime" id="datetime">
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="subject">Subject</label>
                            <span id="subject_info" class="error-info"></span>
                        </div>
                        <select class="browser-default custom-select" name="subject" id="subject">
                            <?php
                            require("./db.php");

                            $mysqli = new \mysqli($ip, $un, $psw, $db);

                            if ($mysqli->connect_error) {
                                $_SESSION["errorMessage"] = "Can't connect to database!";
                                header("Location: ./dashboard.php");
                                exit('Error connecting to database');
                            }

                            $sql = "select * from subjects where user_id = ?";
                            $stmt = $mysqli->prepare($sql);
                            $stmt->bind_param("i", $_SESSION["userId"]);
                            $stmt->execute();
                            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                            //echo ' <script>alert("' . $_SESSION["userId"] . '");</script>';
                            if (!$arr) {
                                echo '<option value="-1">NO SUBJECTS YET</option>';
                            }

                            foreach ($arr as &$row) {
                                echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-group">
                            <div>
                                <label for="type">Type</label>
                                <span id="type_info" class="error-info"></span>
                            </div>
                            <select class="browser-default custom-select" name="type" id="type">
                                <option value="Assignment">Assignment</option>
                                <option value="Report">Report</option>
                                <option value="Test">Test</option>
                                <option value="Exam">Exam</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="priority">Priority</label>
                                <span id="type_info" class="error-info"></span>
                            </div>
                            <select class="browser-default custom-select" name="priority" id="priority">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1" selected>1</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-lg btn-block login-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function validateNewTask() {
        var $valid = true;
        document.getElementById("name_info").innerHTML = "";
        document.getElementById("date_info").innerHTML = "";

        var name = document.getElementById("name").value;
        var datetime = document.getElementById("datetime").value;

        if (document.getElementById("subject").value == -1) {
            document.getElementById("subject_info").innerHTML = " required";
            $valid = false;
        }

        if (name == "") {
            document.getElementById("name_info").innerHTML = " required";
            $valid = false;
        }
        if (datetime == "") {
            document.getElementById("date_info").innerHTML = " required";
            $valid = false;
        }

        return $valid;
    }
</script>
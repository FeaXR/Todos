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

<div id="newSubjectForm" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Subject</h4>
            </div>
            <?php
            if (isset($_SESSION["errorMessage"]) && $_SESSION["errorMessage"] != "") {
                echo '
                    <div class="modal-header">
                <h2 class="modal-title">' . $_SESSION["errorMessage"] . '</h2>
                </div>';
            }
            ?>

            <div class="modal-body" style="text-align: center;">
                <form action="newsubject-action.php" method="post" id="frmNewSubject" onSubmit="return validateNewSubject();">
                    <div class="form-group">
                        <div>
                            <label for="name_subject">Name</label>
                            <span id="name_subject_info" class="error-info"></span>
                        </div>
                        <input type="text" class="form-control error-info" name="name" id="name_subject">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="short_subject">Short name</label>
                            <span id="short_subjectsubject_info" class="error-info"></span>
                        </div>
                        <input type="text" class="form-control error-info" id="short" name="short">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg btn-block login-btn">Submit</button>
                    </div>
                </form>

                <script>
                    function validateNewSubject() {
                        var $valid = true;
                        document.getElementById("name_subject_info").innerHTML = "";
                        document.getElementById("short_subject_info").innerHTML = "";

                        var name = document.getElementById("name_subject").value;
                        var short = document.getElementById("short_subject").value;

                        if (name == "") {
                            document.getElementById("name_subject_info").innerHTML = " required";
                            $valid = false;
                        }
                        if (short == "") {
                            document.getElementById("short_subject_info").innerHTML = " required";
                            $valid = false;
                        }
                        return $valid;
                    }
                </script>
            </div>
        </div>
    </div>
</div>
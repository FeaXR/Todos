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

<div id="loginForm" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body" style="text-align: center;">
                <form action="login-action.php" method="post" id="frmLogin" onSubmit="return validateLogin();">
                    <div class="form-group">
                        <div>
                            <label for="username">Username or Email</label>
                            <span id="user_info" class="error-info"></span>
                        </div>
                        <input type="text" class="form-control error-info" name="user_name" id="user_name">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="password">Password</label>
                            <span id="password_info" class="error-info"></span>
                        </div>
                        <input type="password" class="form-control error-info" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login" value="Login" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function validateLogin() {
        var $valid = true;
        document.getElementById("user_info").innerHTML = "";
        document.getElementById("password_info").innerHTML = "";

        var userName = document.getElementById("user_name").value;
        var password = document.getElementById("password").value;
        if (userName == "") {
            document.getElementById("user_info").innerHTML = " required";
            $valid = false;
        }
        if (password == "") {
            document.getElementById("password_info").innerHTML = " required";
            $valid = false;
        }
        return $valid;
    }
</script>
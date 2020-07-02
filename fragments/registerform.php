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


<!-- Register Form -->
<div id="registerForm" class="modal fade" onload="onLoad()">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Register</h4>
            </div>
            <div class="modal-body" style="text-align: center;">
                <form action="register-action.php" method="post" id="frmRegister" onSubmit="return validateRegister();">
                    <div class="form-group">
                        <div>
                            <label for="username_Register">Username</label><span id="user_info_register" class="error-info"></span>
                        </div>
                        <input type="text" class="form-control error-info" name="user_name_register" id="user_name_register">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="email_Register">Email</label><span id="email_register" class="error-info"></span>
                        </div>
                        <input type="text" class="form-control error-info" name="email_register" id="email_register">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="password_register">Password</label><span id="password_info_register" class="error-info"></span>
                        </div>
                        <input type="password" class="form-control error-info" id="password_register" name="password_register">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="password_again_register">Password again</label><span id="password_again_info_register" class="error-info"></span>
                        </div>
                        <input type="password" class="form-control error-info" id="password_again_register">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login" value="Login" class="btn btn-primary btn-lg btn-block login-btn">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function validateRegister() {
        var $valid = true;
        document.getElementById("user_info_register").innerHTML = "";
        document.getElementById("password_info_register").innerHTML = "";

        var userName = document.getElementById("user_name_register").value;
        var password = document.getElementById("password_register").value;
        var passwordagain = document.getElementById("password_again_register").value;
        var email = document.getElementById("email_register").value;

        if (userName == "") {
            document.getElementById("user_info_register").innerHTML = " required";
            $valid = false;
        }
        if (password == "") {
            document.getElementById("password_info_register").innerHTML = " required";
            $valid = false;
        }
        if (password != passwordagain || passwordagain == "") {
            document.getElementById("password_again_info_register").innerHTML = " should be same";
            $valid = false;
        }
        if (email == "") {
            document.getElementById("email_register_info").innerHTML = " required";
            $valid = false;
        }
        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById("email_register").value))) {
            document.getElementById("email_register_info").innerHTML = " is invalid!";
            $valid = false;
        }
        //Store data so if some of them are invalid we can restore them
        if ($valid) {
            localStorage.setItem("username", userName);
            localStorage.setItem("psw", password);
            localStorage.setItem("pswagain", passwordagain);
            localStorage.setItem("email", email);
        }

        return $valid;
    }
</script>

<script>
    //restore user data if previous registration attempt was unsuccesful
    function onLoad() {
        var userName = localStorage.getItem("username");
        var password = localStorage.getItem("psw");
        var passwordagain = localStorage.getItem("pswagain");

        if (!(userName === null)) {
            document.getElementById("user_name_register").value = userName;
        }
        if (!(password === null)) {

            document.getElementById("password_register").value = password;
        }
        if (!(passwordagain === null)) {

            document.getElementById("password_again_register").value = passwordagain;
        }
    }
</script>
<!-- Register Form -->
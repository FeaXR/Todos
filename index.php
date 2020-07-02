<?php
namespace Phppot;

use \Phppot\Member;

session_start();

if (isset($_SESSION["userId"])) {

  header('Location: dashboard.php');
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

<body>
  <?php
  if (isset($_SESSION["errorMessage"])) {
    echo '<script>alert("'.$_SESSION["errorMessage"].'");</script>';
    unset($_SESSION["errorMessage"]);
  }
  ?>

  <!-- Navbar -->
  <?php
  require_once "fragments/outNavbar.php";
  ?>
  <!-- Navbar -->
  <?php
  require_once "fragments/loginform.php";
  require_once "fragments/registerform.php";
  ?>
  <!-- Full Page Intro -->
  <div class="view full-page-intro" style="        
        background-image: url('img/notes.jpg');
        background-repeat: no-repeat;
        background-size: cover;
      ">
    <!-- Mask & flexbox options-->
    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
      <!-- Content -->
      <div class="container">
        <!--Grid row-->
        <div class="row wow fadeIn">
          <!--Grid column-->
          <div class="col-md-6 mb-4 white-text text-center text-md-left">
            <h1 class="display-4 font-weight-bold">
              ORGANISE YOUR TASKS WITH US
            </h1>

            <hr class="hr-light" />

            <p>
              <strong>Best & free task organiser for university students</strong>
            </p>

            <p class="mb-4 d-none d-md-block">
              <strong>The best way to organise your tasks with support for classes, subjects, and much more.</strong>
            </p>

            <a href="#registerForm" data-toggle="modal" class="btn btn-indigo btn-lg">Register now</a>
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </div>
      <!-- Content -->
    </div>
    <!-- Mask & flexbox options-->
  </div>
  <!-- Full Page Intro -->

  <!--Main layout-->
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

</html>
<!DOCTYPE html>

<html lang="en">



<?php

session_start();

require "config.php";



function timer()

{

    static $start;



    if (is_null($start))

    {

        $start = microtime(true);

    }

    else

    {

        $diff = round((microtime(true) - $start), 4);

        $start = null;

        return $diff;

    }

}



timer();



$row_cnt_emps = 0;

$row_cnt_apps = 0;

$row_cnt_certs = 0;

$row_cnt_users = 0;



if ($result = mysqli_query($link, "SELECT * FROM members")) {



  /* determine number of rows result set */

  $row_cnt_users = mysqli_num_rows($result);



  /* close result set */

  mysqli_free_result($result);

}



if ($result = mysqli_query($link, "SELECT * FROM scfrapps")) {



  /* determine number of rows result set */

  $row_cnt_apps = mysqli_num_rows($result);



  /* close result set */

  mysqli_free_result($result);

}



if ($result = mysqli_query($link, "SELECT * FROM certs")) {



  /* determine number of rows result set */

  $row_cnt_certs = mysqli_num_rows($result);



  /* close result set */

  mysqli_free_result($result);

}



if ($result = mysqli_query($link, "SELECT * FROM members WHERE perm > 0")) {



  /* determine number of rows result set */

  $row_cnt_emps = mysqli_num_rows($result);



  /* close result set */

  mysqli_free_result($result);

}

if ($result = mysqli_query($link, 'SELECT * FROM scfrapps WHERE outcome = "Under review"')) {



  /* determine number of rows result set */

  $row_cnt_appsNew = mysqli_num_rows($result);



  /* close result set */

  mysqli_free_result($result);

}



if (isset($_SESSION['username'])) {

  $userLookup = mysqli_query($link, 'SELECT id, username, perm, password FROM members WHERE username = "'.$_SESSION['username'].'"');

  $res = mysqli_fetch_array($userLookup);



  $_SESSION['perm'] = $res['perm'];

}

?>



<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta http-equiv="x-ua-compatible" content="ie=edge">



  <title>SCFR | <?php echo $title?></title>

  <!-- MDB icon -->

  <link rel="icon" href="img/favicon.ico" type="image/x-icon">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

  <!-- Google Fonts Roboto -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

  <!-- Bootstrap core CSS -->

  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Material Design Bootstrap -->

  <link rel="stylesheet" href="css/mdb.min.css">

  <!-- Your custom styles (optional) -->

  <link rel="stylesheet" href="css/style.css">



</head>

<body>



<nav class="mb-1 navbar navbar-expand-lg navbar-dark danger-color fixed-top">

  <a class="navbar-brand" href="/scfr/"><img src="img/logo.png" width="50px" height="50px"></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"

    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>

  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">

    <ul class="navbar-nav mr-auto">

      <li class="nav-item">

        <a class="nav-link" href="/scfr/">Home

          <span class="sr-only">(current)</span>

        </a>

      </li>

      <?php if (isset($_SESSION['perm']) && $_SESSION['perm'] >= 0) {echo '<li class="nav-item"><a class="nav-link" href="dashboard.php">Your dashboard<span class="badge badge-danger ml-2"></span></a></li>';}?>

      <?php if (isset($_SESSION['perm']) && $_SESSION['perm'] >= 1) {echo '<li class="nav-item"><a class="nav-link" href="empdash.php">Employee dashboard<span class="badge badge-danger ml-2"></span></a></li>';}?>

    </ul>

    <ul class="navbar-nav ml-auto nav-flex-icons">

    <?php if (isset($_SESSION['perm']) && $_SESSION['perm'] >= 4) {echo '<li class="nav-item"><a class="nav-link" href="/scfr/admin.php">Admin<span class="sr-only"></span></a></li>';}?>

    <?php if (isset($_SESSION['perm']) && $_SESSION['perm'] >= 3) {echo '<li class="nav-item"><a class="nav-link" href="/scfr/mod.php">Mod<span class="badge badge-danger ml-2">' ;echo $row_cnt_appsNew; echo' NEW APPS</span><span class="sr-only"></span></a></li>';}?>

      <li class="nav-item dropdown">

        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"

          aria-haspopup="true" aria-expanded="false">

          <i class="fas fa-user"></i><?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {echo $_SESSION['username'];}?>

        </a>

        <div class="dropdown-menu dropdown-menu-right dropdown-default"

          aria-labelledby="navbarDropdownMenuLink-333">

          <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {echo '<a class="dropdown-item" href="/scfr/account.php">Account</a>';}?>

          <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {echo '<a class="dropdown-item" href="/scfr/auth/logout.php">Log out</a>';}?>

          <?php if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {echo '<a class="dropdown-item" href="/scfr/auth">Log in</a>';}?>

          <?php if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {echo '<a class="dropdown-item" href="/scfr/auth/register.php">Sign up</a>';}?>

        </div>

      </li>

    </ul>

  </div>

</nav>

<div class="p-5"></div>


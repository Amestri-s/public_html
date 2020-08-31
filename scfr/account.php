<!DOCTYPE html>

<html lang="en">

<?php

session_start();



if(!(isset($_SESSION['loggedin']))) {

    header('Location: /scfr/auth/');

    exit;

}



/* Database credentials. Assuming you are running MySQL

server with default setting (user 'root' with no password) */

define('DB_SERVER', 'localhost');

define('DB_USERNAME', 'scfrsite_scfrdata');

define('DB_PASSWORD', 'scfrdata11');

define('DB_NAME', 'scfrsite_scfrdata');

 

/* Attempt to connect to MySQL database */

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

 

// Check connection

if($link === false){

    die("ERROR: Could not connect. " . mysqli_connect_error());

}



if ($result = mysqli_query($link, "SELECT * FROM new")) {



  /* determine number of rows result set */

  $row_cnt = mysqli_num_rows($result);



  /* close result set */

  mysqli_free_result($result);

}



if ($result = mysqli_query($link, "SELECT * FROM members")) {



  /* determine number of rows result set */

  $row_cnt_users = mysqli_num_rows($result);



  /* close result set */

  mysqli_free_result($result);

}



/* close connection */

mysqli_close($link);



?>

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>SCFR | Your account</title>

  <!-- MDB icon -->

  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">

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



  <!-- Start your project here-->  

  <nav class="mb-1 navbar navbar-expand-lg navbar-dark aqua-gradient animated fadeIn slower">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"

      aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">

      <span class="navbar-toggler-icon"></span>

    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent-333">



    </div>

  </nav>

  <?php if(!(isset($_SESSION['loggedin']))) { echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Welcome!</strong> Enjoy your stay. Login/register for more.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';}?>



  <div class="p-5"></div>

  <div class="p-1"></div>



  <div class="jumbotron animated zoomIn delay-1s">

    <h2 class="display-4 animated fadeIn text-center">Your details</h2>

    <p class="lead animated fadeIn text-center">View and change account settings here...</p>

    <a class="aqua-gradient text-center btn-block btn" href="/scfr">Go back</a>

    <hr class="my-4 animated fadeIn delay-1s">

    <!-- Card deck -->

<div class="card-deck  animated fadeIn delay-2s">



<!-- Card -->

<div class="card mb-4">



  <!--Card content-->

  <div class="card-body">



    <!--Title-->

    <h4 class="card-title text-center">Name</h4>

    <!--Text-->

    <h1 class="text-center"><?php echo $_SESSION['username']?></h1>

    <hr>

    <p class="text-center">Your name is unique to you. No one else can hold the same name. This can be used when referencing your account for changes like permissions.



  </div>



</div>

<!-- Card -->



<!-- Card -->

<div class="card mb-4">



  <!--Card content-->

  <div class="card-body">



    <!--Title-->

    <h4 class="card-title text-center">Permission level</h4>

    <!--Text-->

    <h1 class="text-center"><?php echo $_SESSION['perm'];?></h1>

    <hr>



    <p class="text-center">Your permission level controls what you can do and access with 0 being the lowest, and 4 being the highest. An admin can change your permission level.</p>

  </div>



</div>

<!-- Card -->



<!-- Card -->

<div class="card mb-4">



  <!--Card content-->

  <div class="card-body">



    <!--Title-->

    <h4 class="card-title text-center">ID</h4>

    <!--Text-->

    <h1 class="text-center"><?php echo $_SESSION['id'];?></h1>

    <hr>

    <p class="text-center">Your ID is unique to you and used in the backend of the site, when storing permissions, data, apps and more.</p>

  </div>



</div>

<!-- Card -->





</div>

<!-- Card deck -->

  </div>



<!-- Footer -->

<footer class="page-footer font-small aqua-gradient pt-4">



  <!-- Footer Links -->

  <div class="container-fluid text-center text-md-left">



    <!-- Grid row -->

    <div class="row">



      <!-- Grid column -->

      <div class="col-md-6 mt-md-0 mt-3">



        <!-- Content -->

        <h5 class="text-uppercase"></h5>



      </div>

      <!-- Grid column -->



      <hr class="clearfix w-100 d-md-none pb-3">







    </div>

    <!-- Grid row -->



  </div>

  <!-- Footer Links -->



  <!-- Copyright -->

  <div class="footer-copyright py-3 text-center">© 2020 Copyright:

    <a href="#!">Adam Steele</a></a>

  </div>

  <!-- Copyright -->



</footer>

<!-- Footer -->

  <!-- End your project here-->



  <!-- jQuery -->

  <script type="text/javascript" src="js/jquery.min.js"></script>

  <!-- Bootstrap tooltips -->

  <script type="text/javascript" src="js/popper.min.js"></script>

  <!-- Bootstrap core JavaScript -->

  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <!-- MDB core JavaScript -->

  <script type="text/javascript" src="js/mdb.min.js"></script>

  <!-- Your custom scripts (optional) -->

  <script type="text/javascript"></script>



</body>

</html>
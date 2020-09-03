<?php
    $title = "Homepage";
    require "require/head.php";
?>

<div class="jumbotron animated zoomIn">
    <h2 class="display-4 animated fadeIn">Hello, <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {echo $_SESSION['username'];} else {echo "Guest";}?></h2>
    <p class="lead animated fadeIn">The Sussex County Fire Rescue is responsible for saving lives, preventing loss of life, protecting property and citizens from fires, and other emergencies.</p>
    <hr class="my-4 animated fadeIn delay-1s">
    <p class="animated fadeIn delay-1s">We all strive to complete this by providing emergency services, community outreach, and fire education. </p>
    <?php if(!(isset($_SESSION['loggedin']))) { echo '<a class="btn btn-danger btn-lg animated bounceIn delay-1s" href="/scfr/auth/" role="button">Log in</a>';}?>
    <?php if(!(isset($_SESSION['loggedin']))) { echo '<a class="btn btn-danger btn-lg animated bounceIn delay-1s" href="/scfr/auth/register.php" role="button">Create account</a>';}?>
    <?php if((isset($_SESSION['loggedin']))) { echo '<a class="btn btn-danger btn-lg animated bounceIn delay-1s slower" href="/scfr/dashboard.php" role="button">View dashboard</a>';}?>
</div>
<hr>
<br>
<div class="p-4"></div>
<div class="jumbotron animated flipInX delay-1s ">
    <h4 class="display-4 animated fadeIn text-center">What we offer</h2>
    <p class="lead animated fadeIn text-center">We have careers available in many different disciplines including investigation, public relations, firefighting, providing healthcare and more. You can apply for the department by creating an account, logging into it, and clicking the new application button in your dashboard.</p>
    <div class="text-center">
        <a class="btn btn-outline-danger waves-effect mx-auto" href="/scfr/dashboard.php">Apply now</a>
    </div>
</div>

<div class="jumbotron animated zoomIn delay-1s">
    <h2 class="display-4 animated fadeIn text-center">Currently</h2>
    <p class="lead animated fadeIn text-center">Stats about the current operations of SCFR</p>

    <div class="card-deck  animated fadeIn delay-2s">

    <!-- Card -->
    <div class="card mb-4">

    <!--Card content-->
    <div class="card-body">

        <!--Title-->
        <h4 class="card-title text-center">Users</h4>
        <!--Text-->
        <h1 class="text-center"><?php echo $row_cnt_users;?></h1>

    </div>

    </div>
    <!-- Card -->

    <!-- Card -->
    <div class="card mb-4">

    <!--Card content-->
    <div class="card-body">

        <!--Title-->
        <h4 class="card-title text-center">Employees</h4>
        <!--Text-->
        <h1 class="text-center"><?php echo $row_cnt_emps;?></h1>

    </div>

    </div>
    <!-- Card -->    

    <!-- Card -->
    <div class="card mb-4">

    <!--Card content-->
    <div class="card-body">

        <!--Title-->
        <h4 class="card-title text-center">Submitted applications</h4>
        <!--Text-->
        <h1 class="text-center"><?php echo $row_cnt_apps;?></h1>

    </div>

    </div>
    <!-- Card -->

    <!-- Card -->
    <div class="card mb-4">

    <!--Card content-->
    <div class="card-body">

        <!--Title-->
        <h4 class="card-title text-center">Certifications handed out</h4>
        <!--Text-->
        <h1 class="text-center"><?php echo $row_cnt_certs;?></h1>

    </div>

</div>
<!-- Card -->
    

    

    </div>
    <!-- Card deck -->
</div>

<div class="jumbotron animated flipInX delay-1s">
    <h4 class="display-4 animated fadeIn text-center">History</h2>
    <p class="lead animated fadeIn text-center">The Sussex County Fire Rescue was established in 2019 and is a volunteer department. The Sussex County Fire Rescue offers both fire and medical services to Sussex County. The Sussex County Fire Rescue was originally divided into two different fire departments, the Delaware State Fire Department and Sussex Metro Fire Department. </p>
</div>



<?php
    require "require/footer.php";
?>
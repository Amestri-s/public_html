<?php



$title = "Employee dashboard";

require "require/head.php";



if(!(isset($_SESSION['perm'])) || !($_SESSION['perm'] >= 1)) {

  header('Location: /scfr/auth/');

  exit;

}



$notices = mysqli_query($link, 'SELECT title, text, author, date FROM notices');

$resources = mysqli_query($link, 'SELECT name, description, resLink FROM resources');





mysqli_close($link);

?>

<div class="jumbotron animated zoomIn delay-1s">
    <h2 class="display-4 animated fadeIn text-center">Quick actions</h2>

    <div class="card-deck  animated fadeIn delay-2s">

    <!-- Card -->
    <div class="card mb-2">

    <!--Card content-->
    <div class="card-body">

        <!--Title-->
        <h4 class="card-title text-center">Coming soon</h4>
        <!--Text-->

    </div>

    </div>
    <!-- Card -->

    <!-- Card -->
    <div class="card mb-2">

    <!--Card content-->
    <div class="card-body">

        <!--Title-->
        <h4 class="card-title text-center">Coming soon</h4>
        <!--Text-->

    </div>

    </div>
    <!-- Card -->

    <!-- Card -->
    <div class="card mb-2">

    <!--Card content-->
    <div class="card-body">

        <!--Title-->
        <h4 class="card-title text-center">Coming soon</h4>
        <!--Text-->

    </div>

    </div>
    <!-- Card -->

    <!-- Card -->
    <div class="card mb-2">

    <!--Card content-->
    <div class="card-body">

        <!--Title-->
        <h4 class="card-title text-center">Coming soon</h4>
        <!--Text-->

    </div>

</div>
<!-- Card -->




    </div>
    <!-- Card deck -->
</div>



<div class="m-3 animated fadeIn">

  <div class="card p">

    <h5 class="card-header h5">Notices</h5>

    <div class="card-body">

      <div class="row  animated fadeIn slower">

        <div class="col-sm">

          <?php 

            while($res = mysqli_fetch_array($notices)) {

              echo '<div class="card m-2"><div class="card-body"><h5 class="card-title">';

              echo $res['title'].'</h5><p>';

              echo $res['text'].'</p><p class="card-text">';

              echo $res['author'].' - '.$res['date'].'</p></div></div>';

            }

          ?>

        </div>

      </div>

    </div>

  </div>

</div>



<div class="m-3 animated fadeIn">

  <div class="card p">

    <h5 class="card-header h5">Department resources</h5>

    <div class="card-body">

      <!--Table-->

      <table id="tablePreview" class="table table-hover table-bordered animated fadeIn slower">

        <!--Table body-->

        <tbody>

          <?php 

            while($res = mysqli_fetch_array($resources)) {         

              echo '<tr>';

              echo "<td>".$res['name']."</td>"; 

              echo "<td>".$res['description']."</td>";

              echo '<td><a class="btn btn-danger" href="'.$res['resLink'].'" target="_blank">Link to '.$res['name'].'</a></td>';     

            }

          ?> 

        </tbody>

        <!--Table body-->

      </table>

      <!--Table-->

    </div>

  </div>

</div>

<?php

require "require/footer.php";

?>
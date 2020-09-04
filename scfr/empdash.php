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
<!-- Modal -->
<div class="modal fade" id="submitPatrolLog" tabindex="-1" role="dialog" aria-labelledby="submitPatrolLog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="submitPatrolLogTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="jumbotron">
    <h3 class="display-4 animated fadeIn text-center">Quick actions</h3>
    <hr>

    <div class="card-deck  animated fadeIn">

    <!-- Card -->
    <div class="card mb-2">

    <!--Card content-->
    <div class="card-body text-center">

        <!--Title-->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#submitPatrolLog">
          Submit call log
        </button>
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

    <div class="card-body table-responsive">

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
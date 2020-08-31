<?php



$title = "Your dashboard";

require "require/head.php";



if(!(isset($_SESSION['perm'])) || !($_SESSION['perm'] >= 0)) {

  header('Location: /scfr/auth/');

  exit;

}

$eligible = 0;

$scfrApps = mysqli_query($link, 'SELECT id, outcome, outcomeFeedback, createdAt FROM scfrapps WHERE username = "'. $_SESSION['username'].'"');

$sfrAppCount = mysqli_num_rows($scfrApps);

$certs = mysqli_query($link, 'SELECT certName FROM certs WHERE username = "'. $_SESSION['username'].'"');





mysqli_close($link);

?>

<div class="m-3 animated fadeIn">

  <div class="card p">

    <h5 class="card-header h5">Your SCFR apps</h5>

    <div class="card-body">

      <!--Table-->

      <table id="tablePreview" class="table table-striped table-bordered animated fadeIn slower">

      <!--Table head-->

        <thead>

          <tr>

            <th>ID</th>

            <th>Application outcome</th>

            <th>Application feedback</th>

            <th>Applicate date</th>

          </tr>

        </thead>

        <!--Table head-->

        <!--Table body-->

        <tbody>

          <?php 

              while($res = mysqli_fetch_array($scfrApps)) { 

                echo "<tr>";        

                echo "<td>".$res['id']."</td>";

                echo "<td>".$res['outcome']."</td>";

                if ($res['outcome'] == "Denied") {$eligible = 1;} else {$eligible = 0;};

                echo "<td>".$res['outcomeFeedback']."</td>"; 

                echo "<td>".$res['createdAt']."</td>";    

              }

          ?> 

        </tbody>

        <!--Table body-->

      </table>

      <!--Table-->

      <p class="animated fadeIn slower">Your application ID is unique and can be used when referencing an application that has been made. Once you make an application, it will show up here. You will be able to track its progress and final outcome. If you fail the application, you are always able to take it again.</p>

      <?php if($sfrAppCount == 0 || $eligible == 1) { echo '<a class="btn btn-danger btn-lg animated bounceIn slower delay-1s" href="/scfr/application.php" role="button">New application</a>';};?>

    </div>

  </div>

</div>



<div class="m-3 animated fadeIn">

  <div class="card p">

    <h5 class="card-header h5">Your certifications</h5>

    <p class="m-4">You currently hold <strong><?php echo mysqli_num_rows($certs)?></strong> certification/s.</p>

    <div class="card-body">

      <!--Table-->

      <table id="tablePreview" class="table table-striped table-bordered animated fadeIn slower">

      <!--Table head-->

        <thead>

          <tr>

            <th>Cert Name</th>

          </tr>

        </thead>

        <!--Table head-->

        <!--Table body-->

        <tbody>

          <?php 

            while($res = mysqli_fetch_array($certs)) {         

              echo "<tr>";

              echo "<td>".$res['certName']."</td>";      

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
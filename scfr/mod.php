<?php

    $title = "Mod panel";
    require "require/head.php";

    if(!(isset($_SESSION['perm'])) || !($_SESSION['perm'] >= 3)) {

        header('Location: /scfr/auth/');

        exit;

    }

    $scfrApps = mysqli_query($link, 'SELECT * from scfrapps WHERE outcome = "Under review"');
    $allScfrApps = mysqli_query($link, 'SELECT * from scfrapps');

?>

<div class="m-3 animated fadeIn">

  <div class="card p">

    <h5 class="card-header h5">New apps</h5>

    <div class="card-body  table-responsive animated fadeIn slower">

      <!--Table-->

      <table id="tablePreview" class="table table-hover table-bordered">

        <!--Table body-->

        <thead>

            <td>Username</td>

            <td>Discord</td>

            <td>Email</td>

            <td>Roblox profile link</td>

            <td>Civ name</td>

            <td>Age</td>

            <td>Has a mic</td>

            <td>Time zone</td>

            <td>Why do you want to join</td>

            <td>Do you have any experience</td>
            
            <td>Anything we should know</td>

            <td>Read guidelines</td>

            <td>Read app</td>

            <td>Old enough</td>

            <td>Action</td>

        </thead>

        <tbody>

          <?php 

            while($res = mysqli_fetch_array($scfrApps)) {         

              echo "<tr>";

              echo "<td>".$res['username']."</td>"; 

              echo "<td>".$res['discordUsername']."</td>";

              echo "<td>".$res['email']."</td>";

              echo "<td>".$res['robloxProfileLink']."</td>";

              echo "<td>".$res['civName']."</td>";

              echo "<td>".$res['age']."</td>";

              if ($res['doHaveMic'] = 1) {
                echo "<td>Yes</td>";
              }else {
                echo "<td>No</td>";
              }

              echo "<td>".$res['timeZone']."</td>";

              echo "<td>".$res['whyBePart']."</td>";

              echo "<td>".$res['experience']."</td>";

              echo "<td>".$res['anythingWannaKnow']."</td>";

              if ($res['readGuidelines'] = 1) {
                echo "<td>Yes</td>";
              }else {
                echo "<td>No</td>";
              }

              if ($res['readApp'] = 1) {
                echo "<td>Yes</td>";
              }else {
                echo "<td>No</td>";
              }

              if ($res['oldEnough'] = 1) {
                echo "<td>Yes</td>";
              }else {
                echo "<td>No</td>";
              }



              echo "<td><a class='btn btn-green' href=\"action.php?id=$res[id]&action=accept&ret=mod\" onClick=\"return confirm('Are you sure you want to accept this user?')\">Accept</a> <a class='btn btn-red' href=\"action.php?id=$res[id]&action=deny&ret=mod\" onClick=\"return confirm('Are you sure you want to deny this user.')\">Deny</a></td>";    

            }

          ?> 

        </tbody>

        <!--Table body-->

      </table>

      <!--Table-->

    </div>

  </div>

</div>

<div class="m-3 animated fadeIn">

  <div class="card p">

    <h5 class="card-header h5">All apps</h5>

    <div class="card-body  table-responsive animated fadeIn slower">

      <!--Table-->

      <table id="tablePreview" class="table table-hover table-bordered">

        <!--Table body-->

        <thead>

            <td>Username</td>

            <td>Discord</td>

            <td>Email</td>

            <td>Roblox profile link</td>

            <td>Civ name</td>

            <td>Age</td>

            <td>Has a mic</td>

            <td>Time zone</td>

            <td>Why do you want to join</td>

            <td>Do you have any experience</td>
            
            <td>Anything we should know</td>

            <td>Read guidelines</td>

            <td>Read app</td>

            <td>Old enough</td>

            <td>Outcome</td>

        </thead>

        <tbody>

          <?php 

            while($res = mysqli_fetch_array($allScfrApps)) {         

              echo "<tr>";

              echo "<td>".$res['username']."</td>"; 

              echo "<td>".$res['discordUsername']."</td>";

              echo "<td>".$res['email']."</td>";

              echo "<td>".$res['robloxProfileLink']."</td>";

              echo "<td>".$res['civName']."</td>";

              echo "<td>".$res['age']."</td>";

              if ($res['doHaveMic'] = 1) {
                echo "<td>Yes</td>";
              }else {
                echo "<td>No</td>";
              }

              echo "<td>".$res['timeZone']."</td>";

              echo "<td>".$res['whyBePart']."</td>";

              echo "<td>".$res['experience']."</td>";

              echo "<td>".$res['anythingWannaKnow']."</td>";

              if ($res['readGuidelines'] = 1) {
                echo "<td>Yes</td>";
              }else {
                echo "<td>No</td>";
              }

              if ($res['readApp'] = 1) {
                echo "<td>Yes</td>";
              }else {
                echo "<td>No</td>";
              }

              if ($res['oldEnough'] = 1) {
                echo "<td>Yes</td>";
              }else {
                echo "<td>No</td>";
              }
              
              echo "<td>".$res['outcome']."</td>";

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
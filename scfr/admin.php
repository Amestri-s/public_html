<?php

  $title = "Admin panel";
  require "require/head.php";



  if(!(isset($_SESSION['perm'])) || !($_SESSION['perm'] >= 4)) {

    header('Location: /scfr/auth/');

    exit;

  }

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $titleName = $_POST['titleName'];
    $titleText = $_POST['titleText'];

    if(isset($titleName)) {
      //Notice

      $author = $_SESSION['username'];
      $title = trim($_POST['titleName']);
      $text = trim($_POST['titleText']);
      $sql = "INSERT INTO notices (author, title, text) VALUES (?, ?, ?)";

      if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "sss", $author, $title, $text);
        if(!(mysqli_stmt_execute($stmt))){
          echo "Something went wrong. Please try again later.";  
        }
      }
    }
  }

  //TODO ADD IN RESOURCE THING


  $users = mysqli_query($link, 'SELECT id, username, perm, accepted_at FROM members');

  $notices = mysqli_query($link, 'SELECT id, title, text, author, date FROM notices');

  $resources = mysqli_query($link, 'SELECT id, name, description, resLink FROM resources');

?>

<div class="m-3 animated fadeIn">

  <div class="card p">

    <h5 class="card-header h5">User management</h5>

    <div class="card-body  animated fadeIn slower">

      <!--Table-->

      <table id="tablePreview" class="table table-hover table-bordered">

        <!--Table body-->

        <thead>

            <td>Username</td>

            <td>Perm</td>

            <td>Date created</td>

            <td>Action</td>

        </thead>

        <tbody>

          <?php 

            while($res = mysqli_fetch_array($users)) {         

              echo "<tr>";

              echo "<td>".$res['username']."</td>"; 

              echo "<td>".$res['perm']."</td>";

              echo "<td>".$res['accepted_at']."</td>";

              echo "<td><a class='btn btn-red' href=\"action.php?id=$res[id]&action=del&ret=admin\" onClick=\"return confirm('Are you sure you want to delete?')\">X</a>  |  <a class='btn btn-green' href=\"action.php?id=$res[id]&action=prom&ret=admin\" onClick=\"return confirm('Are you sure you want to promote this user by 1?')\">Promote</a> | <a class='btn btn-red' href=\"action.php?id=$res[id]&action=dem&ret=admin\" onClick=\"return confirm('Are you sure you want to demote this user by 1?')\">Demote</a></td>";    

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

    <h5 class="card-header h5">Current notices</h5>

    <div class="card-body  animated fadeIn slower">

      <!--Table-->

      <table id="tablePreview" class="table table-hover table-bordered">

        <!--Table body-->

        <thead>

            <td>Title</td>

            <td>Text</td>

            <td>Action</td>

        </thead>

        <tbody>

          <?php 

            while($res = mysqli_fetch_array($notices)) {         

              echo "<tr>";

              echo "<td>".$res['title']."</td>"; 

              echo "<td>".$res['text']."</td>";

              echo "<td><a class='btn btn-red' href=\"action.php?id=$res[id]&action=deletenotice&ret=admin\" onClick=\"return confirm('Are you sure you want to delete?')\">X</a>";

            }

          ?> 

        </tbody>

        <!--Table body-->

      </table>

      <!--Table-->

      <hr>

      <form class="border border-light p-3 card-body" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <label for="noticeTitle">Title of notice.</label>

        <input type="text" id="noticeTitle" class="form-control mb-4" placeholder="Conduct" name="titleName" required>



        <label for="noticeText">Main text of notice.</label>

        <input type="text" id="noticeText" class="form-control mb-4" placeholder="You must remain professional at all times." name="titleText" required>



        <button class="btn btn-danger btn-block" type="submit">Create notice</button>

      </form>

    </div>

  </div>

</div>



<div class="m-3 animated fadeIn">

  <div class="card p">

    <h5 class="card-header h5">Resources</h5>

    <div class="card-body  animated fadeIn slower">

      <!--Table-->

      <table id="tablePreview" class="table table-hover table-bordered">

        <!--Table body-->

        <thead>

            <td>Resource name</td>

            <td>Resource description</td>

            <td>Resource link</td>

            <td>Ation</td>

        </thead>

        <tbody>

          <?php 

            while($res = mysqli_fetch_array($resources)) {         

                echo "<tr>";

                echo "<td>".$res['name']."</td>"; 

                echo "<td>".$res['description']."</td>";

                echo '<td><a class="btn btn-danger" href="'.$res['resLink'].'" target="_blank">Link to '.$res['name'].'</a></td>';

                echo "<td><a class='btn btn-red' href=\"action.php?id=$res[id]&action=deleteresource&ret=admin\" onClick=\"return confirm('Are you sure you want to delete?')\">X</a>";

              }

          ?> 

        </tbody>

        <!--Table body-->

      </table>

      <!--Table-->

      <hr>

      <form class="border border-light p-3 card-body" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <label for="resTitle">Resource title.</label>

        <input type="text" id="resTitle" class="form-control mb-4" placeholder="Trello" name="resTitle" required>



        <label for="resDesc">Resource description.</label>

        <input type="text" id="resDesc" class="form-control mb-4" placeholder="Contains stuff" name="resDesc" required>



        <label for="resLink">Resource link.</label>

        <input type="text" id="resLink" class="form-control mb-4" placeholder="https://www.youtube.com/watch?v=dQw4w9WgXcQ" name="resLink" required>



        <button class="btn btn-danger btn-block" type="submit">Create notice</button>

      </form>

    </div>

  </div>

</div>



<?php
    mysql_close($link);
    require "require/footer.php";

?>




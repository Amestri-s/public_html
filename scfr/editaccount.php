<?php

  $title = "Modify account";
  require "require/head.php";

  $webhook_url = "https://discordapp.com/api/webhooks/750321907861291018/swMuUfXRa4KW5WOowA5HLU28lwCUFhcAcezwgCRsGvoYpufJPntHGCM5xdifeu2u_xaL";
  $timestamp = date("c", strtotime("now"));



  if(!(isset($_SESSION['perm'])) || !($_SESSION['perm'] >= 4)) {
    header('Location: /scfr/auth/');
  exit;

  $id = $_GET['id'];

  $accountLookup = mysqli_query($link, "SELECT * FROM members WHERE id=$id");
  $accountData = mysqli_fetch_array($accountLookup);

  $username = $accountData['username'];

  $certLookup = mysqli_query($link, "SELECT * FROM certs WHERE username=$username");

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $certName = trim($_POST['certName']);

    $sql = "INSERT INTO certs (username, certName) VALUES (?, ?)";

    if($stmt = mysqli_prepare($link, $sql)){
      mysqli_stmt_bind_param($stmt, "ss", $username, $certName);

      if(!(mysqli_stmt_execute($stmt))){
        echo "Something went wrong. Please try again later.";
      }
    }
  }

?>

<div class="m-3 animated fadeIn">

  <div class="card p">

    <h5 class="card-header h5">Certs for <?php echo $username; ?></h5>

    <div class="card-body  animated fadeIn slower">

      <!--Table-->

      <table id="tablePreview" class="table table-hover table-bordered">

        <!--Table body-->

        <thead>

            <td>Cert Name</td>

            <td>Action</td>

        </thead>

        <tbody>

          <?php

            while($res = mysqli_fetch_array($certLookup)) {

              echo "<tr>";

              echo "<td>".$res['certName']."</td>";

              echo "<td><a class='btn btn-red' href=\"revcert.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to revoke this cert?')\">X</a>";

            }

          ?>

        </tbody>

        <!--Table body-->

      </table>

      <!--Table-->

      <hr>

          <form class="border border-light p-3 card-body" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                  <label for="certName">Cert name</label>

                  <input type="certName" id="certName" class="form-control mb-4" placeholder="Conduct" name="certName" required>


                  <button class="btn btn-danger btn-block" type="submit">Add cert</button>

           </form>

    </div>

  </div>

</div>

<?php
  require "require/footer.php";
?>
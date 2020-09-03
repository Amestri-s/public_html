<?php 

  $title = "Welcome to the SCFR website!";
  require "require/head.php";

  header('Location: /scfr/');
  

?>

  <div style="height: 100vh">
    <div class="flex-center flex-column">
      <h1 class="text-hide animated fadeIn mb-4" style="background-image: url('/img/logo.png'); width: 500px; height: 500px;">SCFR LOGO</h1>
      <h5 class="animated fadeIn mb-3">Welcome, guest.</h5>
      <p class="animated fadeIn text-muted">Something is coming soon...</p>
    </div>
  </div>

<?php
  require "require/footer.php";
?>

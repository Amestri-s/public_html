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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

<!-- Footer -->
<footer class="page-footer font-small danger-color pt-4">

  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-6 mt-md-0 mt-3">

        <!-- Content -->
        <h5 class="text-uppercase">Mission statement</h5>
        <hr>
        <p>Sussex County Fire Rescue is responsible for saving lives, preventing loss of life, protecting property and citizens from fires, and other emergencies. We all strive to complete this by providing emergency services, community outreach, and fire education. </p>
        <hr>
      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none pb-3">

      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase">Links</h5>

        <ul class="list-unstyled">
          <li>
            <a href="/scfr/auth">Login</a>
          </li>
          <li>
            <a href="/scfr/auth/register.php">Register</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <p><strong>Adam (Amestris)</strong> & <strong>SCFR</strong><br><br>
    <?php echo "Page loaded in ". timer(). " seconds.";?><br>
    <?php date_default_timezone_set('GMT'); echo 'Server time: '; echo date('Y-m-d H:i:s');?>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</body>
</html>
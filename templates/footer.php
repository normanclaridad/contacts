<?php
    $uri = $_SERVER['REQUEST_URI'];
?>

    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo BASE_URL ?>/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?php echo BASE_URL ?>/assets/vendors/chart.js/chart.umd.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo BASE_URL ?>/assets/js/off-canvas.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/js/misc.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/js/settings.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/js/todolist.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <?php if($uri == '/') { ?>
        <!-- <script src="<?php echo BASE_URL ?>/assets/js/dashboard.js"></script> -->
    <?php } ?>
    <!-- End custom js for this page -->
      
    <script src="<?php echo BASE_URL ?>/assets/js/parsley.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/js/select2.full.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/vendors/summernote-0.9.0-dist/summernote-bs5.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/vendors/summernote-0.9.0-dist/lang/summernote-en-US.js"></script>
  </body>
</html>
<?php
require_once('inc/helpers.php');
require_once('inc/app_settings.php');
$helpers = new Helpers();

if($helpers->checkSession()) {
    header('Location: /');
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/parsley.css">
     
    <script src="<?php echo BASE_URL ?>/assets/js/jquery-3.7.1.min.js"></script>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-12 mx-auto text-center">
                <h4>Thank you for Registering</h4>
                <div class="mt-3">
                    <button type="button" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" id="btn-submit">Submit</button>
                  </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <!-- endinject -->
     <script src="<?php echo BASE_URL ?>/assets/js/parsley.js"></script>
     <script>
        $(document).ready(function(){
            $('#btn-submit').click(function(){
                $.ajax({
                    url : 'api/thank-you.php',
                    type : 'post',
                    data : {},
                    success : function(data) {
                        var json = $.parseJSON(data);

                        if(json['code'] == 0) {
                            location.href="<?php echo BASE_URL ?>";
                        } else {
                            alert('Internal error. Please contact administrator.');
                        }
                    }
                })
                return false;
            })
        })
        </script>
  </body>
</html>
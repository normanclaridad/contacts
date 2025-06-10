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
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                    Contact System Specs
                </div>
                <h4>New here?</h4>
                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                <form class="pt-3" method="post" data-parsley-validate="" id="frm-registration">
                    <div class="error-message"></div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Name" required>
                  </div>

                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Email"  required>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="confirm_password" name="confirm_password" required data-parsley-equalto="#password" placeholder="Confirm Password">
                  </div>
                  <div class="mt-3">
                    <button type="button" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" id="btn-submit">Submit</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login.html" class="text-primary">Login</a>
                  </div>
                </form>
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

                if(!$('form#frm-registration').parsley().validate()) {
                    return;
                }
                var msg = $('.error-message');
                $.ajax({
                    url : 'api/register.php',
                    type : 'post',
                    data : $('#frm-registration').serialize(),
                    success : function(data) {
                        var json = $.parseJSON(data);

                        if(json['code'] == 0) {
                            msg.html('<div class="alert alert-success">'+ json['message'] +'</div>');
                            location.href="<?php echo BASE_URL ?>/thank-you.php";
                        } else {
                            msg.html('<div class="alert alert-danger">'+ json['message'] +'</div>');
                        }
                    }
                })
                return false;
            })
        })
        </script>
  </body>
</html>
<?php
include('inc/app_settings.php');
require_once('inc/helpers.php');
require_once('models/Contacts.php');

$helpers = new Helpers();
$contacts = new Contacts();

if(!$helpers->checkSession()) {
    $helpers->redirectLogin();
    return;
}

$id = isset($_GET['id']) ? $_GET['id'] : '';
$contactId = null;
$name = null;
$company = null;
$phone = null;
$email = null;
$actionType = 'add';
if(!empty($id)) {
    $resContact = $contacts->getWhere(" AND id = $id");
    if(!empty($resContact)) {
        $contactId = $resContact[0]['id'];
        $name = $resContact[0]['name'];
        $company = $resContact[0]['company'];
        $phone = $resContact[0]['phone'];
        $email = $resContact[0]['email'];
        $actionType = 'update';
    }
}

include_once 'templates/header.php';
// include_once 'templates/sidebar.php';
?>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-6 mx-auto">
              <div class="auth-form-light text-left p-5">
                <h4>Add Contact</h4>
                <form class="pt-3" method="post" data-parsley-validate="" id="frm-contact">
                    <input type="hidden" name="id" id="id" value="<?php echo $contactId ?>">
                    <input type="hidden" name="action_type" id="action_type" value="<?php echo $actionType ?>">
                    <div class="error-message"></div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="name" id="name" placeholder="Name" required value="<?php echo $name ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company" class="col-sm-3 col-form-label">Company</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="company" id="company" placeholder="Company" required value="<?php echo $company ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required value="<?php echo $phone ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email" required value="<?php echo $email ?>">
                        </div>
                    </div>
                    <div class="mt-6">
                        <button type="button" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" id="btn-submit">Submit</button>
                        <button class="btn btn-light">Cancel</button>
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
<?php
    include_once 'templates/footer.php';
?>
<script>
    $(document).ready(function(){
        $('#btn-submit').click(function(){

            if(!$('form#frm-contact').parsley().validate()) {
                return;
            }
            var msg = $('.error-message');
            $.ajax({
                url : 'api/dml.php',
                type : 'post',
                data : $('#frm-contact').serialize(),
                success : function(data) {
                    var json = $.parseJSON(data);

                    if(json['code'] == 0) {
                        msg.html('<div class="alert alert-success">'+ json['message'] +'</div>');
                        location.href="<?php echo BASE_URL ?>/";
                    } else {
                        msg.html('<div class="alert alert-danger">'+ json['message'] +'</div>');
                    }
                }
            })
            return false;
        })
    })
    </script>
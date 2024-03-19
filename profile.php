<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $data_to_store = array_filter($_POST);

  $db = getDbInstance();

  $db->where('id', $_SESSION['user_id']);
  $last_id = $db->update('agents', $data_to_store);
  $msg = "edited";


  if ($last_id) {
    $_SESSION['success'] = "User details $msg successfully!";
  } else {
    echo 'insert failed: ' . $db->getLastError();
    exit();
  }
}

$edit = true;
$db = getDbInstance();
$db->where('id', $_SESSION['user_id']);
$data = $db->getOne("agents"); 

require_once 'includes/agent_header.php';
?>
<!-- Layout container -->
<div class="layout-page">
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Edit Profile</h4>
      <?php include BASE_PATH . '/includes/flash_messages.php'; ?>
      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-body">
              <form  action="" method="post" id="hotel_form" enctype="multipart/form-data">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-company">Full Name</label>
                  <input type="text" disabled class="form-control"   value="<?php echo htmlspecialchars($edit ? $data['full_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Full name" />
                </div>
                <div class="row mb-3">
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Email ID</label>
                    <input type="text" disabled id="basic-default-phone"   value="<?php echo htmlspecialchars($edit ? $data['email_id'] : '', ENT_QUOTES, 'UTF-8'); ?>" class="form-control phone-mask" value="emailid@gmail.com" />
                  </div>
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Mobile No.</label>
                    <input type="text" id="basic-default-phone" name="mobile" value="<?php echo htmlspecialchars($edit ? $data['mobile'] : '', ENT_QUOTES, 'UTF-8'); ?>" class="form-control phone-mask" value="9999995555" />
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Company Name</label>
                    <input type="text" name="company_name" value="<?php echo htmlspecialchars($edit ? $data['company_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" class="form-control phone-mask" />
                  </div>
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">GST No.</label>
                    <input type="text" class="form-control phone-mask" name="gst_no" value="<?php echo htmlspecialchars($edit ? $data['gst_no'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-email">Complete Address</label>
                  <input type="text" class="form-control phone-mask" name="complete_address" value="<?php echo htmlspecialchars($edit ? $data['complete_address'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                </div>
                <div class="row mb-3">
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Country</label>
                    <input type="text" class="form-control phone-mask" name="country" value="<?php echo htmlspecialchars($edit ? $data['country'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">State</label>
                    <input type="text" class="form-control phone-mask" name="state" value="<?php echo htmlspecialchars($edit ? $data['state'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
  </div>
</div>

<?php include BASE_PATH . '/includes/agent_footer.php'; ?>
<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $data_to_store = array_filter($_POST);

  $db = getDbInstance();
  if (isset($_POST['id']) && !empty($_POST['id'])) {
    $db->where('id', $_POST['id']);
    $last_id = $db->update('hotels', $data_to_store);
    $msg = "edited";
  } else {
    $msg = "added";
    $last_id = $db->insert('hotels', $data_to_store);
  }

  if ($last_id) {
    $_SESSION['success'] = "Hotel $msg successfully!";
    header('location: hotel.php');
    exit();
  } else {
    echo 'insert failed: ' . $db->getLastError();
    exit();
  }
}

$id = isset($_GET['crm']) && !empty($_GET['crm']) ? decryptId($_GET['crm']) : "";
$edit = false;
if (!empty($id)) {
  $edit = true;
  $db = getDbInstance();
  $db->where('id', $id);
  $data = $db->getOne("hotels");
}


include BASE_PATH . '/includes/header.php';
?>
<!-- Layout container -->
<div class="layout-page">

  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

      <h4 class="py-3 mb-4">Add Hotel Information</h4>

      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-body">
              <form action="" method="post" id="hotel_form" enctype="multipart/form-data">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-company">Hotel Name</label>
                  <input type="text" class="form-control" name="hotel_name" value="<?php echo htmlspecialchars($edit ? $data['hotel_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                </div>
                <div class="row mb-3">
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Owner Name</label>
                    <input type="text" class="form-control" name="owner_name" value="<?php echo htmlspecialchars($edit ? $data['owner_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                
                
                <div class="col-md">
                  <label class="form-label" for="basic-default-email">Hotel Category</label>
                  <div class="input-group">
                    <label class="input-group-text" for="inputGroupSelect01">Options</label>
                    <select class="form-select" id="inputGroupSelect01" >
                      <option selected="">Choose...</option>
                      <option>Budget</option>
                      <option>Standard</option>
                      <option>Deluxe</option>
                      <option>Super Deluxe</option>
                      <option>Premium</option>
                      
                    </select>
                  </div>
                </div>
</div>
                <div class="row mb-3">
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Email ID</label>
                    <input type="text" class="form-control phone-mask" name="email_id" value="<?php echo htmlspecialchars($edit ? $data['email_id'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Mobile No.</label>
                    <input type="text" class="form-control phone-mask" name="mobile" value="<?php echo htmlspecialchars($edit ? $data['mobile'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                  <input type="hidden" name="id" value="<?php echo $id ?>" />
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
  </div>
</div>
<?php include BASE_PATH . '/includes/footer.php'; ?>
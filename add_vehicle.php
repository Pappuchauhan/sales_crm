<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $data_to_store = array_filter($_POST);

  $db = getDbInstance();

  if (isset($_POST['id']) && !empty($_POST['id'])) {
    $db->where('id', $_POST['id']);
    $last_id = $db->update('vehicles', $data_to_store);
    $msg = "edited";
  } else {
    $msg = "added";
    $last_id = $db->insert('vehicles', $data_to_store);
  }

  if ($last_id) {
    $_SESSION['success'] = "Vehicle $msg successfully!";
    header('location: vehicle.php');
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
  $data = $db->getOne("vehicles");
}

$transportation = setTransportation();

require_once 'includes/header.php';
?>
<!-- Layout container -->
<div class="layout-page">

  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

      <h4 class="py-3 mb-4"><?=$edit?'Edit':"Add"?> Vehicle Details</h4>

      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-body">
              <form action="" method="post" id="customer_form" enctype="multipart/form-data">
                <div class="row mb-3">
                <div class="col-md">
                  <label class="form-label" for="basic-default-company">Driver Name</label>
                  <input type="text" class="form-control" name="driver_name" value="<?php echo xss_clean($edit ? $data['driver_name'] : ''); ?>" required />
                </div>
                
                  <div class="col-md">
                  <label class="form-label" for="basic-default-phone">Vehicle Type</label>
                    <select name="vehicle_type" class="form-select" id="inputGroupSelect01" required>
                      <option value="">Select Vehicle</option>
                      <?php
                      foreach($transportation as $key=>$transport){
                       $selected = ($key == $data['vehicle_type'])?'selected':"";
                        echo "<option value=\"$key\" $selected>$key</option>";
                      }
                      ?> 
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Vehicle Number</label>
                    <input type="text" class="form-control phone-mask" name="vehicle_number" value="<?php echo xss_clean($edit ? $data['vehicle_number'] : ''); ?>" required />
                  </div>
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Mobile No.</label>
                    <input type="number" class="form-control phone-mask" name="mobile" value="<?php echo xss_clean($edit ? $data['mobile'] : ''); ?>" required />
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
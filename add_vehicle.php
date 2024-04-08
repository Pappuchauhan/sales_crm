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
                  <input type="text" class="form-control" name="driver_name" value="<?php echo htmlspecialchars($edit ? $data['driver_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" required />
                </div>
                
                  <div class="col-md">
                  <label class="form-label" for="basic-default-phone">Passenger Limit</label>
                    <select class="form-select" id="inputGroupSelect01" required>
                      <option value="">Select Vehicle</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="3">4</option>
                      <option value="3">5</option>
                      <option value="3">6</option>
                      <option value="3">7</option>
                      <option value="3">8</option>
                      <option value="3">9</option>
                      <option value="3">10</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Vehicle Number</label>
                    <input type="text" class="form-control phone-mask" name="vehicle_number" value="<?php echo htmlspecialchars($edit ? $data['vehicle_number'] : '', ENT_QUOTES, 'UTF-8'); ?>" required />
                  </div>
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Mobile No.</label>
                    <input type="number" class="form-control phone-mask" name="mobile" value="<?php echo htmlspecialchars($edit ? $data['mobile'] : '', ENT_QUOTES, 'UTF-8'); ?>" required />
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
<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php'; 

// Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');

// Per page limit for pagination.
$pagelimit = 2;

// Get current page.
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
  $page = 1;
}

// If filter types are not selected we show latest added data first
if (!$filter_col) {
  $filter_col = 'id';
}
if (!$order_by) {
  $order_by = 'asc';
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('id', 'driver_name', 'vehicle_number', 'mobile', 'created_at', 'updated_at');

//Start building query according to input parameters.
// If search string
if ($search_string) {
  $db->where("$filter_col", '%' . $search_string . '%', 'like');
}

//If order by option selected
if ($order_by) {
  $db->orderBy($filter_col, $order_by);
}

// Set pagination limit
$db->pageLimit = $pagelimit;

// Get result of the query.
$rows = $db->arraybuilder()->paginate('vehicles', $page, $select);
$total_pages = $db->totalPages;

include BASE_PATH . '/includes/header.php';
?>
<!-- Layout container -->
<div class="layout-page">

  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <form>
        <div class="card mb-4">
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-5">
                <label class="form-label">Search by</label>
                <div class="input-group">
                  <label class="input-group-text">Options</label>
                  <select class="form-select" name="filter_col">
                    <option selected="">Choose...</option>
                    <option value="id" selected>Driver ID</option>
                    <option value="driver_name">Driver Name</option>
                    <option value="vehicle_number">Mobile Number</option>
                  </select>
                </div>
              </div>
              <div class="col-md-5">
                <label class="form-label">Enter Text</label>
                <input class="form-control" name="search_string" type="text" placeholder="Search...">
              </div>
              <div class="col-md">
                <label class="form-label" style="display: block;">&nbsp;</label>
                <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </div>
          </div>
      </form>
    </div>

    <div class="row">
      <div class="col">
        <h4 class="py-3 mb-4">View Vehicle Details</h4>
      </div>
      <div class="col-auto">
        <a href="add_vehicle.php" class="btn btn-primary">Add Vehicle</a>
      </div>
    </div> 
    <?php include BASE_PATH . '/includes/flash_messages.php'; ?>
    <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-body">
            <div class="table-responsive text-nowrap border-light border-solid mb-3">
              <table class="table">
                <thead>
                  <tr class="text-nowrap bg-dark align-middle">
                  <th class="text-white border-right-white">#</th>
                    <th class="text-white border-right-white">Driver ID</th>
                    <th class="text-white border-right-white">Driver Name</th>
                    <th class="text-white border-right-white">Vehicle Number</th>
                    <th class="text-white border-right-white">Mobile Number</th>
                    <th class="text-white border-right-white">Edit Details</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  <?php  
                  $k= ($page != 1)? (($page-1) * $pagelimit)+1:1;
                  foreach ($rows as $row) : ?>
                    <tr>
                      <td class="border-right-dark"><?=$k?></td>
                      <td class="border-right-dark">#<?php echo $row['id']; ?></td>
                      <td class="border-right-dark"><?php echo xss_clean($row['driver_name']); ?></td>
                      <td class="border-right-dark"><?php echo xss_clean($row['vehicle_number']); ?></td>
                      <td class="border-right-dark"><?php echo xss_clean($row['mobile']); ?></td>
                      <td class="border-right-dark"><a href="add_vehicle.php?crm=<?php echo encryptId($row['id']); ?>" >Edit Details</a></td>
                    </tr>
                  <?php 
                  $k++;
                  endforeach; ?>

                </tbody>
              </table>
            </div>
            <!-- Pagination -->
            <div class="text-center">
              <?php echo paginationLinks($page, $total_pages, 'vehicle.php'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / Content -->
</div>
</div>

<?php include BASE_PATH . '/includes/footer.php'; ?>
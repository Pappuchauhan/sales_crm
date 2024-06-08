<?php
session_start();
require_once './config/config.php';
require_once 'includes/agent_header.php';

// Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');

// Per page limit for pagination. 

// Get current page.
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
  $page = 1;
}

if (!$filter_col) {
  $filter_col = 'id';
}
if (!$order_by) {
  $order_by = 'asc';
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('id', 'name', 'tour_start_date', 'duration', 'package_id', 'category',  'cumulative', 'per_person', 'per_service', 'person',  'permit', 'guide',  'transport', 'booking_code', 'type', 'created_at', 'updated_at');
$db->where('type', 'Query');


// If search string
if ($search_string) {
  $db->where("$filter_col", '%' . $search_string . '%', 'like');
}

//If order by option selected
if ($order_by) {
  $db->orderBy($filter_col, $order_by);
}

// Set pagination limit
$db->pageLimit = PAGE_LIMIT;

// Get result of the query.
$rows = $db->arraybuilder()->paginate('agent_queries', $page, $select);
$total_pages = $db->totalPages;

?>



<!-- Layout container -->
<div class="layout-page">
  <!-- Navbar -->
  <!-- <nav
              class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
              id="layout-navbar">
              <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                  <i class="bx bx-menu bx-sm"></i>
                </a>
              </div>
  
              <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <div class="navbar-nav align-items-center">
                  <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input
                      type="text"
                      class="form-control border-0 shadow-none ps-1 ps-sm-2"
                      placeholder="Search..."
                      aria-label="Search..." />
                  </div>
                </div>
              </div>
            </nav> -->

  <!-- / Navbar -->

  <!-- Content wrapper -->
  <div class="content-wrapper">


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
                    <option value="name" selected>Guest Name</option>
                    <option value="tour_start_date">Tour start date</option>
                    <option value="category">category</option>
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



    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Booking Summary</h4>

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

                      <th class="text-white border-right-white">Booking No</th>
                      <th class="text-white border-right-white">Package Type</th>
                      <th class="text-white border-right-white">Guest Name</th>
                      <th class="text-white border-right-white">No of Pax</th>
                      <th class="text-white border-right-white">No of Nights</th>
                      <th class="text-white border-right-white">Hotel Category</th>
                      <th class="text-white border-right-white">Arrival</th>
                      <th class="text-white border-right-white">Departure</th>
                      <th class="text-white border-right-white">Total Amount</th>
                      <th class="text-white border-right-white">Commission</th>
                      <th class="text-white border-right-white">GST</th>
                      <th class="text-white border-right-white">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php
                    $k = ($page != 1) ? (($page - 1) * PAGE_LIMIT) + 1 : 1;
                    foreach ($rows as $row) :

                    ?>
                      <tr>
                        <td class="border-right-dark"><?= $k ?></td>

                        <td class="border-right-dark"><?php echo xss_clean($row['booking_code']); ?></td>
                        <td class="border-right-dark">Group Booking</td>
                        <td class="border-right-dark"><?php echo xss_clean($row['name']); ?></td>
                        <td class="border-right-dark">12</td>
                        <td class="border-right-dark"><?php echo xss_clean($row['duration']); ?></td>
                        <td class="border-right-dark"><?php echo xss_clean($row['category']); ?></td>
                        <td class="border-right-dark"><?php echo xss_clean($row['tour_start_date']); ?></td>
                        <td class="border-right-dark">08/04/2024</td>
                        <td class="border-right-dark">₹23500</td>
                        <td class="border-right-dark">10%</td>
                        <td class="border-right-dark">ABCDE0340404</td>
                        <td class="border-right-dark"><a href="agent_query_edit.php?ID=<?php echo encryptId($row['id']); ?>">Edit</a></td>

                      </tr>
                    <?php
                      $k++;
                    endforeach;
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
            <?php echo paginationLinks($page, $total_pages, 'agent_query.php'); ?>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
  </div>
</div>
</div>
</div>

<?php include 'includes/agent_footer.php'; ?>
<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';
require_once 'includes/header.php'; 
// Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');

// Get current page.
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
  $page = 1;
}

if (!$filter_col) {
  $filter_col = 'agent_queries.id';
}
if (!$order_by) {
  $order_by = 'asc';
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$db->join('agents', 'agents.id = agent_queries.created_by', 'LEFT');
$select = array('agent_queries.id', 'name', 'tour_start_date', 'duration', 'package_id', 'category',  'cumulative', 'per_person', 'per_service', 'person',  'permit', 'guide',  'transport', 'booking_code', 'agent_queries.type', 'agent_queries.created_at', 'agent_queries.updated_at','query_code','your_budget','gst_no','tour_end_date','total_amount','total_pax','full_name','is_accept');
$db->where('agent_queries.type', 'Booking');


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
<div class="layout-page">

  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->
<style>
  .style{
    color:red !important;
    font-weight: bold;
  }
</style>
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

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">All Booking Summary</h4>

      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-body">
              <div class="table-responsive text-nowrap border-light border-solid mb-3">
                <table class="table">
                  <thead>
                    <tr class="text-nowrap bg-dark align-middle">
                      <th class="text-white border-right-white">#</th>
                      <th class="text-white border-right-white">Booking Code</th>
                      <th class="text-white border-right-white">Booking Accepted</th>
                      <th class="text-white border-right-white">Booking Date</th>  
                      <th class="text-white border-right-white">Agent Name</th>
                      <th class="text-white border-right-white">Package Type</th>
                      <th class="text-white border-right-white">Guest Name</th>
                      <th class="text-white border-right-white">No of Pax</th>
                      <th class="text-white border-right-white">No of Nights</th>
                      <th class="text-white border-right-white">Hotel Category</th>
                      <th class="text-white border-right-white">Arrival</th>
                      <th class="text-white border-right-white">Departure</th>
                      <th class="text-white border-right-white">Total Amount</th>
                      <th class="text-white border-right-white">Budget</th>
                      <th class="text-white border-right-white">GST</th>
                      <th class="text-white border-right-white">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php
                    $k = ($page != 1) ? (($page - 1) * PAGE_LIMIT) + 1 : 1;
                    foreach ($rows as $row) :
                     $class =  $row['is_accept'] =='No'?"style":'';
                    ?>
                      <td class="border-right-dark"><?= $k ?></td>

                      <td class="border-right-dark <?=$class?>"><?php echo xss_clean($row['booking_code']); ?></td>
                      <td class="border-right-dark"><?=$row['is_accept'] ?></td>
                      <td class="border-right-dark"><?php echo xss_clean(date("Y-m-d",strtotime($row['created_at']))); ?></td> 
                      <td class="border-right-dark"><?php echo xss_clean($row['full_name']); ?></td>
                      <td class="border-right-dark">Group Booking</td>
                      <td class="border-right-dark"><?php echo xss_clean($row['name']); ?></td>
                      <td class="border-right-dark"><?=$row['total_pax']?></td>
                      <td class="border-right-dark"><?php echo xss_clean($row['duration']); ?></td>
                      <td class="border-right-dark"><?php echo xss_clean($row['category']); ?></td>
                      <td class="border-right-dark"><?php echo xss_clean($row['tour_start_date']); ?></td>
                      <td class="border-right-dark"><?=$row['tour_end_date']?></td>
                      <td class="border-right-dark">₹<?=$row['total_amount']?></td>
                      <td class="border-right-dark">₹<?=$row['your_budget']?></td>
                      <td class="border-right-dark"><?=$row['gst_no']?></td>
                      <td class="border-right-dark">

                      <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="agent_query_edit.php?ID=<?php echo encryptId($row['id']); ?>"><i class="bx bx-edit-alt me-1"></i> View Booking</a>
                            <?php if($row['is_accept'] =='Yes'){ ?>
                            <a class="dropdown-item" href="generate_invoice.php?ID=<?php echo encryptId($row['id']); ?>"><i class="bx bx-trash me-1"></i> Generate Invoice</a>
                            <?php } ?>
                          </div>
                        </div>

                      <!-- <a href="agent_query_edit.php?ID=<?php echo encryptId($row['id']); ?>">View</a> 
                     <?php if($row['is_accept'] =='Yes'){ ?> / 
                      <a href="generate_invoice.php?ID=<?php echo encryptId($row['id']); ?>">Invoice</a>
                      <?php } ?>
                    </td> -->
                      
                      </tr>
                    <?php
                      $k++;
                    endforeach;
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
            <?php echo paginationLinks($page, $total_pages, 'booking.php'); ?>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
  </div>
</div>
</div>
</div>

<?php include BASE_PATH . '/includes/footer.php'; ?>
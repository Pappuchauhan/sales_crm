<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

// Costumers class
require_once BASE_PATH . '/lib/Costumers/Costumers.php';
$costumers = new Costumers();

// Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');

// Per page limit for pagination.
$pagelimit = 15;

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
  $order_by = 'Desc';
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('id', 'email_id','full_name', 'mobile', 'created_at', 'updated_at');

//Start building query according to input parameters.
// If search string
if ($search_string) {
  $db->where("$filter_col", '%' . $search_string . '%', 'like');
  // $db->orwhere('l_name', '%' . $search_string . '%', 'like');
}

//If order by option selected
if ($order_by) {
  $db->orderBy($filter_col, $order_by);
}

// Set pagination limit
$db->pageLimit = $pagelimit;

// Get result of the query.
$rows = $db->arraybuilder()->paginate('agents', $page, $select);
$total_pages = $db->totalPages;

include BASE_PATH . '/includes/header.php';
?>
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
                                    <option value="id" selected>Agent id</option>
                                    <option value="email_id">Agent Email</option>
                                    <option value="full_name">Agent Name</option>
                                    <option value="mobile">Agent Mobile no.</option>
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
            </div>
            </form>
        
            <h4 class="py-3 mb-4">Agent Details</h4>
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
                                            <th class="text-white border-right-white">Agent Code</th>
                                            <th class="text-white border-right-white">Email Id</th>
                                            <th class="text-white border-right-white">Mobile Number</th>
                                            <th class="text-white border-right-white">Agent Name</th>
                                            <!-- <th class="text-white border-right-white">Company Name</th> -->
                                            <th class="text-white border-right-white">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                    <?php foreach ($rows as $row) : ?>
                                        <tr>
                                            <td class="border-right-dark">#<?php echo $row['id']; ?></td>
                                            <td class="border-right-dark"><?php echo xss_clean($row['email_id']); ?></td>
                                            <td class="border-right-dark"><?php echo xss_clean($row['mobile']); ?></td>
                                            <td class="border-right-dark"><?php echo xss_clean($row['full_name']); ?></td>
                                            
                                            <td class="border-right-dark">
                                                <div class="dropdown pos-relative">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                                                        <i class="bx bx-dots-vertical-rounded"><span></span></i>
                                                    </button>
                                                    <div class="dropdown-menu custom-dd-menu">
                                                        <a class="dropdown-item" href="edit_agent.php?crm=<?php echo encryptId($row['id']); ?>"><i class="bx bx-edit-alt me-1"></i> Edit Details</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Deactive</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
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
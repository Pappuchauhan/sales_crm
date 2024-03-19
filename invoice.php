<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

include BASE_PATH . '/includes/header.php';
?>
<div class="layout-page">

  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="card mb-4">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-5">
              <label class="form-label">Search by</label>
              <div class="input-group">
                <label class="input-group-text">Options</label>
                <select class="form-select">
                  <option selected="">Choose...</option>
                  <option>Invoice No</option>
                  <option>Booking Number</option>
                  <option>Agent Code</option>
                  <option>Package Name</option>
                  <option>Guest Name</option>
                </select>
              </div>
            </div>
            <div class="col-md-5">
              <label class="form-label">Enter Text</label>
              <input class="form-control" type="text" placeholder="Search...">
            </div>
            <div class="col-md">
              <label class="form-label" style="display: block;">&nbsp;</label>
              <button type="submit" class="btn btn-primary">Search</button>
            </div>
          </div>
        </div>
      </div>
      <h4 class="py-3 mb-4">All Invoices</h4>

      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-body">
              <div class="table-responsive text-nowrap border-light border-solid mb-3">
                <table class="table">
                  <thead>
                    <tr class="text-nowrap bg-dark align-middle">
                      <th class="text-white border-right-white">Invoice No</th>
                      <th class="text-white border-right-white">Booking No</th>
                      <th class="text-white border-right-white">Agent Code</th>
                      <th class="text-white border-right-white">Package Type</th>
                      <th class="text-white border-right-white">Guest Name</th>
                      <th class="text-white border-right-white">No of Pax</th>
                      <th class="text-white border-right-white">Total Amount</th>
                      <th class="text-white border-right-white">Download Invoice</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">Leh Ladakh Group Tour</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="admin-edit-invoice.html"><i class="bx bx-edit-alt me-1"></i> Edit Invoice</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Download Invoice</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">Leh Ladakh Group Tour</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit Invoice</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Download Invoice</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">Leh Ladakh Group Tour</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit Invoice</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Download Invoice</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">Leh Ladakh Group Tour</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit Invoice</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Download Invoice</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">Leh Ladakh Group Tour</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit Invoice</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Download Invoice</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">Leh Ladakh Group Tour</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit Invoice</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Download Invoice</a>
                          </div>
                        </div>
                      </td>
                    </tr>
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
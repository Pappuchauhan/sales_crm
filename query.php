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
                  <option>Booking Number</option>
                  <option>Agent Code</option>
                  <option>Query Number</option>
                  <option>Package Name</option>
                  <option>Booking Date</option>
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
      <h4 class="py-3 mb-4">All Query Summary</h4>

      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-body">
              <div class="table-responsive text-nowrap border-light border-solid mb-3">
                <table class="table">
                  <thead>
                    <tr class="text-nowrap bg-dark align-middle">
                      <th class="text-white border-right-white">Query No</th>
                      <th class="text-white border-right-white">Booking No</th>
                      <th class="text-white border-right-white">Booking Date</th>
                      <th class="text-white border-right-white">Agent Code</th>
                      <th class="text-white border-right-white">Agent Name</th>
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
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">27-05-2024</td>
                      <td class="border-right-dark">LDKH031</td>
                      <td class="border-right-dark">Ctour</td>
                      <td class="border-right-dark">Group Booking</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">7</td>
                      <td class="border-right-dark">Budget</td>
                      <td class="border-right-dark">03/04/2024</td>
                      <td class="border-right-dark">08/04/2024</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">10%</td>
                      <td class="border-right-dark">ABCDE0340404</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="full-information.html"><i class="bx bx-edit-alt me-1"></i> Full Detail</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">27-05-2024</td>
                      <td class="border-right-dark">LDKH031</td>
                      <td class="border-right-dark">Ctour</td>
                      <td class="border-right-dark">Group Booking</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">7</td>
                      <td class="border-right-dark">Budget</td>
                      <td class="border-right-dark">03/04/2024</td>
                      <td class="border-right-dark">08/04/2024</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">10%</td>
                      <td class="border-right-dark">ABCDE0340404</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="full-information.html"><i class="bx bx-edit-alt me-1"></i> Full Detail</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">27-05-2024</td>
                      <td class="border-right-dark">LDKH031</td>
                      <td class="border-right-dark">Ctour</td>
                      <td class="border-right-dark">Group Booking</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">7</td>
                      <td class="border-right-dark">Budget</td>
                      <td class="border-right-dark">03/04/2024</td>
                      <td class="border-right-dark">08/04/2024</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">10%</td>
                      <td class="border-right-dark">ABCDE0340404</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="full-information.html"><i class="bx bx-edit-alt me-1"></i> Full Detail</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">27-05-2024</td>
                      <td class="border-right-dark">LDKH031</td>
                      <td class="border-right-dark">Ctour</td>
                      <td class="border-right-dark">Group Booking</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">7</td>
                      <td class="border-right-dark">Budget</td>
                      <td class="border-right-dark">03/04/2024</td>
                      <td class="border-right-dark">08/04/2024</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">10%</td>
                      <td class="border-right-dark">ABCDE0340404</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="full-information.html"><i class="bx bx-edit-alt me-1"></i> Full Detail</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">27-05-2024</td>
                      <td class="border-right-dark">LDKH031</td>
                      <td class="border-right-dark">Ctour</td>
                      <td class="border-right-dark">Group Booking</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">7</td>
                      <td class="border-right-dark">Budget</td>
                      <td class="border-right-dark">03/04/2024</td>
                      <td class="border-right-dark">08/04/2024</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">10%</td>
                      <td class="border-right-dark">ABCDE0340404</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="full-information.html"><i class="bx bx-edit-alt me-1"></i> Full Detail</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">27-05-2024</td>
                      <td class="border-right-dark">LDKH031</td>
                      <td class="border-right-dark">Ctour</td>
                      <td class="border-right-dark">Group Booking</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">7</td>
                      <td class="border-right-dark">Budget</td>
                      <td class="border-right-dark">03/04/2024</td>
                      <td class="border-right-dark">08/04/2024</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">10%</td>
                      <td class="border-right-dark">ABCDE0340404</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="full-information.html"><i class="bx bx-edit-alt me-1"></i> Full Detail</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">27-05-2024</td>
                      <td class="border-right-dark">LDKH031</td>
                      <td class="border-right-dark">Ctour</td>
                      <td class="border-right-dark">Group Booking</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">7</td>
                      <td class="border-right-dark">Budget</td>
                      <td class="border-right-dark">03/04/2024</td>
                      <td class="border-right-dark">08/04/2024</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">10%</td>
                      <td class="border-right-dark">ABCDE0340404</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="full-information.html"><i class="bx bx-edit-alt me-1"></i> Full Detail</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-right-dark">#001</td>
                      <td class="border-right-dark">GL2034</td>
                      <td class="border-right-dark">27-05-2024</td>
                      <td class="border-right-dark">LDKH031</td>
                      <td class="border-right-dark">Ctour</td>
                      <td class="border-right-dark">Group Booking</td>
                      <td class="border-right-dark">Praveen Jha</td>
                      <td class="border-right-dark">12</td>
                      <td class="border-right-dark">7</td>
                      <td class="border-right-dark">Budget</td>
                      <td class="border-right-dark">03/04/2024</td>
                      <td class="border-right-dark">08/04/2024</td>
                      <td class="border-right-dark">₹23500</td>
                      <td class="border-right-dark">10%</td>
                      <td class="border-right-dark">ABCDE0340404</td>
                      <td class="border-right-dark">
                        <div class="dropdown pos-relative">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow toggle-options">
                            <i class="bx bx-dots-vertical-rounded"><span></span></i>
                          </button>
                          <div class="dropdown-menu custom-dd-menu">
                            <a class="dropdown-item" href="full-information.html"><i class="bx bx-edit-alt me-1"></i> Full Detail</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
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
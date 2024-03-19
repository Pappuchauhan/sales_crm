<?php
require_once 'includes/agent_header.php';
?>
          <!-- Layout container -->
          <div class="layout-page">
            <!-- Navbar -->
            <nav
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
            </nav>
  
            <!-- / Navbar -->
  
            <!-- Content wrapper -->
            <div class="content-wrapper">
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
                                <th class="text-white border-right-white">Query No</th>
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
                            <tr>
                                <td class="border-right-dark">#001</td>
                                <td class="border-right-dark">GL2034</td>
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
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> View Details</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Download Invoice</a>
                                      </div>
                                  </div>
                              </td>
                            </tr>
                            <tr>
                                <td class="border-right-dark">#001</td>
                                <td class="border-right-dark">GL2034</td>
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
                                  <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> View Details</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Download Invoice</a>
                                      </div>
                                  </div>
                              </td>
                            </tr>
                            <tr>
                                <td class="border-right-dark">#001</td>
                                <td class="border-right-dark">GL2034</td>
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
                                  <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> View Details</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Download Invoice</a>
                                      </div>
                                  </div>
                              </td>
                            </tr>
                            <tr>
                                <td class="border-right-dark">#001</td>
                                <td class="border-right-dark">GL2034</td>
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
                                  <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> View Details</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Download Invoice</a>
                                      </div>
                                  </div>
                              </td>
                            </tr>
                            <tr>
                                <td class="border-right-dark">#001</td>
                                <td class="border-right-dark">GL2034</td>
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
                                  <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> View Details</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Download Invoice</a>
                                      </div>
                                  </div>
                              </td>
                            </tr>
                            <tr>
                                <td class="border-right-dark">#001</td>
                                <td class="border-right-dark">GL2034</td>
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
                                  <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> View Details</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Download Invoice</a>
                                      </div>
                                  </div>
                              </td>
                            </tr>
                            <tr>
                                <td class="border-right-dark">#001</td>
                                <td class="border-right-dark">GL2034</td>
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
                                  <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> View Details</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Download Invoice</a>
                                      </div>
                                  </div>
                              </td>
                            </tr>
                            <tr>
                                <td class="border-right-dark">#001</td>
                                <td class="border-right-dark">GL2034</td>
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
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                          <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> View Details</a>
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
        </div>
      </div>

      <?php include 'includes/agent_footer.php'; ?>
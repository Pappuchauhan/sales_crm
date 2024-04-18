<?php
session_start();
require_once './config/config.php';
require_once 'includes/agent_header.php';
$edit = false;


$db = getDbInstance();
$db->where('type', 'Cumulative');
$cumulative_service = $db->get("services");

$db = getDbInstance();
$db->where('type', 'Per Person');
$per_person_service = $db->get("services");

$db = getDbInstance();
$db->where('type', 'Per Service');
$per_services = $db->get("services");

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="layout-page">
  <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="front-body-content">
        <div class="block">
          <div class="left-part">
            <div class="card">
              <h1>Quick Booking</h1>

              <div class="row mb-3">
                <div class="col-md">
                  <label class="form-label">Guest Name</label>
                  <input type="text" class="form-control" placeholder="">
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md">
                  <label class="form-label">Select Duration</label>
                  <div class="input-group">
                    <label class="input-group-text">Options</label>
                    <select class="form-select" name="duration" id="duration">
                      <option>Choose...</option>
                      <option value="2 Days 1 Nights" <?php echo ($edit &&  $data['duration'] == "2 Days 1 Nights") ? 'selected' : '' ?>>2 Days 1 Nights</option>
                      <option value="3 Days 2 Nights" <?php echo ($edit &&  $data['duration'] == "3 Days 2 Nights") ? 'selected' : '' ?>>3 Days 2 Nights</option>
                      <option value="4 Days 3 Nights" <?php echo ($edit &&  $data['duration'] == "4 Days 3 Nights") ? 'selected' : '' ?>>4 Days 3 Nights</option>
                      <option value="5 Days 4 Nights" <?php echo ($edit &&  $data['duration'] == "5 Days 4 Nights") ? 'selected' : '' ?>>5 Days 4 Nights</option>
                      <option value="6 Days 5 Nights" <?php echo ($edit &&  $data['duration'] == "6 Days 5 Nights") ? 'selected' : '' ?>>6 Days 5 Nights</option>
                      <option value="7 Days 6 Nights" <?php echo ($edit &&  $data['duration'] == "7 Days 6 Nights") ? 'selected' : '' ?>>7 Days 6 Nights</option>
                      <option value="8 Days 7 Nights" <?php echo ($edit &&  $data['duration'] == "8 Days 7 Nights") ? 'selected' : '' ?>>8 Days 7 Nights</option>
                    </select>
                  </div>
                </div>
                <div class="col-md">
                  <label class="form-label">Select Date</label>
                  <input class="form-control" type="date" name="tour_start_date" onChange="return itinerary_list()" value="2024-04-18">
                </div>
              </div>


              <h3 class="mt-3 mb-3">Select Package</h3>
              <div class="row mb-3">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead class="table-dark">
                      <tr>
                        <th class="text-white px-2" style="max-width: 84px">Select Package</th>
                        <th class="text-white px-2" style="max-width: 84px">Package Code</th>
                        <th class="text-white px-2">Package Name</th>
                        <th class="text-white px-2">Duration</th>
                        <th class="text-white px-2">Hotel Category</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="package_list">

                    </tbody>
                  </table>
                </div>
              </div>
              <input type="hidden" name="package_id">
              <input type="hidden" name="category">

              <div class="row mb-3" id="package-other-details">

              </div>


              <div class="row mb-3">
                <h3 class="mt-3 mb-3">Extra Services</h3>
                <div class="col-md-3">
                  <div class="form-check mt-b">
                    <input class="form-check-input" checked type="checkbox" value="" id="permit">
                    <label class="form-check-label" for="permit">Permit </label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check mt-b">
                    <input class="form-check-input" checked type="checkbox" value="" id="guide">
                    <label class="form-check-label" for="guide">Guide </label>
                  </div>
                </div>
              </div>

              <?php foreach ($cumulative_service as $cumulative) : ?>
                <div class="row mb-3 align-items-top">
                  <div class="col-md-3">
                    <div class="form-check mt-b">
                      <input class="form-check-input" onClick="return calculateTotal()" type="checkbox" name="cumulative[]" amount-cumulative="<?= $cumulative['amount'] ?>" id="cumulative_<?= $cumulative['id'] ?>">
                      <label class="form-check-label" for="lunch"><?= $cumulative['name'] ?> </label>
                    </div>
                  </div>
                  <div class="col-md-9" id="cumulative-<?= str_replace(" ", "_", $cumulative['name']) ?>">
                    <div class="row" id="dateInputRow">

                      <div class="col-md">
                        <input type="text" class="form-control phone-mask" onChange="return calculateTotal();" placeholder="No. of Person">
                      </div>
                      <div class="col-md text-end">
                        <input class="form-control" type="date" value="<?= date("Y-m-d") ?>">
                        <small><a href="#" class="addMoreDate cumulative" data-id="cumulative-<?= str_replace(" ", "_", $cumulative['name']) ?>">Add More Date</a></small>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>

              <?php foreach ($per_person_service as $per_person) : ?>
                <div class="row mb-3 align-items-top">
                  <div class="col-md-3">
                    <div class="form-check mt-b">
                      <input class="form-check-input" onClick="return calculateTotal()" type="checkbox" name="per_person[]" amount-per-person="<?= $per_person['amount'] ?>" id="per_person_<?= $per_person['id'] ?>">

                      <label class="form-check-label" for="lunch"><?= $per_person['name'] ?> </label>
                    </div>
                  </div>
                  <div class="col-md-9" id="per-person-<?= str_replace(" ", "_", $per_person['name']) ?>">
                    <div class="row" id="dateInputRow">
                      <div class="col-md">
                        <input type="text" class="form-control phone-mask" onChange="return calculateTotal();" placeholder="No. of Person">
                      </div>
                      <div class="col-md text-end">
                        <input class="form-control" type="date" value="<?= date("Y-m-d") ?>">
                        <small><a href="#" class="addMoreDate per-person" data-id="per-person-<?= str_replace(" ", "_", $per_person['name']) ?>">Add More Date</a></small>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>

              <?php foreach ($per_services as $per_service) : ?>
                <div class="row mb-3 align-items-top">
                  <div class="col-md-3">
                    <div class="form-check mt-b">
                      <input class="form-check-input" onClick="return calculateTotal()" type="checkbox" name="per_service[]" amount-per-service="<?= $per_service['amount'] ?>" id="per_service_<?= $per_service['id'] ?>">
                      <label class="form-check-label" for="lunch"><?= $per_service['name'] ?> </label>
                    </div>
                  </div>
                  <div class="col-md-9" id="per-service-<?= str_replace(" ", "_", $per_service['name']) ?>">
                    <div class="row" id="dateInputRow">

                      <div class="col-md">
                        <input type="text" class="form-control phone-mask" onChange="return calculateTotal();" placeholder="No. of Person">
                      </div>
                      <div class="col-md text-end">
                        <input class="form-control" type="date" value="<?= date("Y-m-d") ?>">
                        <small><a href="#" class="addMoreDate per-service" data-id="per-service-<?= str_replace(" ", "_", $per_service['name']) ?>">Add More Date</a></small>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
              <div class="row mb-3 align-items-top">
                <div class="col-md-3">
                  <div class="form-check mt-b">
                    <input class="form-check-input" type="checkbox" value="" id="bottles">
                    <label class="form-check-label" for="bottles">Water Bottles </label>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md">
                      <input type="text" class="form-control phone-mask" placeholder="No. of Water Bottle">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-3 align-items-top">
                <div class="col-md-3">
                  <div class="form-check mt-b">
                    <input class="form-check-input" type="checkbox" value="" id="bike">
                    <label class="form-check-label" for="bike">Bike </label>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="row">

                    <div class="col-md">
                      <input type="text" class="form-control phone-mask" placeholder="No. of Day">
                    </div>

                  </div>
                </div>
              </div>
              <h3 class="mt-3 mb-3">Enter Bike Details</h3>
              <div class="row mb-3">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td>Twin Bike</td>
                        <td><input type="text" class="form-control phone-mask" placeholder="No. of Single rider bike"></td>
                        <td><input type="text" class="form-control phone-mask" placeholder="No. of Double rider bike"></td>

                      </tr>
                      <tr>
                        <td>Twin Bike</td>
                        <td><input type="text" class="form-control phone-mask" placeholder="No. of Single rider bike"></td>
                        <td><input type="text" class="form-control phone-mask" placeholder="No. of Double rider bike"></td>

                      </tr>
                      <tr>
                        <td>Twin Bike</td>
                        <td><input type="text" class="form-control phone-mask" placeholder="No. of Single rider bike"></td>
                        <td><input type="text" class="form-control phone-mask" placeholder="No. of Double rider bike"></td>

                      </tr>
                      <tr>
                        <td>Mechanic</td>
                        <td colspan="2">
                          <select class="form-select">
                            <option>No</option>
                            <option>Yes</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Marshal with Bike</td>
                        <td colspan="2">
                          <select class="form-select">
                            <option>No</option>
                            <option>Yes</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Fuel</td>
                        <td colspan="2">
                          <select class="form-select">
                            <option>No</option>
                            <option>Yes</option>
                          </select>
                        </td>

                      </tr>
                      <tr>
                        <td>Backup</td>
                        <td colspan="2">
                          <select class="form-select">
                            <option>No</option>
                            <option>Yes</option>
                          </select>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <h3 class="mt-3 mb-3">Itinerary</h3>
              <div class="row mb-3">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead class="table-dark">
                      <tr>
                        <th class="text-white">Day</th>
                        <th class="text-white">Date</th>
                        <th class="text-white">Day</th>
                        <th class="text-white">Plan #001</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="itinerary-list">

                    </tbody>
                  </table>
                </div>
              </div>
              <?php $transportations = setTransportation(); ?>
              <h3 class="mt-3 mb-3">Select Transportation</h3>
              <div class="row mb-3">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead class="table-dark">
                      <tr>
                        <th class="text-white">Select Transport</th>
                        <th class="text-white">Number of Pax</th>
                        <th class="text-white">Remarks</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr class="transport-row">
                        <td>
                          <select class="form-select transportation-select" onChange="return calculateTotal();">
                            <option>Select Transport</option>
                            <?php foreach ($transportations as $name => $val) : ?>
                              <option value="<?php echo $name; ?>" data-trans="<?php echo $val; ?>"><?php echo $name; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </td>
                        <td>
                          <select class="form-select num-persons-select">
                            <option>Select Person</option>
                          </select>
                        </td>
                        <td>Maximum <span class="max-persons"></span> Persons</td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align:right;"><a href="#" id="addMoreTransport">Add More</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <h3 class="mt-3 mb-3">Hotel Details</h3>
              <div class="row mb-3">
                <div class="table-responsive text-nowrap">
                  <table class="table table-bordered">
                    <thead class="table-dark">
                      <tr>
                        <th class="text-white px-2" style="max-width: 84px">Day</th>
                        <th class="text-white px-2" style="max-width: 84px">Hotel Name</th>
                        <th class="text-white px-2">Check in Date</th>
                        <th class="text-white px-2">Check out Date</th>
                        <th class="text-white px-2">Night</th>
                        <th class="text-white px-2">Location</th>
                        <th class="text-white px-2">Manager Cont.</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="hotel-list">

                    </tbody>
                  </table>
                </div>
              </div>

              <h3 class="mt-3 mb-3">Inclusions and Exclusions</h3>
              <div class="row mb-3">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead class="table-dark">
                      <tr>
                        <th class="text-white">Inclusions</th>
                        <th class="text-white">Exclusions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td>Permit</td>
                        <td>Bike</td>
                      </tr>
                      <tr>
                        <td>Guide</td>
                        <td>Lunch</td>
                      </tr>
                      <tr>
                        <td>Bonfire</td>
                        <td>Water Bottles</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <h3 class="mt-3 mb-3">Transport</h3>
              <div class="row mb-3">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead class="table-dark">
                      <tr>
                        <th class="text-white">Category</th>
                        <th class="text-white">No. of Vehicle</th>
                        <th class="text-white">Driver Name</th>
                        <th class="text-white">Mobile No.</th>
                        <th class="text-white">Region</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td style="min-width: 82px">Innova</td>
                        <td style="min-width: 130px">2</td>
                        <td>Kumer</td>
                        <td>9999999999</td>
                        <td>Leh</td>
                      </tr>
                      <tr>
                        <td style="min-width: 82px">Innova</td>
                        <td style="min-width: 130px">2</td>
                        <td>Kumer</td>
                        <td>9999999999</td>
                        <td>Leh</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <h3 class="mt-3 mb-3">Emergency Contact Details</h3>
              <div class="row mb-3">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead class="table-dark">
                      <tr>
                        <th class="text-white">Hotel Operation</th>
                        <th class="text-white">Transport</th>
                        <th class="text-white">Airport Manager</th>
                        <th class="text-white">Support Team</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td>9999999999</td>
                        <td>9999999999</td>
                        <td>9999999999</td>
                        <td>9999999999</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <h3 class="mt-3 mb-3">Final Quotation</h3>
              <div class="row mb-3">
                <div class="table-responsive">
                  <table class="table table-bordered" id="final_quotation">
                    <thead class="table-dark">
                      <tr>
                        <th colspan="4" class="text-white">Your query 01133 Details Quotation in INR</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td class="dark-col"><strong>Plan</strong></td>
                        <td class="dark-col"><strong>Amount</strong></td>
                        <td class="dark-col"><strong>Pax</strong></td>
                        <td class="dark-col"><strong>Total amount</strong></td>
                      </tr>


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="right-part">
            <div class="booking-summary">
              <div class="card">
                <div class="head">
                  <h3>Booking Summary</h3>
                </div>
                <div class="summary-detail">
                  <div class="row mb-3">
                    <div class="col-md text-bold"><strong>Duration:</strong></div>
                    <div class="col-md">6 Days 5 Nights</div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md"><strong>Travel Date:</strong></div>
                    <div class="col-md">6 October 2024</div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md"><strong>Total No. of Pax:</strong></div>
                    <div class="col-md">15</div>
                  </div>
                  <div class="row">
                    <div class="col-md"><strong>Calculated Price:</strong></div>
                    <div class="col-md"><strong>₹23500</strong></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row get-quote-btn">
              <button type="submit" class="btn btn-primary">Generate Quote</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<script>
  $(document).ready(function() {
    $('#duration').change(function() {
      var duration = $('#duration').val();
      $.ajax({
        url: 'ajax/package_list.php',
        type: 'POST',
        data: {
          duration: duration
        },
        success: function(data) {
          $('#package_list').html(data);
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
        }
      });
    });
  });

  function setPackageId(package_id) {
    $('input[name="package_id"]').val(package_id)
    setTimeout(function() {
      itinerary_list();
    }, 10);

  }

  function setCategory(category, package_id) {
    if ($('input[name="package_id"]').val() == package_id) {
      $('input[name="category"]').val(category)
      setTimeout(function() {
        hotel_list();
      }, 10);
    } else {
      alert("Please select package name")
    }
  }

  function itinerary_list() {
    let tour_date = $('input[name="tour_start_date"]').val()
    let package_id = $('input[name="package_id"]').val()


    $.ajax({
      url: 'ajax/itinerary_list.php',
      type: 'POST',
      data: {
        package_id: package_id,
        tour_date: tour_date
      },
      success: function(data) {
        $('#itinerary-list').html(data);
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
      }
    });
  }

  function package_other_details(package_id, category) {
    $.ajax({
      url: 'ajax/package_other_details.php',
      type: 'POST',
      data: {
        package_id: package_id,
        category: category
      },
      success: function(data) {
        $('#package-other-details').html(data);
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
        $('#package-other-details').html(error);
      }
    });
  }

  function hotel_list() {
    let tour_date = $('input[name="tour_start_date"]').val()
    let package_id = $('input[name="package_id"]').val()
    let category = $('input[name="category"]').val()

    package_other_details(package_id, category)
    $.ajax({
      url: 'ajax/hotel_list.php',
      type: 'POST',
      data: {
        package_id: package_id,
        tour_date: tour_date,
        category: category
      },
      success: function(data) {
        $('#hotel-list').html(data);
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
      }
    });
  }


  function handleIncrement() {
    const input = this.parentElement.querySelector('.quantity');
    input.value = parseInt(input.value) + 1;

    calculateTotal();
  }

  function handleDecrement() {
    const input = this.parentElement.querySelector('.quantity');
    if (parseInt(input.value) > 0) {
      input.value = parseInt(input.value) - 1;

      calculateTotal();
    }
  }

  document.addEventListener('click', function(event) {
    if (event.target.classList.contains('increment')) {
      handleIncrement.call(event.target);
    }
  });


  document.addEventListener('click', function(event) {
    if (event.target.classList.contains('decrement')) {
      handleDecrement.call(event.target);

    }
  });

  document.addEventListener('DOMContentLoaded', function() {

    //cumulative
    const addMoreDateButtons = document.querySelectorAll('.cumulative');
    addMoreDateButtons.forEach(function(button) {
      button.addEventListener('click', function(event) {
        event.preventDefault();
        const dateInputsContainer = document.getElementById(this.getAttribute("data-id"));

        const newRow = document.createElement('div');
        newRow.classList.add('row');

        newRow.innerHTML = ` 
                <div class="col-md">
                    <input type="text" class="form-control phone-mask" onChange="return calculateTotal();" placeholder="No. of Person">
                </div>
                <div class="col-md text-end">
                    <input class="form-control" type="date" value="2021-06-18">
                    <small><a href="#" class="removeDate">Remove</a></small>
                </div>
            `;

        dateInputsContainer.append(newRow);
      });
    });
    //per-person
    const addMorePerPerson = document.querySelectorAll('.per-person');
    addMorePerPerson.forEach(function(button) {
      button.addEventListener('click', function(event) {
        event.preventDefault();
        const dateInputsContainer = document.getElementById(this.getAttribute("data-id"));

        const newRow = document.createElement('div');
        newRow.classList.add('row');

        newRow.innerHTML = ` 
                <div class="col-md">
                    <input type="text" class="form-control phone-mask" onChange="return calculateTotal();" placeholder="No. of Person">
                </div>
                <div class="col-md text-end">
                    <input class="form-control" type="date" value="2021-06-18">
                    <small><a href="#" class="removeDate">Remove</a></small>
                </div>
            `;

        dateInputsContainer.append(newRow);
      });
    });
    //per-service
    const addMorePerService = document.querySelectorAll('.per-service');
    addMorePerService.forEach(function(button) {
      button.addEventListener('click', function(event) {
        event.preventDefault();
        const dateInputsContainer = document.getElementById(this.getAttribute("data-id"));

        const newRow = document.createElement('div');
        newRow.classList.add('row');

        newRow.innerHTML = ` 
                <div class="col-md">
                    <input type="number" class="form-control phone-mask" onChange="return calculateTotal();" placeholder="No. of Service">
                </div>
                <div class="col-md text-end">
                    <input class="form-control" type="date" value="2021-06-18">
                    <small><a href="#" class="removeDate">Remove</a></small>
                </div>
            `;

        dateInputsContainer.append(newRow);
      });
    });

    // Remove for all the three
    document.addEventListener('click', function(event) {
      if (event.target.classList.contains('removeDate')) {
        event.preventDefault();
        event.target.closest('.row').remove();
      }
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    // Function to update maximum number of persons
    function updateMaxPersons() {
      const selectedTransport = $(this).find('option:selected').data('trans');
      $(this).closest('.transport-row').find('.max-persons').text(selectedTransport);
      $(this).closest('.transport-row').find('.num-persons-select').empty();
      for (let i = 1; i <= selectedTransport; i++) {
        $(this).closest('.transport-row').find('.num-persons-select').append(`<option value="${i}">${i}</option>`);
      }
    }

    // Initial setup for first row
    $('.transportation-select').each(updateMaxPersons);

    // Add more transportation option
    $('#addMoreTransport').click(function(e) {
      e.preventDefault();
      const newRow = $('.transport-row:first').clone();
      newRow.find('.transportation-select').val('Select Transport');
      newRow.find('.num-persons-select').val('Select Person');
      newRow.find('.max-persons').empty();
      newRow.insertAfter('.transport-row:last');
      newRow.find('.transportation-select').each(updateMaxPersons);
    });

    // Event delegation for dynamically added elements
    $('.table').on('change', '.transportation-select', updateMaxPersons);
  });

  function calculateTotal() {
    const packageDetails = document.querySelectorAll('#package-other-details .col-md');
    const targetTableBody = document.querySelector('#final_quotation tbody');

    let totalAmount = 0;

    const existingRows = targetTableBody.querySelectorAll('tr:not(:first-child)');
    existingRows.forEach(row => row.remove());

    packageDetails.forEach(detail => {
      const label = detail.querySelector('.form-label').textContent;
      const price = parseFloat(detail.querySelector('input').dataset.amount);
      const quantity = parseInt(detail.querySelector('input').value);
      const total = price * quantity;
      if (quantity > 0) {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
                <td>${label}</td>
                <td>${price}</td>
                <td>${quantity}</td>
                <td>${total}</td>
            `;
        targetTableBody.appendChild(newRow);
        totalAmount += total; // Accumulate total amount
      }
    });
    //cumulative
    const cumulatives = document.querySelectorAll('input[name="cumulative[]"]:checked');
    cumulatives.forEach(checkbox => {
      const label = checkbox.parentElement.querySelector('.form-check-label').textContent;
      const amount = parseFloat(checkbox.getAttribute('amount-cumulative'));
      let quantity = 0;
      const inputs = checkbox.closest('.row').querySelectorAll('input[type="text"]');
      inputs.forEach(input => {
        quantity = quantity + parseInt(input.value);
      });
      const total = amount * quantity;
      totalAmount = totalAmount + total;
      const targetTableBody = document.querySelector('#final_quotation tbody');
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
            <td>${label}</td>
            <td>${amount}</td>
            <td>${quantity}</td>
            <td>${total}</td>
        `;
      targetTableBody.appendChild(newRow);
    });

    //per_person
    const per_person = document.querySelectorAll('input[name="per_person[]"]:checked');
    per_person.forEach(checkbox => {
      const label = checkbox.parentElement.querySelector('.form-check-label').textContent;
      const amount = parseFloat(checkbox.getAttribute('amount-per-person'));
      let quantity = 0;
      const inputs = checkbox.closest('.row').querySelectorAll('input[type="text"]');
      inputs.forEach(input => {
        quantity = quantity + parseInt(input.value);
      });
      const total = amount * quantity;
      totalAmount = totalAmount + total;
      const targetTableBody = document.querySelector('#final_quotation tbody');
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
            <td>${label}</td>
            <td>${amount}</td>
            <td>${quantity}</td>
            <td>${total}</td>
        `;
      targetTableBody.appendChild(newRow);
    });

    //per_service
    const per_service = document.querySelectorAll('input[name="per_service[]"]:checked');
    per_service.forEach(checkbox => {
      const label = checkbox.parentElement.querySelector('.form-check-label').textContent;
      const amount = parseFloat(checkbox.getAttribute('amount-per-service'));
      let quantity = 0;
      const inputs = checkbox.closest('.row').querySelectorAll('input[type="text"]');
      inputs.forEach(input => {
        quantity = quantity + parseInt(input.value);
      });
      const total = amount * quantity;
      totalAmount = totalAmount + total;
      const targetTableBody = document.querySelector('#final_quotation tbody');
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
            <td>${label}</td>
            <td>${amount}</td>
            <td>${quantity}</td>
            <td>${total}</td>
        `;
      targetTableBody.appendChild(newRow);
    });

    //Transportation 
    const transportationSelects = document.querySelectorAll('.transportation-select');
    transportationSelects.forEach(select => {
      const detailId = 'detail_' + select.value.replace(' / ', '_');
      console.log(detailId)
      if (document.getElementById(detailId)) {
        const label = select.value;

        const amount = parseFloat(document.getElementById(detailId).value);
        const quantity = 1; // Quantity is always 1
        const total = amount * quantity;
        totalAmount = totalAmount + total;
        // Append to the table
        const targetTableBody = document.querySelector('#final_quotation tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${label}</td>
            <td>${amount}</td>
            <td>${quantity}</td>
            <td>${total}</td>
        `;
        targetTableBody.appendChild(newRow);
      }
    });


    const hotelList = document.getElementById('hotel-list');
    hotelList.querySelectorAll('tr').forEach(row => {

      const nightInput = row.querySelector('input[name="hotel_night[]"]');
      const amountInput = row.querySelector('input[name="hotel_amount[]"]');
      const nameInput = row.querySelector('input[name="hotel_name[]"]');

      const night = nightInput.value;
      const amount = amountInput.value;
      const name = nameInput.value;
      const total = amount * night;
      totalAmount = totalAmount + total;
      const targetTableBody = document.querySelector('#final_quotation tbody');
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
            <td>${name}</td>
            <td>${amount}</td>
            <td>${night}</td>
            <td>${total}</td>
        `;
      targetTableBody.appendChild(newRow);
    });

    // Add total rows
    const totalRows = `
        <tr>
            <td></td>
            <td colspan="2">Total amount</td>
            <td>${totalAmount}</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">IGST 2.5%</td>
            <td>${totalAmount * 0.025}</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">SGST 2.5%</td>
            <td>${totalAmount * 0.025}</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">Saleable Price</td>
            <td>${totalAmount}</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" class="dark-col"><strong>Saleable Price</strong></td>
            <td>${totalAmount * 1.05}</td>
        </tr>
    `;

    targetTableBody.insertAdjacentHTML('beforeend', totalRows);
  }



  //calculateTotal();
  /*
document.addEventListener('input', function(event) { 
    if (event.target.classList.contains('quantity')) {
        calculateTotal(); 
    }
});
*/
</script>
<?php include  'includes/agent_footer.php'; ?>
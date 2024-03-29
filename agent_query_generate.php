<?php

require_once 'includes/agent_header.php';
$edit = false;
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
                            <label class="form-label">Select Duration</label>
                            <div class="input-group">
                              <label class="input-group-text">Options</label>
                              <select class="form-select" name="duration" id="duration">
                              <option >Choose...</option>
                              <option value="2 Days 1 Nights" <?php echo ($edit &&  $data['duration']=="2 Days 1 Nights") ? 'selected' : '' ?>>2 Days 1 Nights</option>
                              <option value="3 Days 2 Nights" <?php echo ($edit &&  $data['duration']=="3 Days 2 Nights") ? 'selected' : '' ?>>3 Days 2 Nights</option>
                              <option value="4 Days 3 Nights" <?php echo ($edit &&  $data['duration']=="4 Days 3 Nights") ? 'selected' : '' ?>>4 Days 3 Nights</option>
                              <option value="5 Days 4 Nights" <?php echo ($edit &&  $data['duration']=="5 Days 4 Nights") ? 'selected' : '' ?>>5 Days 4 Nights</option>
                              <option value="6 Days 5 Nights" <?php echo ($edit &&  $data['duration']=="6 Days 5 Nights") ? 'selected' : '' ?>>6 Days 5 Nights</option>
                              <option value="7 Days 6 Nights" <?php echo ($edit &&  $data['duration']=="7 Days 6 Nights") ? 'selected' : '' ?>>7 Days 6 Nights</option>
                              <option value="8 Days 7 Nights" <?php echo ($edit &&  $data['duration']=="8 Days 7 Nights") ? 'selected' : '' ?>>8 Days 7 Nights</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md">
                            <label class="form-label">Select Date</label>
                            <input class="form-control" type="date" value="2021-06-18">
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
                                <tr>
                                  <td>
                                    <select class="form-select">
                                      <option>Select Transport</option>
                                      <option value="1">Tempo Traveller</option>
                                      <option value="2">Innova</option>
                                      <option value="3">Eco</option>
                                    </select>
                                  </td>
                                  <td>
                                    <select class="form-select">
                                      <option>Select Person</option>
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
                                      <option value="3">11</option>
                                      <option value="3">12</option>
                                    </select>
                                  </td>
                                  <td>Maximum 12 Persons</td>
                                </tr>
                                <tr>
                                  <td colspan="3" style="text-align:right;"><a href="#">Add More</a></td>
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
                                  <th class="text-white px-2">Meal Plan</th>
                                  <th class="text-white px-2">Status</th>
                                  <th class="text-white px-2">Location</th>
                                  <th class="text-white px-2">Google Map</th>
                                  <th class="text-white px-2">Manager Cont.</th>
                                </tr>
                              </thead>
                              <tbody class="table-border-bottom-0">
                                <tr>
                                  <td>1</td>
                                  <td>Hotel Radison</td>
                                  <td>04-05-2024</td>
                                  <td>06-05-2024</td>
                                  <td>2</td>
                                  <td>MAP</td>
                                  <td>Waiting</td>
                                  <td>Leh</td>
                                  <td><a href="#">Location</a></td>
                                  <td>9999999999</td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td>Hotel Radison</td>
                                  <td>04-05-2024</td>
                                  <td>06-05-2024</td>
                                  <td>2</td>
                                  <td>MAP</td>
                                  <td>Waiting</td>
                                  <td>Leh</td>
                                  <td><a href="#">Location</a></td>
                                  <td>9999999999</td>
                                </tr>
                                <tr>
                                  <td>3</td>
                                  <td>Hotel Radison</td>
                                  <td>04-05-2024</td>
                                  <td>06-05-2024</td>
                                  <td>2</td>
                                  <td>MAP</td>
                                  <td>Waiting</td>
                                  <td>Leh</td>
                                  <td><a href="#">Location</a></td>
                                  <td>9999999999</td>
                                </tr>
                                <tr>
                                  <td>4</td>
                                  <td>Hotel Radison</td>
                                  <td>04-05-2024</td>
                                  <td>06-05-2024</td>
                                  <td>2</td>
                                  <td>MAP</td>
                                  <td>Waiting</td>
                                  <td>Leh</td>
                                  <td><a href="#">Location</a></td>
                                  <td>9999999999</td>
                                </tr>
                                <tr>
                                  <td>5</td>
                                  <td>Hotel Radison</td>
                                  <td>04-05-2024</td>
                                  <td>06-05-2024</td>
                                  <td>2</td>
                                  <td>MAP</td>
                                  <td>Waiting</td>
                                  <td>Leh</td>
                                  <td><a href="#">Location</a></td>
                                  <td>9999999999</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md">
                            <label class="form-label">Guest Name</label>
                            <input type="text" class="form-control" placeholder="">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md">
                            <label class="form-label">Twin</label>
                            <small class="text-muted float-end set-padding-top">2 Pax</small>
                            <div class="input-group">
                              <button class="btn btn-outline-primary border-lighter add-custom-padding" type="button">-</button>
                              <input type="text" class="form-control text-center" placeholder="" value="1">
                              <button class="btn btn-outline-primary border-lighter add-custom-padding" type="button">+</button>
                            </div>
                          </div>
                          <div class="col-md">
                            <label class="form-label">Triple</label>
                            <small class="text-muted float-end set-padding-top">3 Pax</small>
                            <div class="input-group">
                              <button class="btn btn-outline-primary border-lighter add-custom-padding" type="button">-</button>
                              <input type="text" class="form-control text-center" placeholder="" value="1">
                              <button class="btn btn-outline-primary border-lighter add-custom-padding" type="button">+</button>
                            </div>
                          </div>
                          <div class="col-md">
                            <label class="form-label">Child No Bed</label>
                            <small class="text-muted float-end set-padding-top">1 Pax</small>
                            <div class="input-group">
                              <button class="btn btn-outline-primary border-lighter add-custom-padding" type="button">-</button>
                              <input type="text" class="form-control text-center" placeholder="" value="1">
                              <button class="btn btn-outline-primary border-lighter add-custom-padding" type="button">+</button>
                            </div>
                          </div>
                          <div class="col-md">
                            <label class="form-label">Single</label>
                            <small class="text-muted float-end set-padding-top">1 Pax</small>
                            <div class="input-group">
                              <button class="btn btn-outline-primary border-lighter add-custom-padding" type="button">-</button>
                              <input type="text" class="form-control text-center" placeholder="" value="1">
                              <button class="btn btn-outline-primary border-lighter add-custom-padding" type="button">+</button>
                            </div>
                          </div>
                          <div class="col-md">
                            <label class="form-label">Infant</label>
                            <small class="text-muted float-end set-padding-top">1 Pax</small>
                            <div class="input-group">
                              <button class="btn btn-outline-primary border-lighter add-custom-padding" type="button">-</button>
                              <input type="text" class="form-control text-center" placeholder="" value="1">
                              <button class="btn btn-outline-primary border-lighter add-custom-padding" type="button">+</button>
                            </div>
                          </div>
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
                            <div class="col-md-3">
                              <div class="form-check mt-b">
                                <input class="form-check-input" checked type="checkbox" value="" id="monument">
                                <label class="form-check-label" for="monument">Monument </label>
                              </div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-top">
                          <div class="col-md-3">
                            <div class="form-check mt-b">
                              <input class="form-check-input" type="checkbox" value="" id="lunch">
                              <label class="form-check-label" for="lunch">Lunch </label>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="row">
                              <div class="col-md">
                                <input type="text" class="form-control phone-mask" placeholder="No. of Days">
                              </div>
                              <div class="col-md">
                                <input type="text" class="form-control phone-mask" placeholder="No. of Person">
                              </div>
                              <div class="col-md text-end">
                                <input class="form-control" type="date" value="2021-06-18">
                                <small><a href="#">Add More Date</a></small>
                              </div>
                            </div>
                          </div>
                        </div>
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
                                <input type="text" class="form-control phone-mask" placeholder="No. of Bike">
                              </div>
                              <div class="col-md">
                                <input type="text" class="form-control phone-mask" placeholder="No. of Day">
                              </div>
                              <div class="col-md">
                                <input type="text" class="form-control phone-mask" placeholder="Remarks">
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
                                  <td>Bike</td>
                                  <td>
                                    <select class="form-select">
                                      <option>Select Number of Day</option>
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
                                      <option value="3">11</option>
                                      <option value="3">12</option>
                                    </select>
                                  </td>
                                  <td>
                                    <select class="form-select">
                                      <option>Select Riding Plan</option>
                                      <option value="1">Single</option>
                                      <option value="2">Double</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Mechanic</td>
                                  <td colspan="2">
                                    <select class="form-select">
                                      <option>Select Number of Day</option>
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
                                      <option value="3">11</option>
                                      <option value="3">12</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Marshal with Bike</td>
                                  <td colspan="2">
                                    <select class="form-select">
                                      <option>Number of Day</option>
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
                                      <option value="3">11</option>
                                      <option value="3">12</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Fuel</td>
                                  <td>
                                    <select class="form-select">
                                      <option>Number of Day</option>
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
                                      <option value="3">11</option>
                                      <option value="3">12</option>
                                    </select>
                                  </td>
                                  <td>
                                    <select class="form-select">
                                      <option>Select Riding Plan</option>
                                      <option value="1">Single</option>
                                      <option value="2">Double</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Backup</td>
                                  <td colspan="2">
                                    <select class="form-select">
                                      <option>Number of Day</option>
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
                                      <option value="3">11</option>
                                      <option value="3">12</option>
                                    </select>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="row mb-3 align-items-top">
                          <div class="col-md-3">
                            <div class="form-check mt-b">
                              <input class="form-check-input" type="checkbox" value="" id="bonfire">
                              <label class="form-check-label" for="bonfire">Bonfire </label>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="row">
                              <div class="col-md">
                                <input class="form-control" type="date" value="2021-06-18">
                                <small><a href="#">Add More Date</a></small>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3 align-items-top">
                          <div class="col-md-3">
                            <div class="form-check mt-b">
                              <input class="form-check-input" type="checkbox" value="" id="marshal">
                              <label class="form-check-label" for="marshal">Marshal </label>
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
                        <div class="row mb-3 align-items-top">
                          <div class="col-md-3">
                            <div class="form-check mt-b">
                              <input class="form-check-input" type="checkbox" value="" id="cultural">
                              <label class="form-check-label" for="cultural">Cultural Show </label>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="row">
                              <div class="col-md">
                                <input class="form-control" type="date" value="2021-06-18">
                                <small><a href="#">Add More Date</a></small>
                              </div>
                            </div>
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
                                  <td >Bike</td>
                                </tr>
                                <tr>
                                  <td>Guide</td>
                                  <td >Lunch</td>
                                </tr>
                                <tr>
                                  <td>Bonfire</td>
                                  <td >Water Bottles</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <h3 class="mt-3 mb-3">Itineary</h3>
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
                              <tbody class="table-border-bottom-0">
                                <tr>
                                  <td style="min-width: 82px">Day 1</td>
                                  <td style="min-width: 130px">30-08-2024</td>
                                  <td>Friday</td>
                                  <td>Arrive In Srinagar</td>
                                </tr>
                                <tr>
                                  <td>Day 2</td>
                                  <td>31-08-2024</td>
                                  <td>Saturday</td>
                                  <td>You might have a brilliant tour plan in mind, but is it realistic? When creating a tour from scratch it’s wise to understand your competition and whether your ideas are realistic. So while the possibilities are endless, building sustainable tour business needs to look at the competition in your area.</td>
                                </tr>
                                <tr>
                                  <td>Day 3</td>
                                  <td>01-09-2024</td>
                                  <td>Sunday</td>
                                  <td>You might have a brilliant tour plan in mind, but is it realistic? When creating a tour from scratch it’s wise to understand your competition and whether your ideas are realistic. So while the possibilities are endless, building sustainable tour business needs to look at the competition in your area.</td>
                                </tr>
                                <tr>
                                  <td>Day 4</td>
                                  <td>02-09-2024</td>
                                  <td>Monday</td>
                                  <td>You might have a brilliant tour plan in mind, but is it realistic? When creating a tour from scratch it’s wise to understand your competition and whether your ideas are realistic. So while the possibilities are endless, building sustainable tour business needs to look at the competition in your area.</td>
                                </tr>
                                <tr>
                                  <td>Day 5</td>
                                  <td>03-09-2024</td>
                                  <td>Tuesday</td>
                                  <td>You might have a brilliant tour plan in mind, but is it realistic? When creating a tour from scratch it’s wise to understand your competition and whether your ideas are realistic. So while the possibilities are endless, building sustainable tour business needs to look at the competition in your area.</td>
                                </tr>
                                <tr>
                                  <td>Day 6</td>
                                  <td>04-09-2024</td>
                                  <td>Wednesday</td>
                                  <td>Ladakh Airport Drop</td>
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
                                  <td >9999999999</td>
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
                            <table class="table table-bordered">
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
                                <tr>
                                  <td>Twin sharing basis</td>
                                  <td>20000</td>
                                  <td>20</td>
                                  <td>400000</td>
                                </tr>
                                <tr>
                                  <td>Triple</td>
                                  <td>20000</td>
                                  <td>20</td>
                                  <td>400000</td>
                                </tr>
                                <tr>
                                  <td>Extra bed</td>
                                  <td>20000</td>
                                  <td>20</td>
                                  <td>400000</td>
                                </tr>
                                <tr>
                                  <td>Single</td>
                                  <td>20000</td>
                                  <td>1</td>
                                  <td>400000</td>
                                </tr>
                                <tr>
                                  <td>Quiad</td>
                                  <td>20000</td>
                                  <td>20</td>
                                  <td>400000</td>
                                </tr>
                                <tr>
                                  <td>Extra Services</td>
                                  <td>Bike</td>
                                  <td>7 Days</td>
                                  <td>100000</td>
                                </tr>
                                <tr>
                                  <td>Extra Services</td>
                                  <td>Rafting</td>
                                  <td>7 Days</td>
                                  <td>100000</td>
                                </tr>
                                <tr>
                                  <td>Extra Services</td>
                                  <td>Course show</td>
                                  <td>7 Days</td>
                                  <td>100000</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td colspan="2">Total amount</td>
                                  <td>1560000</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td colspan="2">IGST 2.5%</td>
                                  <td>390000</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td colspan="2">SGST 2.5%</td>
                                  <td>390000</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td colspan="2">Total net amount payable</td>
                                  <td>93600000</td>
                                </tr>
                                <tr>
                                  <td><strong>Agent Commission</strong></td>
                                  <td colspan="2"><input type="text" class="form-control phone-mask" placeholder="In percentage"></td>
                                  <td>80000</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td colspan="2" class="dark-col"><strong>Saleable Price</strong></td>
                                  <td class="dark-col"><strong>4340000</strong></td>
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
                          <div class="head"><h3>Booking Summary</h3></div>
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
                    data: { duration: duration },
                    success: function(data) {
                        $('#package_list').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>

      <?php include  'includes/agent_footer.php'; ?> 
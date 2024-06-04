<?php
session_start();
require_once './config/config.php';
require_once 'includes/agent_header.php';
$edit = false;
$id = isset($_GET['ID']) && !empty($_GET['ID']) ? decryptId($_GET['ID']) : "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data_to_store = array_filter($_POST);
    $save_data = [];
    $save_data["name"] = $data_to_store['name'];
    $save_data["duration"] = $data_to_store['duration'];
    $save_data["tour_start_date"] = $data_to_store['tour_start_date'];
    $save_data["package_id"] = $data_to_store['package_id'];
    $save_data["category"] = $data_to_store['category'];
    $save_data["cumulative"] = json_encode($data_to_store['cumulative'] ?? []);
    $save_data["per_person"] = json_encode($data_to_store['per_person'] ?? []);
    $save_data["per_service"] = json_encode($data_to_store['per_service'] ?? []);

    $db = getDbInstance();
    $db->where('id', $id);
    $last_id = $db->update('agent_queries', $save_data);
}
if (!empty($id)) {
    $db = getDbInstance();
    $db->where('id', $id);
    $queries = $db->getOne("agent_queries");

    $db = getDbInstance();
    $db->where('id',  $queries['package_id']);
    $package = $db->getOne("packages");
}

$save_transport = json_decode($queries['transport'], true);

$db = getDbInstance();
$vehicles = $db->get("vehicles", null, 'driver_name, vehicle_number, mobile, vehicle_type');
$vehicleData = [];
foreach ($vehicles as $vehicle) {
    $vehicleData[$vehicle['vehicle_type']] = $vehicle;
}
$json_vehicle = json_encode($vehicleData);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div class="layout-page">
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="front-body-content">
                <form method="post" data-disable-inputs="true">
                    <div class="block">
                        <div class="left-part">
                            <div class="card">
                                <h1>Quick Booking</h1>

                                <div class="row mb-3">
                                    <div class="col-md">
                                        <label class="form-label">Guest Name</label>
                                        <input type="text" disabled name="name" class="form-control" placeholder="" value="<?php echo $queries['name'] ?? ''; ?>">
                                    </div>
                                    <div class="col-md">
                                        <label class="form-label">Select Duration</label>
                                        <div class="input-group">
                                            <label class="input-group-text">Options</label>
                                            <select class="form-select" disabled name="duration" id="duration">
                                                <option>Choose...</option>
                                                <option value="2 Days 1 Nights" <?php echo ($queries['duration'] ?? '') === "2 Days 1 Nights" ? 'selected' : ''; ?>>2 Days 1 Nights</option>
                                                <option value="3 Days 2 Nights" <?php echo ($queries['duration'] ?? '') === "3 Days 2 Nights" ? 'selected' : ''; ?>>3 Days 2 Nights</option>
                                                <option value="4 Days 3 Nights" <?php echo ($queries['duration'] ?? '') === "4 Days 3 Nights" ? 'selected' : ''; ?>>4 Days 3 Nights</option>
                                                <option value="5 Days 4 Nights" <?php echo ($queries['duration'] ?? '') === "5 Days 4 Nights" ? 'selected' : ''; ?>>5 Days 4 Nights</option>
                                                <option value="6 Days 5 Nights" <?php echo ($queries['duration'] ?? '') === "6 Days 5 Nights" ? 'selected' : ''; ?>>6 Days 5 Nights</option>
                                                <option value="7 Days 6 Nights" <?php echo ($queries['duration'] ?? '') === "7 Days 6 Nights" ? 'selected' : ''; ?>>7 Days 6 Nights</option>
                                                <option value="8 Days 7 Nights" <?php echo ($queries['duration'] ?? '') === "8 Days 7 Nights" ? 'selected' : ''; ?>>8 Days 7 Nights</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <label class="form-label">Select Date</label>
                                        <input class="form-control" disabled type="date" name="tour_start_date" onChange="return itinerary_list()" value="<?= $queries['tour_start_date'] ?>">
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
                                                <?php
                                                $default_categories = getCategories();
                                                $db = getDbInstance();
                                                $db->where('duration', $queries['duration']);
                                                $results = $db->get("packages");
                                                foreach ($results as $result) :
                                                    $selected =  ($result['id'] == $queries['package_id']) ? 'checked' : "";

                                                ?>

                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input name="package_name" disabled onClick="return setPackageId(<?= $result['id'] ?>)" class="form-check-input" type="radio" <?= $selected ?> value="<?= $result['id'] ?>" id="defaultRadio1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="fw-medium">#00<?= $result['id'] ?></span>
                                                        </td>
                                                        <td><?= $result['package_name'] ?></td>
                                                        <td><?= $result['duration'] ?></td>
                                                        <td>
                                                            <select disabled class="form-select" onchange="return setCategory(this.value, <?= $result['id'] ?>);">
                                                                <option>Choose Hotel Category</option>
                                                                <?php
                                                                foreach ($default_categories as $category) {
                                                                    $cat_selected = "";
                                                                    if (!empty($selected)) {
                                                                        $cat_selected = ($category == $queries['category']) ? "selected" : "";
                                                                    }

                                                                    echo " <option value=\"$category\" $cat_selected>$category</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <input type="hidden" name="package_id" value="<?php echo $save_data['package_id'] ?? ''; ?>">
                                <input type="hidden" name="category" value="<?php echo $save_data['category'] ?? ''; ?>">

                                <div class="row mb-3" id="package-other-details">
                                    <?php include("./ajax/package_other_details_edit.php") ?>
                                </div>

                                <?php $transportations = setTransportation(); ?>
                                <h3 class="mt-3 mb-3">Select Transportation</h3>
                                <div class="row mb-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="text-white">Select Transport</th>

                                                    <th class="text-white">Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php if ($save_transport["'name'"] < 1) { ?>
                                                    <tr class="transport-row">
                                                        <td>
                                                            <select disabled class="form-select transportation-select" onChange="return calculateTotal();">
                                                                <option>Select Transport</option>
                                                                <?php foreach ($transportations as $name => $val) : ?>
                                                                    <option value="<?php echo $name; ?>" data-trans="<?php echo $val; ?>"><?php echo $name; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                        <td>Maximum <span class="max-persons"></span> Persons</td>
                                                    </tr>

                                                <?php
                                                }
                                                foreach ($save_transport["'name'"] as $key => $sname) :
                                                ?>
                                                    <tr class="transport-row">
                                                        <td>
                                                            <select disabled class="form-select transportation-select" onChange="return calculateTotal();">
                                                                <option>Select Transport</option>
                                                                <?php foreach ($transportations as $name => $val) :
                                                                    $selected = $name == $sname ? "selected" : ""
                                                                ?>
                                                                    <option <?= $selected ?> value="<?php echo $name; ?>" data-trans="<?php echo $val; ?>"><?php echo $name; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>

                                                        <td>Maximum <span class="max-persons"></span> Persons</td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="3" style="text-align:right;"><a href="#" id="addMoreTransport">Add More</a></td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mb-3" id="fixed-service">
                                    <h3 class="mt-3 mb-3">Extra Services</h3>
                                    <div class="col-md-3">
                                        <div class="form-check mt-b">
                                            <input disabled class="form-check-input" <?php if ($queries['permit'] == 'on') {
                                                                                            echo "checked";
                                                                                        } ?> type="checkbox" onClick="return calculateTotal();" data-permit="<?= $package['permit'] ?>" name="permit" id="permit">
                                            <label class="form-check-label" for="permit">Permit </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check mt-b">
                                            <input disabled class="form-check-input" <?php if ($queries['guide'] == 'on') {
                                                                                            echo "checked";
                                                                                        } ?> type="checkbox" onClick="return calculateTotal();" data-guide="<?= $package['guide'] ?>" name="guide" id="guide">
                                            <label disabled class="form-check-label" for="guide">Guide </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="table-responsive" id="service-list">

                                        <?php
                                        $tour_date = $queries['tour_start_date'];
                                        preg_match('/\d+/', $queries['duration'], $matches);
                                        $days = $matches[0];
                                        $date_data = [];
                                        for ($i = 0; $i < $days; $i++) {
                                            $date_data[] = date('d-m-Y', strtotime($tour_date));
                                            $tour_date = addOneDay($tour_date);
                                        }
                                        $save_cumulative  =    json_decode($queries['cumulative'], true);
                                        $save_per_person  =    json_decode($queries['per_person'], true);
                                        $save_per_service  =    json_decode($queries['per_service'], true);

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
                                        <table class="table table-bordered">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="text-white">Service</th>
                                                    <?php foreach ($date_data as $d) { ?>
                                                        <th class="text-white"><?= $d ?></th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php foreach ($cumulative_service as $cumulative) : ?>
                                                    <tr>
                                                        <td>
                                                            <label class="form-check-label" for="><?= $cumulative['name'] ?>"><?= $cumulative['name'] ?> </label>
                                                        </td>
                                                        <?php foreach ($date_data as $d) {
                                                            $checked = "";

                                                            if (isset($save_cumulative[$cumulative['id']]['dates']) && in_array($d, $save_cumulative[$cumulative['id']]['dates'])) {
                                                                $checked = "checked";
                                                            }


                                                        ?>
                                                            <td>
                                                                <input disabled <?= $checked ?> onClick="return calculateTotal();" class="form-check-input" type="checkbox" name="cumulative[<?= $cumulative['id'] ?>][dates][]" amount-cumulative="<?= $cumulative['amount'] ?>" value="<?= $d ?>" id="cumulative<?= $cumulative['id'] ?>_<?= $d ?>">
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php endforeach ?>

                                                <?php foreach ($per_person_service as $per_person) : ?>
                                                    <tr>
                                                        <td>
                                                            <label class="form-check-label" for="<?= $per_person['name'] ?>"><?= $per_person['name'] ?> </label>
                                                        </td>
                                                        <?php foreach ($date_data as $d) {
                                                            $checked = "";

                                                            if (isset($save_per_person[$per_person['id']]['dates']) && in_array($d, $save_per_person[$per_person['id']]['dates'])) {
                                                                $checked = "checked";
                                                            }
                                                        ?>
                                                            <td>
                                                                <input disabled <?= $checked ?> onClick="return calculateTotal();" class="form-check-input" type="checkbox" name="per_person[<?= $per_person['id'] ?>][dates][]" amount-per-person="<?= $per_person['amount'] ?>" value="<?= $d ?>" id="per_person<?= $per_person['id'] ?>_<?= $d ?>">
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php endforeach ?>
                                        </table>
                                    </div>
                                </div>

                                <h3 class="mt-3 mb-3">Per Service</h3>
                                <?php foreach ($per_services as $per_service) : ?>
                                    <div class="row mb-3 align-items-top" id="service-per-service">
                                        <div class="col-md-3">
                                            <div class="form-check mt-b">
                                                <label class="form-check-label" for="<?= $per_service['name'] ?>"><?= $per_service['name'] ?> </label>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md">
                                                    <input disabled value="<?= $save_per_service[$per_service['id']][0] ?>" onChange="return calculateTotal();" placeholder="Enter no. of quantity" type="number" min="0" class="form-control phone-mask" name="per_service[<?= $per_service['id'] ?>][]" amount-per-service="<?= $per_service['amount'] ?>" id="per_service<?= $per_service['id'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>




                                <div class="row mb-3 align-items-top d-none">
                                    <div class="col-md-3">
                                        <div class="form-check mt-b">
                                            <input class="form-check-input" type="checkbox" value="" id="bike">
                                            <label class="form-check-label" for="bike">Bike </label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">

                                            <div class="col-md">
                                                <input disabled type="text" class="form-control phone-mask" placeholder="No. of Day">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <h3 class="mt-3 mb-3 d-none">Enter Bike Details</h3>
                                <div class="row mb-3 d-none">
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

                                <h3 class="mt-3 mb-3" id="enter-bike-details">Enter Bike Details</h3>
                                <div class="row mb-3" id="enter-bike-details-section">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody class="table-border-bottom-0">
                                                <tr>
                                                    <td>No. of Bike</td>
                                                    <td colspan="2">
                                                        <input type="number" name="number_of_bike" onChange="return calculateTotal();" class="form-control phone-mask">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Mechanic</td>
                                                    <td colspan="2">
                                                        <select class="form-select" name="mechanic" onChange="return calculateTotal();">
                                                            <option>No</option>
                                                            <option>Yes</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Marshal with Bike</td>
                                                    <td colspan="2">
                                                        <select class="form-select" name="marshal" onChange="return calculateTotal();">
                                                            <option>No</option>
                                                            <option>Yes</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Fuel</td>
                                                    <td colspan="2">
                                                        <select class="form-select" name="fuel" onChange="return calculateTotal();">
                                                            <option>No</option>
                                                            <option>Yes</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Backup</td>
                                                    <td colspan="2">
                                                        <select class="form-select" name="backup" onChange="return calculateTotal();">
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
                                                <?php

                                                $db = getDbInstance();
                                                $db->where('package_id', $queries['package_id']);
                                                $db->where('itineary', ['TWIN Fixed', 'CWB Fixed', 'CNB Fixed', 'TRIPLE Fixed', 'SINGLE Fixed', 'QUAD SHARING Fixed'], "NOT IN");
                                                $results = $db->get("package_details");
                                                $tour_date =  date('d-m-Y', strtotime($queries['tour_start_date']));

                                                foreach ($results as $key => $result) :

                                                ?>

                                                    <tr>
                                                        <td style="min-width: 82px">Day <?= $key + 1 ?></td>
                                                        <td style="min-width: 130px"><?= $tour_date ?></td>
                                                        <td><?= date('l', strtotime($tour_date)) ?></td>
                                                        <td><?= $result['itineary'] ?></td>
                                                    </tr>
                                                <?php
                                                    $tour_date = addOneDay($tour_date);
                                                endforeach;
                                                /*
                                                $db = getDbInstance();
                                                $db->where('id', $queries['package_id']);
                                                $result = $db->getOne("packages", 'permit, guide');
                                                */
                                                ?>
                                                <!-- break
                                                <h3 class="mt-3 mb-3">Extra Services</h3>
                                                <div class="col-md-3">
                                                    <div class="form-check mt-b">
                                                     <input class="form-check-input" checked type="checkbox" onClick="return calculateTotal(<?= $result['id'] ?>);" data-permit="<?= $result['permit'] ?>" id="permit">
                                                    <label class="form-check-label" for="permit">Permit </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check mt-b">
                                                    <input class="form-check-input" checked type="checkbox" onClick="return calculateTotal(<?= $result['id'] ?>);" `data-guide="<?= $result['guide'] ?>" id="guide"`>
                                                    <label class="form-check-label" for="guide">Guide </label>
                                                    </div>
                                                </div> -->

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                                <h3 class="mt-3 mb-3">Hotel Details</h3>
                                
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Choose Hotel</button>
                                            </div>
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
                                                <?php
                                                $db = getDbInstance();
                                                $db->where('package_id', $queries['package_id']);
                                                $db->where('itineary', ['TWIN Fixed', 'CWB Fixed', 'CNB Fixed', 'TRIPLE Fixed', 'SINGLE Fixed', 'QUAD SHARING Fixed'], "NOT IN");
                                                $results = $db->get("package_details");
                                                $tour_date = date('d-m-Y', strtotime($queries['tour_start_date']));
                                                $location = "";
                                                $checkIn = $tour_date;
                                                $day = 0;

                                                foreach ($results as $key => $result) :
                                                    $night = 0;

                                                    switch (strtolower($queries['category'])) {
                                                        case 'budget':
                                                            $amount = $result['budget'];
                                                            break;
                                                        case 'standard':
                                                            $amount = $result['standard'];
                                                            break;
                                                        case 'deluxe':
                                                            $amount = $result['deluxe'];
                                                            break;
                                                        case 'super_deluxe':
                                                            $amount = $result['super_deluxe'];
                                                            break;
                                                        case 'premium':
                                                            $amount = $result['premium'];
                                                            break;
                                                        case 'premium_plus':
                                                            $amount = $result['premium_plus'];
                                                            break;
                                                        case 'luxury':
                                                            $amount = $result['luxury'];
                                                            break;
                                                        case 'luxury_plus':
                                                            $amount = $result['luxury_plus'];
                                                            break;
                                                        default:
                                                            $amount = 0;
                                                            break;
                                                    }

                                                    if ($result['location'] != $location) {

                                                        $location = $result['location'];
                                                        $checkOut = addOneDay($checkIn);
                                                        $i = $key + 1;
                                                        $night++;
                                                        while (isset($results[$i]['location']) && $result['location'] == $results[$i]['location']) {
                                                            $checkOut =  addOneDay($checkOut);
                                                            $i++;
                                                            $night++;
                                                        }


                                                        $db = getDbInstance();
                                                        $db->where('location', $result['location']);
                                                        $db->where('category', $queries['category']);
                                                        $hotel = $db->getOne("hotels");
                                                        if ($hotel) :
                                                ?>

                                                            <tr>
                                                                <td><?= $day = $day + $night ?>
                                                                    <input type="hidden" name="hotel_night[]" value="<?= $night ?>" />
                                                                    <input type="hidden" name="hotel_amount[]" value="<?= $amount ?>" />
                                                                    <input type="hidden" name="hotel_name[]" value="<?= $hotel['hotel_name'] ?>" />
                                                                </td>
                                                                <td><?= $hotel['hotel_name'] ?></td>
                                                                <td><?= $checkIn ?></td>
                                                                <td><?= $checkOut ?></td>
                                                                <td><?= $night ?></td>
                                                                <td><?= $hotel['location'] ?></td>
                                                                <td><?= $hotel['mobile'] ?></td>
                                                            </tr>
                                                <?php
                                                        endif;
                                                        $checkIn = $checkOut;
                                                    }
                                                endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                                <h3 class="mt-3 mb-3">Transport</h3>
                                
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Choose Driver</button>
                                            </div>

                                <div class="row mb-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="driver_list">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="text-white">Vehicle Type</th>
                                                    <th class="text-white">No. of Vehicle</th>
                                                    <th class="text-white">Driver Name</th>
                                                    <th class="text-white">Mobile No.</th>
                                                </tr>
                                            </thead>
                                            <tbody class=" table-border-bottom-0">
                                                <?php foreach ($save_transport["'name'"] as $trans) : ?>
                                                    <tr>
                                                        <td><?= $trans ?></td>
                                                        <td>1</td>
                                                        <td><?= $vehicleData["$trans"]['driver_name'] ?></td>
                                                        <td><?= $vehicleData["$trans"]['mobile'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
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
                        <div class="right-part" style="position:fixed;right:0px">
                            <div class="booking-summary">
                                <div class="card">
                                    <div class="head">
                                        <h3>Booking Summary</h3>
                                    </div>
                                    <div class="summary-detail">
                                        <div class="row mb-3">
                                            <div class="col-md text-bold"><strong>Duration:</strong></div>
                                            <div class="col-md" id="summary-duration">-</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md"><strong>Travel Date:</strong></div>
                                            <div class="col-md" id="summary-travel-date">-</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md"><strong>Total No. of Pax:</strong></div>
                                            <div class="col-md" id="summary-no-of-pax">-</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md"><strong>Calculated Price:</strong></div>
                                            <div class="col-md"><strong id="summary-calculated-price"></strong></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md"><strong>Per Person Price:</strong></div>
                                            <div class="col-md"><strong id="per-person-calculated-price"></strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row get-quote-btn">
                                <button type="submit" class="btn btn-primary">Generate Quote</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="driver_list">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-white">Vehicle Type</th>
                                    <th class="text-white">No. of Vehicle</th>
                                    <th class="text-white">Driver Name</th>
                                    <th class="text-white">Mobile No.</th>
                                </tr>
                            </thead>
                            <tbody class=" table-border-bottom-0">
                                <tr>
                                    <td>CRYISTA</td>
                                    <td>1</td>
                                    <td>CRYISTA DRIVER</td>
                                    <td>8743094432</td>
                                </tr>
                            </tbody>
                        </table>
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
            service_list();
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

        service_list();
        $.ajax({
            url: 'ajax/itinerary_list.php',
            type: 'POST',
            data: {
                package_id: package_id,
                tour_date: tour_date
            },
            success: function(data) {
                let dataArr = data.split("break")
                $('#itinerary-list').html(dataArr[0]);
                $('#fixed-service').html(dataArr[1]);

                setTimeout(function() {
                    calculateTotal();
                }, 2)
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function service_list() {
        let tour_date = $('input[name="tour_start_date"]').val()
        let days = parseInt($("#duration").val().match(/\d+/)[0]);

        if ($('input[name="tour_start_date"]').val() != '' &&
            $("#duration").val().match(/\d+/)[0] != "") {
            $.ajax({
                url: 'ajax/service_list.php',
                type: 'POST',
                data: {
                    days: days,
                    tour_date: tour_date
                },
                success: function(data) {
                    let dataArr = data.split("break")
                    $('#service-list').html(dataArr[0]);
                    $('#service-per-service').html(dataArr[1]);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
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
        // Function to update maximum number of persons
        function updateMaxPersons() {
            // console.log( $(this))
            const selectedTransport = $(this).find('option:selected').data('trans');
            $(this).closest('.transport-row').find('.max-persons').text(selectedTransport);
            $(this).closest('.transport-row').find('.num-persons-select').empty();
            for (let i = 0; i <= 5; i++) {
                $(this).closest('.transport-row').find('.num-persons-select').append(`<option value="${i}">${i}</option>`);
            }
        }

        function removeAllBelowElement() {
            $('.transport-row:not(:first)').remove();
        }

        // Initial setup for first row
        // $('.transportation-select').each(updateMaxPersons);

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
        $('.table').on('change', '.transportation-select:first', removeAllBelowElement);

        //bike section hide and show
        const bikeCheckbox = document.getElementById('bike');
        const bikeDetailsSection = document.getElementById('enter-bike-details-section');
        const bikeDetails = document.getElementById('enter-bike-details');
        bikeDetailsSection.style.display = 'none';
        bikeDetails.style.display = 'none';
        bikeCheckbox.addEventListener('change', function() {
            if (this.checked) {
                bikeDetailsSection.style.display = 'block';
                bikeDetails.style.display = 'block';
            } else {
                bikeDetailsSection.style.display = 'none';
                bikeDetails.style.display = 'none';
            }
        });
        calculateTotal();
    });

    function calculateTotal() {
        const packageDetails = document.querySelectorAll('#package-other-details .col-md');
        const targetTableBody = document.querySelector('#final_quotation tbody');

        let totalAmount = 0;
        let total_per_person = 0;
        const existingRows = targetTableBody.querySelectorAll('tr:not(:first-child)');
        existingRows.forEach(row => row.remove());
        const rowData = {
            items: [],
            totalMember: 0
        };

        packageDetails.forEach(detail => {
            const label = detail.querySelector('.form-label').textContent;
            const price = parseFloat(detail.querySelector('input').dataset.amount);
            const quantity = parseInt(detail.querySelector('input').value);
            const total = price * quantity;
            //totalPax = totalPax + quantity;
            let h_pax = quantity;

            switch (label.trim()) {

                case 'TWIN':
                    h_pax = (quantity * 2);
                    break;
                case 'TRIPLE':
                    h_pax = (quantity * 3);
                    break;
                case 'QUAD SHARING':
                    h_pax = (quantity * 4);
                    break;
                default:
                    h_pax = quantity;
                    break;

            }
            if (quantity > 0) {
                const newRowData = {
                    label: label,
                    price: price,
                    h_pax: h_pax,
                    total: total,
                    quantity: quantity
                };
                rowData.items.push(newRowData);
                rowData.totalMember += h_pax;

            }
        });
        //Extra Services 
        //permit
        console.log(rowData)
        let totalPax = rowData.totalMember;
        let permitElement = document.getElementById("permit");
        if (permitElement) {
            if (permitElement.checked) {
                permit_amount = permitElement.getAttribute("data-permit");
                permit_amount = parseInt(permit_amount * totalPax);
                total_per_person = total_per_person + parseInt((permit_amount / totalPax));
            }
        }
        //guide 
        let guideElement = document.getElementById("guide");
        if (guideElement) {
            if (guideElement.checked) {
                guide_amount = guideElement.getAttribute("data-guide");
                total_per_person = total_per_person + parseInt((guide_amount / totalPax));
            }
        }

        //services
        const serviceDetails = {};
        document.querySelectorAll('#service-list input[type="checkbox"]').forEach(function(checkbox) {
            if (checkbox.checked) {
                const serviceName = checkbox.closest('tr').querySelector('label').textContent.trim();
                const amount = parseFloat(checkbox.getAttribute('amount-cumulative') || checkbox.getAttribute('amount-per-person'));
                const date = checkbox.value;
                let service_type = ""
                if (checkbox.getAttribute('amount-cumulative')) {
                    service_type = "Cumulative"
                } else if (checkbox.getAttribute('amount-per-person')) {
                    service_type = "Per Person"
                } else if (checkbox.getAttribute('amount-per-service')) {
                    service_type = "Per Service"
                }

                if (serviceDetails.hasOwnProperty(serviceName)) {
                    serviceDetails[serviceName].quantity += 1;
                } else {
                    serviceDetails[serviceName] = {
                        amount: amount,
                        quantity: 1,
                        total: amount,
                        type: service_type
                    };
                }
            }
        });

        for (const serviceName in serviceDetails) {
            if (serviceDetails.hasOwnProperty(serviceName)) {
                const {
                    amount,
                    quantity,
                    type
                } = serviceDetails[serviceName];

                if (type == "Cumulative") {
                    total_per_person = total_per_person + ((amount * quantity) / totalPax);
                } else if (type == "Per Person") {
                    total_per_person = total_per_person + (amount * quantity);
                }

            }
        }


        // Service Per Service
        const perService = document.getElementById('service-per-service');
        perService.querySelectorAll('.row.mb-3.align-items-top').forEach(row => {
            const input = row.querySelector('input[type="number"]');
            const label = row.querySelector('.form-check-label').textContent.trim();
            const amount = input.getAttribute('amount-per-service')
            const quantity = parseInt(input.value) || 0;
            if (quantity > 0) {
                total_per_person = total_per_person + ((amount * quantity) / totalPax);
            }
        });


        //Transportation 
        /*
        const driverTableBody = document.querySelector('#driver_list tbody');
        const driverDetails = <?= $json_vehicle ?>;
        console.log(driverDetails);
        const existingDriver = driverTableBody.querySelectorAll('tr');
        existingDriver.forEach(row => row.remove());
        const transportationSelects = document.querySelectorAll('.transportation-select');
        transportationSelects.forEach(select => {
          const detailId = 'detail_' + select.value.replace(' / ', '_');
          console.log(detailId)
          if (document.getElementById(detailId)) {
            const label = select.value;

            const amount = parseFloat(document.getElementById(detailId).value);
            const quantity = 1; // Quantity is always 1
            const total = amount * quantity;
            // Append to the table
            total_per_person = total_per_person + ((amount * quantity) / totalPax)


            let driver_name = driverDetails[label].driver_name;
            let mobile = driverDetails[label].mobile;
            const driverRow = document.createElement('tr');
            driverRow.innerHTML = `
                <td>${label}</td>
                <td>${quantity}</td>
               <!-- <td>${driver_name}</td>
                <td>${mobile}</td>-->
                <td>Pending</td>
                <td>Pending</td>
            `;
            driverTableBody.appendChild(driverRow);

          }
        });
        */

        // Get Bike Details
        const numberOfBike = document.querySelector('input[name="number_of_bike"]').value;
        const mechanic = document.querySelector('select[name="mechanic"]').value;
        const marshal = document.querySelector('select[name="marshal"]').value;
        const fuel = document.querySelector('select[name="fuel"]').value;
        const backup = document.querySelector('select[name="backup"]').value;

        // Retrieve the values of the inputs
        const numberOfBikePrice = parseInt(numberOfBike) * parseInt(<?php echo Bike ?>);
        const mechanicPrice = mechanic == 'Yes' ? parseInt(<?php echo Mechanic ?>) : 0;
        const marshalPrice = marshal == 'Yes' ? parseInt(<?php echo Marshal ?>) : 0;
        const fuelPrice = fuel == 'Yes' ? parseInt(<?php echo Fuel ?>) : 0;
        const backupPrice = backup == 'Yes' ? parseInt(<?php echo Backup ?>) : 0;
        //document.getElementById('bike').checked 
        const total_bike_price = (numberOfBikePrice + mechanicPrice + marshalPrice + fuelPrice + backupPrice)

        rowData.items.forEach(function(item) {
            let price = item.price + total_per_person;
            let h_pax = item.quantity;
            let total = price * item.quantity;
            let per_person_pr = item.price;
            if ("TWIN" == item.label.trim()) {
                price = item.price + (total_per_person * 2)
                h_pax = item.quantity * 2;
                total = price * item.quantity;
                per_person_pr = (total / h_pax);
            } else if ("TRIPLE" == item.label.trim()) {
                price = item.price + (total_per_person * 3)
                h_pax = item.quantity * 3;
                total = price * item.quantity;
                per_person_pr = (total / h_pax);
            } else if ("QUAD SHARING" == item.label.trim()) {
                price = item.price + (total_per_person * 4)
                h_pax = item.quantity * 4;
                total = price * item.quantity;
                per_person_pr = (total / h_pax);
            }
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${item.label}</td>
                <td>${round(per_person_pr)}</td>
                <td>${h_pax}</td>
                <td>${round(total)}</td>
            `;
            targetTableBody.appendChild(newRow);
            totalAmount += total;
        });
        //totalMember
        if (document.getElementById('bike').checked) {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>Bike</td>
                <td>${(total_bike_price/ numberOfBike).toFixed(2)}</td>
                <td>${ numberOfBike}</td>
                <td>${total_bike_price.toFixed(2)}</td>
            `;
            targetTableBody.appendChild(newRow);
            totalAmount += total_bike_price;
        }

        // Hotel List
        /*
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
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
            <td>${name}</td>
            <td>${amount}</td>
            <td>${night}</td>
            <td>${total}</td>
        `;
      targetTableBody.appendChild(newRow);
    });
*/
        // Add total rows
        var finalPrice = totalAmount;
        var igstPrice = round((totalAmount * 0.025));
        var sgstPrice = round((totalAmount * 0.025));
        finalPrice = round((finalPrice + igstPrice + sgstPrice));
        const totalRows = `
        <tr>
            <td></td>
            <td colspan="2">Total Amount Excluding GST</td>
            <td>${totalAmount}</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">IGST 2.5%</td>
            <td>${igstPrice}</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">SGST 2.5%</td>
            <td>${sgstPrice}</td>
        </tr> 
        <tr>
            <td></td>
            <td colspan="2" class="dark-col"><strong>Total Amount Including GST</strong></td>
            <td>${finalPrice}</td>
        </tr>
    `;

        targetTableBody.insertAdjacentHTML('beforeend', totalRows);

        document.getElementById('summary-duration').innerHTML = document.getElementById('duration').value;
        document.getElementById('summary-travel-date').innerHTML = $('input[name="tour_start_date"]').val();
        document.getElementById('summary-no-of-pax').innerHTML = totalPax;
        document.getElementById('summary-calculated-price').innerHTML = '₹' + finalPrice;
        document.getElementById('per-person-calculated-price').innerHTML = '₹' + round(parseInt(finalPrice / totalPax));
    }

    function round(number) {
        return Math.round(number * 100) / 100;
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
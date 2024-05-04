<?php
session_start();
require_once '../config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

$db = getDbInstance();
$db->where('type', 'Cumulative');
$cumulative_service = $db->get("services");

$db = getDbInstance();
$db->where('type', 'Per Person');
$per_person_service = $db->get("services");

$db = getDbInstance();
$db->where('type', 'Per Service');
$per_services = $db->get("services");

$tour_date = $_POST['tour_date'];
$days = $_POST['days'];
$date_data = [];
for ($i = 0; $i < $days; $i++) {
    $date_data[] = date('d-m-Y', strtotime($tour_date));
    $tour_date = addOneDay($tour_date);
}

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
                <?php foreach ($date_data as $d) { ?>
                    <td>
                        <input onClick="return calculateTotal();" class="form-check-input" type="checkbox" name="cumulative[<?= $cumulative['id'] ?>][dates][]" amount-cumulative="<?= $cumulative['amount'] ?>" value="<?= $d ?>" id="cumulative<?= $cumulative['id'] ?>_<?= $d ?>">
                    </td>
                <?php } ?>
            </tr>
        <?php endforeach ?>

        <?php foreach ($per_person_service as $per_person) : ?>
            <tr>
                <td>
                    <label class="form-check-label" for="<?= $per_person['name'] ?>"><?= $per_person['name'] ?> </label>
                </td>
                <?php foreach ($date_data as $d) { ?>
                    <td>
                        <input onClick="return calculateTotal();" class="form-check-input" type="checkbox" name="per_person[<?= $per_person['id'] ?>][dates][]" amount-per-person="<?= $per_person['amount'] ?>" value="<?= $d ?>" id="per_person<?= $per_person['id'] ?>_<?= $d ?>">
                    </td>
                <?php } ?>
            </tr>
        <?php endforeach ?>        

    </tbody>
</table>
break
<h3 class="mt-3 mb-3">Per Service</h3>
<?php foreach ($per_services as $per_service) : ?>
<div class="row mb-3 align-items-top">
    <div class="col-md-3">
        <div class="form-check mt-b"> 
            <label class="form-check-label" for="<?= $per_service['name'] ?>"><?= $per_service['name'] ?> </label>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md">
                <input onChange="return calculateTotal();" placeholder="Enter no. of quantity" type="number" min="0" class="form-control phone-mask" name="per_service[<?= $per_service['id'] ?>][]" amount-per-service="<?= $per_service['amount'] ?>"  id="per_service<?= $per_service['id'] ?>">
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
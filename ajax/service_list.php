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
    $date_data[] = date('d-m-Y',strtotime($tour_date));
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
            <tr class="transport-row">
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
            <tr class="transport-row">
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

        <?php foreach ($per_services as $per_service) : ?>
            <tr class="transport-row">
                <td>
                    <label class="form-check-label" for="<?= $per_service['name'] ?>"><?= $per_service['name'] ?> </label>
                </td>
                <?php foreach ($date_data as $d) { ?>
                    <td>
                     <input onClick="return calculateTotal();" class="form-check-input" type="checkbox" name="per_service[<?= $per_service['id'] ?>][dates][]" amount-per-service="<?= $per_service['amount'] ?>" value="<?= $d ?>" id="per_service<?= $per_service['id'] ?>_<?= $d ?>">                     
                    </td>
                <?php } ?>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>
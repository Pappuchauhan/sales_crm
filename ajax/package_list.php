<?php
session_start();
require_once '../config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

$db = getDbInstance();
$db->where('duration', $_POST['duration']);
$results = $db->get("packages");
foreach($results as $result):
?>

<tr>
    <td>
        <div class="form-check">
            <input name="default-radio-1" checked class="form-check-input" type="radio" value="" id="defaultRadio1">
        </div>
    </td>
    <td>
        <span class="fw-medium">#001</span>
    </td>
    <td><?=$result['package_name']?></td>
    <td>6 Days 5 Nights</td>
    <td>
        <select class="form-select">
            <option>Hotel Category</option>
            <option value="1">Budget</option>
            <option value="2">Standard</option>
            <option value="3">Deluxe</option>
            <option value="3">Super Deluxe</option>
            <option value="3">Premium</option>
            <option value="3">Luxury</option>
        </select>
    </td>
</tr>
<?php endforeach; ?>
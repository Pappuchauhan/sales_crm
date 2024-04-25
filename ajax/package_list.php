<?php
session_start();
require_once '../config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

$default_categories = getCategories();
$db = getDbInstance();
$db->where('duration', $_POST['duration']);
$db->where('status', 'Active');
$results = $db->get("packages");
foreach($results as $result):
?>

<tr>
    <td>
        <div class="form-check">
            <input name="package_name" onClick="return setPackageId(<?=$result['id']?>)"   class="form-check-input" type="radio" value="<?=$result['id']?>" id="defaultRadio1">
        </div>
    </td>
    <td>
        <span class="fw-medium">#00<?=$result['id']?></span>
    </td>
    <td><?=$result['package_name']?></td>
    <td><?=$result['duration']?></td>
    <td>
        <select class="form-select" onchange="return setCategory(this.value, <?=$result['id']?>);">
            <option>Choose Hotel Category</option>
            <?php
            foreach($default_categories as $category){
                echo " <option value=\"$category\">$category</option>";
            }
            ?> 
        </select>
    </td>
</tr>
<?php endforeach; ?>
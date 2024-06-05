<?php
session_start();
require_once '../config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

$db = getDbInstance();
$db->where('id', $_POST['agent_query_id']);
$result = $db->getOne("agent_queries");
// Decode the transport field
$trans = json_decode($result['transport'] ?? "{}", true);
$transName = $trans["'name'"] ?? [];
foreach ($transName as $name) :
    $db = getDbInstance();
    $db->where('vehicle_type', $name);
    $results = $db->get("vehicles");

?>

    <tr>
        <input type="hidden" name="transport['type'][]" value="<?= $name ?>" />
        
        <input type="hidden" name="transport['mobile'][]" value="<?= $results[0]['mobile'] ?>" />
        <td><?= $name ?></td>
        <td>1</td>
        <td>
            <select name="transport['driver'][]" class="form-select transportation-select">
                <?php foreach ($results as $res) :  ?>
                    <option value="<?php echo $res['driver_name']; ?>"><?php echo  $res['driver_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <td><?= $results[0]['mobile'] ?></td>
    </tr>
<?php
endforeach;
?>
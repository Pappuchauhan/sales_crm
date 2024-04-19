<?php
session_start();
require_once '../config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

$db = getDbInstance();
$db->where('package_id', $_POST['package_id']);
$db->where('itineary',['TWIN Fixed','CWB Fixed','CNB Fixed','TRIPLE Fixed','SINGLE Fixed','QUAD SHARING Fixed'], "NOT IN");
$results = $db->get("package_details");
$tour_date =  date('d-m-Y',strtotime($_POST['tour_date']));
foreach($results as $key=>$result):
   
?>

<tr>
<td style="min-width: 82px">Day <?=$key+1?></td>
<td style="min-width: 130px"><?=$tour_date?></td>
<td><?=date('l',strtotime($tour_date))?></td>
<td><?=$result['itineary']?></td>
</tr>
<?php 
 $tour_date = addOneDay($tour_date);
endforeach;

$db = getDbInstance();
$db->where('id', $_POST['package_id']); 
$result = $db->getOne("packages", 'permit, guide'); 
?>

break
<h3 class="mt-3 mb-3">Extra Services</h3>
<div class="col-md-3">
    <div class="form-check mt-b">
    <input class="form-check-input" checked type="checkbox" onClick="return calculateTotal();" data-permit="<?=$result['permit']?>" id="permit">
    <label class="form-check-label" for="permit">Permit </label>
    </div>
</div>
<div class="col-md-3">
    <div class="form-check mt-b">
    <input class="form-check-input" checked type="checkbox" onClick="return calculateTotal();" data-guide="<?=$result['guide']?>" id="guide">
    <label class="form-check-label" for="guide">Guide </label>
    </div>
</div>
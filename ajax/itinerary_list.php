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
endforeach; ?>
<?php
session_start();
require_once '../config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

$db = getDbInstance();
$db->where('package_id', $_POST['package_id']);
$db->where('itineary', ['TWIN Fixed', 'CWB Fixed', 'CNB Fixed', 'TRIPLE Fixed', 'SINGLE Fixed', 'QUAD SHARING Fixed'], "NOT IN");
$results = $db->get("package_details");
$tour_date =  date('d-m-Y', strtotime($_POST['tour_date']));
$location = "";
$checkIn = $tour_date;
$day =0;
//print_r($results);
foreach ($results as $key => $result) :
    $night = 0;

    switch (strtolower($_POST['category'])) {
        case 'budget':
            $amount = $result['budget'];
            break;
        case 'standard':
            $amount = $result['standard'];
            break;
        case 'deluxe':
            $amount = $result['deluxe'];
            break;
        case 'super deluxe':
            $amount = $result['super_deluxe'];
            break;
        case 'premium':
            $amount = $result['premium'];
            break;
        case 'premium plus':
            $amount = $result['premium_plus'];
            break;
        case 'luxury':
            $amount = $result['luxury'];
            break;
        case 'luxury plus':
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
        $db->where('category', $_POST['category']);
        $hotels = $db->get("hotels");
        if ($hotels) :
?>

            <tr>
                <td><?=$day = $day+$night?> 
                <input type="hidden" name="hotel_night[]" value="<?=$night?>" /> 
                <input type="hidden" name="hotel_amount[]" value="<?=$amount?>" />
                <input type="hidden" name="hotel_name[]" value="<?=$hotels[0]['hotel_name']?>" />
            </td>
                <td> 
                    <select  class="form-select transportation-select" > 
                        <?php foreach ($hotels as $hotel) :  ?>
                            <option value="<?php echo $hotel['hotel_name']; ?>"><?php echo  $hotel['hotel_name']; ?></option>
                        <?php endforeach; ?>
                    </select></td>
                <td><?= $checkIn ?></td>
                <td><?= $checkOut ?></td>
                <td><?= $night?></td>
                <td><?= $hotels[0]['location'] ?></td>
                <td><?= $hotels[0]['mobile'] ?></td>
            </tr>
<?php
        endif;
        $checkIn = $checkOut;
    }
endforeach; ?>
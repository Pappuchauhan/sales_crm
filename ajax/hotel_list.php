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
        $db->where('category', $_POST['category']);
        $hotel = $db->getOne("hotels");
        if ($hotel) :
?>

            <tr>
                <td><?=$day = $day+$night?> 
                <input type="hidden" name="hotel_night[]" value="<?=$night?>" /> 
                <input type="hidden" name="hotel_amount[]" value="<?=$amount?>" />
                <input type="hidden" name="hotel_name[]" value="<?=$hotel['hotel_name']?>" />
            </td>
                <td><?= $hotel['hotel_name'] ?></td>
                <td><?= $checkIn ?></td>
                <td><?= $checkOut ?></td>
                <td><?= $night?></td>
                <td><?= $hotel['location'] ?></td>
                <td><?= $hotel['mobile'] ?></td>
            </tr>
<?php
        endif;
        $checkIn = $checkOut;
    }
endforeach; ?>
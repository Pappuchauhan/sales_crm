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
foreach ($results as $key => $result) :

    if ($result['location'] != $location) {
        $location = $result['location'];
        $checkOut = addOneDay($checkIn);
        $i = $key + 1;
        if ($results[$i]['location']) {
            while ($result['location'] == $results[$i]['location']) {
                $checkOut =  addOneDay($checkOut);
                $i++;
            }
        }

        $db = getDbInstance();
        $db->where('location', $result['location']);
        $db->where('category', $_POST['category']);
        $hotel = $db->getOne("hotels");
        if ($hotel) :
?>

            <tr>
                <td>1</td>
                <td><?= $hotel['hotel_name'] ?></td>
                <td><?= $checkIn ?></td>
                <td><?= $checkOut ?></td>
                <td>2</td>
                <td><?= $hotel['location'] ?></td>
                <td><?= $hotel['mobile'] ?></td>
            </tr>
<?php
        endif;
        $checkIn = $checkOut;
    }
endforeach; ?>
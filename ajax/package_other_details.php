<?php
session_start();
require_once '../config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

$db = getDbInstance();
$db->where('package_id', $_POST['package_id']);
$db->where('itineary', ['TWIN Fixed', 'CWB Fixed', 'CNB Fixed', 'TRIPLE Fixed', 'SINGLE Fixed', 'QUAD SHARING Fixed'], "IN");
$results = $db->get("package_details");
$category = $_POST['category'];
foreach ($results as $key => $result) :

    switch (strtolower($category)) {
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

?>

    <div class="col-md">
        <label class="form-label"><?=str_replace("Fixed", "", $result['itineary']) ?></label>
        <!-- <small class="text-muted float-end set-padding-top">2 Pax</small>-->
        <div class="input-group">
            <button class="btn btn-outline-primary border-lighter add-custom-padding decrement" type="button" >-</button>
            <input 
            data-amount="<?=$amount?>"                          
            type="text" class="form-control text-center quantity" value="0">
            <button class="btn btn-outline-primary border-lighter add-custom-padding increment"  type="button">+</button>
        </div>
    </div>
<?php
endforeach; 

$db = getDbInstance();
$db->where('package_id', $_POST['package_id']);
$db->where('itineary', ['TWIN Fixed', 'CWB Fixed', 'CNB Fixed', 'TRIPLE Fixed', 'SINGLE Fixed', 'QUAD SHARING Fixed'], "NOT IN");
$db->orderBy('id','ASC');
$results = $db->getOne("package_details");
 

?>
<input type="hidden" name="detail_COACH" id="detail_COACH" value="<?=$results['coach']?>" />
<input type="hidden" name="detail_TEMPO" id="detail_TEMPO" value="<?=$results['tempo']?>" />
<input type="hidden" name="detail_CRYISTA" id="detail_CRYISTA" value="<?=$results['cryista']?>" />
<input type="hidden" name="detail_INNOVA" id="detail_INNOVA" value="<?=$results['innova']?>" />
<input type="hidden" name="detail_ZYALO_ERTIGA" id="detail_ZYALO_ERTIGA" value="<?=$results['zyalo_ertiga']?>" />
<input type="hidden" name="detail_ECO" id="detail_ECO" value="<?=$results['eco']?>" />
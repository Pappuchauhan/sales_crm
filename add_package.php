<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data_to_store = array_filter($_POST);
  $details = $data_to_store['detail'];
  $twinSave = $data_to_store['twin'];
  $cwbSave = $data_to_store['cwb'];
  $cnbSave = $data_to_store['cnb'];
  $tripleSave = $data_to_store['triple'];
  $singleSave = $data_to_store['single'];
  unset($data_to_store['detail']);
  unset($data_to_store['twin']);
  unset($data_to_store['cwb']);
  unset($data_to_store['cnb']);
  unset($data_to_store['triple']);
  unset($data_to_store['single']);
  $db = getDbInstance();

  if (isset($_POST['id']) && !empty($_POST['id'])) {
    $msg = "edited";
    $db->where('id', $_POST['id']);
    $package_id = $db->update('packages', $data_to_store);
    // delete exiting package details for insert new
    $db = getDbInstance();
    $db->where('package_id', $_POST['id']);
    $db->delete('package_details');
    // Insert here
    $db = getDbInstance();
    foreach ($details as $detail) {
      $detail['package_id'] = $_POST['id'];
      $pkg_detail_id = $db->insert('package_details', $detail);
    }
    $twinSave['package_id'] = $_POST['id'];
    $cwbSave['package_id'] = $_POST['id'];
    $cnbSave['package_id'] = $_POST['id'];
    $tripleSave['package_id'] = $_POST['id'];
    $singleSave['package_id'] = $_POST['id'];
    $pkg_detail_id = $db->insert('package_details', $twinSave);
    $pkg_detail_id = $db->insert('package_details', $cwbSave);
    $pkg_detail_id = $db->insert('package_details', $cnbSave);
    $pkg_detail_id = $db->insert('package_details', $tripleSave);
    $pkg_detail_id = $db->insert('package_details', $singleSave);
  } else {
    $msg = "added";
    $package_id = $db->insert('packages', $data_to_store);
    $db = getDbInstance();
    foreach ($details as $detail) {
      $detail['package_id'] = $package_id;
      $pkg_detail_id = $db->insert('package_details', $detail);
    }

    $twinSave['package_id'] = $package_id;
    $cwbSave['package_id'] = $package_id;
    $cnbSave['package_id'] = $package_id;
    $tripleSave['package_id'] = $package_id;
    $singleSave['package_id'] = $package_id;
    $pkg_detail_id = $db->insert('package_details', $twinSave);
    $pkg_detail_id = $db->insert('package_details', $cwbSave);
    $pkg_detail_id = $db->insert('package_details', $cnbSave);
    $pkg_detail_id = $db->insert('package_details', $tripleSave);
    $pkg_detail_id = $db->insert('package_details', $singleSave);
  }
  if ($package_id) {
    $_SESSION['success'] = "Package $msg successfully!";
    header('location: package.php');
    exit();
  } else {
    echo 'insert failed: ' . $db->getLastError();
    exit();
  }
}

$id = isset($_GET['crm']) && !empty($_GET['crm']) ? decryptId($_GET['crm']) : "";
$edit = false;
if (!empty($id)) {
  $edit = true;
  $db = getDbInstance();
  $db->where('id', $id);
  $data = $db->getOne("packages");

  $db = getDbInstance();
  $db->where('itineary', ['TWIN Fixed', 'CWB Fixed', 'CNB Fixed', 'TRIPLE Fixed', 'SINGLE Fixed'], 'not in');
  $db->where('package_id', $id);
  $package_details = $db->get("package_details");

  $db = getDbInstance();
  $db->where('itineary', 'TWIN Fixed');
  $db->where('package_id', $id);
  $twin = $db->getOne("package_details");

  $db = getDbInstance();
  $db->where('itineary', 'CWB Fixed');
  $db->where('package_id', $id);
  $cwb = $db->getOne("package_details");

  $db = getDbInstance();
  $db->where('itineary', 'CNB Fixed');
  $db->where('package_id', $id);
  $cnb = $db->getOne("package_details");

  $db = getDbInstance();
  $db->where('itineary', 'TRIPLE Fixed');
  $db->where('package_id', $id);
  $triple = $db->getOne("package_details");

  $db = getDbInstance();
  $db->where('itineary', 'SINGLE Fixed');
  $db->where('package_id', $id);
  $single = $db->getOne("package_details");
}

include BASE_PATH . '/includes/header.php';
?>
<div class="layout-page">

  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4"><span class="text-muted fw-light">Package/</span> Add Package</h4>

      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Create Package</h5>
              <!-- <small class="text-muted float-end">Product Code</small> -->
            </div>
            <div class="card-body">
              <form action="" method="post" id="hotel_form" enctype="multipart/form-data">

                <div class="mb-3">
                  <label class="form-label" for="basic-default-company">Package Name</label>
                  <input type="text" class="form-control" name="package_name" value="<?php echo htmlspecialchars($edit ? $data['package_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                </div>
                <div class="row mb-3">
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Permit</label>
                    <input type="number" id="basic-default-phone" class="form-control phone-mask" name="permit" value="<?php echo htmlspecialchars($edit ? $data['permit'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Guide</label>
                    <input type="number" id="basic-default-phone" class="form-control phone-mask" name="guide" value="<?php echo htmlspecialchars($edit ? $data['guide'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Bike</label>
                    <input type="number" id="basic-default-phone" class="form-control phone-mask" name="bike" value="<?php echo htmlspecialchars($edit ? $data['bike'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Lunch</label>
                    <input type="number" id="basic-default-phone" class="form-control phone-mask" name="lunch" value="<?php echo htmlspecialchars($edit ? $data['lunch'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Water bottle</label>
                    <input type="number" id="basic-default-phone" class="form-control phone-mask" name="water_bottle" value="<?php echo htmlspecialchars($edit ? $data['water_bottle'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Tea</label>
                    <input type="number" id="basic-default-phone" class="form-control phone-mask" name="tea" value="<?php echo htmlspecialchars($edit ? $data['tea'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Bon fire</label>
                    <input type="number" id="basic-default-phone" class="form-control phone-mask" name="bon_fire" value="<?php echo htmlspecialchars($edit ? $data['bon_fire'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                  <div class="col-md">
                    <label class="form-label" for="basic-default-phone">Oxygen Cyliender</label>
                    <input type="number" id="basic-default-phone" class="form-control phone-mask" name="oxygen_cyliender" value="<?php echo htmlspecialchars($edit ? $data['oxygen_cyliender'] : '', ENT_QUOTES, 'UTF-8'); ?>" />
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-email">Select Duration</label>
                  <div class="input-group">
                    <label class="input-group-text" for="inputGroupSelect01">Options</label>
                    <select class="form-select" id="duration" name="duration" <?php echo  $edit ? "disabled" : "" ?>>
                      <option>Choose...</option>
                      <option value="2 Days 1 Nights" <?php echo ($edit &&  $data['duration'] == "2 Days 1 Nights") ? 'selected' : '' ?>>2 Days 1 Nights</option>
                      <option value="3 Days 2 Nights" <?php echo ($edit &&  $data['duration'] == "3 Days 2 Nights") ? 'selected' : '' ?>>3 Days 2 Nights</option>
                      <option value="4 Days 3 Nights" <?php echo ($edit &&  $data['duration'] == "4 Days 3 Nights") ? 'selected' : '' ?>>4 Days 3 Nights</option>
                      <option value="5 Days 4 Nights" <?php echo ($edit &&  $data['duration'] == "5 Days 4 Nights") ? 'selected' : '' ?>>5 Days 4 Nights</option>
                      <option value="6 Days 5 Nights" <?php echo ($edit &&  $data['duration'] == "6 Days 5 Nights") ? 'selected' : '' ?>>6 Days 5 Nights</option>
                      <option value="7 Days 6 Nights" <?php echo ($edit &&  $data['duration'] == "7 Days 6 Nights") ? 'selected' : '' ?>>7 Days 6 Nights</option>
                      <option value="8 Days 7 Nights" <?php echo ($edit &&  $data['duration'] == "8 Days 7 Nights") ? 'selected' : '' ?>>8 Days 7 Nights</option>
                    </select>
                  </div>
                </div>
                <div class="table-responsive text-nowrap border-light border-solid mb-3">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap bg-dark align-middle">
                        <th class="text-white border-right-white sticky-col">Day</th>
                        <th class="text-white border-right-white sticky-col">Itineary</th>
                        <th class="text-white border-right-white">Budget</th>
                        <th class="text-white border-right-white">Standard</th>
                        <th class="text-white border-right-white">Deluxe</th>
                        <th class="text-white border-right-white">Super Deluxe</th>
                        <th class="text-white border-right-white">Premium</th>
                        <th class="text-white border-right-white"><input type="text" class="form-control phone-mask w-px-100" name="no_name1" value="<?php echo htmlspecialchars($edit ? $data['no_name1'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Luxury" /></th>
                        <th class="text-white border-right-white"><input type="text" class="form-control phone-mask w-px-100" name="no_name2" value="<?php echo htmlspecialchars($edit ? $data['no_name2'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Luxury" /></th>
                        <th class="text-white border-right-white"><input type="text" class="form-control phone-mask w-px-100" name="no_name3" value="<?php echo htmlspecialchars($edit ? $data['no_name3'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Luxury" /></th>
                        <th class="text-white border-right-white"><input type="text" class="form-control phone-mask w-px-100" name="no_name4" value="<?php echo htmlspecialchars($edit ? $data['no_name4'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Luxury" /></th>
                        <th class="text-white border-right-white"><input type="text" class="form-control phone-mask w-px-100" name="no_name5" value="<?php echo htmlspecialchars($edit ? $data['no_name5'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Luxury" /></th>
                        <th class="text-white border-right-white">Coach</th>
                        <th class="text-white border-right-white">Tempo</th>
                        <th class="text-white border-right-white">Cryista</th>
                        <th class="text-white border-right-white">Innova</th>
                        <th class="text-white border-right-white">Zyalo / Ertiga</th>
                        <th class="text-white border-right-white">Eco</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="existingTable">
                      <?php
                      if ($edit) {
                        $total_budget = 0;
                        foreach ($package_details as $j => $pack) {
                          $total_budget += $pack['budget'];
                      ?>

                          <tr>
                            <td class="border-right-dark sticky-col"><input type="number" class="form-control phone-mask w-px-75" value="<?= $pack['day'] ?>" name="detail[<?= $j ?>][day]" placeholder="Day" /></td>
                            <td class="border-right-dark sticky-col"><textarea class="form-control w-px-300 h-px-75" name="detail[<?= $j ?>][itineary]" placeholder="Enter Short Itineary"><?= $pack['itineary'] ?></textarea></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['budget'] ?>" name="detail[<?= $j ?>][budget]" onchange="calculateBudgetSum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['standard'] ?>" name="detail[<?= $j ?>][standard]" onchange="calculateStandardSum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['deluxe'] ?>" name="detail[<?= $j ?>][deluxe]" onchange="calculateDeluxeSum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['super_deluxe'] ?>" name="detail[<?= $j ?>][super_deluxe]" onchange="calculateSuperDeluxeSum()()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['premium'] ?>" name="detail[<?= $j ?>][premium]" onchange="calculatePremiumSum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['no_name1'] ?>" name="detail[<?= $j ?>][no_name1]" onchange="calculateNoName1Sum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['no_name2'] ?>" name="detail[<?= $j ?>][no_name2]" onchange="calculateNoName2Sum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['no_name3'] ?>" name="detail[<?= $j ?>][no_name3]" onchange="calculateNoName3Sum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['no_name4'] ?>" name="detail[<?= $j ?>][no_name4]" onchange="calculateNoName4Sum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['no_name5'] ?>" name="detail[<?= $j ?>][no_name5]" onchange="calculateNoName5Sum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['coach'] ?>" name="detail[<?= $j ?>][coach]" onchange="calculateCoachSum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['tempo'] ?>" name="detail[<?= $j ?>][tempo]" onchange="calculateTempoSum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['cryista'] ?>" name="detail[<?= $j ?>][cryista]" onchange="calculateCryistaSum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['innova'] ?>" name="detail[<?= $j ?>][innova]" onchange="calculateInnovaSum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['zyalo_ertiga'] ?>" name="detail[<?= $j ?>][zyalo_ertiga]" onchange="calculateZyaloEetigaSum()" placeholder="" /></td>
                            <td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" value="<?= $pack['eco'] ?>" name="detail[<?= $j ?>][eco]" onchange="calculateEcoSum()" placeholder="" /></td>



                          </tr>
                      <?php
                        }
                      }
                      ?>

                      <tr>
                        <td class="border-right-dark sticky-col"></td>
                        <td class="border-right-dark sticky-col">TWIN</td>
                        <td class="border-right-dark" id="twin-budget">₹<?= $twin['budget'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-standard">₹<?= $twin['standard'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-deluxe">₹<?= $twin['deluxe'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-super-deluxe">₹<?= $twin['super_deluxe'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-premium">₹<?= $twin['premium'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-no_name1">₹<?= $twin['no_name1'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-no_name2">₹<?= $twin['no_name2'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-no_name3">₹<?= $twin['no_name3'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-no_name4">₹<?= $twin['no_name4'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-no_name5">₹<?= $twin['no_name5'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-coach">₹<?= $twin['coach'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-tempo">₹<?= $twin['tempo'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-cryista">₹<?= $twin['cryista'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-innova">₹<?= $twin['innova'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-zyalo_ertiga">₹<?= $twin['zyalo_ertiga'] ?? "" ?></td>
                        <td class="border-right-dark" id="twin-eco">₹<?= $twin['eco'] ?? "" ?></td>
                        <input type="hidden" value="" name="twin[day]" />
                        <input type="hidden" value="TWIN Fixed" name="twin[itineary]" />
                        <input type="hidden" value="<?= $twin['budget'] ?? "" ?>" name="twin[budget]" />
                        <input type="hidden" value="<?= $twin['standard'] ?? "" ?>" name="twin[standard]" />
                        <input type="hidden" value="<?= $twin['deluxe'] ?? "" ?>" name="twin[deluxe]" />
                        <input type="hidden" value="<?= $twin['super_deluxe'] ?? "" ?>" name="twin[super_deluxe]" />
                        <input type="hidden" value="<?= $twin['premium'] ?? "" ?>" name="twin[premium]" />
                        <input type="hidden" value="<?= $twin['no_name1'] ?? "" ?>" name="twin[no_name1]" />
                        <input type="hidden" value="<?= $twin['no_name2'] ?? "" ?>" name="twin[no_name2]" />
                        <input type="hidden" value="<?= $twin['no_name3'] ?? "" ?>" name="twin[no_name3]" />
                        <input type="hidden" value="<?= $twin['no_name4'] ?? "" ?>" name="twin[no_name4]" />
                        <input type="hidden" value="<?= $twin['no_name5'] ?? "" ?>" name="twin[no_name5]" />
                        <input type="hidden" value="<?= $twin['coach'] ?? "" ?>" name="twin[coach]" />
                        <input type="hidden" value="<?= $twin['tempo'] ?? "" ?>" name="twin[tempo]" />
                        <input type="hidden" value="<?= $twin['cryista'] ?? "" ?>" name="twin[cryista]" />
                        <input type="hidden" value="<?= $twin['innova'] ?? "" ?>" name="twin[innova]" />
                        <input type="hidden" value="<?= $twin['zyalo_ertiga'] ?? "" ?>" name="twin[zyalo_ertiga]" />
                        <input type="hidden" value="<?= $twin['eco'] ?? "" ?>" name="twin[eco]" />
                      </tr>
                      <tr>
                        <td class="border-right-dark sticky-col"></td>
                        <td class="border-right-dark sticky-col">CWB</td>
                        <td class="border-right-dark" id="cwb-budget">₹<?= $cwb['budget'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-standard">₹<?= $cwb['standard'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-deluxe">₹<?= $cwb['deluxe'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-super-deluxe">₹<?= $cwb['super_deluxe'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-premium">₹<?= $cwb['premium'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-no_name1">₹<?= $cwb['no_name1'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-no_name2">₹<?= $cwb['no_name2'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-no_name3">₹<?= $cwb['no_name3'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-no_name4">₹<?= $cwb['no_name4'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-no_name5">₹<?= $cwb['no_name5'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-coach">₹<?= $cwb['coach'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-tempo">₹<?= $cwb['tempo'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-cryista">₹<?= $cwb['cryista'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-innova">₹<?= $cwb['innova'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-zyalo_ertiga">₹<?= $cwb['zyalo_ertiga'] ?? "" ?></td>
                        <td class="border-right-dark" id="cwb-eco">₹<?= $cwb['eco'] ?? "" ?></td>
                        <input type="hidden" value="" name="cwb[day]" />
                        <input type="hidden" value="CWB Fixed" name="cwb[itineary]" />
                        <input type="hidden" value="<?= $cwb['budget'] ?? "" ?>" name="cwb[budget]" />
                        <input type="hidden" value="<?= $cwb['standard'] ?? "" ?>" name="cwb[standard]" />
                        <input type="hidden" value="<?= $cwb['deluxe'] ?? "" ?>" name="cwb[deluxe]" />
                        <input type="hidden" value="<?= $cwb['super_deluxe']  ?? ""  ?>" name="cwb[super_deluxe]" />
                        <input type="hidden" value="<?= $cwb['premium'] ?? "" ?>" name="cwb[premium]" />
                        <input type="hidden" value="<?= $cwb['no_name1'] ?? ""  ?>" name="cwb[no_name1]" />
                        <input type="hidden" value="<?= $cwb['no_name2'] ?? ""  ?>" name="cwb[no_name2]" />
                        <input type="hidden" value="<?= $cwb['no_name3'] ?? "" ?>" name="cwb[no_name3]" />
                        <input type="hidden" value="<?= $cwb['no_name4'] ?? "" ?>" name="cwb[no_name4]" />
                        <input type="hidden" value="<?= $cwb['no_name5'] ?? "" ?>" name="cwb[no_name5]" />
                        <input type="hidden" value="<?= $cwb['coach'] ?? ""  ?>" name="cwb[coach]" />
                        <input type="hidden" value="<?= $cwb['tempo'] ?? ""  ?>" name="cwb[tempo]" />
                        <input type="hidden" value="<?= $cwb['cryista'] ?? "" ?>" name="cwb[cryista]" />
                        <input type="hidden" value="<?= $cwb['innova'] ?? "" ?>" name="cwb[innova]" />
                        <input type="hidden" value="<?= $cwb['zyalo_ertiga'] ?? "" ?>" name="cwb[zyalo_ertiga]" />
                        <input type="hidden" value="<?= $cwb['eco'] ?? ""  ?>" name="cwb[eco]" />
                      </tr>
                      <tr>
                        <td class="border-right-dark sticky-col"></td>
                        <td class="border-right-dark sticky-col">CNB</td>
                        <td class="border-right-dark" id="cnb-budget">₹<?= $cnb['budget'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-standard">₹<?= $cnb['standard'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-deluxe">₹<?= $cnb['deluxe'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-super-deluxe">₹<?= $cnb['super_deluxe'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-premium">₹<?= $cnb['premium'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-no_name1">₹<?= $cnb['no_name1'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-no_name2">₹<?= $cnb['no_name2'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-no_name3">₹<?= $cnb['no_name3'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-no_name4">₹<?= $cnb['no_name4'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-no_name5">₹<?= $cnb['no_name5'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-coach">₹<?= $cnb['coach'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-tempo">₹<?= $cnb['tempo'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-cryista">₹<?= $cnb['cryista'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-innova">₹<?= $cnb['innova'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-zyalo_ertiga">₹<?= $cnb['zyalo_ertiga'] ?? ""  ?></td>
                        <td class="border-right-dark" id="cnb-eco">₹<?= $cnb['eco'] ?? ""  ?></td>

                        <input type="hidden" value="" name="cnb[day]" />
                        <input type="hidden" value="CNB Fixed" name="cnb[itineary]" />
                        <input type="hidden" value="<?= $cnb['budget'] ?? ""  ?>" name="cnb[budget]" />
                        <input type="hidden" value="<?= $cnb['standard'] ?? ""  ?>" name="cnb[standard]" />
                        <input type="hidden" value="<?= $cnb['deluxe'] ?? ""  ?>" name="cnb[deluxe]" />
                        <input type="hidden" value="<?= $cnb['super_deluxe'] ?? ""  ?>" name="cnb[super_deluxe]" />
                        <input type="hidden" value="<?= $cnb['premium'] ?? ""  ?>" name="cnb[premium]" />
                        <input type="hidden" value="<?= $cnb['no_name1'] ?? ""  ?>" name="cnb[no_name1]" />
                        <input type="hidden" value="<?= $cnb['no_name2'] ?? ""  ?>" name="cnb[no_name2]" />
                        <input type="hidden" value="<?= $cnb['no_name3'] ?? ""  ?>" name="cnb[no_name3]" />
                        <input type="hidden" value="<?= $cnb['no_name4'] ?? ""  ?>" name="cnb[no_name4]" />
                        <input type="hidden" value="<?= $cnb['no_name5'] ?? ""  ?>" name="cnb[no_name5]" />
                        <input type="hidden" value="<?= $cnb['coach'] ?? ""  ?>" name="cnb[coach]" />
                        <input type="hidden" value="<?= $cnb['tempo'] ?? ""  ?>" name="cnb[tempo]" />
                        <input type="hidden" value="<?= $cnb['cryista'] ?? ""  ?>" name="cnb[cryista]" />
                        <input type="hidden" value="<?= $cnb['innova'] ?? ""  ?>" name="cnb[innova]" />
                        <input type="hidden" value="<?= $cnb['zyalo_ertiga'] ?? ""  ?>" name="cnb[zyalo_ertiga]" />
                        <input type="hidden" value="<?= $cnb['eco'] ?? ""  ?>" name="cnb[eco]" />
                      </tr>
                      <tr>
                        <td class="border-right-dark sticky-col"></td>
                        <td class="border-right-dark sticky-col">TRIPLE</td>
                        <td class="border-right-dark" id="triple-budget">₹<?= $triple['budget'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-standard">₹<?= $triple['standard'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-deluxe">₹<?= $triple['deluxe'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-super-deluxe">₹<?= $triple['super_deluxe'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-premium">₹<?= $triple['premium'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-no_name1">₹<?= $triple['no_name1'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-no_name2">₹<?= $triple['no_name2'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-no_name3">₹<?= $triple['no_name3'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-no_name4">₹<?= $triple['no_name4'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-no_name5">₹<?= $triple['no_name5'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-coach">₹<?= $triple['coach'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-tempo">₹<?= $triple['tempo'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-cryista">₹<?= $triple['cryista'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-innova">₹<?= $triple['innova'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-zyalo_ertiga">₹<?= $triple['zyalo_ertiga'] ?? ""  ?></td>
                        <td class="border-right-dark" id="triple-eco">₹<?= $triple['eco'] ?? ""  ?></td>

                        <input type="hidden" value="" name="triple[day]" />
                        <input type="hidden" value="TRIPLE Fixed" name="triple[itineary]" />
                        <input type="hidden" value="<?= $triple['budget'] ?? ""  ?>" name="triple[budget]" />
                        <input type="hidden" value="<?= $triple['standard'] ?? ""  ?>" name="triple[standard]" />
                        <input type="hidden" value="<?= $triple['deluxe'] ?? ""  ?>" name="triple[deluxe]" />
                        <input type="hidden" value="<?= $triple['super_deluxe'] ?? ""  ?>" name="triple[super_deluxe]" />
                        <input type="hidden" value="<?= $triple['premium'] ?? ""  ?>" name="triple[premium]" />
                        <input type="hidden" value="<?= $triple['no_name1'] ?? ""  ?>" name="triple[no_name1]" />
                        <input type="hidden" value="<?= $triple['no_name2'] ?? ""  ?>" name="triple[no_name2]" />
                        <input type="hidden" value="<?= $triple['no_name3'] ?? ""  ?>" name="triple[no_name3]" />
                        <input type="hidden" value="<?= $triple['no_name4'] ?? ""  ?>" name="triple[no_name4]" />
                        <input type="hidden" value="<?= $triple['no_name5'] ?? ""  ?>" name="triple[no_name5]" />
                        <input type="hidden" value="<?= $triple['coach'] ?? ""  ?>" name="triple[coach]" />
                        <input type="hidden" value="<?= $triple['tempo'] ?? ""  ?>" name="triple[tempo]" />
                        <input type="hidden" value="<?= $triple['cryista'] ?? ""  ?>" name="triple[cryista]" />
                        <input type="hidden" value="<?= $triple['innova'] ?? ""  ?>" name="triple[innova]" />
                        <input type="hidden" value="<?= $triple['zyalo_ertiga'] ?? ""  ?>" name="triple[zyalo_ertiga]" />
                        <input type="hidden" value="<?= $triple['eco'] ?? ""  ?>" name="triple[eco]" />
                      </tr>
                      <tr>
                        <td class="border-right-dark sticky-col"></td>
                        <td class="border-right-dark sticky-col">SINGLE</td>
                        <td class="border-right-dark" id="single-budget">₹<?= $single['budget'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-standard">₹<?= $single['standard'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-deluxe">₹<?= $single['deluxe'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-super-deluxe">₹<?= $single['super_deluxe'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-premium">₹<?= $single['premium'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-no_name1">₹<?= $single['no_name1'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-no_name2">₹<?= $single['no_name2'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-no_name3">₹<?= $single['no_name3'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-no_name4">₹<?= $single['no_name4'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-no_name5">₹<?= $single['no_name5'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-coach">₹<?= $single['coach'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-tempo">₹<?= $single['tempo'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-cryista">₹<?= $single['cryista'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-innova">₹<?= $single['innova'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-zyalo_ertiga">₹<?= $single['zyalo_ertiga'] ?? ""  ?></td>
                        <td class="border-right-dark" id="single-eco">₹<?= $single['eco'] ?? ""  ?></td>
                        <input type="hidden" value="" name="single[day]" />
                        <input type="hidden" value="SINGLE Fixed" name="single[itineary]" />
                        <input type="hidden" value="<?= $single['budget'] ?? ""  ?>" name="single[budget]" />
                        <input type="hidden" value="<?= $single['standard'] ?? ""  ?>" name="single[standard]" />
                        <input type="hidden" value="<?= $single['deluxe'] ?? ""  ?>" name="single[deluxe]" />
                        <input type="hidden" value="<?= $single['super_deluxe'] ?? ""  ?>" name="single[super_deluxe]" />
                        <input type="hidden" value="<?= $single['premium'] ?? ""  ?>" name="single[premium]" />
                        <input type="hidden" value="<?= $single['no_name1'] ?? ""  ?>" name="single[no_name1]" />
                        <input type="hidden" value="<?= $single['no_name2'] ?? ""  ?>" name="single[no_name2]" />
                        <input type="hidden" value="<?= $single['no_name3'] ?? ""  ?>" name="single[no_name3]" />
                        <input type="hidden" value="<?= $single['no_name4'] ?? ""  ?>" name="single[no_name4]" />
                        <input type="hidden" value="<?= $single['no_name5'] ?? ""  ?>" name="single[no_name5]" />
                        <input type="hidden" value="<?= $single['coach'] ?? ""  ?>" name="single[coach]" />
                        <input type="hidden" value="<?= $single['tempo'] ?? ""  ?>" name="single[tempo]" />
                        <input type="hidden" value="<?= $single['cryista'] ?? ""  ?>" name="single[cryista]" />
                        <input type="hidden" value="<?= $single['innova'] ?? ""  ?>" name="single[innova]" />
                        <input type="hidden" value="<?= $single['zyalo_ertiga'] ?? ""  ?>" name="single[zyalo_ertiga]" />
                        <input type="hidden" value="<?= $single['eco'] ?? ""  ?>" name="single[eco]" />
                      </tr>

                    </tbody>
                  </table>
                </div>

                <input type="hidden" name="id" value="<?php echo $id ?>" />
                <button type="submit" class="btn btn-primary">Send</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
  </div>
</div>

<script>
  document.getElementById('duration').addEventListener('change', function() {
    var numberOfRows = parseInt(this.value.match(/\d+/)[0]);
    //var numberOfRows = parseInt(this.value);
    var existingTable = document.getElementById('existingTable');

    // Remove rows with the specified class
    var rowsToRemove = existingTable.getElementsByClassName('new-row');
    while (rowsToRemove.length > 0) {
      rowsToRemove[0].parentNode.removeChild(rowsToRemove[0]);
    }

    var insertAfterRow = '';
    console.log(insertAfterRow)

    for (var j = 0; j < numberOfRows; j++) {
      var row = existingTable.insertRow(insertAfterRow.rowIndex + j);
      row.classList.add('new-row');
      row.innerHTML = `
     <td class="border-right-dark sticky-col"><input type="number" class="form-control phone-mask w-px-75" name="detail[${j}][day]" placeholder="Day" /></td>
		<td class="border-right-dark sticky-col"><textarea class="form-control w-px-300 h-px-75" name="detail[${j}][itineary]" placeholder="Enter Short Itineary"></textarea></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][budget]" onchange="calculateBudgetSum()" placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][standard]" onchange="calculateStandardSum()" placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][deluxe]" onchange="calculateDeluxeSum()"  placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][super_deluxe]" onchange="calculateSuperDeluxeSum()"  placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][premium]" onchange="calculatePremiumSum()"  placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][no_name1]" onchange="calculateNoName1Sum()" placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][no_name2]" onchange="calculateNoName2Sum()" placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][no_name3]" onchange="calculateNoName3Sum()" placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][no_name4]" onchange="calculateNoName4Sum()" placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][no_name5]" onchange="calculateNoName5Sum()"placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][coach]" onchange = "calculateCoachSum()" placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][tempo]" onchange = "calculateTempoSum()"placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][cryista]" onchange = "calculateCryistaSum()" placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][innova]" onchange = "calculateInnovaSum()" placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][zyalo_ertiga]" onchange = "calculateZyaloEetigaSum()" placeholder="" /></td>
		<td class="border-right-dark"><input type="number" class="form-control phone-mask w-px-100" name="detail[${j}][eco]" onchange = "calculateEcoSum()" placeholder="" /></td>
    `;
    }
  });


  // Function to calculate sum  
  function calculateBudgetSum() {
    var budgetInputs = document.querySelectorAll('input[name^="detail"][name$="[budget]"]');
    var budgetSum = 0;
    budgetInputs.forEach(function(input) {
      if (input.value !== '') {
        budgetSum += parseInt(input.value);
      }
    });
    document.getElementById('twin-budget').innerHTML = `₹${budgetSum}`;
    document.getElementById('cwb-budget').innerHTML = `₹${budgetSum * 1.5}`;
    document.getElementById('cnb-budget').innerHTML = `₹${budgetSum * 2}`;
    document.getElementById('triple-budget').innerHTML = `₹${budgetSum * 2.5}`;
    document.getElementById('single-budget').innerHTML = `₹${budgetSum * 3}`;

    document.querySelector('input[name="twin[budget]"]').value = budgetSum;
    document.querySelector('input[name="cwb[budget]"]').value = budgetSum * 1.5;
    document.querySelector('input[name="cnb[budget]"]').value = budgetSum * 2;
    document.querySelector('input[name="triple[budget]"]').value = budgetSum * 2.5;
    document.querySelector('input[name="single[budget]"]').value = budgetSum * 3;
    return budgetSum;
  }

  function calculateStandardSum() {
    var standardInputs = document.querySelectorAll('input[name^="detail"][name$="[standard]"]');
    var standardSum = 0;
    standardInputs.forEach(function(input) {
      if (input.value !== '') {
        standardSum += parseInt(input.value);
      }
    });
    document.getElementById('twin-standard').innerHTML = `₹${standardSum}`;
    document.getElementById('cwb-standard').innerHTML = `₹${standardSum * 1.5}`;
    document.getElementById('cnb-standard').innerHTML = `₹${standardSum * 2}`;
    document.getElementById('triple-standard').innerHTML = `₹${standardSum * 2.5}`;
    document.getElementById('single-standard').innerHTML = `₹${standardSum * 3}`;

    document.querySelector('input[name="twin[standard]"]').value = standardSum;
    document.querySelector('input[name="cwb[standard]"]').value = standardSum * 1.5;
    document.querySelector('input[name="cnb[standard]"]').value = standardSum * 2;
    document.querySelector('input[name="triple[standard]"]').value = standardSum * 2.5;
    document.querySelector('input[name="single[standard]"]').value = standardSum * 3;
    return standardSum;
  }

  function calculateDeluxeSum() {
    var deluxeInputs = document.querySelectorAll('input[name^="detail"][name$="[deluxe]"]');
    var deluxeSum = 0;
    deluxeInputs.forEach(function(input) {
      if (input.value !== '') {
        deluxeSum += parseInt(input.value);
      }
    });
    document.getElementById('twin-deluxe').innerHTML = `₹${deluxeSum}`;
    document.getElementById('cwb-deluxe').innerHTML = `₹${deluxeSum * 1.5}`;
    document.getElementById('cnb-deluxe').innerHTML = `₹${deluxeSum * 2}`;
    document.getElementById('triple-deluxe').innerHTML = `₹${deluxeSum * 2.5}`;
    document.getElementById('single-deluxe').innerHTML = `₹${deluxeSum * 3}`;

    document.querySelector('input[name="twin[deluxe]"]').value = deluxeSum;
    document.querySelector('input[name="cwb[deluxe]"]').value = deluxeSum * 1.5;
    document.querySelector('input[name="cnb[deluxe]"]').value = deluxeSum * 2;
    document.querySelector('input[name="triple[deluxe]"]').value = deluxeSum * 2.5;
    document.querySelector('input[name="single[deluxe]"]').value = deluxeSum * 3;
    return deluxeSum;
  }

  function calculateSuperDeluxeSum() {
    var super_deluxeInputs = document.querySelectorAll('input[name^="detail"][name$="[super_deluxe]"]');
    var super_deluxeSum = 0;
    super_deluxeInputs.forEach(function(input) {
      if (input.value !== '') {
        super_deluxeSum += parseInt(input.value);
      }
    });
    document.getElementById('twin-super-deluxe').innerHTML = `₹${super_deluxeSum}`;
    document.getElementById('cwb-super-deluxe').innerHTML = `₹${super_deluxeSum * 1.5}`;
    document.getElementById('cnb-super-deluxe').innerHTML = `₹${super_deluxeSum * 2}`;
    document.getElementById('triple-super-deluxe').innerHTML = `₹${super_deluxeSum * 2.5}`;
    document.getElementById('single-super-deluxe').innerHTML = `₹${super_deluxeSum * 3}`;

    document.querySelector('input[name="twin[super_deluxe]"]').value = super_deluxeSum;
    document.querySelector('input[name="cwb[super_deluxe]"]').value = super_deluxeSum * 1.5;
    document.querySelector('input[name="cnb[super_deluxe]"]').value = super_deluxeSum * 2;
    document.querySelector('input[name="triple[super_deluxe]"]').value = super_deluxeSum * 2.5;
    document.querySelector('input[name="single[super_deluxe]"]').value = super_deluxeSum * 3;
    return super_deluxeSum;
  }

  function calculatePremiumSum() {
    var premiumInputs = document.querySelectorAll('input[name^="detail"][name$="[premium]"]');
    var premiumSum = 0;
    premiumInputs.forEach(function(input) {
      if (input.value !== '') {
        premiumSum += parseInt(input.value);
      }
    });
    document.getElementById('twin-premium').innerHTML = `₹${premiumSum}`;
    document.getElementById('cwb-premium').innerHTML = `₹${premiumSum * 1.5}`;
    document.getElementById('cnb-premium').innerHTML = `₹${premiumSum * 2}`;
    document.getElementById('triple-premium').innerHTML = `₹${premiumSum * 2.5}`;
    document.getElementById('single-premium').innerHTML = `₹${premiumSum * 3}`;

    document.querySelector('input[name="twin[premium]"]').value = premiumSum;
    document.querySelector('input[name="cwb[premium]"]').value = premiumSum * 1.5;
    document.querySelector('input[name="cnb[premium]"]').value = premiumSum * 2;
    document.querySelector('input[name="triple[premium]"]').value = premiumSum * 2.5;
    document.querySelector('input[name="single[premium]"]').value = premiumSum * 3;
    return premiumSum;
  }

  function calculateNoName1Sum() {
    var inputs = document.querySelectorAll('input[name^="detail"][name$="[no_name1]"]');
    var sum = 0;
    inputs.forEach(function(input) {
      if (input.value !== '') {
        sum += parseInt(input.value);
      }
    });
    document.getElementById('twin-no_name1').innerHTML = `₹${sum}`;
    document.getElementById('cwb-no_name1').innerHTML = `₹${sum * 1.5}`;
    document.getElementById('cnb-no_name1').innerHTML = `₹${sum * 2}`;
    document.getElementById('triple-no_name1').innerHTML = `₹${sum * 2.5}`;
    document.getElementById('single-no_name1').innerHTML = `₹${sum * 3}`;

    document.querySelector('input[name="twin[no_name1]"]').value = sum;
    document.querySelector('input[name="cwb[no_name1]"]').value = sum * 1.5;
    document.querySelector('input[name="cnb[no_name1]"]').value = sum * 2;
    document.querySelector('input[name="triple[no_name1]"]').value = sum * 2.5;
    document.querySelector('input[name="single[no_name1]"]').value = sum * 3;
    return sum;
  }

  function calculateNoName2Sum() {
    var inputs = document.querySelectorAll('input[name^="detail"][name$="[no_name2]"]');
    var sum = 0;
    inputs.forEach(function(input) {
      if (input.value !== '') {
        sum += parseInt(input.value);
      }
    });
    document.getElementById('twin-no_name2').innerHTML = `₹${sum}`;
    document.getElementById('cwb-no_name2').innerHTML = `₹${sum * 1.5}`;
    document.getElementById('cnb-no_name2').innerHTML = `₹${sum * 2}`;
    document.getElementById('triple-no_name2').innerHTML = `₹${sum * 2.5}`;
    document.getElementById('single-no_name2').innerHTML = `₹${sum * 3}`;

    document.querySelector('input[name="twin[no_name2]"]').value = sum;
    document.querySelector('input[name="cwb[no_name2]"]').value = sum * 1.5;
    document.querySelector('input[name="cnb[no_name2]"]').value = sum * 2;
    document.querySelector('input[name="triple[no_name2]"]').value = sum * 2.5;
    document.querySelector('input[name="single[no_name2]"]').value = sum * 3;
    return sum;
  }

  function calculateNoName3Sum() {
    var inputs = document.querySelectorAll('input[name^="detail"][name$="[no_name3]"]');
    var sum = 0;
    inputs.forEach(function(input) {
      if (input.value !== '') {
        sum += parseInt(input.value);
      }
    });
    document.getElementById('twin-no_name3').innerHTML = `₹${sum}`;
    document.getElementById('cwb-no_name3').innerHTML = `₹${sum * 1.5}`;
    document.getElementById('cnb-no_name3').innerHTML = `₹${sum * 2}`;
    document.getElementById('triple-no_name3').innerHTML = `₹${sum * 2.5}`;
    document.getElementById('single-no_name3').innerHTML = `₹${sum * 3}`;

    document.querySelector('input[name="twin[no_name3]"]').value = sum;
    document.querySelector('input[name="cwb[no_name3]"]').value = sum * 1.5;
    document.querySelector('input[name="cnb[no_name3]"]').value = sum * 2;
    document.querySelector('input[name="triple[no_name3]"]').value = sum * 2.5;
    document.querySelector('input[name="single[no_name3]"]').value = sum * 3;
    return sum;
  }

  function calculateNoName4Sum() {
    var inputs = document.querySelectorAll('input[name^="detail"][name$="[no_name4]"]');
    var sum = 0;
    inputs.forEach(function(input) {
      if (input.value !== '') {
        sum += parseInt(input.value);
      }
    });
    document.getElementById('twin-no_name4').innerHTML = `₹${sum}`;
    document.getElementById('cwb-no_name4').innerHTML = `₹${sum * 1.5}`;
    document.getElementById('cnb-no_name4').innerHTML = `₹${sum * 2}`;
    document.getElementById('triple-no_name4').innerHTML = `₹${sum * 2.5}`;
    document.getElementById('single-no_name4').innerHTML = `₹${sum * 3}`;

    document.querySelector('input[name="twin[no_name4]"]').value = sum;
    document.querySelector('input[name="cwb[no_name4]"]').value = sum * 1.5;
    document.querySelector('input[name="cnb[no_name4]"]').value = sum * 2;
    document.querySelector('input[name="triple[no_name4]"]').value = sum * 2.5;
    document.querySelector('input[name="single[no_name4]"]').value = sum * 3;
    return sum;
  }

  function calculateNoName5Sum() {
    var inputs = document.querySelectorAll('input[name^="detail"][name$="[no_name5]"]');
    var sum = 0;
    inputs.forEach(function(input) {
      if (input.value !== '') {
        sum += parseInt(input.value);
      }
    });
    document.getElementById('twin-no_name5').innerHTML = `₹${sum}`;
    document.getElementById('cwb-no_name5').innerHTML = `₹${sum * 1.5}`;
    document.getElementById('cnb-no_name5').innerHTML = `₹${sum * 2}`;
    document.getElementById('triple-no_name5').innerHTML = `₹${sum * 2.5}`;
    document.getElementById('single-no_name5').innerHTML = `₹${sum * 3}`;

    document.querySelector('input[name="twin[no_name5]"]').value = sum;
    document.querySelector('input[name="cwb[no_name5]"]').value = sum * 1.5;
    document.querySelector('input[name="cnb[no_name5]"]').value = sum * 2;
    document.querySelector('input[name="triple[no_name5]"]').value = sum * 2.5;
    document.querySelector('input[name="single[no_name5]"]').value = sum * 3;
    return sum;
  }

  function calculateCoachSum() {
    var inputs = document.querySelectorAll('input[name^="detail"][name$="[coach]"]');
    var sum = 0;
    inputs.forEach(function(input) {
      if (input.value !== '') {
        sum += parseInt(input.value);
      }
    });
    document.getElementById('twin-coach').innerHTML = `₹${sum}`;
    document.getElementById('cwb-coach').innerHTML = `₹${sum * 1.5}`;
    document.getElementById('cnb-coach').innerHTML = `₹${sum * 2}`;
    document.getElementById('triple-coach').innerHTML = `₹${sum * 2.5}`;
    document.getElementById('single-coach').innerHTML = `₹${sum * 3}`;

    document.querySelector('input[name="twin[coach]"]').value = sum;
    document.querySelector('input[name="cwb[coach]"]').value = sum * 1.5;
    document.querySelector('input[name="cnb[coach]"]').value = sum * 2;
    document.querySelector('input[name="triple[coach]"]').value = sum * 2.5;
    document.querySelector('input[name="single[coach]"]').value = sum * 3;
    return sum;
  }

  function calculateTempoSum() {
    var inputs = document.querySelectorAll('input[name^="detail"][name$="[tempo]"]');
    var sum = 0;
    inputs.forEach(function(input) {
      if (input.value !== '') {
        sum += parseInt(input.value);
      }
    });
    document.getElementById('twin-tempo').innerHTML = `₹${sum}`;
    document.getElementById('cwb-tempo').innerHTML = `₹${sum * 1.5}`;
    document.getElementById('cnb-tempo').innerHTML = `₹${sum * 2}`;
    document.getElementById('triple-tempo').innerHTML = `₹${sum * 2.5}`;
    document.getElementById('single-tempo').innerHTML = `₹${sum * 3}`;

    document.querySelector('input[name="twin[tempo]"]').value = sum;
    document.querySelector('input[name="cwb[tempo]"]').value = sum * 1.5;
    document.querySelector('input[name="cnb[tempo]"]').value = sum * 2;
    document.querySelector('input[name="triple[tempo]"]').value = sum * 2.5;
    document.querySelector('input[name="single[tempo]"]').value = sum * 3;
    return sum;
  }

  function calculateCryistaSum() {
    var inputs = document.querySelectorAll('input[name^="detail"][name$="[cryista]"]');
    var sum = 0;
    inputs.forEach(function(input) {
      if (input.value !== '') {
        sum += parseInt(input.value);
      }
    });
    document.getElementById('twin-cryista').innerHTML = `₹${sum}`;
    document.getElementById('cwb-cryista').innerHTML = `₹${sum * 1.5}`;
    document.getElementById('cnb-cryista').innerHTML = `₹${sum * 2}`;
    document.getElementById('triple-cryista').innerHTML = `₹${sum * 2.5}`;
    document.getElementById('single-cryista').innerHTML = `₹${sum * 3}`;

    document.querySelector('input[name="twin[cryista]"]').value = sum;
    document.querySelector('input[name="cwb[cryista]"]').value = sum * 1.5;
    document.querySelector('input[name="cnb[cryista]"]').value = sum * 2;
    document.querySelector('input[name="triple[cryista]"]').value = sum * 2.5;
    document.querySelector('input[name="single[cryista]"]').value = sum * 3;
    return sum;
  }

  function calculateInnovaSum() {
    var inputs = document.querySelectorAll('input[name^="detail"][name$="[innova]"]');
    var sum = 0;
    inputs.forEach(function(input) {
      if (input.value !== '') {
        sum += parseInt(input.value);
      }
    });
    document.getElementById('twin-innova').innerHTML = `₹${sum}`;
    document.getElementById('cwb-innova').innerHTML = `₹${sum * 1.5}`;
    document.getElementById('cnb-innova').innerHTML = `₹${sum * 2}`;
    document.getElementById('triple-innova').innerHTML = `₹${sum * 2.5}`;
    document.getElementById('single-innova').innerHTML = `₹${sum * 3}`;

    document.querySelector('input[name="twin[innova]"]').value = sum;
    document.querySelector('input[name="cwb[innova]"]').value = sum * 1.5;
    document.querySelector('input[name="cnb[innova]"]').value = sum * 2;
    document.querySelector('input[name="triple[innova]"]').value = sum * 2.5;
    document.querySelector('input[name="single[innova]"]').value = sum * 3;
    return sum;
  }

  function calculateZyaloEetigaSum() {
    var inputs = document.querySelectorAll('input[name^="detail"][name$="[zyalo_ertiga]"]');
    var sum = 0;
    inputs.forEach(function(input) {
      if (input.value !== '') {
        sum += parseInt(input.value);
      }
    });
    document.getElementById('twin-zyalo_ertiga').innerHTML = `₹${sum}`;
    document.getElementById('cwb-zyalo_ertiga').innerHTML = `₹${sum * 1.5}`;
    document.getElementById('cnb-zyalo_ertiga').innerHTML = `₹${sum * 2}`;
    document.getElementById('triple-zyalo_ertiga').innerHTML = `₹${sum * 2.5}`;
    document.getElementById('single-zyalo_ertiga').innerHTML = `₹${sum * 3}`;


    document.querySelector('input[name="twin[zyalo_ertiga]"]').value = sum;
    document.querySelector('input[name="cwb[zyalo_ertiga]"]').value = sum * 1.5;
    document.querySelector('input[name="cnb[zyalo_ertiga]"]').value = sum * 2;
    document.querySelector('input[name="triple[zyalo_ertiga]"]').value = sum * 2.5;
    document.querySelector('input[name="single[zyalo_ertiga]"]').value = sum * 3;
    return sum;
  }

  function calculateEcoSum() {
    var inputs = document.querySelectorAll('input[name^="detail"][name$="[eco]"]');
    var sum = 0;
    inputs.forEach(function(input) {
      if (input.value !== '') {
        sum += parseInt(input.value);
      }
    });
    document.getElementById('twin-eco').innerHTML = `₹${sum}`;
    document.getElementById('cwb-eco').innerHTML = `₹${sum * 1.5}`;
    document.getElementById('cnb-eco').innerHTML = `₹${sum * 2}`;
    document.getElementById('triple-eco').innerHTML = `₹${sum * 2.5}`;
    document.getElementById('single-eco').innerHTML = `₹${sum * 3}`;

    document.querySelector('input[name="twin[eco]"]').value = sum;
    document.querySelector('input[name="cwb[eco]"]').value = sum * 1.5;
    document.querySelector('input[name="cnb[eco]"]').value = sum * 2;
    document.querySelector('input[name="triple[eco]"]').value = sum * 2.5;
    document.querySelector('input[name="single[eco]"]').value = sum * 3;
    return sum;
  }
</script>
<?php include BASE_PATH . '/includes/footer.php'; ?>
<!-- <?php //include BASE_PATH . '/footer.php'; ?>includes -->
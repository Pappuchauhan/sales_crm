<?php
session_start();
require_once '../config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['data_save_form']) && $_POST['data_save_form'] == 'hotel') {
    $data_to_store = array_filter($_POST);
    $db = getDbInstance();
    $save_data = [];
    $save_data["hotel_details"] = json_encode($data_to_store['hotel'] ?? []);
    $_POST['agent_query_id'];
    $db->where('id', $_POST['agent_query_id']);
    $last_id = $db->update('agent_queries', $save_data);
    echo "hotel saved";
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['data_save_form']) && $_POST['data_save_form'] == 'driver') {
    $data_to_store = array_filter($_POST);
    $db = getDbInstance();
    $save_data = [];
    $save_data["driver_details"] = json_encode($data_to_store['transport'] ?? []);
    $_POST['agent_query_driver_id'];
    $db->where('id', $_POST['agent_query_driver_id']);
    $last_id = $db->update('agent_queries', $save_data);
    echo "driver saved";
} else {
    echo "404";
}

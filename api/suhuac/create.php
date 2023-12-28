<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/database.php';
include_once '../../models/SuhuAc.php';
$database = new Database();
$db = $database->getConnection();
$item = new SuhuAc($db);
$data = json_decode(file_get_contents("php://input"));
$item->suhu_min = $data->suhu_min;
$item->suhu_mid = $data->suhu_mid;
$item->suhu_max = $data->suhu_max;
if($item->createData()){
    echo json_encode( 'Data created successfully.');
} else{
    echo json_encode('Data could not be created.');
}
?>

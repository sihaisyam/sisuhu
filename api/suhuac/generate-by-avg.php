<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-AllowHeaders, Authorization, X-Requested-With");
include_once '../../config/database.php';
include_once '../../models/SuhuAc.php';

$database = new Database();
$db = $database->getConnection();
$item = new SuhuAc($db);
$item->generateByAVG();
if($item->suhu_min != null){
    $data_arr = array(
    "ternyaman" => "Suhu ternyaman PT ABC dimulai dari ".
            round($item->suhu_min)." derajat sampai ".
            round($item->suhu_mid)." derajat celsius",
    "terendah" => "Suhu terendah PT ABC dimulai kurang dari ".
            round($item->suhu_min)." derajat celsius",
    "tertinggi" => "Suhu tertinggi PT ABC lebih dari ".
    round($item->suhu_max)." derajat celsius"
    );
    http_response_code(200);
    echo json_encode($data_arr);
}
else{
    http_response_code(404);
    echo json_encode("Suhu AC not found.");
}
    
?>

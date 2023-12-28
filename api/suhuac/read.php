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
if(isset($_GET['id'])){
    $item = new SuhuAc($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
    $item->getSingleData();
    if($item->suhu_min != null){
        // create array
        $data_arr = array(
        "id" => $item->id,
        "suhu_min" => $item->suhu_min,
        "suhu_mid" => $item->suhu_mid,
        "suhu_max" => $item->suhu_max
        );
        http_response_code(200);
        echo json_encode($data_arr);
    }
    else{
        http_response_code(404);
        echo json_encode("Suhu AC not found.");
    }
}
else {
    $items = new SuhuAc($db);
    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){
        $DataArr = array();
        $DataArr["body"] = array();
        $DataArr["total"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "suhu_min" => $suhu_min,
                "suhu_mid" => $suhu_mid,
                "suhu_max" => $suhu_max
            );
            array_push($DataArr["body"], $e);
        }
        echo json_encode($DataArr);
    }
    else{
        http_response_code(404);
        echo json_encode(array("message" => "No record found."));
    }
}
?>

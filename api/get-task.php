<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 7200");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization");
include_once './db.php';
include_once './classes/tasks.php';
$database = new Database();
$db = $database->connect();

$tasks   = new Tasks($db);
$data = json_decode(file_get_contents("php://input"));

$tasks->id = $data->id;
$result = $tasks->details();
if($result->num_rows>0){
    $data   = $result->fetch_assoc();    
    http_response_code(200);
    echo json_encode(array("success"=>true, "message" => "Task Detail", "data"=>$data));
}else{
    http_response_code(201);
    echo json_encode(array("success"=>false, "message" => "No results found!."));
}
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

$tasks = new Tasks($db);
$data = json_decode(file_get_contents("php://input"));

$error = false;

if(empty($data->id)){
    $error = true;
    $message = '"id" is required';
}
if(empty($data->title)){
	$error = true;
	$message = '"title" is required';
}

if(empty($data->description)){
	$error = true;
	$message = '"description" is required';
}

if(empty($data->status)){
	$error = true;
	$message = '"status" is required';
}

if($error===false){
    $tasks->id = $data->id;
    $tasks->title = $data->title;
    $tasks->description = $data->description;
    $tasks->status = $data->status;
    if($tasks->update()){
        http_response_code(200);
        echo json_encode(array("success"=>true, "message" => "Task updated successfully."));
    } else{
        http_response_code(503);
        echo json_encode(array("success"=>false, "message" => "Unable to create task."));
    }
}else {
    http_response_code(400);    
    echo json_encode(array("success"=>false, "message" => "Unable to update task. ".$message));
}
?>
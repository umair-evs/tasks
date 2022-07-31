<?php 
include_once("./functions.php");
if(isset($_POST) && !empty($_POST["id"])){
	extract($_POST);
	$endPoint = "http://localhost/todo/api/update-task.php";
	$response = makeApiPOSTCall($endPoint, json_encode($_POST));
	if($response->success==true){
		header("location:index.php?msg=".$response->message); exit;
	}
}

	$arrayName = array('id' => $_GET['id']);
	$endPoint = "http://localhost/todo/api/get-task.php";
	$resp = makeApiGETCall($endPoint, json_encode($arrayName));

	// print_r($resp); 

	$id = $resp->data->id;
	$title = $resp->data->title;
	$status = $resp->data->status;
	$description = $resp->data->description;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

	<script src="https://kit.fontawesome.com/f21d69a600.js" crossorigin="anonymous"></script>
	</head>
	<style type="text/css">
body{color: #000;overflow-x: hidden;height: 100%;background-image: url("wallpaperflare.com_wallpaper.jpg");background-repeat: no-repeat;background-size: 100% 100%}.card{padding: 30px 40px;margin-top: 60px;margin-bottom: 60px;border: none !important;box-shadow: 0 6px 12px 0 rgba(0,0,0,0.2)}.blue-text{color: #00BCD4}.form-control-label{margin-bottom: 0}input,select, textarea, button{padding: 8px 15px;border-radius: 5px !important;margin: 5px 0px;box-sizing: border-box;border: 1px solid #ccc;font-size: 18px !important;font-weight: 300}input:focus, textarea:focus{-moz-box-shadow: none !important;-webkit-box-shadow: none !important;box-shadow: none !important;border: 1px solid #00BCD4;outline-width: 0;font-weight: 400}.btn-block{text-transform: uppercase;font-size: 15px !important;font-weight: 400;height: 43px;cursor: pointer}.btn-block:hover{color: #fff !important}button:focus{-moz-box-shadow: none !important;-webkit-box-shadow: none !important;box-shadow: none !important;outline-width: 0}		
	</style>
<body>
	<div class="container">
	<div class="col-md-12">


<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11">
			<h3 class="text-white">Add new Task</h3>            
            <div class="card">
                <h5 class="mb-4">Please fill-out and submit</h5>
                <form class="form-card" action="" method="POST">
                    <div class="row justify-content-between text-left">

                        <div class="form-group col-sm-6 flex-column d-flex">
                        	<input type="hidden" name="id" value="<?php echo $id ?>">
                        	<label class="form-control-label px-3">Title<span class="text-danger"> *</span></label>
                        	<input type="text" id="title" name="title" placeholder="Task title here" value="<?php echo $title ?>" >
                        </div>

                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Status
                        	<span class="text-danger"> *</span></label>
                        	<select class=""  name="status"  >
                        		<option>Select Status</option>
                        		<option <?php if(strtolower($status)==='complated'){ echo ' selected '; } ?> value="Complated">Complated</option>
                        		<option <?php if(strtolower($status)==='pending'){ echo ' selected '; } ?>  value="Pending">Pending</option>
                        		<option <?php if(strtolower($status)==='inprogress'){ echo ' selected '; } ?>  value="Inprogress">Inprogress</option>
                        	</select>
						 </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-12 flex-column d-flex"> <label class="form-control-label px-3">Description<span class="text-danger"> *</span></label>
                        	<textarea name="description"><?php echo $description ?></textarea>
                    </div>

                    <div class="row justify-content-end">
                        <div class="form-group col-sm-12">
                        	<button type="submit" class="btn-block btn-primary">Update Task</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



	</div>		
	</div>

</body>
</html>
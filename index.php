<?php 
include_once("./functions.php");
$endPoint = "http://localhost/todo/api/get-tasks.php";
$responce = makeApiGETCall($endPoint, $data = false);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

	<script src="https://kit.fontawesome.com/f21d69a600.js" crossorigin="anonymous"></script>
	</head>
	<script>

	function removeTask(id){

		if(confirm("Are you sure you want to delete this?")) {
			var myHeaders = new Headers();
			myHeaders.append("Content-Type", "application/json");

			var raw = JSON.stringify({
			  "id": id
			});

			var requestOptions = {
			  method:'POST',
			  body: raw,
			  headers: myHeaders,
			  redirect: 'follow'
			};

			fetch("http://localhost/todo/api/remove-task.php", requestOptions)
			  .then((response) => {
			  	response.text()
				window.location.href="index.php?msg=Record Deleted";
			  })
			  .then((result) => {

			  		// console.log(result)
			  		if(result.success===true){
			  			alert(result.message);
						window.location.href="index.php?msg=Record Deleted";			  			
			  		}
			  })
			  .catch((error) => {
			  	console.log('error', error)
			  });

		}
	}
	  </script>		
<body>
	<div class="container">
	<div class="col-md-12">
		<div class="d-flex justify-content-between mt-4">
			<h3 class="text-primary">To Do List</h3>
			<a href="add-task.php">
				<button class="btn btn-primary" name="add">Add new Task</button>
			</a>
		</div>
		<?php echo $_GET['msg']; ?> 
		<hr style="border-top:1px dotted #ccc;"/>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>description</th>
					<th>status</th>
					<th>Created On</th>
					<th>Last Modified</th>
					<th align="center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($responce->success){
					// print_r($responce->data); exit;

					foreach ($responce->data as $key => $task)
					{
				?>
				<tr>
					<td><?php echo $key+1?></td>
					<td><?php echo $task->title?></td>
					<td><?php echo $task->description?></td>
					<td><?php echo $task->status?></td>
					<td><?php echo $task->createdAt?></td>
					<td><?php echo $task->updatedAt?></td>
					<td colspan="2">
						<center>
							<?php
								if($task->status != "Done"){
									echo 
									'<a href="edit-task.php?id='.$task->id.'" class="btn btn-success">
											<i class="fa fa-pen"></i>
									</a> |';
								}
							?>

							 <a href="javascript:void(0);" onclick="removeTask(<?=$task->id?>)" class="btn btn-danger">
							 	<i class="fa fa-close"></i>
							 </a>
						</center>
					</td>
				</tr>
				<?php
					}
				}
				?>
			</tbody>
		</table>
	</div>		
	</div>

</body>
</html>
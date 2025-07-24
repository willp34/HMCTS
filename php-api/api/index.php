<?php
//
header("Access-Control-Allow-Origin: ");
header("Content-Type: application/json; charset=UTF-8");


//require __DIR__ . '../../../vendor/autoload.php';



include_once '../src/Database.php';
include_once '../src/Task.php';



// Only allow AJAX requests
if (
    !isset($_SERVER['HTTP_X_REQUESTED_WITH']) ||
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest'
) {
    http_response_code(403); // Forbidden
    exit('Access denied');
}

$database = new Database();

$db = $database->getConnection();

$task = new Task($db);

$method = $_SERVER['REQUEST_METHOD'];


	if($method==='POST' && isset($_POST['_method']) ){
	
			$method =$_POST['_method'];
	}
	if($method==='GET' && isset($_GET['_method']) ){
		$method =$_GET['_method'];
	}

switch(strtoupper($method)){
	
	case "GET":
			
			$url = $_SERVER['REQUEST_URI'];
			
			$url_parts= explode('/',$url);
			//$task->files_in_Directory();
			
			
			if(isset($url_parts[5])){
				
				$stmt = $task->tasks_upcomingweek();
				$task_arr["no_upcoming_tasks"] =$stmt->rowCount();
			}else{
				$stmt = $task->read();
			}
			
			$num = $stmt->rowCount();
			//print_r($url_parts);
			if($num>0){
				$task_arr["tasks"] = array();
				while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					
					$task_item = array(
						"id"=> $id,
						"title" => $title,
						"description" => $description,
						"status" => $status,
						"due" => $due,
						"created_at" =>$created_at						
					);
					array_push($task_arr["tasks"], $task_item);
					
				}
				http_response_code(200);
				echo json_encode($task_arr);
			}else{
				//http_response_code(404);
				echo json_encode(array(  "tasks"=> [],"messages"=>"No Tasks found."));
			}
			break;
	case "POST":
			$data = (object) $_POST;
			//$data =   file_get_contents("php://input");
		
		
			if(!empty($data->title)   ){
				$task->title=$data->title ;
				$task->description=$data->description;
				$task->status=$data->status ;
    
				$task->due=$data->completion;
				$task->created_at= date('Y-m-d H:i:s');
				 $lastID = $task->create() ;
				 
				if($lastID>0){
					http_response_code(201);
					$taskadded = array();
					
					$taskadded["messages"] ="task was created.";
					$taskadded["data"] = array(
						"id" => $lastID,
						"title"  => $task->title,
						"description" => $task->description,
						"status" => $task->status,
						"due" => $task->due,
						"created_at" => $task->created_at
					);
					echo json_encode($taskadded);

				}else{
					http_response_code(503);
					echo json_encode(array("messages"=>"Unable to create task."));

				}
			}else{
				http_response_code(400);
				echo json_encode(array("messages"=>"Unable to create task. Data is incomplete"));
			}
			break;
	case "PUT":
			
			$updated_task = (object) $_POST;
			$taskEdit = array();
				$task = new Task($db);
				$task->title=$updated_task->title ;
				$task->description=$updated_task->description;
				$task->status=$updated_task->status ;    
				$task->due=$updated_task->completion;
				$task->id= $updated_task->taskid ;
				
			
		
			
			if($task->update_task()){
				$taskEdit["messages"] = "Information updated sucessfully ";
				
			}else{
					http_response_code(503);
					$taskEdit["messages"]="Unable to Update task.";

				}
			echo json_encode($taskEdit);
			break;
	case "DELETE":
			
			$delete_task = (object) $_GET ;
			$taskDelete["messages"] = array();
			if($task->Delete_task($delete_task->taskID)){
				$taskDelete["messages"] = "Task ". $delete_task->taskID ." was deleted";
				echo json_encode($taskDelete);
			}else{
					http_response_code(503);
					echo json_encode(array("messages"=>"Unable to Delete task."));

				}
			
			break;
}
?>
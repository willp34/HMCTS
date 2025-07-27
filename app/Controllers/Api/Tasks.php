<?php  

 namespace  App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use App\Controllers\BaseController;
use App\Models\TaskModel;
use CodeIgniter\API\ResponseTrait;
use DateTime;
class Tasks extends ResourceController
{
	use ResponseTrait; 
	protected $newTask ;
	
	
	public function __construct(){
		$this->newTask = new TaskModel();
	}
	public function create(){
		
		
		try {
			$data = $this->request->getJSON(true);
			
			
			
			// Try converting date format (dd-mm-yyyy or yyyy-mm-dd)
			$date = DateTime::createFromFormat('m/d/Y', $data['completion']);
					
			
			$mysqlFormattedDate = $date->format('Y-m-d');
			
			$taskCreated =  date('Y-m-d H:i:s');
			$title = $data['title'];
			$description = $data['description'];
			$status = $data['status'];
			$task_due = $mysqlFormattedDate  ;
			$created_at = $taskCreated;
			
		     //var_dump($data);
			$lastTaskID = $this->newTask->insert([
						
						"title"  => $title,
						"description" => $description,
						"status" => $status,
						"due" => $task_due,
						//"created_at" => $created_at
					] );
					
				
			if($lastTaskID>0){	
				http_response_code(201);
				
				$taskadded = array();
				$taskadded["messages"] ="task was created.";
					$taskadded["data"] = array(
						"id" => $lastTaskID,
						"title"  => $title,
						"description" => $description,
						"status" => $status,
						"due" => $task_due,
						"created_at" => $created_at
					);
				return $this->respondCreated( $taskadded);
			}else{
					http_response_code(503);
					echo json_encode(array("messages"=>"Unable to create task."));

				}
		} catch (\CodeIgniter\HTTP\Exceptions\HTTPException $e) {
			return $this->response->setJSON([
				'error' => 'Invalid JSON: ' . $e->getMessage()
			])->setStatusCode(400);
		}
		
		
	}
	
	public function bulkAdd(){
		
		$data = $this->request->getJSON(true);
		
		
		return $this->respondCreated( array("messages"=>$data));
		//echo json_encode(array("messages"=>$data));
	}
	
	public function editTask($taskID)
	{
		$data = $this->request->getJSON(true);
	
		
		$date = DateTime::createFromFormat('m/d/Y', $data['completion']);
					
			
			$mysqlFormattedDate = $date->format('Y-m-d');
			
			$taskCreated =  date('Y-m-d H:i:s');
			$title = $data['title'];
			$description = $data['description'];
			$status = $data['status'];
			$task_due = $mysqlFormattedDate  ;
			$created_at = $taskCreated;
		
		
		
		
		$this->newTask->update($taskID, [
						
						"title"  => $title,
						"description" => $description,
						"status" => $status,
						"due" => $task_due,
						//"created_at" => $created_at
					] );
		$taskEdited["messages"] = "Task " . $taskID . " was edited";
				return $this->respondUpdated($taskEdited);
	}
	
	public function  deleteTask($taskID){
		
		
		$taskDelete = array();
		
			if ($this->newTask->delete($taskID)) {
				$taskDelete["messages"] = "Task " . $taskID . " was deleted";
				return $this->respondDeleted($taskDelete); // use respondDeleted if it's a DELETE operation
			} else {
				http_response_code(503);
				$taskDelete["messages"] = "Unable to delete task.";
				return $this->respond($taskDelete, 503);
			}
		
	}
	
	public function getTasks(){
		$data = $this->request->getJSON(true);
		
		$tasks = $this->newTask->getAllTasks();
		
		return $this->respondCreated(['tasks' => $tasks]);
		
	}
	
	
	public function upcoming_week(){
		$data = $this->request->getJSON(true);
		
		$tasks = $this->newTask->tasks_upcomingweek();
		
		return $this->respondCreated(['tasks' => $tasks]);
		
	}
}
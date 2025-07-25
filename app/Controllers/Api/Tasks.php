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
	
	public function  deleteTask($taskID){
		
		echo  "Task Id  $taskID ";
	}
	
	public function getTasks(){
		$data = $this->request->getJSON(true);
		
		$tasks = $this->newTask->getAllTasks();
		
		return $this->respondCreated(['tasks' => $tasks]);
		
	}
}
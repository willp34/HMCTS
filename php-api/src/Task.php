<?php
	

	class Task {
		private $conn;
		private $table_name = "tasks";
		
		public $id;
		public $title;
		public $description;
		public $due;
		public $status ;
		public $created_at;
		
		public function __construct($db){
			
			$this->conn = $db;
		}
		
		public function read($id=-1){
		
				$this->markOverdueTasks() ; 
			$query = "SELECT * FROM ". $this->table_name. " where due  > CURDATE()   ORDER BY created_at";
			if($id >0){
				$query = "SELECT * FROM ". $this->table_name. " where id=:id ORDER BY created_at";
			}
			$stmt = $this->conn->prepare($query);
			if($id >0){
				$id=htmlspecialchars(strip_tags($id));
			
				$stmt->bindParam(":id",$id );
			}
			
			
			
			$stmt->execute();
			
			return $stmt;			
			
		}
		
		public function create($user_arr=array() ){
			$user = array();
			
					if(!$user_arr){
						
						$user_arr= array(
							"title"=> $this->title,
							"description" =>$this->description,
							"status" =>$this->status,
							"due" => $this->due,
							"created_at" =>$this->created_at );
							
							
						$this->title = htmlspecialchars(strip_tags($user_arr["title"]));
						$this->description=htmlspecialchars(strip_tags($user_arr["description"]));
						$this->status=htmlspecialchars(strip_tags($user_arr["status"]));
						$this->due=htmlspecialchars(strip_tags($user_arr["due"]));
						$this->created_at=htmlspecialchars(strip_tags($user_arr["created_at"]));
							
							
					}
			// Try converting date format (dd-mm-yyyy or yyyy-mm-dd)
			$date = DateTime::createFromFormat('m/d/Y', $this->due);
					
			
			$mysqlFormattedDate = $date->format('Y-m-d');
			
			$query = "INSERT INTO ".$this->table_name. " SET  title=:title, description=:description,status=:status, due=:date_due, created_at=:created_at";
			$stmt  = $this->conn->prepare($query);
			
			
			$stmt->bindParam(":title",$this->title );
			$stmt->bindParam(":description", $this->description);
			$stmt->bindParam(":status", $this->status);
			$stmt->bindParam(":date_due", $mysqlFormattedDate);
			$stmt->bindParam(":created_at", $this->created_at);
	
		   
			if($stmt->execute()){
				 $lastId =  $this->conn->lastInsertId();
				return $lastId;
			}
			
			return false;
		}
		
		public function update_task(){
			$query = "UPDATE ".$this->table_name. " SET  title=:title, description=:description, status =:status , due=:date_due WHERE id=:id ";
			$taskID=  (int)$this->id  ;
			$stmt  = $this->conn->prepare($query);
		
		   
			// Try converting date format (dd-mm-yyyy or yyyy-mm-dd)
			$date = DateTime::createFromFormat('m/d/Y', $this->due);
					
			
			$mysqlFormattedDate = $date->format('Y-m-d');
			
			//echo $this->due."   $date   formatted date ". $mysqlFormattedDate ;
			$stmt->bindParam(":title",$this->title );
			$stmt->bindParam(":description", $this->description);
			$stmt->bindParam(":status", $this->status);
			$stmt->bindParam(":date_due", $mysqlFormattedDate);
			$stmt->bindParam(":id",$taskID, PDO::PARAM_INT );
			if($stmt->execute()){
				return true;
			}
			
			return false ;
			
		}
		public function Delete_task($taskID){
			$query = "DELETE FROM ".$this->table_name. " WHERE id=:id";
			$stmt  = $this->conn->prepare($query);
			$id = (int)$taskID;
			$stmt->bindParam(':id',$id, PDO::PARAM_INT );

			if($stmt->execute()){
				return true;
			}
			
			return false;
		}
		
		public function tasks_upcomingweek(){
			
			$query = "SELECT * FROM " . $this->table_name . " 
                  WHERE due BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY) 
                  ORDER BY due ASC";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			
			return $stmt;	
			
		}
	
	public function markOverdueTasks() {
		$query = "UPDATE " . $this->table_name . " 
				  SET status = 'Over due' 
				  WHERE due < CURDATE() 
				  AND status != 'completed' 
				  AND status != 'Over due'";

		$stmt = $this->conn->prepare($query);

		
			if ($stmt->execute()) {
				return $stmt->rowCount(); // number of tasks marked as overdue
			} else {
				
				return $stmt->errorInfo();
			}
		
}

	private function read_file($file_to_read){
	  $file = fopen($file_to_read,"r");
			if($file){
				
				while(($line =fgets($file)) !==false){
					//echo  "line:   $line  <br />";
					$Data= explode(',',$line);
					$userData =  array(
							"name"=> $Data[0],
							"email" =>$Data[1],
							"created_at" =>date('Y-m-d H:i:s')
							 );
					
					$this->create($userData);
				}
				fclose($file);
			}else{
				echo "Unable to open file.<br />";
			}
	
	}
	

		
	}
?>
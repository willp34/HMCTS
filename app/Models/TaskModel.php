<?php 

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
	protected $table = "tasks";
	protected $primaryKey= 'id';
	protected $returnType = 'array';
	protected $allowedFields = ['title','description', 'status', 'due', 'created_at'];
	protected $useTimestamps = true;
	
	
	
	 // Get teams user belongs to
   
	
	
	
	public function getAllTasks(){
		
		$records =$this->select('*')->findAll();
		return $records;	  
	}
	

	

}
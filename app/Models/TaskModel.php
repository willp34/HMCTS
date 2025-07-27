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
   
	
	
	
	public function getAllTasks()
{
    $currentDate = date('Y-m-d'); // or 'Y-m-d H:i:s' if your column has time
      $records = $this->select('*')  // specify only required fields
                    ->where('due >', $currentDate)
                    ->findAll();

    return $records;
}
	
	
	
	public function tasks_upcomingweek()
{
    $today = date('Y-m-d');
    $nextWeek = date('Y-m-d', strtotime('+7 days'));

    return $this->where('due >=', $today)
                ->where('due <=', $nextWeek)
                ->orderBy('due', 'ASC')
                ->findAll();
}

	

}
<?php

namespace App\Controllers;
use App\Models\UserModel;
class Home extends BaseController
{
    public function index()
    {
	
		$data['js']= array("jquery/jquery.min.js","src/Process_request.js","Validate_registrationform.js"  ) ; 
        $this->template('home',$data);
    }
	
	public function bulkAdd(){
		$data['js'] = array("jquery/jquery.min.js","jquery/jquery.cookie.js","logonForm.js");
		$this->template('bulkAdd',$data);
	}
	
	
	
	
	
}

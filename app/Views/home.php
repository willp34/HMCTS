

<div class="container mt-5">
 
   
		
	<h1>Ministry of Justice Demo </h1>
	
	<h3>HMCTS case management system</h3>
	 
	 <button class="btn btn-primary" id="show-tasks" >Add Task</button>
	 <div class="row">
	 <div id="task-display">
	 
		 <form class="process"  action ="<?php echo base_url()?>index.php/api/addTask" method="post"   >
					<fieldset>
						<legend> Add Task </legend>
							<div   class="form-group">
									<label>Title:</label>
									<input class="form-control" type="text" name="title" id= "title" required   >
									</div>
									<div class="form-group">
									  <label for="description">Description:</label>
									  <textarea class="form-control" rows="5" name="description" id="description" required ></textarea>
									</div>
									
									
									<div class="form-group">
									  <label for="sel1">Select list:</label>
									  <select class="form-control" name="status" id="status">
										<option value="To Do" selected>To Do</option>
										<option  value="In Progress">In progress</option>
									  </select>
									</div>
								
									
									 <label for="date" class="col-1 col-form-label">Date of Completion:</label>
										<div class="col">
										  <div class="input-group date datepicker">
											<input type="text" class="form-control" name="completion" id="completion" placeholder="Date Completion" />
											<span class="input-group-append">
											  <span class="input-group-text bg-light d-block">
												<i class="fa fa-calendar"></i>
											  </span>
											</span>
										  </div>
										</div>
								
							
					</fieldset>
						 
						<input type="hidden" name="_method" id="_method" value="POST" disabled>
						<input type="hidden" name="taskid"  id="taskID"   disabled>
						<input type="hidden" name="row_task_id" id="row_task_id" disabled>
						<input class="btn  btn-primary" TYPE="submit" value="Create/ Update Task" name="submit"  >
			</form>
		</div>
		<br />
	 <br />
	 <div id="dialog" ></div>
				 
	 
	 
	 
 	<table  id="hmct_data_table" class="table table-striped " style="width:100%" >
	
	</table>
	
	</div>
  </div>
</div>



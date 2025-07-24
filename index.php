
<html>
<head>
	<link rel="stylesheet" href="assets/css/datatables.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/main.css">
	
</head>
<body>

	<header >
				<nav class="navbar navbar-default">
				  <div class="container-fluid">
					<div class="navbar-header">
					  <a class="navbar-brand" href="#">MoJ Demo</a>
					</div>
					<ul   id="navbar-items" class="nav navbar-nav">
					  <li class="active"><a href="#">Home</a></li>
					  <li><a href="#">Page 1</a></li>
					  <li><a href="#">Page 2</a></li>
					
					</ul>
				  </div>
				</nav>
		</header>
	
	<div class="container">
	

	<h1>Ministry of Justice Demo </h1>
	
	<h3>HMCTS case management system</h3>
	 
	 <button class="btn btn-primary" id="show-tasks" >Add Tasck</button>
	 
	 <div id="task-display">
		 <form class="process"  action ="php-api/api/index.php" method="post"   >
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
										  <div class="input-group date" id="datepicker">
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
				 
	 
	 
	 
	 	<table  id="hmct_data_table" class="table table-striped table-dark" style="width:100%" >
	
	</table>
	
	</div>
		

	
     
	

<footer id="mdb-footer" class="bg-light text-center p-3 fixed-bottom shadow">
  <div class="container">
    <p class="mb-2">
      Get useful tips &amp; free resources directly to your inbox along with exclusive subscriber-only content.
    </p>
    <a href="https://mdbootstrap.com/newsletter/" class="btn btn-primary">
      JOIN OUR MAILING LIST NOW <i class="fas fa-angle-double-right ms-2"></i>
    </a>
  </div>
  <div class="text-center pt-2 small text-muted">
    © 2023 <a href="https://mdbootstrap.com/" class="text-reset"><strong>MDBootstrap.com</strong></a>
  </div>
</footer>



	<!--  Modal --->
	
	<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labellbedby="taskModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h2 class="modal-title" id="taskModalLabel">Add Task </h2>
				<button type="button" class="close"  data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times </span>
				</button>
				</div>
				
						
				<div class="modal-body">
							
								<form class="process_edit"  action ="php-api/api/index.php" method="post"   >
							<fieldset>
								
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
												  <div class="input-group date" id="datepicker">
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
							
								<input class="btn  btn-primary" TYPE="submit" value="Create/ Update Task" name="submit"  >
					</form>
				</div>
				<div   class="modal-footer">
					
				</div>
			
			</div>
		</div>
	
	</div>       

</body>
<script type="text/javascript"  src="assets/js/jquery/jquery.min.js"  > </script>
<script type="text/javascript"  src="assets/js/datatables.min.js"  > </script>
<script type="text/javascript"  src="assets/js/bootstrap.min.js"  > </script>
<!-- Bootstrap 5 JavaScript Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript"  src="assets/js/homepage.js"  > </script>

</html>



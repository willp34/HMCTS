
	</div>
</div>

<div class="mt-5 p-4 bg-dark text-white text-center">
  <p>Footer</p>
</div>




<!--  Modal --->
	
	<div class="modal fade" id="taskModal" >
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

<!-- Bootstrap 5 JavaScript Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript"  src="assets/js/homepage.js"  > </script>
</html>


<div class="container mt-5">
 
   
		
	<h1>Ministry of Justice Demo </h1>
	
	<h3>HMCTS case management system</h3>
	 
	
	 <div class="row">
	
	 <div id="dialog" ></div>
				 
	 
	 <form method="post" action="save.php">
		  <table id="bulk_table" class="table table-striped " style="width:100%">
			<thead>
			  <tr>
				<th>ID</th>
				<th>Title</th>
				<th>Description</th>
				<th>Status</th>
				<th>Completed by</th>
				<th>Action</th>
			  </tr>
			</thead>
			<tbody>
					<tr>
						<td></td>
						<td><input class="form-control" type="text" name="rows[0]['title']" id= "title" required   ></td>
						<td><textarea class="form-control" rows="5" name="rows[0]['description']" id="description" required ></textarea></td>
						<td><select class="form-control" name="status" id="rows[0]['status']">
										<option value="To Do" selected>To Do</option>
										<option  value="In Progress">In progress</option>
									  </select></td>
						<td>
						
						  <div class="input-group date datepicker">
											<input type="text" class="form-control" name="rows[0]['completion']" id="completion" placeholder="Date Completion" />
											<span class="input-group-append">
											  <span class="input-group-text bg-light d-block">
												<i class="fa fa-calendar"></i>
											  </span>
											</span>
										  </div></td>
										  <td><button type="button" class="removeRow">Remove</button></td>
					</tr>
			</tbody>
		  </table>

			  <br>
			  <button class="btn btn-primary" type="button" id="addRow">+ Add New Row</button>
			  <br><br>
			  <input class="btn btn-primary" type="submit" value="Save Changes">
			</form>
	 
 	
	
	</div>
  </div>
</div>



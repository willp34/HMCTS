

<div class="container mt-5">
 
   
		
	<h1>Ministry of Justice Demo </h1>
	
	<h3>HMCTS case management system</h3>
	 
	
	 <div class="row">
	
	 <div id="dialog" ></div>
				 
	 
	<form id="bulkForm">
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
						<td><input class="form-control row-title" type="text"  required   ></td>
						<td><textarea class="form-control row-description " rows="5"  required ></textarea></td>
						<td><select class="form-control  row-status" >
										<option value="To Do" selected>To Do</option>
										<option  value="In Progress">In progress</option>
									  </select></td>
						<td>
						
						  <div class="input-group date datepicker">
											<input type="text" class="form-control row-completion"  placeholder="Date Completion" />
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
</div>
			  <br>
			  <button class="btn btn-primary" type="button" id="addRow">+ Add New Row</button>
			  <br><br>
			  <input class="btn btn-primary"  type="submit" id="saveChanges" value="Save Changes">
		
	 </form>
 	
	
	
  </div>
</div>



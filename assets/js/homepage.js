jQuery(document).ready(function () {
	
	
	
	
	handleAjaxRequest("GET", "php-api/api/index.php/upcoming_tasks", null, true, function (response) {
		
		
		let upcoming_tasks = response.tasks;
		 if (upcoming_tasks && upcoming_tasks.length > 0) {
		  let dropdown = `
			<li class="nav-item dropdown">
			  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"  role="button" data-bs-toggle="dropdown">
				Upcoming Tasks ( ${upcoming_tasks.length} )
			  </a>
			  <ul class="dropdown-menu">`;
		  // Add each submenu item from query result
		  upcoming_tasks.forEach(item => {
			dropdown += `<li><a class="dropdown-item" href="#">${item.title}</a></li>`;
		  });

		  dropdown += `</ul></li>`;

		  jQuery('#navbar-items').append(dropdown);
			 
		 }
	
              
        });
	
	
	
	jQuery(function() {
        jQuery('#datepicker').datepicker();
    });
    // Initialize DataTable
    new DataTable("#hmct_data_table", {
        ajax: {
				url: '../../HMCTS/php-api/api/index.php',
				dataSrc: 'tasks',
				error: function (xhr) {
				  console.error('AJAX Error:', xhr.status, xhr.responseText);
				}
		},
        columns: [
            { title: "Id", data: 'id' },
            { title: "Title", data: 'title' },
            { title: "Description", data: 'description' },
            { title: "Status", data: 'status' },
			{ title: "Completed by" , data: 'due' },
            { title: "TimeStamp", data: 'created_at' },
            {
                title: "Edit", className: 'edit-column', data: 'id',
                render: function (data) {
                    return `<button class="btn btn-primary taskAction" data-toggle="modal" data-target="#taskModal" data-action="Put">Edit</button>`;
                }
            },
            {
                title: "Delete", data: 'id',
                render: function (data) {
                    return `<button class="btn btn-danger taskAction" data-action="Delete" data-uid="${data}" id="userDelete">Delete</button>`;
                }
            }
        ],
        fnRowCallback: function (row, data) {
            row.setAttribute('id', data.id);
        },
        dom: 'Bfrtip',
        buttons: ['edit']
    });

    

  jQuery("#show-tasks").click(function(){
	
	 jQuery("#task-display").toggle();
	 
	 
	 jQuery("#taskID").prop('disabled', true);
		jQuery(".modal-body  #_method").prop('disabled', false);
		jQuery('.modal-body  #_method').val("PUSH");
		
		jQuery('.modal-body  #taskID').val("");
        jQuery('.modal-body  #title').val("");
        jQuery('.modal-body  #description').val("");
        jQuery('.modal-body  #status').val("");
		jQuery('.modal-body  #completion').val("");
 } );
    // Event delegation for processing user actions
    jQuery(document).on("click", ".taskAction",task_action );
	
	function task_action() {
        const action = jQuery(this).data("action");
        const rowElement = jQuery(this).closest('tr');
      
		 
        if (action === "Put") {
			
			
            handleEditAction(rowElement);
        } else if (action === "Delete") {
			console.log("delete");
            handleDeleteAction(rowElement);
        }
    }
	
	    // Form submission for input
    jQuery(".process_edit").on("submit",update_task );
	
	
	function update_task(e) {
			e.preventDefault();
			 let taskId = jQuery(' .modal-body #taskID').val(); // ✅ GET ROW ID HERE
			//const formData = new FormData();
		
			const formData = jQuery(this).serialize();
			console.log("Data "+formData);
			const actionUrl = jQuery(this).attr("action");
			handleAjaxRequest("POST", actionUrl, formData, false, function (response) {
					   
			const resultsContainer = jQuery(" #dialog");
			resultsContainer.html("");
			const successContent = `<div class="alert alert-success">${response.messages} </div>`;

			
            resultsContainer.append(successContent);
				
						let table = jQuery("#hmct_data_table").DataTable();
						let row = table.row('#'+taskId); // assumes <tr id="row-21">
						let rowData = row.data();
						console.log("row data  "+rowData+"   "+jQuery('  .modal-body #title').val());
						//set values
						
						rowData.title = jQuery(' .modal-body #title').val();
						rowData.description = jQuery(' .modal-body #description').val();
						
						rowData.status = jQuery(' .modal-body #status').val();
						rowData.due = jQuery(' .modal-body #completion').val();
						row.data(rowData).draw(false);
						
						
					
			});
	}
	
    // Form submission for input
    jQuery(".process").on("submit",Add_task );
	function Add_task(e) {
			e.preventDefault();
			 let taskId = jQuery('#taskID').val(); // ✅ GET ROW ID HERE
			//const formData = new FormData();
		
			const formData = jQuery(this).serialize();
			console.log("Data "+formData);
			const actionUrl = jQuery(this).attr("action");
			handleAjaxRequest("POST", actionUrl, formData, false, function (response) {
					   
			const resultsContainer = jQuery(" #dialog");
			resultsContainer.html("");
			const successContent = `<div class="alert alert-success">${response.messages} </div>`;
			resultsContainer.append(successContent);
			
			
			
			// Add to data tables
			
			
			   let table = jQuery('#hmct_data_table').DataTable(); // Use your actual table ID
				  table.row.add({
					id: response.data.id,
					title: response.data.title,					
					description: response.data.description,
					status: response.data.status,
					due : response.data.due,
					created_at:response.data.created_at,
					  actions: `'<button class="btn btn-primary taskAction" data-toggle="modal" data-target="#taskModal" data-action="Put">Edit</button>',
					'<button class="btn btn-danger taskAction" data-action="Delete" data-uid="555" id="userDelete">Delete</button>'`
				  }).draw(false);
				  
				  
				  
				  // crear fields 
				  
				  jQuery('.process  #taskID').val("");
					jQuery('.process  #title').val("");
					jQuery('.process  #description').val("");
					jQuery('.process #status').val("");
					jQuery('.process  #completion').val("");
				  
				  
				  });
		  
		}


    // Handle Edit Action
    function handleEditAction(rowElement) {
		
		let rowId = rowElement.attr('id'); // "row-21"
		let taskId = rowId.replace('row-', '');  
        let rowData = rowElement.children('td').map(function () {
            return jQuery(this).text();
        }).get();
		console.log("data ",rowData);
		
	
		jQuery(" .modal-body #taskID").prop('disabled', false);
		jQuery(".modal-body  #_method").prop('disabled', false);
		jQuery('.modal-body  #_method').val("PUT");
		jQuery('.modal-body  #taskID').val(rowData[0]);
        jQuery('.modal-body #title').val(rowData[1]);
        jQuery('.modal-body  #description').val(rowData[2]);
        jQuery('.modal-body  #status').val(rowData[3]);
		let rawDate = rowData[4]; // e.g. "2025-07-30"
				let dateObj = new Date(rawDate);

				let month = String(dateObj.getMonth() + 1).padStart(2, '0'); // 0-indexed
				let day = String(dateObj.getDate()).padStart(2, '0');
				let year = dateObj.getFullYear();

				let formatted = `${month}/${day}/${year}`; // "07/30/2025"
			jQuery('.modal-body  #completion').val(formatted);
		
		
		// get row id
		jQuery('#row_task_id').val(taskId);
		
      



	
    }

    // Handle Delete Action
    function handleDeleteAction( rowElement) {
          const rowData = rowElement.children('td').map(function () {
            return jQuery(this).text();
        }).get();
		const deleteData = "_method=Delete&taskID="+rowData[0];
		console.log("Delet action");
        handleAjaxRequest("GET", "php-api/api/index.php", deleteData, true, function (response) {
            console.log("Delete Response:", response);
			 const resultsContainer = jQuery(" #dialog");
			resultsContainer.html("");
			   const successContent = `<div class="alert alert-success">${response.messages} </div>`;
			  
            resultsContainer.append(successContent);
            rowElement.remove();
        });
	
    }

    // General AJAX request handler
    function handleAjaxRequest(method, url, data, processData = true, successCallback) {
        jQuery.ajax({
            type: method,
            url: url,
            data: data,
            //contentType: "application/json",
            dataType: "json",
            success: successCallback,
            error: function (xhr, status, error) {
                console.error('Error ',xhr.status ,' : ',status,' ' );
            }
        });
    }

    // Generate Response UI
    function generate_response(response) {
        if (!response) {
          
            return;
        }

        const resultsContainer = jQuery(" #dialog");
        resultsContainer.html("");

        if (response.errors) {
            const errorContent = `<div class="alert alert-danger"><ul>${response.errors.map(error => `<li>${error}</li>`).join('')}</ul></div>`;
            resultsContainer.append(errorContent);
        }

        if (response.records) {
            const successContent = `<div class="alert alert-success">${response.records} ${response.execution_time}</div>`;
            resultsContainer.append(successContent);
        }

        if (response.content) {
            jQuery(" #Dolphin_table_results").html(response.content);
        }
    }
});

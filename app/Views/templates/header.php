<!DOCTYPE html>
<html>
<head>
	
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="http://localhost/HMCTS/public/assets/css/datatables.min.css">
  
  
	<link rel="stylesheet" href="http://localhost/HMCTS/public/assets/css/main.css">
	
</head>
<body>

	<header >
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
				  <div class="container-fluid">
					<a class="navbar-brand" href="#">MoJ Demo</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarItems" aria-controls="navbarItems" aria-expanded="false" aria-label="Toggle navigation">
					  <span class="navbar-toggler-icon"></span>
					</button>
					
					<div class="collapse navbar-collapse"id="navbarItems">
					  <ul id="navbar-items"   class="navbar-nav me-auto mb-2 mb-lg-0" >
						<li class="nav-item">
						  <a class="nav-link active" aria-current="page" href="#">Home</a>
						</li>
						<li class="nav-item">
						  <a class="nav-link" href="<?php echo base_url()?>index.php/bulkAdd">Add multiple tasks</a>
						</li>
						<li class="nav-item">
						  <a class="nav-link" href="#">Page 2</a>
						</li>
					  </ul>
					</div>
				  </div>
				</nav>
		</header>

<div class="container mt-5">
  <div class="row">
			<div id="Show-Messages"></div>
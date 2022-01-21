<?php

session_start();
include_once 'functions.php';
if (isset($_SESSION['host']) && isset($_SESSION['host_id'])) {
	if ($_SESSION['host'] !== get_ip() || $_SESSION['auth'] == false) {
		$_SESSION['host'] = null;
		$_SESSION['auth'] = false;
		$location = get_url('index.php');
		header("Location: $location");
	  	exit;
	}
}
else {
	$location = get_url('index.php');
	header("Location: $location");
	exit;
}

include_once 'header.php';

if (isset($_GET['sort'])) {
	$_SESSION['sort'] = $_GET['sort'];
}

?>

	<DIV class="content">
		<DIV class="container">
			<div class="row page_header">	
				<ul>	
					<li><h3><i class="bi bi-list-task"></i> Все заявки   </h3></li>
					<li><hr></li>
				</ul>	
			</div>	
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="<?php echo get_url('modules/mytickets.php') ?>">Все заявки</a></li>
				  </ol>
				</nav>
			</div>
			<div class="row">
				<div class="col-auto">
					<div class="dropdown">
					  <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
					    Сортировать
					  </button>
					  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
					    <li><a class="dropdown-item" href=" <?php echo get_url('modules/mytickets.php');?>?sort=date">по дате</a></li>
					    <li><a class="dropdown-item" href="<?php echo get_url('modules/mytickets.php');?>?sort=priority">по приоритету</a></li>
					    <li><a class="dropdown-item" href="<?php echo get_url('modules/mytickets.php');?>?sort=category">по категориям</a></li>
					    <li><a class="dropdown-item" href="<?php echo get_url('modules/mytickets.php');?>?sort=status">по статусу заявки</a></li>
					    <?php if (get_client_id($_SESSION['host']) == 'admin') { 
					    	echo '<li><hr class="dropdown-divider"></li><li><a class="dropdown-item" href="' . get_url('modules/mytickets.php') . '?sort=author">по автору</a></li>';

					    } ?>
					  </ul>
					</div>	
				</div>	
				<div class="col-auto">
<!-- 					<div class="row g-3 align-items-center">
					  <div class="col-auto"> -->
					  	<div class="row">
					  		<div class="col-auto">
					  			<input type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
					  		</div>
					    	<div class="col">
					    		<button type="submit" class="btn btn-sm btn-secondary">Найти</button>
					    	</div>					  		
					  	</div>
					    
<!-- 					  </div>
					</div> -->
				</div>	
				<hr class="shortline">	
			</div>		
			<?php include_once 'oneticket.php'; ?>	
				<!-- Ticket -->

					

				<!--  -->
		</DIV>
	</DIV>
	<script type="text/javascript">
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  			return new bootstrap.Tooltip(tooltipTriggerEl)
		})
	</script>
	<script type="text/javascript" src="<?php echo get_url("js/setpriority.js")?>"></script>
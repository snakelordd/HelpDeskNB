<?php

session_start();

$_SESSION['success'] = '';
include_once 'functions.php';
if (isset($_SESSION['host']) && isset($_SESSION['host_id'])) {

	if ($_SESSION['host'] !== get_ip() || $_SESSION['auth'] == false) {
		
		//$_SESSION['host'] = null;
		//$_SESSION['auth'] = false;
		$location = get_url('index.php');
		//header("Location: $location");
	  	//exit;
	}
	else {
		$host_id = $_SESSION['host_id'];
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
		<DIV class="container" id="container">
			<div id="modalclose">
				
			</div>
			<div class="row page_header">	
				<ul>	
					<li><h3><i class="bi bi-list-task"></i> Все заявки   </h3></li>
					<li><hr></li>
				</ul>	
			</div>	
			<div class="row ">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="<?php echo get_url('modules/mytickets.php'); ?>">Все заявки</a></li>
				  </ol>
				</nav>
			</div>
			<div class="row">
				<div class="col">
					<?php if ($_SESSION['message'] == 'success') 
					{
					 	//tab_advice('Заявка успешно создана. Статус заявки можно посмотреть здесь', '<i class="bi bi-check-square-fill"></i>');
					 	//$_SESSION['message']=''; 
					} ?>
				</div>
			</div>
			<div class="row d-flex justify-content-between align-items-start mb-4">
				<div class="col-auto">
					<div class="row">
						<div class="col">
							<div class="dropdown">
							  <button class="btn btn-light dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
							    <?php 

							    if (isset($_SESSION['show'])) {
							    	$show = $_SESSION['show'];
							    }
							    else {
							    	$_SESSION['show'] = 'opened';
							    	$show = $_SESSION['show'];
							    }			    
							    if (isset($_GET['show'])) {
							    	$_SESSION['show'] = $_GET['show'];
							    	$show = $_GET['show'];
							    }
							    
							    
							    switch ($show) {
							    	case 'opened':
							    		$show = 'Открытые запросы';
							    		break;
							    	case 'closed':
							    		$show = 'Закрытые запросы';
							    		break;
							    	case 'all':
							    		$show = 'Все запросы';
							    		break;	
							    	default:
							    		$show = 'Открытые запросы';
							    		break;
							    }
							    
							    
							    echo $show;
							    ?>
		
							  </button>
							  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
							    <li><a class="dropdown-item" href="?show=opened">Открытые запросы</a></li>
							    <li><a class="dropdown-item" href="?show=closed">Закрытые запросы</a></li>
							    <li><hr class="dropdown-divider"></li>
							    <li><a class="dropdown-item" href="?show=all">Все запросы</a></li>
							  </ul>
							</div>
						</div>
						<div class="col">
								<div class="dropdown">
								  <button class="btn btn-light dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
								    Сортировать
								  </button>
								  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								    <li><a class="dropdown-item" href=" <?php echo get_url('modules/mytickets.php');?>?sort=date">по дате</a></li>
								    <li><a class="dropdown-item" href="<?php echo get_url('modules/mytickets.php');?>?sort=priority">по приоритету</a></li>
								    <li><a class="dropdown-item" href="<?php echo get_url('modules/mytickets.php');?>?sort=category">по категориям</a></li>
								    <li><a class="dropdown-item" href="<?php echo get_url('modules/mytickets.php');?>?sort=status">по статусу заявки</a></li>
								    <?php if (get_client_id($_SESSION['host']) == 'admin') { 
								    	echo '<li><hr class="dropdown-divider"></li><li><a class="dropdown-item" href="' . get_url('modules/mytickets.php') . '?sort=author">по автору</a></li>';
								    	echo '<li><li><a class="dropdown-item" href="' . get_url('modules/mytickets.php') . '?sort=holder">по исполнителю</a></li>';
			
								    } ?>
								  </ul>
								</div>	
						</div>
						<div class="col-auto">
						<div class="row">
							<div class="col-auto">
								<input type="text" class="form-control form-control-sm ticketSearch" id="ticketSearch" name="ticketSearch" aria-describedby="ticketSearch">
							</div>
							<div class="col">
								<button type="submit" class="btn btn-sm btn-light">Найти</button>
							</div>					  		
						</div>  
					</div>	
					</div>
				</div>	
			</div>	
			<div class="alltickets" id="alltickets">
			<?php include_once 'oneticket.php'; ?>	
				<!-- Ticket -->


			</div>
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
	<script type="text/javascript" src="<?php echo get_url("js/script.js")?>"></script>
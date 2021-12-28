<?php include_once 'functions.php'; 
session_start();
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="<?php echo get_url('js/bootstrap.bundle.js') ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_url('css/bootstrap.css') ?>">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_url('css/style.css') ?>">
	<title>Helpdesk</title>
</head>
<body>
<header>
		<div class="container-fluid">
			<div class="row row-cols-auto headerMenu">					
				<div class="col-6">			
					<ul class="TopMenu">						
						<li><a href="<?php echo get_url('index.php'); ?>"><i class="bi bi-house-door"></i> Главная</a></li>
						<li><a href="#"><i class="bi bi-exclamation-square"></i> У меня проблема</a></li>
						<li><a href="#"><i class="bi bi-journal"></i></i> Инструкции </a></li>
						<li><a href="<?php echo get_url('modules/newticket.php'); ?>"><i class="bi bi-plus-square"></i> Создать заявку</a></li>
					</ul>
				</div>
				<div class="col lk">
					<div class="search">
						<!-- <div class="mb-3"> -->
							<input type="Search" class="form-control form-control-sm" id="Search" placeholder="Найти">
						<!-- </div> -->
					</div>
					<div class="nav_lk dropdown">
						<a href="#" class=" dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="bi bi-person"></i>
							<div class="user"><?php echo $_SESSION["host_id"]; ?></div>
							
						</a>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<?php 
							if ($_SESSION["host_id"] == 'admin') {
						    	echo '<li><a class="dropdown-item" href="' . get_url('modules/mytickets.php') . '">Все заявки</a></li>';
						    }
						    else echo '<li><a class="dropdown-item" href="' . get_url('modules/mytickets.php'). '">Мои заявки</a></li>'; 
							?>
						    <li><a class="dropdown-item" href="#">История заявок</a></li>
						    <li><hr class="dropdown-divider"></li>
						    <li><a class="dropdown-item disabled" href="#">Помощь</a></li>
						 </ul>						
					</div>
				</div> 
			</div>
		</div>

</header>




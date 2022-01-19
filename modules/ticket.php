<?php
session_start();
include_once 'header.php';
$ticket = mysqli_fetch_assoc(get_one_ticket($_GET['id']));

?>

<div class="content">
	<div class="container">
			<div class="row page_header">	
				<ul>	
					<li><h3><i class="bi bi-list-task"></i> <?php echo $ticket['ticket_theme']; ?></h3></li>
					<li><hr></li>
				</ul>	
			</div>
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="<?php echo get_url('modules/mytickets.php') ?>">Все заявки</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Заявка #<?php echo $_GET['id']?></li>
				  </ol>
				</nav>
			</div>	
	</div>
</div>
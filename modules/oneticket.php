<?php
include_once 'functions.php';
include_once 'tabs.php';

$result = sortby();

if ($result == 'empty') {
	echo '<div class="row"><div class="col"><p>Заявок не найдено</p></div></div>';
	exit;
}

if (isset($_POST['res'])) {
	$id = $_GET['id'];
	//$id = '39';
	$resolution = $_POST['res'];
	if (isset($_POST['comment'])) {
		$comment = $_POST['comment'];
		if (insert_res($id, $resolution, $comment)) {
			//set_status('Закрыт', $id);		
		}
	}
	else {
		if(insert_res($id, $resolution)) {
			//tab_advice('Заявка успешно закрыта', '<i class="bi bi-check-square-fill"></i>');
			//set_status('Закрыт', $id);
		}
	}
}


//var_dump($result);
while ($row = $result->fetch_assoc())
   {
   	$closed_flag = ' ';
   	$phpdate = strtotime($row['t_date']);
	$normaldate = date( 'H:i  d.m.Y ', $phpdate );
	$actions = '<li ><a class="dropdown-item"  href="">Заблокировать</i> </a> </li>';
   	$ticket_id = $row['ticket_id'];
   	$priority = $row['ticket_priority'];
   	$ticket_priority = $row['ticket_priority'];
   	$ticket_status = $row['ticket_status'];
   	$theme = $row['ticket_theme'];
   	if (strlen($theme) >= 40) {
   		//$theme = mb_substr($theme, 0, 40) . '...';
   		
   	}
	if ($priority == 1 || $priority == 0) {
		$priority = 'low';
 	//$priority = '<i class="bi bi-exclamation-circle low" id="" data-bs-toggle="tooltip" data-bs-placement="top" title="Назначить приоритет"></i>';
 	}
	if ($priority == 2) {
		$priority = 'middle';
 	//$priority = '<i class="bi bi-exclamation-circle-fill middle" id="" data-bs-toggle="tooltip" data-bs-placement="top" title="Назначить приоритет"></i><style>.middle { color: #F1C232;}</style>';
	}
	if ($priority == 3) {
		$priority = 'high';
		//$priority = '<i class="bi bi-exclamation-circle-fill high" id="" data-bs-toggle="tooltip" data-bs-placement="top" title="Назначить приоритет"></i><style>.high { color: #CC0000;}</style>';
	}
	
	if ($ticket_status != 'ОТКРЫТ') {
		$status = 'checked';
	}
	else ($status = 'new');
	if ($ticket_status == 'ЗАКРЫТ') {
		$closed_flag = 'd-none';
		if ($ticket_priority != 0) {	
			set_priority(0, $ticket_id);
		}
		$actions = '<li ' . ajax($ticket_id, 'В РАБОТЕ') . '><a class="dropdown-item"  href="">Возобновить</i> </a> </li>';
	}
	
	switch ($ticket_status) {
		case 'ОТКРЫТ':
			$badge = 'bg-primary rounded-pill';
			break;
		case 'ЗАКРЫТ':
			$badge = 'bg-secondary';
			break;
		case 'ОТЛОЖЕН':
			$badge = 'bg-warning text-dark';
			break;
		case 'ОТКЛОНЕН':
			$badge = 'bg-danger';
			break;	
		case 'В РАБОТЕ':
			$badge = 'bg-success';
			break;	
		default:
			//$badge = 'bg-primary rounded-pill';
			break;
	}
       echo '	

       			<div class="row  ' . $status . '" id="t_' . $row['ticket_id'] . '">
				<div class="col ticket" >
					<p></p>
					<div class="list-group">
						<ul class="ticket list-group" id="">
							<li class="  d-flex justify-content-between align-items-start">
							    <div class="ticket_info">
							    	<div class="row">

							    		<div class="col-auto">
									    	<div class="ticket_id">
									    		<a href="' . get_url('modules/ticket.php') . '?id=' . $row['ticket_id'] . '"><i class="bi bi-tag-fill"></i> Заявка <b>#' . $row['ticket_id']  .  '</b></a> 
									    	</div> 			
							    		</div>

							    	</div>
							    	<div class="row ticket-title ticket_list">
										<a class="' . $status . '"href="' . get_url('modules/ticket.php') . '?id=' . $row['ticket_id'] . '">' .  $theme  .
									'</div>
							    </div>
							    <div>
							    	<div class="row ticket-priority">
							    		
							    		<div class="dropstart col-auto" >

										  <a class=" new" href="#" role="button" id="" data-bs-toggle="dropdown" aria-expanded="false" >
								    		<i class="bi bi-exclamation-circle  priority ' . $priority . '" id="" data-bs-toggle="tooltip" data-bs-placement="top" title="Назначить приоритет" ></i>
								    		<style>
								    			.middle { color: #F1C232;}
								    			.high { color: #CC0000;}
								    		</style>
										  </a>
									
									  		<ul class="dropdown-menu ' . $closed_flag . ' " aria-labelledby="dropdownMenuLink" >
									  			<li ' . ajax($ticket_id, '1') . '><a class="dropdown-item 1"  href="">Низкий</i> </a></li>
									    		<li ' . ajax($ticket_id, '2') . '><a class="dropdown-item 2 "  href="">Средний</i> </a></li>
									   			<li ' . ajax($ticket_id, '3') . '><a class="dropdown-item 3"  href="">Высокий</i> </a> </li>
									  		</ul>
										</div>

										<div class="dropdown col-auto">

										  <a class=" new " href="#" role="button" id="" data-bs-toggle="dropdown" aria-expanded="false">
								    		Действия
										  </a>
									
									  		<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
									  			<li ><a class="dropdown-item"  href="">Подробнее</i> </a></li>
									  			'. $actions .'
									  			<li ><a class="dropdown-item ' . $closed_flag . '"  href="">Назначить задачу</i> </a> </li>
									    		<li ><a class="dropdown-item "  href="">Удалить заявку</i> </a></li>
									   			
									  		</ul>
										</div>

							    		<div class="dropdown col-auto">

										  <a class=" " href="#" role="button" id="" data-bs-toggle="dropdown" aria-expanded="false" onClick="ModalSC(\'' . $ticket_id . '\'); ">
								    		<span class="badge ' . $badge . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Изменить статус заявки"> ' . $ticket_status . '</span>
										  </a>
									
									  		<ul class="dropdown-menu ' . $closed_flag . '" aria-labelledby="dropdownMenuLink">
									  			<li ' . ajax($ticket_id, 'В РАБОТЕ') . '><a class="dropdown-item" href="">В работе</a></li>
									    		<li ><a class="dropdown-item" data-bs-toggle="modal" href="#scm_' . $ticket_id . '" role="button">Закрыт</a></li>
									   			<li ' . ajax($ticket_id, 'ОТЛОЖЕН') . '><a class="dropdown-item" href="">Отложен</a></li>
									   			<li ' . ajax($ticket_id, 'ОТКЛОНЕН') . '><a class="dropdown-item" href="">Отклонен</a></li>
									  		</ul>
										</div>
							    	</div>
							    </div>
							</li>
							<li class="description  d-flex justify-content-between align-items-start">						
									<div class="ticket-date ticket-title ' . $status . '">
									    <div class="row">
									    	<div class="col-auto">
												<div class="date">
													<a href="' . get_url('modules/ticket.php') . '?id=' . $row['ticket_id'] . '"> '  . $normaldate . '</a>
												</div>									    				
									    	</div>
									    	<div class="col-auto">
									    		<div class="ticket-category">
													<i>Категория:</i> <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Все заявки категории">' . $row['ticket_category'] . '</a>
												</div>							
									    	</div>
									    	<div class="col-auto">
									    		<div class="ticket-host">
													<i>Автор:</i> <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Все заявки автора"><b>' . $row['client_id'] . '</b></a>
												</div>							
									    	</div>
									    </div>			    				    		
									</div>
							</li>
							
						</ul>
					</div>
				</div>
			</div>
			
			';
		
		
		if (isset($_GET['setstatus']) && $_GET['ticketid'] || $_POST['']) {
			//if (set_priority($_GET['setpriority'], $_GET['ticketid'])) {
			echo $_GET['setstatus'];
			switch ($_GET['setstatus']) {
				case 'close':
					$setstatus = 'Закрыт';
					break;
				case 'reject':
					$setstatus = 'Отклонен';
					break;
				
				default:
					# code...
					break;
			}
			set_status($setstatus, $_GET['ticketid']);
			//}
			//echo $_GET['setpriority'];

			//$result = sortby();
		}
   }



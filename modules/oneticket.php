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
	if (isset($_POST['resolution_comment'])) {
		$resolution_comment = $_POST['resolution_comment'];
		print_r($resolution_comment);
		if (insert_res($id, $resolution, 'Резолюция заявки', $resolution_comment)) {
			$_SESSION['message'] = 'success';
		}

		
	}
	else {
		if(insert_res($id, $resolution)) {
			$_SESSION['message'] = 'success';
			//tab_advice('Заявка успешно закрыта', '<i class="bi bi-check-square-fill"></i>');
			//set_status('Закрыт', $id);
		}
	}
}


if (isset($_GET['select']) && isset($_GET['param'])) {
	$select = $_GET['select'];
	$param = $_GET['param'];
	$result = select($select, $param);
}

if (isset($_POST['holder'])) {
	$id = $_GET['id'];
	$holder = $_POST['holder'];
	if (isset($_POST['comment_holder'])) {
		$comment_holder = $_POST['comment_holder'];
		if (set_holder($id, $holder, $comment_holder)) {
			$_SESSION['success'] = 1;
		}
	}
	else {
		if (set_holder($id, $holder)) {
			$_SESSION['success'] = 1;
		}
	}
	//set_holder($id, $holder);
}

if (isset($_GET['ticketSearch'])) {
	$query = $_GET['ticketSearch'];
	if (ticket_search($query)!= 'empty') {
		 $result = ticket_search($query);
	}
	else {
		echo 'no result';
	}
}

while ($row = $result->fetch_assoc())
   {
   	$holder_name = '';
   	if (isset($row['ticket_holder'])) {
	   	$holder = get_user($row['ticket_holder']);
	   	$holder = $holder->fetch_assoc();
	   	$holder_name = '  : ' . $holder['client_name'];
	}

   	$closed_flag = ' ';
   	$phpdate = strtotime($row['t_date']);
	$normaldate = date( 'H:i  d.m.Y ', $phpdate );
	$actions = '';
   	$ticket_id = $row['ticket_id'];
   	$priority = $row['ticket_priority'];
   	$ticket_holder = $row['ticket_holder'];
   	$ticket_priority = $row['ticket_priority'];
   	$ticket_status = $row['ticket_status'];
   	if ($priority==0 && $ticket_status != 'Закрыт') {
   		set_priority('1', $ticket_id);
   		$priority = 1;
   	}
   	$theme = $row['ticket_theme'];
   	if (strlen($theme) >= 40) {
   		//$theme = mb_substr($theme, 0, 40) . '...';
   		
   	}
   	if ($priority == 0) {
   		$priority = 'd-none';
   	}
	if ($priority == 1) {
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
	
	if ($ticket_status != 'Открыт') {
		$status = 'checked';
	}
	else ($status = 'new');
	if ($ticket_status == 'Закрыт' || $ticket_status =='Отклонен') {
		if (!$query) {
			$closed_flag = 'd-none';
		}
		if ($ticket_priority != 0) {	
			set_priority(0, $ticket_id);
		}
		$actions = '<li ' . ajax($ticket_id, 'В работе') . '><a class="dropdown-item"  href="">Возобновить</i> </a> </li>';
		if ($_SESSION['show'] == 'opened') {
			continue;
		}

	}
	if ($ticket_status == 'Удален') {
		if ($show != 'all') {
			if (!$query) {
				continue;		
			}
		}
	}
	if ($_SESSION['show'] == 'all') {

	}
	if ($_SESSION['show'] == 'closed') {
		if ($ticket_status != 'Закрыт' ) {
			continue;
		}
		if (  $ticket_status != 'Отклонен') {
			//continue;
		}
	}
	
	switch ($ticket_status) {

		case 'Открыт':
			$badge = 'bg-primary';
			break;
		case 'Введен':
			$badge = 'bg-warning text-dark';
			break;
		case 'Закрыт':
			$badge = 'bg-secondary';
			break;
		case 'Отложен':
			$badge = 'bg-secondary';
			break;
		case 'Отклонен':
			$badge = 'bg-danger';
			break;	
		case 'В работе':
			$badge = 'bg-success';
			break;	
		case 'Удален':
			$badge = 'bg-danger';
			break;	
		default:
			$badge = 'bg-danger';
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
							    			<div class="row">
							    				<div class="col-auto">
									    			<div class="ticket_id">
									    				<a href="' . get_url('modules/ticket.php') . '?id=' . $row['ticket_id'] . '"><i class="bi bi-tag-fill"></i> Заявка <b>#' . $row['ticket_id']  .  '	</b><span class="holder   position-relative top-50 start-0">'. $holder_name .' <span class="visually-hidden">Исполнитель</span></span></a> 
									    			</div> 			
							    				</div>
							    				<div class="col-auto">
									    			<div class="holder">
									    				
									    			</div> 			
							    				</div>
							    			</div>
							    		</div>

							    	</div>
							    	<div class="row ticket-title ticket_list">
										<a class="' . $status . '"href="' . get_url('modules/ticket.php') . '?id=' . $row['ticket_id'] . '">' .  $theme  .
									'</div>
							    </div>
							    <div>
							    	<div class="row ticket-priority row-cols-auto">
							    		
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
										'; if ($host_id == 'admin') {
											$modal = ', \'issue\'';
										}
										else {
											$modal = ', \'confirm\'';
										}

										 echo '
										  <a class=" new " href="#" role="button" id="" data-bs-toggle="dropdown" aria-expanded="false" onClick="ModalSC(' . $ticket_id . $modal . '); ">
								    		Действия
										  </a>
									
									  		<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
									  			<li ><a class="dropdown-item"  href="' . get_url('modules/ticket.php') . '?id=' . $row['ticket_id'] . '&type=more">Подробнее</i> </a></li>';
									  			if ($host_id == 'admin') {
									  				echo 
									  			 	$actions .'
									  				<li ><a class="dropdown-item ' . $closed_flag . '" data-bs-toggle="modal" href="#scm_' . $ticket_id . '">Назначить задачу</i> </a> </li>';
									    			
									    		}
									   		 
									   			if ($host_id != 'admin' && $ticket_status == 'Открыт') {
									   				echo '<li ><a class="dropdown-item " data-bs-toggle="modal" href="#scm_' . $ticket_id . '">Удалить заявку</i> </a></li>';
									   			}
									  		echo '</ul>
										</div>

							    		<div class="dropdown col-auto">

										  <a class=" " href="#" role="button" id="" data-bs-toggle="dropdown" aria-expanded="false" onClick="ModalSC(\'' . $ticket_id . '\', \'close\'); ">
								    		<span class="badge ' . $badge . '"'; 
								    		if ($host_id == 'admin' && $ticket_status != 'Закрыт') {
									  				echo ' data-bs-toggle="tooltip" data-bs-placement="top" title="Изменить статус заявки" ';
									  		}
									  		echo  '>' . $ticket_status . '</span>
										  </a>';
										  	if (isset($row['ticket_holder'])) {
												if ($row['ticket_holder'] == $_SESSION['user_id']) {
									  				echo '
									  				<ul class="dropdown-menu ' . $closed_flag . '" aria-labelledby="dropdownMenuLink">
									  					<li ' . ajax($ticket_id, 'В работе') . '><a class="dropdown-item" href="">В работе</a></li>
									    				<li ><a class="dropdown-item" data-bs-toggle="modal" href="#scm_' . $ticket_id . '" role="button">Закрыт</a></li>
									   					<li ' . ajax($ticket_id, 'Отложен') . '><a class="dropdown-item" href="">Отложен</a></li>
									   					<li ' . ajax($ticket_id, 'Отклонен') . '><a class="dropdown-item" href="">Отклонен</a></li>
									  				</ul>';
									  			}
									  		}
									  		else {
									  			echo '
									  				<ul class="dropdown-menu ' . $closed_flag . '" aria-labelledby="dropdownMenuLink">
									  					<li ' . ajax($ticket_id, 'В работе') . '><a class="dropdown-item" href="">В работе</a></li>
									    				<li ><a class="dropdown-item" data-bs-toggle="modal" href="#scm_' . $ticket_id . '" role="button">Закрыт</a></li>
									   					<li ' . ajax($ticket_id, 'Отложен') . '><a class="dropdown-item" href="">Отложен</a></li>
									   					<li ' . ajax($ticket_id, 'Отклонен') . '><a class="dropdown-item" href="">Отклонен</a></li>
									  				</ul>';
									  		}
									  	echo '
										</div>
							    	</div>
							    </div>
							</li>
							<li class="description  d-flex justify-content-between align-items-start">						
									<div class="ticket-date ticket-title ' . $status . '">
									    <div class="row">
									    	<div class="col-auto">
												<div class="date">
													<a href="ticket.php?id=' . $row['ticket_id'] . '"> '  . $normaldate . '</a>
												</div>									    				
									    	</div>
									    	<div class="col-auto">
									    		<div class="ticket-category">
													<i>Категория:</i> <a href="?select=category&param=' . $row['ticket_category'] . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Все заявки категории">' . $row['ticket_category'] . '</a>
												</div>							
									    	</div>
									    	<div class="col-auto">
									    		<div class="ticket-host">
													<i>Автор:</i> <a href="?select=author&param=' . $row['client_id'] . '"'; if ($host_id == 'admin') { echo 'data-bs-toggle="tooltip" data-bs-placement="top" title="Все заявки автора"'; } echo '><b>' . $row['client_id'] . '</b></a>
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
   }



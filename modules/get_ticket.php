<?php
include_once 'functions.php';

if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$result = get_one_ticket($id);
	$row = $result->fetch_assoc();
}

if ($result == 'empty') {
	echo '<div class="row"><div class="col"><p>Заявок не найдено</p></div></div>';
	exit;
}
if (isset($_POST['priority'])) {
	$priority = $_POST['priority'];
}
else {
	$priority = $row['ticket_priority'];
}

if ($id && $priority ) {
	if (set_priority($priority, $id)) {		
	}
}
if (isset($_POST['status'])) {
	$ticket_status = $_POST['status'];
}
else {
	$ticket_status = $row['ticket_status'];
}
if ($id && $ticket_status){
	set_status($ticket_status, $id);
}


   //{
   	
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
	
	if ($ticket_status !== 'new') {
		$status = 'checked';
	}

       echo '			<div class="row ticket ' . $status . '" id="t_' . $row['ticket_id'] .'">
				<div class="col">
					<p></p>
					<div class="list-group">
						<ul class="ticket list-group" id=" ' . $row['ticket_id'] . ' ">
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
										<a class="' . $status . '"href="' . get_url('modules/ticket.php') . '?id=' . $row['ticket_id'] . '">' .  $row['ticket_theme']  .
									'</div>
							    </div>
							    <div>
							    	<div class="row ticket-priority">

							    		<div class="dropstart col-auto" 

										  <a class=" " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								    		<i class="bi bi-exclamation-circle priority ' . $priority . '"  data-bs-toggle="tooltip" data-bs-placement="top" title="Назначить приоритет"></i>
								    		<style>
								    			.middle { color: #F1C232;}
								    			.high { color: #CC0000;}
								    		</style>
										  </a>
									
									  		<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									  			<li ' . ajax($ticket_id, '1', $ticket_status) . '><a class="dropdown-item 1"  href="">Низкий</i> </a></li>
									    		<li ' . ajax($ticket_id, '2', $ticket_status) . '><a class="dropdown-item 2 "  href="">Средний</i> </a></li>
									   			<li ' . ajax($ticket_id, '3', $ticket_status) . '><a class="dropdown-item 3"  href="">Высокий</i> </a> </li>
									  		</ul>
										</div>


							    		
							    		<div class="dropstart col-auto">

										  <a class=" " href="#" role="button"  data-bs-toggle="dropdown" aria-expanded="false">
								    		<span class="badge ' . $badge .'" data-bs-toggle="tooltip" data-bs-placement="top" title="Изменить статус заявки"> ' . $row['ticket_status'] . '</span>
										  </a>
									
									  		<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									  			<li ' . ajax($ticket_id, $priority, 'Введен') . '><span class="badge bg-secondary"> Введен</span></li>
									    		<li ' . ajax($ticket_id, $priority, 'Закрыт') . '><span class="badge bg-success"> Закрыт</span></li>
									   			<li ' . ajax($ticket_id, $priority, 'Отложен') . '><span class="badge bg-warning text-dark"> Отложен</span></li>
									   			<li ' . ajax($ticket_id, $priority, 'Отклонен') . '><span class="badge bg-danger"> Отклонен</span></li>
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
													<a href="' . get_url('modules/ticket.php') . '?id=' . $row['ticket_id'] . '"> '  . $row['t_date'] . '</a>
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
	

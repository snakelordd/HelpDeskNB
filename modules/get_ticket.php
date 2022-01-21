<?php
include_once 'functions.php';

if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$result = get_one_ticket($id);
}
if ($result == 'empty') {
	echo '<div class="row"><div class="col"><p>Заявок не найдено</p></div></div>';
	exit;
}
if (isset($_POST['priority'])) {
	$priority = $_POST['priority'];
}
if (isset($_POST['status'])) {
	$status = $_POST['status'];
}
if ($id && $priority ) {
			if (set_priority($priority, $id)) {}
}

if ($id && $status ) {
		if (set_status($id, $status)) {
		}
}
//while $row = $result->fetch_assoc())
    $row = $result->fetch_assoc();
   	//$id = $row['ticket_id'];
   	//$status = $row['ticket_status'];
   	//$priority = $row['ticket_priority'];
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
	$status = $row['ticket_status'];
	if ($status !== 'new') {
		$status_check = 'checked';
	}
       echo '			<div class="row ticket ' . $status_check . '" id="t_' . $row['ticket_id'] . '">
				<div class="col">
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
										<a class="' . $status_check . '"href="' . get_url('modules/ticket.php') . '?id=' . $row['ticket_id'] . '">' .  $row['ticket_theme']  .
									'</div>
							    </div>
							    <div>
							    	<div class="row ticket-priority">

							    		<div class="dropstart col-auto" id="">

										  <a class=" " href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								    		<i class="bi bi-exclamation-circle priority ' . $priority . '" id="" data-bs-toggle="tooltip" data-bs-placement="top" title="Назначить приоритет"></i>
								    		<style>
								    			.middle { color: #F1C232;}
								    			.high { color: #CC0000;}
								    		</style>
										  </a>
									
									  		<ul class="dropdown-menu" id=" " aria-labelledby="dropdownMenuLink">
									  			<li ' . ajax($id, '1', $status) . '><a class="dropdown-item 1"  href=" ">Низкий</i> </a></li>
									    		<li ' . ajax($id, '2', $status) . '><a class="dropdown-item 2 "  href=" ">Средний</i> </a></li>
									   			<li ' . ajax($id, '3', $status) . '><a class="dropdown-item 3"  href=" ">Высокий</i> </a> </li>
									  		</ul>
										</div>


							    		
							    		<div class="col">
							    			<div class="dropdown col-auto" id="">
	
											  <a class=" " href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								    			<span class="badge bg-primary rounded-pill" data-bs-toggle="tooltip" data-bs-placement="top" title="Изменить статус заявки">' . $row['ticket_status'] .'</span>
								    			<style>
								    				.middle { color: #F1C232;}
								    				.high { color: #CC0000;}
								    			</style>
											  </a>
										
									  			<ul class="dropdown-menu" id="" aria-labelledby="dropdownMenuLink">									  				
									    			
									   				<li ' . ajax($id, $priority, 'Введен') . '><a class="dropdown-item"  href=" "><span class="badge rounded-pill bg-warning text-dark">Введен</span> </a></li>
									   				<li ' . ajax($id, $priority, 'Закрыт') . '><a class="dropdown-item" data-bs-toggle="modal" href="#statusCloseModal" role="button"><span class="badge bg-success">Закрыт</span> </a></li>
									   				<li ' . ajax($id, $priority, 'Отложен') . '><a class="dropdown-item"  href=" "><span class="badge bg-secondary">Отложен</span> </a></li>
									   				<li ' . ajax($id, $priority, 'Отклонен') . '><a class="dropdown-item"  href=" "><span class="badge rounded-pill bg-danger">Отклонен</span> </a></li>
									  			</ul>
											</div>
							    		</div>
							    	</div>
							    </div>
							</li>
							<li class="description  d-flex justify-content-between align-items-start">						
									<div class="ticket-date ticket-title ' . $status_check . '">
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

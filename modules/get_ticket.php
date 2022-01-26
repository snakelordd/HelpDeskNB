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
	else $status = 'new';
	switch ($ticket_status) {
		case 'Открыт':
			$badge = 'bg-primary rounded-pill';
			break;
		case 'Закрыт':
			$badge = 'bg-success';
			break;
		case 'Отложен':
			$badge = 'bg-warning text-dark';
			break;
		case 'Отклонен':
			$badge = 'bg-danger';
			break;	
		case 'Введен':
			$badge = 'bg-secondary';
			break;	
		default:
			//$badge = 'bg-primary rounded-pill';
			break;
	}
       echo  '	

       			<div class="modal " id="statusCloseModal" aria-hidden="true" aria-labelledby="statusCloseModal">
			  <div class="modal-dialog modal-dialog-centered modal-lg" >
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title">Закрыть заявку</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			        <div class="row">
						<div class="col-3">
							<select class="form-select" id="t_category" name="t_category" aria-label="Default select example">
							  <option selected >Резолюция</option>
							  <option value="fixed">Исправлено</option>
							  <option value="consultated">Консультация</option>
							  <option value="Other">Выполнено</option>
							</select>				
						</div>	
						<div class="col">
							<div class="mb-3">
 								<input type="email" class="form-control"  placeholder="Комментарий (необязательно) ' . $ticket_id . '">
							</div>
						</div>
					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
			        <a class="btn btn-success" href=" " ' . ajax($ticket_id, 'Закрыт') . '>Закрыть заявку</a>
			      </div>
			    </div>
			  </div>
			</div>


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
							    		
							    		<div class="dropstart col-auto">

										  <a class=" new" href="#" role="button" id="" data-bs-toggle="dropdown" aria-expanded="false">
								    		<i class="bi bi-exclamation-circle  priority ' . $priority . '" id="" data-bs-toggle="tooltip" data-bs-placement="top" title="Назначить приоритет"></i>
								    		<style>
								    			.middle { color: #F1C232;}
								    			.high { color: #CC0000;}
								    		</style>
										  </a>
									
									  		<ul class="dropdown-menu ' . $closed_flag . ' " aria-labelledby="dropdownMenuLink">
									  			<li ' . ajax($ticket_id, '1') . '><a class="dropdown-item 1"  href="">Низкий</i> </a></li>
									    		<li ' . ajax($ticket_id, '2') . '><a class="dropdown-item 2 "  href="">Средний</i> </a></li>
									   			<li ' . ajax($ticket_id, '3') . '><a class="dropdown-item 3"  href="">Высокий</i> </a> </li>
									  		</ul>
										</div>

										<div class="dropdown col-auto">

										  <a class=" new " href="#" role="button" id="" data-bs-toggle="dropdown" aria-expanded="false">
								    		Действия
										  </a>
									
									  		<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									  			<li ><a class="dropdown-item"  href="">Подробнее</i> </a></li>
									  			'. $actions .'
									  			<li ><a class="dropdown-item ' . $closed_flag . '"  href="">Назначить задачу</i> </a> </li>
									    		<li ><a class="dropdown-item "  href="">Удалить заявку</i> </a></li>
									   			
									  		</ul>
										</div>

							    		<div class="dropdown col-auto">

										  <a class=" " href="#" role="button" id="" data-bs-toggle="dropdown" aria-expanded="false">
								    		<span class="badge ' . $badge . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Изменить статус заявки"> ' . $ticket_status . '</span>
										  </a>
									
									  		<ul class="dropdown-menu ' . $closed_flag . '" aria-labelledby="dropdownMenuLink">
									  			<li ' . ajax($ticket_id, 'Введен') . '><a class="dropdown-item" href="">Введен</a></li>
									    		<li ' . ajax($ticket_id, 'Закрыт') . '><a class="dropdown-item" data-bs-toggle="modal" href="#statusCloseModal" role="button">Закрыт</a></li>
									   			<li ' . ajax($ticket_id, 'Отложен') . '><a class="dropdown-item" href="">Отложен</a></li>
									   			<li ' . ajax($ticket_id, 'Отклонен') . '><a class="dropdown-item" href="">Отклонен</a></li>
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
	

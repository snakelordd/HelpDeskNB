<?php
include_once 'functions.php';


$result = sortby();

if ($result == 'empty') {
	echo '<div class="row"><div class="col"><p>Заявок не найдено</p></div></div>';
	exit;
}

//var_dump($result);
while ($row = $result->fetch_assoc())
   {
   	$priority = $row['ticket_priority'];
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
		$status = 'checked';
	}
       echo '			<div class="row ticket ' . $status . '" id="t_' . $row['ticket_id'] . '">
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
										<a class="' . $status . '"href="' . get_url('modules/ticket.php') . '?id=' . $row['ticket_id'] . '">' .  $row['ticket_theme']  .
									'</div>
							    </div>
							    <div>
							    	<div class="row ticket-priority">

							    		<div class="dropstart col-auto" id="t_' . $row['ticket_id'] . '">

										  <a class=" " href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								    		<i class="bi bi-exclamation-circle priority ' . $priority . '" id="" data-bs-toggle="tooltip" data-bs-placement="top" title="Назначить приоритет"></i>
								    		<style>
								    			.middle { color: #F1C232;}
								    			.high { color: #CC0000;}
								    		</style>
										  </a>
									
									  		<ul class="dropdown-menu" id=" ' . $row['ticket_id'] .   ' " aria-labelledby="dropdownMenuLink">
									  			<li onClick="myFu(' . $row['ticket_id'] .', 1); return fasle;"><a class="dropdown-item 1"  href="">Низкий</i> </a></li>
									    		<li onClick="myFu(' . $row['ticket_id'] .', 2); return fasle;"><a class="dropdown-item 2 "  href="">Средний</i> </a></li>
									   			<li onClick="myFu(' . $row['ticket_id'] .', 3); return fasle;"><a class="dropdown-item 3"  href="">Высокий</i> </a> </li>
									  		</ul>
										</div>


							    		
							    		<div class="col">
							    			<span class="badge bg-primary rounded-pill">' . $row['ticket_status'] . '</span>
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
		
		
		if (isset($_GET['setpriority']) && $_GET['ticketid'] ) {
			if (set_priority($_GET['setpriority'], $_GET['ticketid'])) {
				
			}
			//echo $_GET['setpriority'];
			$_GET['setpriority'] = null;
			$_GET['ticketid'] = null;
			//$result = sortby();
		}
   }



<?php
include_once 'functions.php';


$result = sortby();

//var_dump($result);
while ($row = $result->fetch_assoc())
   {
   	$priority = $row['ticket_priority'];
	if ($priority == 1) {
 	$priority = '<i class="bi bi-exclamation-circle low" id="" data-bs-toggle="tooltip" data-bs-placement="top" title="Назначить приоритет"></i>';
 	}
	if ($priority == 2) {
 	$priority = '<i class="bi bi-exclamation-circle-fill middle" id="" data-bs-toggle="tooltip" data-bs-placement="top" title="Назначить приоритет"></i><style>.middle { color: #F1C232;}</style>';
	}
	if ($priority == 3) {
		$priority = '<i class="bi bi-exclamation-circle-fill high" id="" data-bs-toggle="tooltip" data-bs-placement="top" title="Назначить приоритет"></i><style>.high { color: #CC0000;}</style>';
	}

       echo '			<div class="row ticket" id="' . $row['client_id'] .'">
				<div class="col">
					<div class="list-group">
						<ul class="ticket list-group" id=" ' . $row['ticket_id'] . ' ">
							<li class="list-group-item ticket-title d-flex justify-content-between align-items-start">
							    <div class="ticket_info">
							    	<div class="row">
							    		<div class="col-auto">
									    	<div class="ticket_id">
									    		<a href="#"> Заявка #' . $row['ticket_id'] . ' </a>
									    	</div> 
									    	<div class="ticket-date">
									    		<div class="row">
									    			<div class="col-auto">
											    		<div class="date">
											    			' . $row['t_date'] . '
											    		</div>									    				
									    			</div>
									    			<div class="col-auto">
									    				<div class="ticket-category">
															<i>Категория:</i> <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Все заявки категории">' . $row['ticket_category'] . '</a>
														</div>							
									    			</div>
									    			<div class="col-auto">
									    				<div class="ticket-host">
															<i>Автор:</i> <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Все заявки автора">' . $row['client_id'] . '</a>
														</div>							
									    			</div>
									    		</div>			    				    		
									    	</div>		
							    		</div>
							    	</div>


							    </div>
							    <div>
							    	<div class="row ticket-priority">

							    	<div class="dropstart col-auto">

										  <a class=" " href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								    		' . $priority .  '
										  </a>
									
									  <ul class="dropdown-menu" id=" ' . $row['ticket_id'] .   ' " aria-labelledby="dropdownMenuLink">
									  	<li><a class="dropdown-item 1"  href="' . get_url('modules/mytickets.php') .'/?setpriority=1&ticketid=' . $row['ticket_id'] . '">Низкий</i> </a></li>
									    <li><a class="dropdown-item 2 "  href="' . get_url('modules/mytickets.php') .'/?setpriority=2&ticketid=' . $row['ticket_id'] . '">Средний</i> </a></li>
									    <li><a class="dropdown-item 3"  href="' . get_url('modules/mytickets.php') .'/?setpriority=3&ticketid=' . $row['ticket_id'] . '">Высокий</i> </a></li>
									  </ul>
									</div>


							    		
							    		<div class="col">
							    			<span class="badge bg-primary rounded-pill">' . $row['ticket_status'] . '</span>
							    		</div>
							    	</div>
							    </div>
							</li>
							<li class="description list-group-item d-flex justify-content-between align-items-start">
								<div class="problem">
									<div class="row ticket-date">
										Тема заявки: ' . $row['ticket_theme'] . '
									</div>
									<div class="row">
										' . $row['ticket_problem'] . '
									</div>
							</li>
							
						</ul>
					</div>
				</div>
				<p></p>
				<p></p>
			</div>
			
			';
		
		
		if (isset($_GET['setpriority']) && $_GET['ticketid'] ) {
			if (set_priority($_GET['setpriority'], $_GET['ticketid'])) {
				
			}
			//echo $_GET['setpriority'];
			$_GET['setpriority'] = null;
			$_GET['ticketid'] = null;
			$result = sortby();
		}
   }



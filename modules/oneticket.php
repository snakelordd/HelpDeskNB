<?php
include_once 'functions.php';

$result = get_ticket('admin');
while ($row = $result->fetch_assoc())
   {
       // Оператором echo выводим на экран поля таблицы name_blog и text_blog
       echo '			<div class="row ticket" id="' . $row['client_id'] .'">
				<div class="col">
					<div class="list-group">
						<ul class="ticket list-group">
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
															<i>Категория:</i> ' . $row['ticket_category'] . '
														</div>							
									    			</div>
									    			<div class="col-auto">
									    				<div class="ticket-host">
															<i>Автор:</i> ' . $row['client_id'] . '
														</div>							
									    			</div>
									    		</div>			    				    		
									    	</div>		
							    		</div>
							    	</div>


							    </div>

							    <span class="badge bg-primary rounded-pill">' . $row['ticket_status'] . '</span>
							</li>
							<li class="description list-group-item">
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
			</div>';
   }

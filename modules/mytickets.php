<?php


include_once 'header.php';

?>

	<DIV class="content">
		<DIV class="container">
			<div class="row page_header">	
				<ul>	
					<li><h3><i class="bi bi-list-task"></i> Все заявки   </h3></li>
					<li><hr></li>
				</ul>	
			</div>	
			<div class="row">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="#">Все заявки</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Заявка #xxx</li>
				  </ol>
				</nav>
			</div>
			<div class="row">
				<div class="col-auto">
					<div class="dropdown">
					  <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
					    Сортировать
					  </button>
					  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
					    <li><a class="dropdown-item" href=" <?php echo get_url('modules/mytickets.php');?>?sort=date">по дате</a></li>
					    <li><a class="dropdown-item" href="<?php echo get_url('modules/mytickets.php');?>?sort=priority">по приоритету</a></li>
					    <li><a class="dropdown-item" href="<?php echo get_url('modules/mytickets.php');?>?sort=category">по категориям</a></li>
					    <li><a class="dropdown-item" href="<?php echo get_url('modules/mytickets.php');?>?sort=status">по статусу заявки</a></li>
					  </ul>
					</div>	
				</div>	
				<div class="col-auto">
<!-- 					<div class="row g-3 align-items-center">
					  <div class="col-auto"> -->
					  	<div class="row">
					  		<div class="col-auto">
					  			<input type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
					  		</div>
					    	<div class="col">
					    		<button type="submit" class="btn btn-sm btn-secondary">Найти</button>
					    	</div>					  		
					  	</div>
					    
<!-- 					  </div>
					</div> -->
				</div>
				<p></p>		
			</div>		
			<?php include_once 'oneticket.php'; ?>	
<!-- 			<div class="row ticket">
				<div class="col">
					<div class="list-group">
						<ul class="ticket list-group">
							<li class="list-group-item ticket-title d-flex justify-content-between align-items-start">
							    <div class="ticket_info">
							    	<div class="row">
							    		<div class="col-auto">
									    	<div class="ticket_id">
									    		Заявка #xxx
									    	</div> 
									    	<div class="ticket-date">
									    		<div class="row">
									    			<div class="col-auto">
											    		<div class="date">
											    			DD.MM.YY
											    		</div>									    				
									    			</div>
									    			<div class="col-auto">
									    				<div class="ticket-category">
															Категория:
														</div>							
									    			</div>
									    		</div>			    				    		
									    	</div>		
							    		</div>
							    	</div>


							    </div>

							    <span class="badge bg-primary rounded-pill">Закрыт</span>
							</li>
							<li class="description list-group-item">
								description
							</li>
							
						</ul>
					</div>
				</div>
 				<div class="col-2">
					<ul class="list-group">
					  <li class="list-group-item">Элемент</li>
					  <li class="list-group-item">Второй элемент</li>
					  <li class="list-group-item">Третий элемент</li>
					  <li class="list-group-item">Четвертый элемент</li>
					  <li class="list-group-item">И пятый</li>
					</ul>
				</div> 
			</div> -->
		</DIV>
	</DIV>
	<script type="text/javascript">
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  			return new bootstrap.Tooltip(tooltipTriggerEl)
		})
	</script>
	<script type="text/javascript" src="<?php echo get_url("js/setpriority.js")?>"></script>
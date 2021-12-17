<?php 

include_once 'header.php';
include_once 'tabs.php';
$back = $_SERVER['HTTP_REFERER'];

?>
<script type="text/javascript" src="<?php echo get_url("js/script.js")?>"></script>
<div id="content">
	<div class="container">
		<?php if ($back != (get_url('modules/newticket.php'))) { tab_warning('Прежде чем создавать новую заявку, ознакомьтесь с существующими заявками и инструкцией. Возможно, ваша проблема уже имеет решение. Инструкции можете посмотреть здесь'); } ?>
		<?php if ($back != (get_url('modules/newticket.php'))) { tab_advice('<ul>
					 			<li><a href="#">Link 1</a></li>
					 			<li><a href="#">Link 2</a></li>
					 			<li><a href="#">Link 3</a></li>
					 			<li><a href="#">Link 4</a></li>
					 		</ul>', '', 'Возможно вам помогут...'); } ?>
		<?php if ($back == (get_url('modules/newticket.php'))) { tab_advice('Заявка успешно создана. Статус заявки можно посмотреть здесь', '<i class="bi bi-check-square-fill"></i>');}?>
		 
		<div class="row page_header">	
			<ul>	
				<li><h3><i class="bi bi-plus-square"></i> Создать новую заявку   </h3></li>
				<li><hr></li>
			</ul>	
		</div>

		<div class="row newticket">
		 	<div class="col">
		 		<form name = "newticket" method="post" action=" <?php echo get_url('modules/newticket_action.php')?>">
					<div class="row ticketforms">
					<div class="col-2"> Выберите категорию </div>
						<div class="col">
							<select class="form-select" id="t_category" name="t_category" aria-label="Default select example">
							  <option selected>Open this select menu</option>
							  <option value="M-Apt">One</option>
							  <option value="Printers">Two</option>
							  <option value="Other">Three</option>
							</select>				
						</div>	
					</div>
					<div class="row ticketforms"> 
						<div class="col-2">Тема вашей заявки </div>
						<div class="col ">
							<div class="mb-3">						    
							    <input type="text" id="t_theme" name="t_theme" class="form-control" id="inputTheme" aria-describedby="themeHelp">
							    <div id="themeHelp" class="form-text">Напишите здесь тему вашего обращения</div>
							  </div>
						</div>	
					</div>
					<div class="row ticketforms"> 
						<div class="col-2"> Опишите проблему </div>
						<div class="col ">
							<div class="mb-3">						    
							    <textarea type="text" class="form-control" id="t_describe" name="t_describe" aria-describedby="describeHelp" rows="5" cols="20"></textarea>
							    <div id="describeHelp" class="form-text">Пожалуйста, опишите подробно свою проблему</div>
							  </div>
						</div>	
					</div>	
					<div class="row ticketforms">
						<div class="col-2"></div>
						<div class="col">
							<div class="mb-3">
							  <input type="file" class="form-control" id="t_inputfile" name="t_inputfile" aria-describedby="fileRequire">
							  <div id="fileRequire" class="form-text">Необязательно</div>
							</div>
						</div>	
					</div>
					<div class="row ticketforms">
						<div class="col-2"></div>
						<div class="col">
							<div class="mb-3">
							  <button type="submit" class="btn btn-primary">Отправить</button>
							</div>
						</div>	
					</div>
				</form>				
		 	</div> 		 	
		</div>
		
	</div>

</div>















<?php include_once 'footer.php'; ?>
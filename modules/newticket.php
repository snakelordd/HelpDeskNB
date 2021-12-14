<?php 

include_once 'header.php';
?>
<script type="text/javascript" src="<?php echo get_url("js/script.js")?>"></script>
<div id="content">
	<div class="container">
		<div class="row ">
			<div class="col faq faq1 " id="faq_1">
				<div class="row justify-content-center ">
			 		<div class="row justify-content-center ">
			 			<div class="col align-items-center">				 		
					 	</div>
					 	<button type="button" class="btn-close"></button>
					 </div>
					 <div class="col faqtab_warning faq_icon">
					 	<i class="bi bi-exclamation-square-fill"></i>
					 	<style type="text/css">
					 		.bi-exclamation-square-fill {
					 			font-size: 1.4em;
					 			text-align: center;
					 		}
					 	</style>
					 </div>
					 <div class="col-11 faqtab_warning">
					 	<p>Прежде чем создавать новую заявку, ознакомьтесь с существующими заявками и инструкцией. Возможно, ваша проблема уже имеет решение. Инструкции можете посмотреть здесь </p>
					 </div>
					 <div class="row justify-content-center ">
			 			<div class="col align-items-center">
			 			</div>

					 </div>
				</div>
		 	</div> 		 				
		</div>
		<div class="row">
			<div class="col faq faq2" id="faq_2">
		 		<div class="row justify-content-center">
		 			<div class="row justify-content-center">
		 				<div class="col faq_icon">
		 					
		 				</div>
			 			<div class="col faqtab_advice align-items-center">
					 	Возможно вам помогут...
					 	</div>
					 	<button type="button" class="btn-close"></button>
					</div>

					<div class="col faqtab_advice faq_icon">
					 	<i class="bi bi-lightbulb-fill"></i>
					 	<style type="text/css">
					 		.bi-lightbulb-fill {
					 			font-size: 1.4em;
					 			text-align: center;
					 		}
					 	</style>
					</div>
					<div class="col-11 faqtab_advice">
					 	<div class="faq_content ">
					 		<ul>
					 			<li><a href="#">Link 1</a></li>
					 			<li><a href="#">Link 2</a></li>
					 			<li><a href="#">Link 3</a></li>
					 			<li><a href="#">Link 4</a></li>
					 		</ul>
					 	</div>
					</div>
				</div>
		 	</div> 
		</div>	
		<div class="row page_header">	
			<ul>	
				<li><h3><i class="bi bi-plus-square"></i> Создать новую заявку   </h3></li>
				<li><hr></li>
			</ul>	
		</div>

		<div class="row newticket">
		 	<div class="col">
				<div class="row ticketforms">
				<div class="col-2"> Выберите категорию </div>
					<div class="col">
						<select class="form-select" aria-label="Default select example">
						  <option selected>Open this select menu</option>
						  <option value="1">One</option>
						  <option value="2">Two</option>
						  <option value="3">Three</option>
						</select>				
					</div>	
				</div>
				<div class="row ticketforms"> 
					<div class="col-2">Тема вашей заявки </div>
					<div class="col ">
						<div class="mb-3">						    
						    <input type="text" class="form-control" id="inputTheme" aria-describedby="themeHelp">
						    <div id="themeHelp" class="form-text">Напишите здесь тему вашего обращения</div>
						  </div>
					</div>	
				</div>
				<div class="row ticketforms"> 
					<div class="col-2"> Опишите проблему </div>
					<div class="col ">
						<div class="mb-3">						    
						    <textarea type="text" class="form-control" id="describeText" aria-describedby="describeHelp" rows="5" cols="20"></textarea>
						    <div id="describeHelp" class="form-text">Пожалуйста, опишите подробно свою проблему</div>
						  </div>
					</div>	
				</div>	
				<div class="row ticketforms">
					<div class="col-2"></div>
					<div class="col">
						<div class="mb-3">
						  <input type="file" class="form-control" id="inputGroupFile02" aria-describedby="fileRequire">
						  <div id="fileRequire" class="form-text">Необязательно</div>
						</div>
					</div>	
				</div>
				<div class="row ticketforms">
					<div class="col-2"></div>
					<div class="col">
						<div class="mb-3">
						  <button type="button" class="btn btn-primary">Отправить</button>
						</div>
					</div>	
				</div>				
		 	</div> 		 	
		</div>
		
	</div>

</div>















<?php include_once 'footer.php'; ?>
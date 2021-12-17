<?php


function tab_warning($content) {
	 echo '
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
					 	<p>' . $content .'</p>
					 </div>
					 <div class="row justify-content-center ">
			 			<div class="col align-items-center">
			 			</div>

					 </div>
				</div>
		 	</div> 		 				
		</div> 
	';
}

function tab_advice($content, $icon = '', $title = '' ) {
	echo '		<div class="row">
			<div class="col faq faq2" id="faq_2">
		 		<div class="row justify-content-center">
		 			<div class="row justify-content-center">
			 			<div class="col faqtab_advice align-items-center">' . $title . '</div>
					 	<button type="button" class="btn-close"></button>
					</div>
					
		 			<div class="col faqtab_advice faq_icon">' . $icon . 		 					
		 			'</div>					

					<div class="col-11 faqtab_advice">
					 	<div class="faq_content "> <p>' . $content . '</p></div>
					</div>
				</div>
		 	</div> 
		</div>';
}



	
					 	
					 		
					 	
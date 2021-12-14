$(document).ready(function() { 

	var closebtn = $('button.btn-close');
	var elem = $('.faq');
	//var faq_advice = 
	$(elem).show(1500);
	$('#faq_2').hide();
	$(closebtn).click(function() {
		event.preventDefault();
		$elem = $(this).closest('.faq').attr('id');
		//console.log($elem);
		$(this).closest('.faq').hide(600);
		//console.log($(this).closest('.faq').attr('id'));
		if ($(this).closest('.faq').attr('id') == 'faq_1') {
			$('#faq_2').show(1500);
		}
		console.log($elem);
		//$(this).closest('.faq').toggleClass("d-none");
		//$(elem).fadeout();


	});
	
});
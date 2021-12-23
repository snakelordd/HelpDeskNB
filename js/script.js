$(document).ready(function() { 

	var closebtn = $('button.btn-close');
	var elem = $('.faq');

	$(elem).hide();
	$(elem[0]).show(600);

	$(closebtn).click(function() {

		event.preventDefault();

		$elem = $(this).closest('.faq').attr('id');
		$(this).closest('.faq').hide(500);

		if ($(this).closest('.faq').attr('id') == 'faq_1') {
		 	$('#faq_2').show(500);
		}


	});

$('form[id="newticket"]').validate({
  rules: {
    t_category: 'required',
    t_theme: 'required',
    t_describe: 'required'
  },
  messages: {
    t_category: 'Пожалуйста, выберите категорию',
    t_theme: 'Заполните это поле',
    t_describe: 'Заполните это поле',
  },
  submitHandler: function(form) {
    form.submit();
  }
});

	//var submit_btn = $
	


});
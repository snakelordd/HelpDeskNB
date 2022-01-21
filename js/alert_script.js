
	function show_alert() {
		var closebtn = $('button.btn-close');
		var elem = $('.faq');
		//var btn_sccss = $('.btn-success');
	
		$(elem[0]).hide();
	
		
		$(elem[0]).show(600);
		
	
		$(closebtn).click(function() {
	
			event.preventDefault();
	
			$elem = $(this).closest('.faq').attr('id');
			$(this).closest('.faq').hide(300);
	
	
		});
	
	
		//var submit_btn = $
	}



function myFu(id, priority){
        $.ajax({
        	type: "POST",
        	url: "/modules/get_ticket.php/", // Скрипт который будет делать выборку по нужному id
        	dataType: "text", // это прочитаете в мануалах
        	timeout: 50000, // это тоже
        	data:{id:id, priority:priority}, // передаем пхп скрипту нужный id города
        	success: function(data) {
        	                $('#t_'+id).html('<div>'+data+'</div>'); // Собственно, добавляем результат на страниуцу
        	},
        	error: function(request, status, errorT) {
        	     alert('Произошел сбой. Запрос не может быть выполнен. Повторите попытку.');
        	}
    	});
}


















// window.onload = function(){

// 	$(document).ready(function() { 
	
// 		var priorityBtn = $('.dropstart');
// 		var ticket_id;
// 		var select_priority = $('a.dropdown-item');
// 		var priority;
	
// 		$(priorityBtn).click(function() {
// 			$ticket_id = $(this).attr('id');
// 			$priority = $(ticket_id).children('i');
// 			console.log($priority);
// 			//console.log($priority);
// 		});

// 	}
// )};
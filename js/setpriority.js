
	function myFu(id, priority){
        $.ajax({
        	type: "GET",
        	url: "/modules/get_ticket.php/", // Скрипт который будет делать выборку по нужному id
        	dataType: "html", // это прочитаете в мануалах
        	timeout: 5000, // это тоже
        	data:{id:id, priority:priority}, // передаем пхп скрипту нужный id города
        	success: function(data) {
        	                $('#t_'+id).html(data); // Собственно, добавляем результат на страниуцу
        	},
        	error: function(request, status, errorT) {
        	     alert('Произошел сбой. Запрос не может быть выполнен. Повторите попытку.');
        	}
    	});
	}

	function setStatus(id, status){
        $.ajax({
        	type: "GET",
        	url: "/modules/get_ticket.php/", // Скрипт который будет делать выборку по нужному id
        	dataType: "html", // это прочитаете в мануалах
        	timeout: 50000, // это тоже
        	data:{id:id, status:status}, // передаем пхп скрипту нужный id города
        	success: function(data) {
        	                $('#t_'+id).html(data);
                            location.reload();
                             // Собственно, добавляем результат на страниуцу
        	},
        	error: function(request, status, errorT) {
        	     alert('Произошел сбой. Запрос не может быть выполнен. Повторите попытку.');
        	}
    	});
	}

	function ModalSC(id, modaltype){
        $.ajax({
        	type: "GET",
        	url: "/modules/modal.php/", // Скрипт который будет делать выборку по нужному id
        	dataType: "html", // это прочитаете в мануалах
        	timeout: 50000, // это тоже
        	data:{id:id, modaltype:modaltype}, // передаем пхп скрипту нужный id города
        	success: function(data) {
        	                $('#modalclose').html(data); // Собственно, добавляем результат на страниуцу
        	},
        	error: function(request, status, errorT) {
        	     alert('Произошел сбой. Запрос не может быть выполнен. Повторите попытку.');
        	}
    	});
	}

	function setResolution(id, resolution, comment){
		if ($comment == undefined) {
			$comment = null;
		}
        $.ajax({
        	type: "POST",
        	url: "/modules/modal.php/", // Скрипт который будет делать выборку по нужному id
        	dataType: "html", // это прочитаете в мануалах
        	timeout: 50000, // это тоже
        	data:{id:id, resolution:resolution, comment:comment}, // передаем пхп скрипту нужный id города
        	success: function(data) {
        	                //$('#t_'+id).html(data); // Собственно, добавляем результат на страниуцу
        	},
        	error: function(request, status, errorT) {
        	     alert('Произошел сбой. Запрос не может быть выполнен. Повторите попытку.');
        	}
    	});
	}

	function ModalToggleId($id) {
		
			$newid = "scm_" + $id;
		
		
		$('#scm_').attr("id", $newid);

	}

	function refreshPage(){
    	window.location.reload();
	} 

    $('.ticketSearch').bind("change keyup input click", function() {
        if(this.value.length >= 1){
            $.ajax({
                type: "GET",
                url: "/modules/oneticket.php/", // Скрипт который будет делать выборку по нужному id
                dataType: "html", // это прочитаете в мануалах
                timeout: 50000, // это тоже
                data:{'ticketSearch':this.value}, // передаем пхп скрипту нужный id города
                success: function(data) {
                                $('#alltickets').html(data);
                                //location.reload();
                                 // Собственно, добавляем результат на страниуцу
                },
                error: function(request, status, errorT) {
                     alert('Произошел сбой. Запрос не может быть выполнен. Повторите попытку.');
                }
           })
        }

    })














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
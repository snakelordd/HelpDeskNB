<?php 

include_once 'functions.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	//$result = get_one_ticket($id);
	//$row = $result->fetch_assoc();
}
if (isset($_GET['modaltype'])) {
	$type = $_GET['modaltype'];
}


$size = '-lg';

if ($type == 'close') {
		$size = '-lg';
		$title = 'Закрыть заявку';
		$modal = '
					<form action="?id=' . $id . '" method="post">
						<div class="modal-header">
						  <h5 class="modal-title">' . $title . '</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
					<div class="row">
						<div class="col-3">
							<select class="form-select" id="res" name="res" aria-label="Resolution select">
							  <option selected >Резолюция</option>
							  <option value="Исправлено">Исправлено</option>
							  <option value="Консультация">Консультация</option>
							  <option value="Выполнено">Выполнено</option>
							</select>				
						</div>	
						<div class="col">
							<div class="mb-3">
 								<input type="text" class="form-control" id="resolution_comment" name="resolution_comment" placeholder="Комментарий (необязательно)">
							</div>
						</div>
					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
			        <button type="submit" class="btn btn-success" data-bs-dismiss="modal" ' . ajax($id, 'Закрыт') . '>Закрыть заявку</button>
			      </div>
			      </form>';
}

if ($type == 'confirm') {
		$size = '-lg';
		$title = 'Подтвердите удаление';
		$modal = '<div class="modal-header">
						  <h5 class="modal-title">' . $title . '</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
					<div class="modal-body">
					<div class="row">
					<div class="col"
						<p> Вы действительно хотите удалить заявку? </p>
					</div>
			     	</div>
			     	<div class="modal-footer">
			     	  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
			     	  <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" ' . ajax($id, 'Удален') . '>Удалить заявку</button>
			     	</div>';
}

if ($type == 'issue') {
	$option='';
	$title = 'Назначить задачу';
	
	$result = get_user('admin');
	while ($row = $result->fetch_assoc())
    {	
   		$option .= ' <option value="' . $row['id'] . '">'. $row['client_name'] . ' ' . $row['client_last_name'] .'</option>';
    }
	$modal = '<form action="?id=' . $id . '" method="post">
						<div class="modal-header">
						  <h5 class="modal-title">' . $title . '</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
					<div class="row">
						<div class="col-3">
							<select class="form-select" id="holder" name="holder" aria-label="Default select example">
							  <option selected >Назначить</option>
							  '. $option .'
							</select>				
						</div>	
						<div class="col">
							<div class="mb-3">
 								<input type="text" class="form-control" id="comment_holder" name="comment_holder" placeholder="Комментарий (необязательно)">
							</div>
						</div>
					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
			        <button type="submit" class="btn btn-success" data-bs-dismiss="modal" ' . ajax($id, 'Введен') . '>Назначить исполнителя</button>
			      </div>
			      </form>';
}

echo ' 
		<div class="modal " id="scm_' . $id . '" aria-hidden="true" aria-labelledby="statusCloseModal">
			  <div class="modal-dialog modal-dialog-centered modal' . $size . '" >
			    <div class="modal-content">			    
			        ' . $modal . '     
			    </div>
			</div>
		</div>';


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

if ($_GET['modaltype'] == 'close') {
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
							<select class="form-select" id="res" name="res" aria-label="Default select example">
							  <option selected >Резолюция</option>
							  <option value="Исправлено">Исправлено</option>
							  <option value="Консультация">Консультация</option>
							  <option value="Выполнено">Выполнено</option>
							</select>				
						</div>	
						<div class="col">
							<div class="mb-3">
 								<input type="text" class="form-control" id="comment" name="comment" placeholder="Комментарий (необязательно) '.$id.$resolution.'">
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

if ($_GET['modaltype'] == 'confirm') {
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

echo ' 
		<div class="modal " id="scm_' . $id . '" aria-hidden="true" aria-labelledby="statusCloseModal">
			  <div class="modal-dialog modal-dialog-centered modal-lg" >
			    <div class="modal-content">			    
			        ' . $modal . '     
			    </div>
			</div>
		</div>';


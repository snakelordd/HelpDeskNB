<?php 

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	//$result = get_one_ticket($id);
	//$row = $result->fetch_assoc();
}
echo ' 
		<div class="modal " id="scm_' . $id . '" aria-hidden="true" aria-labelledby="statusCloseModal">
			  <div class="modal-dialog modal-dialog-centered modal-lg" >
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title">Закрыть заявку</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			        <div class="row">
						<div class="col-3">
							<select class="form-select" id="res" name="res" method="post" aria-label="Default select example">
							  <option selected >Резолюция</option>
							  <option value="fixed">Исправлено</option>
							  <option value="consultated">Консультация</option>
							  <option value="Other">Выполнено</option>
							</select>				
						</div>	
						<div class="col">
							<div class="mb-3">
 								<input type="text" class="form-control" id="comment" name="comment" placeholder="Комментарий (необязательно)">
							</div>
						</div>
					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
			        <button type="submit" class="btn btn-success" data-bs-dismiss="modal" href="?id=' . $id . '">Закрыть заявку</a>
			      </div>
			    </div>
			</div>
		</div>';
<div class="header row">
	<div class="col-1"></div>
	<div class="col-3">Обновить задачу</div>
	<div class="col-4"></div>
	<div class="col-2">
		<a href="/">Назад</a>
	</div>
	<div class="col-2"></div>
</div>

	<form action='/tasks/update' method='post'>
		<?php include('shared/form.php') ?>
		<div class="form-check">
			<input class="form-check-input" id="inputStatus" type="checkbox" name="status" <?= $status ? 'checked' : ''?> >
			<label class="form-check-label" for="inputStatus">Выполнено</label>
		</div>
		<input type="hidden" name="id" value="<?= $id ?>">
		<div class="row justify-content-center">
			<div class="col-2">
				<input class="btn btn-primary" type="submit" value="Обновить">
			</div>
		</div>
	</form>

	<?php include('shared/errors.php') ?>
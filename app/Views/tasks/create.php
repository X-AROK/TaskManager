<div class="header row">
	<div class="col-2"></div>
	<div class="col-2">Создать задачу</div>
	<div class="col-4"></div>
	<div class="col-2">
		<a href="/">Назад</a>
	</div>
	<div class="col-2"></div>
</div>

<div class="row justify-content-center">
	<div class="col">
		<form class="form" action="/tasks/store" method='post'>
			<?php include('shared/form.php') ?>
			<div class="row justify-content-center">
				<div class="col-2">
					<input class="btn btn-primary" type="submit" value="Создать">
				</div>
			</div>
		</form>
	</div>
</div>

<?php include('shared/errors.php') ?>

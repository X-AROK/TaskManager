<div class="header row">
	<div class="col-2"></div>
	<div class="col-2">Вход</div>
	<div class="col-4"></div>
	<div class="col-2">
		<a href="/">Назад</a>
	</div>
	<div class="col-2"></div>
</div>
<div class="row justify-content-center">
	<div class="col">
		<form action="/login/login" method='post'>
			<div class="form-group">
				<label for="inputLogin">Логин</label>
				<input class="form-control" id="inputLogin" type="text" name="login" placeholder="Введите логин" value="<?= $login ?? '' ?>">
			</div>
			<div class="form-group">
				<label for="inputPass">Пароль</label>
				<input class="form-control" id="inputPass" type="password" name="pass" placeholder="Введите пароль"value="<?= $pass ?? '' ?>">
			</div>
			<div class="row justify-content-center">
				<div class="col-2">
					<input class="btn btn-primary" type="submit" value="Войти">
				</div>
			</div>
		</form>
	</div>
</div>

<?php if (isset($error)): ?>
	<ul>
		<li><?= $error ?></li>
	</ul>
<?php endif; ?>
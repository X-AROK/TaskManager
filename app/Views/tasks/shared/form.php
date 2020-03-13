<div class="form-group">
	<label for="inputName">Имя:</label>
	<input class="form-control" id="inputName" type="text" name="username" placeholder="Введите имя" value="<?= $username ?? '' ?>">
</div>
<div class="form-group">
	<label for="inputEmail">Email:</label>
	<input class="form-control" id="inputEmail" type="text" name="email" placeholder="Введите email" value="<?= $email ?? '' ?>">
</div>
<div class="form-group">
	<label for="inputBody">Текст задачи:</label>
	<textarea class="form-control" id="inputBody" name="body" placeholder="Введите текст задачи"><?= $body ?? '' ?></textarea>
</div>
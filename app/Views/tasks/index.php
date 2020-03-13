<div class="row header">
	<div class="col-2"></div>
	<div class="col-2">Список задач</div>
	<div class="col-4"></div>
	<div class="col-2">
		<?php if (!isset($_SESSION['isLogin'])): ?>
			<a href="/login">Войти</a><br>
		<?php else: ?>
			<a href="/login/logout">Выйти</a>
		<?php endif; ?>
	</div>
	<div class="col-2"></div>
</div>
<div class="row justify-content-start">
	<div class="col-9">
		Сортировать по:
		<a href="/?page=<?= $page ?>&order=username&direction=<?= $direction ?>">Имя</a>
		<a href="/?page=<?= $page ?>&order=email&direction=<?= $direction ?>">Email</a>
		<a href="/?page=<?= $page ?>&order=status&direction=<?= $direction ?>s">Статус</a>
	</div>
</div>
<div class="row justify-content-start">
	<div class="col-9">
		В порядке:
		<a href="/?page=<?= $page ?>&order=<?= $order ?>&direction=asc">Возростания</a>
		<a href="/?page=<?= $page ?>&order=<?= $order ?>&direction=desc">Убывания</a>
	</div>
</div>
<br>

<?php foreach ($tasks as $task): ?>
	<div class = 'task'>
		<div class="task-head row">
			<div class="task-head-elem col-2">Имя:<br><?= $task['username'] ?></div>
			<div class="task-head-elem col-4">Email:<br><?= $task['email'] ?></div>
			<div class="task-head-elem col-6">
				Статус:<br><?= $task['status'] ? 'Выполнено' : 'Не выполнено' ?><?= $task['updated'] ? ' | Обновлено администратором' : '' ?>		
			</div>
		</div>
		<div class="row">
			<div class="task-content col">
				<?= $task['body'] ?>
			</div>
		</div>
		<?php if (isset($_SESSION['isLogin'])): ?>
			<div class="row">
				<div class="task-footer col-6" style="text-align: right;">
					<a class="task-footer-elem" href="/tasks/edit?id=<?= $task['id'] ?>">Редактировать</a>
				</div>
				<div class="task-footer col-6" style="text-align: left;">
					<a class="task-footer-elem" href="/tasks/destroy?id=<?= $task['id'] ?>">Удалить</a>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php endforeach; ?>

<div class="row">
	<div class="col" style="text-align: center;">
		<a href='/tasks/create'>Создать задачу</a>
	</div>
</div>

<div class="row justify-content-center">
	<div class="col" style="text-align: center;">
		<?php if($hasPrevPage): ?>
			<a href="/tasks?page=1&order=<?= $order ?>&direction=<?= $direction ?>">Первая</a> -  
			<a href="/tasks?page=<?= $page - 1 ?>&order=<?= $order ?>&direction=<?= $direction ?>">&lt;-</a>
		<?php endif; ?>
		<?php if($hasNextPage): ?>
			<a href="/tasks?page=<?= $page + 1 ?>&order=<?= $order ?>&direction=<?= $direction ?>">-&gt;</a> - 
			<a href="/tasks?page=<?= $maxPage ?>&order=<?= $order ?>&direction=<?= $direction ?>">Последняя</a>
		<?php endif; ?>
	</div>
</div>

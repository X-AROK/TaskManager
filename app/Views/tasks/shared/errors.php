<?php if (!empty($errors)): ?>
	<ul>
	<?php foreach ($errors as $error): ?>
		<li><?= $error ?></li>
	<?php endforeach; ?>
<?php endif; ?>	
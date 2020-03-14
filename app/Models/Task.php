<?php

namespace App\Models;

use \App\App;

class Task
{
	public static function insert($username, $email, $body)
	{
		App::$db->execute("INSERT INTO tasks (username, email, body) VALUES (?, ?, ?)", array($username, $email, $body));
	}

	public static function update($id, $username, $email, $body, $status, $updated)
	{
		$query = App::$db->execute("UPDATE tasks SET username=?, email=?, body=?, status=?, updated=? WHERE id=?", array($username, $email, $body, $status, $updated, $id));
		var_dump($query);
	}

	public static function delete($id)
	{
		App::$db->execute("DELETE FROM tasks WHERE id=?", array($id));
	}

	public static function paginate($page, $order, $direction)
	{
		if ($page < 1) {
			$page = 1;
		}
		if (!in_array($order, ['username', 'email', 'status'])) {
			$order = 'username';
		}

		$offset = ($page - 1) * 3;
		switch ($direction) {
			case 'desc':
				if ($order === 'status') {
					$orderby = 'ORDER BY status DESC, updated DESC';
				} else {
					$orderby = "ORDER BY {$order} DESC";
				}
				$tasks = App::$db->execute("SELECT * FROM tasks {$orderby} LIMIT 3 OFFSET {$offset}");
				break;
			case 'asc':
			default:
				if ($order === 'status') {
					$orderby = 'ORDER BY status ASC, updated ASC';
				} else {
					$orderby = "ORDER BY {$order} ASC";
				}
				$tasks = App::$db->execute("SELECT * FROM tasks {$orderby} LIMIT 3 OFFSET {$offset}");
				break;
		}
		
		return $tasks;
	}

	public static function count()
	{
		$count = App::$db->execute('SELECT COUNT(*) FROM tasks');
		return $count[0][0];
	}

	public static function getById($id) {
		$task = App::$db->execute('SELECT * FROM `tasks` WHERE id=?', array($id));
		return $task[0] ?? [];
	}

	public static function validate($username, $email, $body)
	{
		$errors = [];
		if (empty($username)) {
			$errors[] = "Имя не должно быть пустым.";
		}
		if (empty($email)) {
			$errors[] = "Email не должен быть пустым.";
		}
		if (empty($body)) {
			$errors[] = "Текст задачи не должен быть пустым.";
		}
		if (!preg_match('/^\w+@\w+\.\w+$/', $email)) {
			$errors[] = "Неправильная форма записи Email.";
		}

		return $errors;
	}
}
<?php

namespace App\Controllers;

use App\Models\Task;

class TasksController extends Controller
{
	public function index()
	{
		$page = $_GET['page'] ?? 1;
		$order = $_GET['order'] ?? 'username';
		$direction = $_GET['direction'] ?? 'asc';
		$tasksCount = Task::count();
		$maxPage = ceil($tasksCount / 3);
		if ($page > $maxPage) {
			$page = $maxPage;
		}

		$tasks = Task::paginate($page, $order, $direction);
		
		$hasNextPage = false;
		$hasPrevPage = false;
		if ($page * 3 < $tasksCount) {
			$hasNextPage = true;
		}
		if ($page > 1) {
			$hasPrevPage = true;
		}

		$this->view('layout', 'tasks.index', compact('tasks', 'hasNextPage', 'hasPrevPage', 'page', 'order', 'direction', 'maxPage'));
	}

	public function create()
	{
		$this->view('layout', 'tasks.create');
	}

	public function store()
	{
		$username = htmlspecialchars($_POST['username']);
		$email = htmlspecialchars($_POST['email']);
		$body = htmlspecialchars($_POST['body']);

		$errors = Task::validate($username, $email, $body);
		if (!empty($errors)) {
			$this->view('layout', 'tasks.create', compact('username', 'email', 'body', 'errors'));
			return;
		}

		Task::insert($username, $email, $body);
		header("Location: /");
	}

	public function edit()
	{
		if (!isset($_GET['id'])) {
			header('Location: /');
			return;
		}
		if (!isset($_SESSION['isLogin'])) {
			header('Location: /login');
			return;
		}

		$id = $_GET['id'];
		$task = Task::getById($id);
		if (empty($task)) {
			header('Location: /');
			return;
		}

		['username' => $username, 
		'email' => $email, 
		'body' => $body, 
		'status' => $status] = $task;

		$this->view('layout', 'tasks.edit', compact('username', 'email', 'body', 'status', 'id'));
	}

	public function update()
	{
		if (!isset($_POST['id'])) {
			header('Location: /');
			return;
		}
		if (!isset($_SESSION['isLogin'])) {
			header('Location: /login');
			return;
		}

		$id = htmlspecialchars($_POST['id']);
		$username = htmlspecialchars($_POST['username']);
		$email = htmlspecialchars($_POST['email']);
		$body = htmlspecialchars($_POST['body']);
		$status = isset($_POST['status']) ? 1 : 0;

		$oldTask = Task::getById($id);

		if ($oldTask['body'] !== $body || $oldTask['updated']) {
			$updated = 1;
		} else {
			$updated = 0;
		}

		$errors = Task::validate($username, $email, $body);
		if (!empty($errors)) {
			$this->view('layout', 'tasks.edit', compact('username', 'email', 'body', 'errors', 'status'));
			return;
		}

		Task::update($id, $username, $email, $body, $status, $updated);
		header("Location: /");
	}

	public function destroy()
	{
		if (!isset($_GET['id'])) {
			header('Location: /');
			return;
		}
		if (!isset($_SESSION['isLogin'])) {
			header('Location: /login');
			return;
		}

		$id = $_GET['id'];
		Task::delete($id);
		header("Location: /");
	}
}
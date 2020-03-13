<?php

namespace App\Controllers;

class LoginController extends Controller
{
	public function index()
	{
		$this->view('layout', 'login.index');
	}

	public function login()
	{
		$login = htmlspecialchars($_POST['login']);
		$pass = htmlspecialchars($_POST['pass']);

		if ($login === 'admin' && $pass === '123') {
			$_SESSION['isLogin'] = true;
			header('Location: /');
			return;
		}

		$error = "Неправильный логин и/или пароль.";
		$this->view('layout', 'login.index', compact('error', 'login', 'pass'));
	}

	public function logout()
	{
		$_SESSION = [];
		session_destroy();
		header('Location: /');
	}
}
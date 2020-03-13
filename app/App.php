<?php

namespace App;

use App\Db;
use App\Router;

class App
{
	protected static $defaultControllerName = 'Tasks';
	protected static $defaultActionName = 'index';

	public static $db;
	public static $router;

	public static function init() {
		static::$db = new Db();
		static::$router = new Router();
	}

	public static function run()
	{
		list($controllerName, $actionName) = static::$router->resolve();

		if (empty($controllerName)) {
			$controllerName = static::$defaultControllerName;
		}

		if (empty($actionName)) {
			$actionName = static::$defaultActionName;
		}

		$controllerName = 'App\\Controllers\\' .  ucfirst($controllerName) . 'Controller';

		if (!class_exists($controllerName)) {
			header('Location: /');
			return;
		}

		$controller = new $controllerName();
		if (!method_exists($controller, $actionName)) {
			header('Location: /');
			return;
		}

		$controller->$actionName();
	}
}
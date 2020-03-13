<?php

namespace App;

class Router
{
	public function resolve()
	{
		$queryStringPos = strpos($_SERVER['REQUEST_URI'], '?');
		if ($queryStringPos !== false) {
			$route = substr($_SERVER['REQUEST_URI'], 0, $queryStringPos);
		}

		$route = $route ?? $_SERVER['REQUEST_URI'];
		$route = explode('/', $route);

		$controllerName = $route[1] ?? "";
		$actionName = $route[2] ?? "";

		return [$controllerName, $actionName];
	}
}
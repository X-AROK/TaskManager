<?php

namespace App\Controllers;

class Controller
{
	public function view($layoutPath, $templatePath, array $params = null)
	{
		if (!is_null($params)) {
			extract($params);
		}

		$layoutPath = str_replace('.', '/', $layoutPath);
		$templatePath = str_replace('.', '/', $templatePath);

		require_once("app/Views/{$layoutPath}.php");
	}
}
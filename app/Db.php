<?php

namespace App;

class Db
{
	public $pdo;

	public function __construct()
	{
		['database' => $config] = json_decode(file_get_contents('config.json'), true);
		if (is_null($config)) {
			throw new \Exception("Database config not found");
		}

		$dsn = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
		$options = [
			\PDO::ATTR_EMULATE_PREPARES => false
		];
		$this->pdo = new \PDO($dsn, $config['user'], $config['pass'], $options);
	}

	public function execute($query, array $params = null)
	{
		if (is_null($params)) {
			$statement = $this->pdo->query($query);
			return $statement->fetchAll();
		}

		$statement = $this->pdo->prepare($query);
		$statement->execute($params);
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function lastInsertId()
	{
		return $this->pdo->lastInsertId();
	}
}
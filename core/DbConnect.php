<?php
/**
 * Подключение к б/д
 *
 * @author Andrew Russkin <andrew.russkin@gmail.com>
 */

namespace core;
use PDO;

class DbConnect {

	/* @var $host string */
	public $host='localhost';

	/* @var $dbName string */
	public $dbName = 'test';

	/* @var $dbUser string */
	public $dbUser = 'root';

	/* @var $dbPassword string */
	public $dbPassword = '5157068';

	/**
	 * Коннект к бд
	 * @return PDO
	 */
	public function getDb(){
		$dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName.';charset=utf8';
		$opt = array(
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		);
		return new PDO($dsn, $this->dbUser, $this->dbPassword, $opt);
	}

}
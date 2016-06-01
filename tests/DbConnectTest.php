<?php

/**
 * Description of DbConnectTest
 *
 * @author Andrew Russkin <andrew.russkin@gmail.com>
 */
require_once '../core/DbConnect.php';

use core\DbConnect;
class DbConnectTest extends PHPUnit_Framework_TestCase{

	public function testgetDb(){
		$class = new DbConnect();
		$class->dbName='test';
		$class->dbPassword='5157068';
		$class->dbUser='root';
		$class->host='localhost';
		$dsn = 'mysql:host='.$class->host.';dbname='.$class->dbName.';charset=utf8';
		$opt = array(
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		);
		$pdo = new PDO($dsn, $class->dbUser, $class->dbPassword, $opt);
		$this->assertEquals($pdo, $class->getDb());
	}
}

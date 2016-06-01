<?php

/**
 * Description of ModelTest
 *
 * @author Andrew Russkin <andrew.russkin@gmail.com>
 */
require_once '../models/Model.php';
require_once '../core/DbConnect.php';
use core\DbConnect;
use models\Model;

class ModelTest extends PHPUnit_Framework_TestCase{

	public function testLoadFalse(){
		$model = new Model;
		$this->assertfalse($model->load(['qwerr'=>1]));
	}

	public function testprepareDataFalse(){
		$model = new Model;
		$this->assertCount(0,$model->prepareData(['qwerr'=>1],4));
	}
}

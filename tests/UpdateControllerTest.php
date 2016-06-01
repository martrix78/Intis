<?php

/**
 * Description of UpdateControllerTest
 *
 * @author Andrew Russkin <andrew.russkin@gmail.com>
 */
require_once '../controllers/UpdateController.php';
require_once '../models/Model.php';
require_once '../core/DbConnect.php';
use core\DbConnect;
use models\Model;
use controllers\UpdateController;

class UpdateControllerTest extends PHPUnit_Framework_TestCase {

	public function testloadFile(){
		$controller = new UpdateController;
		$this->assertCount(3,$controller->loadFile('rates.json'));
	}

    /**
    * @expectedException Exception
    */
	public function testloadFileFail(){
		$controller = new UpdateController;
		$this->assertCount(3,$controller->loadFile('ratesnon.json'));
	}

    /**
    * @expectedException Exception
    */
	public function testindexFail(){
		$controller = new UpdateController;
		$this->assertCount(3,$controller->index(4));
	}

   /**
    * @dataProvider provider
    */
	public function testindex($param){
		$controller = new UpdateController;
		$this->assertTrue($controller->index($param));
	}

	public function provider(){
		return [[1],[2]];
	}
}

<?php

namespace controllers;

/**
 * Типа консольный контроллер
 *
 * @author Andrew Russkin <andrew.russkin@gmail.com>
 */

use models\Model;

class UpdateController {

	/* @var $remoteFile string */
	public $remoteFile='http://localhost/rates1.json';

	/* @var $localFile string */
	public $localFile='rates.json';

	/**
	 * Обработка запроса
	 * @param integer $param
	 * @throws Exception
	 * @return boolean
	 */
	public function index($param){
		switch ($param) {
			case 1:
				$data=$this->loadFile($this->remoteFile);
				break;
			case 2:
				$data=$this->loadFile($this->localFile);
				break;
			default:
				throw new \Exception('Неверный параметр', 500);
		}
		$model = new Model;
		foreach (Model::prepareData($data, $param) as $value) {
			if ($model->load($value) and $model->saveOrInsert()) {
				echo "Успешное обновление\n";
			}
		}
		return true;
	}

	/**
	 * Загрузка файла
	 * @param string $fileName
	 * @return array
	 * @throws Exception
	 */
	public function loadFile($fileName){
		if ($content = file_get_contents($fileName) and $array = json_decode($content, true)) {
			return $array;
		}else{
			throw new \Exception('Файл не найден', 500);
		}
	}


}
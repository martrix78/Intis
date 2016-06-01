<?php

namespace models;
use core\DbConnect;

/**
 * Description of Model
 *
 * @author Andrew Russkin <andrew.russkin@gmail.com>
 */
class Model {

	/* @var $db \PDO*/
	private $db;

	/* @var $symbol array*/
	public $symbol;

	/* @var $rate float*/
	public $rate;

	/**
	 * Простая валидация
	 * @return array
	 */
	public function rules(){
		return ['symbol','rate'];
	}
	public function __construct() {
		$connect = new DbConnect();
		$this->db= $connect->getDb();
	}

	/**
	 * Загрузка данных
	 * @param array $params
	 * @return boolean
	 */
	public function load($params){
		$validateRules = $this->rules();
		foreach ($params as $key => $value) {
			if (in_array($key, $validateRules) and $value) {
				$this->$key=$value;
			}else{
				return FALSE;
			}
		}
		return true;
	}

	/**
	 * Сохранить или добавить, ну мало ли :)
	 * @return boolean
	 */
	public function saveOrInsert(){
		$stmt=$this->db->prepare('select * from currency where symbol=:symbol');
		$stmt->execute([':symbol'=>  $this->symbol]);
		$exists = $stmt->fetch();
		if ($exists) {
			$stmt =$this->db->prepare('UPDATE `currency` SET `rate` = :rate WHERE `symbol` =:symbol;');
		}else{
			$stmt =$this->db->prepare('INSERT INTO `currency` (`symbol` ,`rate`) VALUES ( :symbol, :rate);');
		}
		return $stmt->execute([':symbol'=>  $this->symbol,':rate'=>$this->rate]);

	}

	/**
	 * Подготовка данных
	 * @param array $data
	 * @param integer $paramId
	 * @return array
	 */
	public static function prepareData($data,$paramId){
		$result = [];
		switch ($paramId) {
			case 1:
				$result = self::prepareRemoteData($data);
				break;
			case 2:
				$result = self::prepareLocalData($data);
				break;
			default:
				break;
		}
		return $result;
	}

	/**
	 * Удаленные данные
	 * @param array $data
	 * @return array
	 */
	public static function prepareRemoteData($data){
		$result=[];
		if (is_array($data) and isset($data['rates'])) {
			foreach ($data['rates'] as $row) {
				$result[]=[
					'symbol' => (isset($row['symbol']))?$row['symbol']:'',
					'rate'   => (isset($row['rate']))?$row['rate']:'',
				];
			}
		}
		return $result;
	}

	/**
	 * Локальные данные
	 * @param array $data
	 * @return array
	 */
	public static function prepareLocalData($data){
		$result=[];

		if (is_array($data)) {
			foreach ($data as $row) {
				list($symbol, $rate) = each($row);
					$result[]=[
						'symbol' => $symbol,
						'rate'   => $rate,
					];
			}
		}
		return $result;
	}
}

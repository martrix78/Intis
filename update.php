<?php
	require_once 'controllers/UpdateController.php';
	require_once 'models/Model.php';
	require_once 'core/DbConnect.php';

	$controller = new \controllers\UpdateController;

	if (isset($argv[1]) and $param=(int)$argv[1]) {
		$controller->index($param);
	}else{
		throw new Exception('Неверный или отсутствующий параметр', 500);
	}

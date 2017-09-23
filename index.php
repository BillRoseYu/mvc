<?php	
	header("Content-type: text/html;charset=utf-8");
	//单入口文件
	$controller =isset($_GET['c']) ? $_GET['c'] :'User';
	$action = isset($_GET['a']) ? $_GET['a'] :  'lists';	
	//自动加载
	function __autoload($class) {	//当实例化一个不存在的类的时候php会自动执行
		if (strpos($class, "Controller" )!== false) {
			$dir = 'controller';
		} else if (strpos($class, "Model")!== false) {
			$dir = 'model';
		} else {
			die($class."not exist");
		}
		include "./{$dir}/{$class}.class.php";
	}
	//拼类名
	$className = "{$controller}Controller";
	//实例化
	$con = new $className();
	$con->$action();

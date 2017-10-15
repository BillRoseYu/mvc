<?php	
	header("Content-type: text/html;charset=utf-8");
	//单入口文件
	$controller =isset($_GET['c']) ? $_GET['c'] :'Blog';
	$action = isset($_GET['a']) ? $_GET['a'] :  'lists';	
	session_start();
	include "./common/function.php";
	//拼类名
	$className = "{$controller}Controller";
	//实例化
	$con = new $className();
	$con->$action();

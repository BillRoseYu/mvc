<?php

class UserModel {
	public $mysqli;
	public function __construct() {
			header("Content-type: text/html;charset=utf-8");//显示汉字
			$this->mysqli = new mysqli("localhost","root","","ztstu");//连接数据库)
	}
	public function addUser($name,$age,$password) {
			$sql = "insert into user(name,age,password) value ('{$name}', {$age}, '{$password}')";
			$res = $this->mysqli->query($sql);
			return $res;
	}
	public function getUserLists() {
			$sql = "select * from user";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data;
	}
	public function delUser() {
			$id = $_GET['id'] ? (int)$_GET['id'] : 0;
			$sql= "delete from user where id='{$id}'";
			$res = $this->mysqli->query($sql);
			return $res;
	}
	public function editUser($name,$age,$password) {
			$id = $_POST['id'];
			$sql ="update user set name='{$name}',age={$age},password='{$password}' where id = {$id}";
			$res = $this->mysqli->query($sql);
			return $res;
	}
	public function getUserInfo() {
			$id = $_GET['id'];
			$sql = "select * from user where id={$id}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			$info = $data[0];
			return $info;
	}
}
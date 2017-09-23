<?php
class UserController {

	public function add() {
			include "./view/user/add.html";
	}
	public function doAdd() {
		$name  = $_POST['username'] ? $_POST['username'] : '';
 		$age   = $_POST['age'] ? $_POST['age'] : 0 ;
 		$password = $_POST['password'] ? $_POST['password'] : 0;	
		if (empty($name) || empty($age) ||empty($password)) {       
       		header ('Refresh:3,Url=index.php?c=User&a=lists');//三秒后跳转
       		echo "参数错误,3秒后跳转到list";
       		die();
   		}   
 	  	$userModel = new UserModel();
		$status = $userModel->addUser($name, $age, $password);
		if ($status) {
			header('Refresh:1,Url=index.php?c=User&a=lists');
			echo '发布成功，1秒后跳转到list';
			die();
		}	
	}
	public function lists() {		
		$userModel = new UserModel();
		$data = $userModel->getUserLists();
		include "./view/user/lists.html";
	}
	public function delete() {
		$id = $_GET['id'] ? (int)$_GET['id'] : 0;
		$userModel = new UserModel();
		$res = $userModel->delUser();
		if (!is_int($id) || !$id) {
		echo $id;
		header('Refresh:3,Url=index.php?c=User&a=lists');
		echo "参数不合法，3秒后跳转到list";
		die();
		}				
		header ('Refresh:1,Url=index.php?c=User&a=lists');//三秒后跳转
 		echo "删除成功，1秒后跳转到list";
	}
	public function update() {			
		$userModel = new UserModel();
		$info = $userModel->getUserInfo(); 
		include "./view/user/edit.html";
	}
		public function doUpdate() {
		$id			= $_POST['id'];
 		$name		= $_POST['username'];
 		$age		= $_POST['age'];
 		$password	= $_POST['password'];
 		if (empty($name) || empty($age) ||empty($password)) {       
       		header ('Refresh:3,Url=index.php?c=User&a=lists');//三秒后跳转
       		echo "参数错误,3秒后跳转到list";
       		die();
   		}   
 	  	$userModel = new UserModel();
		$status = $userModel->editUser($name, $age, $password);
		if ($status) {
			header('Refresh:1,Url=index.php?c=User&a=lists');
			echo '修改成功，1秒后跳转到list';
			die();
		}	
	}
}

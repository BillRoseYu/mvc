<?php
	class UserCenterController {
		public function login() {
			include "./view/usercenter/login.html";
		}
		public function doLogin() {
			$name = $_POST['name'];
			$password = $_POST['password'];
			$userModel =  new UserModel();
			$userInfo = $userModel->getUserInfoByName($name);

			if ($userInfo['password'] == $password) {
				unset($userInfo['password']);
				$_SESSION['me'] = $userInfo;
				header('Refresh:3,Url=index.php?c=blog&a=lists');
				echo '登录成功';
				die();
			} else {
				header('Refresh:3,Url=index.php?c=blog&a=lists');
				echo '登录不成功';
				die();
			}
		}	
		public function reg () {
			include "./view/usercenter/reg.html";
		}
		public function doReg() {
			$name 	= $_POST['username'];
			$age 	= $_POST['age'] ? $_POST['age'] : 0;
			$password = $_POST['password'];
			if (empty($name) || empty($password)) {
				header('Refresh:3,Url=index.php?c=UserCenter&a=reg');
				echo '注册不成功';
				die();
			}
			$userModel = new UserModel();
			$status = $userModel->addUser($name , $age, $password);
			if ($status) {
				header('Refresh:1,Url=index.php?c=UserCenter&a=login');
				echo '注册成功，1秒后跳转到list';
				die();
			} else {
				header('Refresh:3,Url=index.php?c=UserCenter&a=reg');
				echo '注册失败，3秒后跳转到list';
				die();
			}
		}
		public function logout () {
			unset($_SESSION['me']);
			header('Refresh:3,Url=index.php?c=Blog&a=lists');
			echo 'logout';
			die();
		}	
	}
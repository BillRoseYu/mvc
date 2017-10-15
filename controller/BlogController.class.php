<?php
	class BlogController {
		public function __construct() {
		}
		public function add () {
			
			if (!isset($_SESSION['me']) || $_SESSION['me']['id'] <=0) {
				header('Location:index.php?c=UserCenter&a=login');
				die();
			}
			include "./view/blog/add.html";
		}
		public function doAdd() {
			// include "./library/Upload.class.php";
			// $upload = new Upload();
			$upload = L("Upload");
			$filename = $upload->run('file');
			$content = $_POST['content'];
			$user_id = $_SESSION['me']['id'];
			$blogModel = new BlogModel();
			$status = $blogModel->addBlog($user_id, $content,$filename);
			if ($status) {
				header('Refresh:1,Url=index.php?c=Blog&a=lists');
				echo '发布成功，1秒后跳转到list';
				die();
			}
		}
		public function lists() {
			$blogModel = new BlogModel();
			$userModel = new UserModel();
			$data = $blogModel->getBlogLists();
			foreach ($data as $key => $value) {
				$user_info = $userModel->getUserInfoById($value['user_id']);
				// var_dump($user_info);
				// die();
				$data[$key]['user_name'] = $user_info['name'];
			}
			include "./view/blog/lists.html";
		}
	
		public function info(){
			$id = $_GET['id'];
			$blogModel = new BlogModel();
			$info = $blogModel->getUserInfoById($id);


			include "./view/blog/info.html";
		}
		public function Image(){
			include "./view/blog/upload.html";
		}
		public function doImage(){
			// echo "<pre>";
			
			//move_uploaded_file($_FILES['file']["tmp_name"], './public/upload/'.$_FILES['file']['name']);
			//move_uploaded_file($_FILES['file']["tmp_name"],"./public/uplode/".$_FILES['file']['name']);
			// echo "</pre>";
			include "./library/Upload.class.php";
			$upload = new Upload();
			$filename = $upload->run('file');
			echo $filename;
			echo $upload->returnSize();

		}
	}
<?php 

namespace Modules\Admin\Controllers;

use Modules\Admin\Models\AdminModel;

class Admin extends BaseController
{
	public $model ;
	public function __construct(){

		$this->model = new AdminModel();
		
	}

	
	public function index(){ //
		
		$data = ['title' => 'Index', 'view' => 'admin/index'];
		return $this->view('template/admin', $data);
	}

	public function getProducts(){

		$keyword = $this->request->getGet("term");

		$products = $this->model->getProducts($keyword);

		response($products);
	}
	
	public function login(){

		$data = ['title' => 'Login', 'view' => 'admin/accounts/login'];
		return $this->view('template/login', $data);
	}

	public function logout(){ // logout
		
		// delete_cookie('user_id');
		// delete_cookie('username');
		// cookie helper không hoạt động

		setcookie('user_id', "", time() - 86400, '/', '');
		setcookie('username', "", time() - 86400, '/', '');

		$this->session->stop();
		$this->session->destroy();

		return redirect()->to(base_url("admin"));
	}

	// xử lý tài khoản của website login v.v
	public function ajaxLogin(){

		$email    = $this->request->getPost("email");
		$password = $this->request->getPost("password");
		if(empty($email)){
			response(array(
				"st"    => "error",
				"label" => "Thông Báo !",
				"txt"   => 'Email là cần thiết ',
				
			));
		}
		if(empty($password)){
			response(array(
				"st"    => "error",
				"label" => "Thông Báo !",
				"txt"   => 'Password là cần thiết ',
				
			));
		}
		$checkEmail = $this->model->getUserByEmail($email);
		if(empty((array)$checkEmail)){

			response(array(
				"st"    => "error",
				"label" => "Thông Báo !",
				"txt"   => 'Email của bạn không tồn tại !',
				
			));
		}

		$loginInfo = $this->model->getLogin($email, $password);

		if(!empty((array)$loginInfo)){ // đúng pass

			// 
			$this->setUserSession($loginInfo); // set session

			response(array(
				"st"    => "success",
				"label" => "Thông Báo !",
				"txt"   => 'Đăng nhập thành công !',
				
			));

		}
		else{

			response(array(
				"st"    => "error",
				"label" => "Thông Báo !",
				"txt"   => 'Mật khẩu của bạn không chính xác !',
				
			));
		}

	}
	
	
	// -----------

}

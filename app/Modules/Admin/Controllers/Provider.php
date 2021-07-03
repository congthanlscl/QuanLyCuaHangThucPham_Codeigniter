<?php 

namespace Modules\Admin\Controllers;

use Modules\Admin\Models\AdminModel;
use Modules\Admin\Models\ProviderModel;

class Provider extends BaseController
{
	private $admin_model ;
    private $provider_model ;
	public function __construct(){

		$this->admin_model = new AdminModel();
        $this->provider_model = new ProviderModel();
		
	}

	
	public function index(){ //
		
        $result = $this->provider_model->getProviders();

		$data = ['title' => 'Danh sách nhà cung cấp', 'result' => $result, 'view' => 'admin/provider/provider'];
		return $this->view('template/admin', $data);
	}

    public function addProvider(){

        $data = ['title' => 'Thêm nhà cung cấp', 'view' => 'admin/provider/AddProvider'];
		return $this->view('template/admin', $data);
    }

    public function updateProvider(){

        $id = $this->request->getGet("id");
        $result = $this->provider_model->getProvider($id);

        $data = ['title' => 'Cập nhật nhà cung cấp', 'result' => $result, 'view' => 'admin/provider/UpdateProvider'];
		return $this->view('template/admin', $data);
    }

    public function ajaxAddProvider(){

        $provider_name    = $this->request->getPost("provider_name");
        $provider_address = $this->request->getPost("provider_address");
        $provider_phone   = $this->request->getPost("provider_phone");

        $rules =  [
			'provider_name' => [
				'label'  => 'Tên nhà cung cấp',
				'rules'  => 'required|is_unique[provider.provider_name]',
				'errors' => [
					'required' => 'Tên nhà cung cấp là cần thiết',
					'is_unique' => "Nhà cung cấp đã tồn tại",
				]
			],
            'provider_address' => [
				'label'  => 'Địa chỉ',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Địa chỉ là cần thiết',
				]
			],
            'provider_phone' => [
				'label'  => 'Số điện thoại',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Số điện thoại là cần thiết',
				]
			],
		];

        if($this->validate($rules)){

			$provider = array(
				"provider_name"    => $provider_name,
                "provider_address" => $provider_address,
                "provider_phone"   => $provider_phone,
			);

			$result = $this->provider_model->addProvider($provider);

			if($result){
				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Thêm nhà cung cấp thành công",
				));
			}
			else{
				response(array(
					"st"   => "error",
					"label" => "Thông Báo !",
					"txt" => "Có lỗi trong quá trình cập nhật",
				));
			}
		}
		else{

			$error = array_shift($this->validator->getErrors());

			response(array(
				"st"   => "error",
				"label" => "Thông Báo !",
				"txt" => $error,
			));
		}
    }

    public function ajaxUpdateProvider(){

        $provider_id = $this->request->getPost("provider_id");
        $provider_address = $this->request->getPost("provider_address");
        $provider_phone   = $this->request->getPost("provider_phone");

        $rules =  [
            'provider_id' => [
				'label'  => 'ID nhà cung cấp',
				'rules'  => 'required|greater_than[0]',
				'errors' => [
					'required' => 'Có lỗi trong quá trình cập nhật',
                    'greater_than' => 'Có lỗi trong quá trình cập nhật',
				]
			],
            'provider_address' => [
				'label'  => 'Địa chỉ',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Địa chỉ là cần thiết',
				]
			],
            'provider_phone' => [
				'label'  => 'Số điện thoại',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Số điện thoại là cần thiết',
				]
			],
		];

        if($this->validate($rules)){

			$provider = array(
                "provider_address" => $provider_address,
                "provider_phone"   => $provider_phone,
			);

			$result = $this->provider_model->updateProvider($provider_id, $provider);

			if($result){
				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Cập nhật nhà cung cấp thành công",
				));
			}
			else{
				response(array(
					"st"   => "error",
					"label" => "Thông Báo !",
					"txt" => "Có lỗi trong quá trình cập nhật",
				));
			}
		}
		else{

			$error = array_shift($this->validator->getErrors());

			response(array(
				"st"   => "error",
				"label" => "Thông Báo !",
				"txt" => $error,
			));
		}
    }

    public function ajaxDeleteProvider(){

		$id = $this->request->getPost("id");

		if(empty($id)){
			response(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => 'Có lỗi trong quá trình thực hiện'
			));
		}


		$result = $this->provider_model->deleteProvider($id);

		if(!empty($result)){

			response(array(
				"st"    => "success",
				"label" => "bg-teal",
				"txt"   => 'Xoá thành công !'
			));
		}
		else{

			response(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => 'Có lỗi trong quá trình cập nhật !'
			));
		}
	}

	public function ajaxActionProvider(){

		$ids = $this->request->getPost("id");
		if(empty($ids)){
			response(array(
				"st"    => "error",
				"label" => "Thông Báo !",
				"txt"   => 'Có lỗi trong quá trình thực hiện !',
				
			));
		}

		foreach($ids as $id){

			$result = $this->provider_model->deleteProvider($id);
		}

		response(array(
			"st"   => "success",
			"label" => "Thông Báo !",
			"txt" => "Thành công !",
		));
	}
	
	// -----------

}
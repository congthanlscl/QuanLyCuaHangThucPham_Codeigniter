<?php 

namespace Modules\Admin\Controllers;

// use Modules\Admin\Models\AdminModel;
use Modules\Admin\Models\CustomerModel;

class Customer extends BaseController
{
	// private $admin_model ;
    private $customer_model ;
	public function __construct(){

		// $this->admin_model = new AdminModel();
        $this->customer_model = new CustomerModel();
		
	}

	
	public function index(){ //
		
        $result = $this->customer_model->getCustomer();

		$data = ['title' => 'Danh sách khách hàng', 'result' => $result, 'view' => 'admin/customer/customer'];
		return $this->view('template/admin', $data);
	}
	
	public function updateCustomer(){

		$customer_id = $this->request->getGet("id");
		if(empty($customer_id)){
			return redirect()->to('/admin/customer');
		}

		$result = $this->customer_model->getCustomerByID($customer_id);

		$data = ['title' => 'Cập nhật khách hàng', "result"=>$result, 'view' => 'admin/customer/UpdateCustomer'];
		return view('template/admin', $data);
	}

	public function ajaxAddCustomer(){

		$customer_name    = $this->request->getPost("customer_name");
		$customer_address = $this->request->getPost("customer_address");
        $customer_phone   = $this->request->getPost("customer_phone");

		$rules =  [
			'customer_name' => [
				'label'  => 'Tên khách hàng',
				'rules'  => 'required|is_unique[customer.customer_name]',
				'errors' => [
					'required' => 'Tên khách hàng là cần thiết',
					'is_unique' => "Khách hàng đã tồn tại",
				]
			],
			'customer_address' => [
				'label'  => 'Địa chỉ',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Địa chỉ là cần thiết',
				]
            ],
            'customer_phone' => [
                'label'  => 'Số điện thoại',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Số điện thoại là cần thiết',
                ]
            ]
		];
		
		if($this->validate($rules)){

			$customer = array(
				"customer_name"    => $customer_name,
				"customer_address" => $customer_address,
                "customer_phone"   => $customer_phone,
			);

			$result = $this->customer_model->addCustomer($customer); // trả về id nếu thành công

			if($result){
				response(array(
					"st"    => "success",
					"label" => "Thông Báo !",
					"id"    => $result,
					"txt" 	=> "Thêm khách hàng thành công",
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

	public function ajaxUpdateCustomer(){

		$customer_id      = $this->request->getPost("customer_id");
		$customer_address = $this->request->getPost("customer_address");
		$customer_phone   = $this->request->getPost("customer_phone");

		$rules =  [
			'customer_id' => [
				'label'  => 'ID khách hàng',
				'rules'  => 'required|greater_than[0]',
				'errors' => [
					'required' => 'ID khách hàng là cần thiết',
					'greater_than' => 'Khách hàng không tồn tại'
				]
			],
			'customer_address' => [
				'label'  => 'Địa chỉ',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Địa chỉ là cần thiết',
				]
			],
			'customer_phone' => [
				'label'  => 'Số điện thoại',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Số điện thoại là cần thiết',
				]
			]
		];
		
		if($this->validate($rules)){

			$customer = array(
				"customer_address" => $customer_address,
				"customer_phone"   => $customer_phone,
			);

			$result = $this->customer_model->updateCustomer($customer, $customer_id);

			if($result){
				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "cập nhật khách hàng thành công",
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

	public function ajaxDeleteCustomer(){

		$id = $this->request->getPost("id");

		if(empty($id)){
			response(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => 'Có lỗi trong quá trình thực hiện'
			));
		}


		$result = $this->customer_model->deleteCustomer($id);

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
				"txt"   => 'Có lỗi trong quá trình cập nhật - Đang tồn tại đơn hàng cho khách hàng này !'
			));
		}
	}

	public function ajaxActionCustomer(){

		$ids = $this->request->getPost("id");
		if(empty($ids)){
			response(array(
				"st"    => "error",
				"label" => "Thông Báo !",
				"txt"   => 'Có lỗi trong quá trình thực hiện !',
				
			));
		}

		foreach($ids as $id){

			$result = $this->customer_model->deleteCustomer($id);
		}

		response(array(
			"st"   => "success",
			"label" => "Thông Báo !",
			"txt" => "Thành công !",
		));
	}
	
	// -----------

}
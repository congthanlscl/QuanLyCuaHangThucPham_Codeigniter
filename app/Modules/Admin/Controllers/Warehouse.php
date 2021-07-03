<?php 

namespace Modules\Admin\Controllers;

use Modules\Admin\Models\AdminModel;
use Modules\Admin\Models\WarehouseModel;

class Warehouse extends BaseController
{
	private $admin_model ;
    private $warehouse_model ;
	public function __construct(){

		$this->admin_model = new AdminModel();
        $this->warehouse_model = new WarehouseModel();
		
	}

	
	public function index(){ //
		
        $result = $this->admin_model->getWarehouse();

		$data = ['title' => 'Danh sách nhà kho', 'result' => $result, 'view' => 'admin/warehouse/warehouse'];
		return $this->view('template/admin', $data);
	}

    public function addWarehouse(){

        $data = ['title' => 'Thêm nhà kho', 'view' => 'admin/warehouse/addWarehouse'];
		return $this->view('template/admin', $data);
    }

    public function updateWarehouse(){

        $id = $this->request->getGet("id");

        $result = $this->warehouse_model->getWarehouseById($id);

        $data = ['title' => 'Cập nhật nhà kho', 'result' => $result, 'view' => 'admin/warehouse/updateWarehouse'];
		return $this->view('template/admin', $data);
    }


    public function ajaxAddWarehouse(){

        $warehouse_name = $this->request->getPost("warehouse_name");

        $rules =  [
			'warehouse_name' => [
				'label'  => 'Tên nhà kho',
				'rules'  => 'required|is_unique[warehouse.warehouse_name]',
				'errors' => [
					'required' => 'Tên nhà kho là cần thiết',
					'is_unique' => "Nhà kho đã tồn tại",
				]
			],
		];

        if($this->validate($rules)){

			$warehouse = array(
				"warehouse_name" => $warehouse_name,
			);

			$result = $this->warehouse_model->addWarehouse($warehouse);

			if($result){
				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Thêm nhà kho thành công",
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

	public function ajaxUpdateWarehouse(){

		$warehouse_name = $this->request->getPost("warehouse_name");
		$old_name = $this->request->getPost("old_name");
		$warehouse_id = $this->request->getPost("warehouse_id");

		$warehouse_name_rules = (strtolower($warehouse_name) != strtolower($old_name)) ? 'required|is_unique[warehouse.warehouse_name]' : 'required';
		$rules =  [
			'warehouse_id' => [
				'label'  => 'ID nhà kho',
				'rules'  => 'required|greater_than[0]',
				'errors' => [
					'required' => 'ID nhà kho là cần thiết',
					'greater_than' => 'ID nhà kho không tồn tại'
				]
			],
			'warehouse_name' => [
				'label'  => 'Tên nhà kho',
				'rules'  => $warehouse_name_rules,
				'errors' => [
					'required' => 'Tên nhà kho là cần thiết',
					'is_unique' => "Nhà kho đã tồn tại",
				]
			],
		];
		
		if($this->validate($rules)){

			$warehouse = array(
				"warehouse_name" => $warehouse_name,
			);

			$result = $this->warehouse_model->updateWarehouse($warehouse, $warehouse_id);

			if($result){
				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Cập nhật nhà kho thành công",
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

	public function ajaxDeleteWarehouse(){

		$id = $this->request->getPost("id");

		if(empty($id)){
			response(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => 'Có lỗi trong quá trình thực hiện'
			));
		}


		$result = $this->warehouse_model->deleteWarehouse($id);

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

	public function ajaxActionWarehouse(){

		$ids = $this->request->getPost("id");
		if(empty($ids)){
			response(array(
				"st"    => "error",
				"label" => "Thông Báo !",
				"txt"   => 'Có lỗi trong quá trình thực hiện !',
				
			));
		}

		foreach($ids as $id){

			$result = $this->warehouse_model->deleteWarehouse($id);
		}

		response(array(
			"st"   => "success",
			"label" => "Thông Báo !",
			"txt" => "Thành công !",
		));
	}
	
	// -----------

}
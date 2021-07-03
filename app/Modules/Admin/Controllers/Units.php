<?php 

namespace Modules\Admin\Controllers;

use Modules\Admin\Models\AdminModel;
use Modules\Admin\Models\UnitsModel;

class Units extends BaseController
{
	private $admin_model ;
    private $units_model ;
	public function __construct(){

		$this->admin_model = new AdminModel();
        $this->units_model = new UnitsModel();
		
	}

	
	public function index(){ //
		
        $result = $this->units_model->getUnits();

		$data = ['title' => 'Danh sách đơn vị', 'result' => $result, 'view' => 'admin/unit/unit'];
		return $this->view('template/admin', $data);
	}
	
	public function addUnits(){

		$data = ['title' => 'Thêm đơn vị', 'view' => 'admin/unit/addUnit'];
		return $this->view('template/admin', $data);
	}

	public function updateUnits(){

		$id = $this->request->getGet("id");
		$result = $this->units_model->getUnit($id);

		$data = ['title' => 'Cập nhật đơn vị', 'result' => $result, 'view' => 'admin/unit/updateUnit'];
		return $this->view('template/admin', $data);
	}

	public function ajaxAddUnits(){

		$unit_name = $this->request->getPost("unit_name");

		$rules =  [
			'unit_name' => [
				'label'  => 'Tên đơn vị',
				'rules'  => 'required|is_unique[unit.unit_name]',
				'errors' => [
					'required' => 'Tên đơn vị là cần thiết',
					'is_unique' => "Đơn vị đã tồn tại",
				]
			],
		];
		
		if($this->validate($rules)){

			$unit = array(
				"unit_name" => $unit_name,
			);

			$result = $this->units_model->addUnit($unit);

			if($result){
				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Thêm đơn vị thành công",
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

	public function ajaxUpdateUnits(){

		$unit_name = $this->request->getPost("unit_name");
		$old_name = $this->request->getPost("old_name");
		$unit_id = $this->request->getPost("unit_id");

		$unit_name_rules = (strtolower($unit_name) != strtolower($old_name)) ? 'required|is_unique[unit.unit_name]' : 'required';
		$rules =  [
			'unit_id' => [
				'label'  => 'ID đơn vị',
				'rules'  => 'required|greater_than[0]',
				'errors' => [
					'required' => 'ID đơn vị là cần thiết',
					'greater_than' => 'ID đơn vị không tồn tại'
				]
			],
			'unit_name' => [
				'label'  => 'Tên đơn vị',
				'rules'  => $unit_name_rules,
				'errors' => [
					'required' => 'Tên đơn vị là cần thiết',
					'is_unique' => "Đơn vị đã tồn tại",
				]
			],
		];
		
		if($this->validate($rules)){

			$unit = array(
				"unit_name" => $unit_name,
			);

			$result = $this->units_model->updateUnit($unit, $unit_id);

			if($result){
				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Cập nhật đơn vị thành công",
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

	public function ajaxDeleteUnits(){

		$id = $this->request->getPost("id");

		if(empty($id)){
			response(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => 'Có lỗi trong quá trình thực hiện'
			));
		}


		$result = $this->units_model->deleteUnit($id);

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

	public function ajaxActionUnit(){

		$ids = $this->request->getPost("id");
		if(empty($ids)){
			response(array(
				"st"    => "error",
				"label" => "Thông Báo !",
				"txt"   => 'Có lỗi trong quá trình thực hiện !',
				
			));
		}

		foreach($ids as $id){

			$result = $this->units_model->deleteUnit($id);
		}

		response(array(
			"st"   => "success",
			"label" => "Thông Báo !",
			"txt" => "Thành công !",
		));
	}
	
	// -----------

}
<?php 

namespace Modules\Admin\Controllers;

use Modules\Admin\Models\AdminModel;
use Modules\Admin\Models\CategoriesModel;

class Categories extends BaseController
{
	private $admin_model ;
    private $categories_model ;
	public function __construct(){

		$this->admin_model = new AdminModel();
        $this->categories_model = new CategoriesModel();
		
	}

	
	public function index(){ //
		
        $result = $this->categories_model->getCategories();

		$data = ['title' => 'Danh sách danh mục sản phẩm', 'result' => $result, 'view' => 'admin/categories/categories'];
		return $this->view('template/admin', $data);
	}
	
	public function updateCategories(){

		$category_id = $this->request->getGet("id");
		if(empty($category_id)){
			return redirect()->to('/admin/categories');
		}

		$result = $this->categories_model->getCategoryByID($category_id);

		$data = ['title' => 'Cập nhật danh mục', "result"=>$result, 'view' => 'admin/categories/UpdateCategory'];
		return view('template/admin', $data);
	}

	public function addCategories(){

		$data = ['title' => 'Thêm danh mục', 'view' => 'admin/categories/AddCategory'];
		return view('template/admin', $data);
	}


	public function ajaxAddCategories(){

		$category_name = $this->request->getPost("category_name");
		$category_slug = $this->request->getPost("category_slug") . ".html";

		$rules =  [
			'category_name' => [
				'label'  => 'Tên danh mục',
				'rules'  => 'required|is_unique[categories.category_name]',
				'errors' => [
					'required' => 'Tên danh mục là cần thiết',
					'is_unique' => "Tên danh mục đã tồn tại",
				]
			],
			'category_slug' => [
				'label'  => 'Slug danh mục',
				'rules'  => 'required|is_unique[categories.category_slug]',
				'errors' => [
					'required' => 'Slug danh mục là cần thiết',
					'is_unique' => "Slug danh mục đã tồn tại",
				]
			]
		];
		
		if($this->validate($rules)){

			$category = array(
				"category_name" => $category_name,
				"category_slug" => $category_slug,
			);

			$result = $this->categories_model->addCategory($category);

			if($result){
				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Thêm danh mục thành công",
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

	public function ajaxUpdateCategories(){

		$category_name = $this->request->getPost("category_name");
		$category_slug = $this->request->getPost("category_slug");
		$category_id   = $this->request->getPost("category_id");
		$old_name      = $this->request->getPost("old_name");

		$category_slug = (strpos($category_slug,".html") == false) ? $category_slug.".html" : $category_slug;

		$category_name_rules = 'required';
		$category_slug_rules = 'required';
		if($category_name != $old_name){
			$category_name_rules = 'required|is_unique[categories.category_name]';
			$category_slug_rules = 'required|is_unique[categories.category_slug]';
		}

		$rules =  [
			'category_id' => [
				'label'  => 'ID danh mục',
				'rules'  => 'required|greater_than[0]',
				'errors' => [
					'required' => 'ID danh mục là cần thiết',
					'greater_than' => 'ID danh mục không tồn tại'
				]
			],
			'category_name' => [
				'label'  => 'Tên danh mục',
				'rules'  => $category_name_rules,
				'errors' => [
					'required' => 'Tên danh mục là cần thiết',
					'is_unique' => "Tên danh mục đã tồn tại",
				]
			],
			'category_slug' => [
				'label'  => 'Slug danh mục',
				'rules'  => $category_slug_rules,
				'errors' => [
					'required' => 'Slug danh mục là cần thiết',
					'is_unique' => "Slug danh mục đã tồn tại",
				]
			]
		];
		
		if($this->validate($rules)){

			$category = array(
				"category_name" => $category_name,
				"category_slug" => $category_slug,
				"update_time"   => date("Y-m-d"),
			);

			$result = $this->categories_model->updateCategory($category_id, $category);

			if($result){
				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "cập nhật danh mục thành công",
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

	public function ajaxDeleteCategories(){

		$id = $this->request->getPost("id");

		if(empty($id)){
			response(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => 'Có lỗi trong quá trình thực hiện'
			));
		}


		$result = $this->categories_model->deleteCategory($id);

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

	public function ajaxActionCategories(){

		$ids = $this->request->getPost("id");
		if(empty($ids)){
			response(array(
				"st"    => "error",
				"label" => "Thông Báo !",
				"txt"   => 'Có lỗi trong quá trình thực hiện !',
				
			));
		}

		foreach($ids as $id){

			$result = $this->categories_model->deleteCategory($id);
		}

		response(array(
			"st"   => "success",
			"label" => "Thông Báo !",
			"txt" => "Thành công !",
		));
	}
	
	// -----------

}
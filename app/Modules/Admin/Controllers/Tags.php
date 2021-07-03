<?php 

namespace Modules\Admin\Controllers;

use Modules\Admin\Models\AdminModel;
use Modules\Admin\Models\TagsModel;

class Tags extends BaseController
{
	private $admin_model ;
    private $tags_model ;
	public function __construct(){

		$this->admin_model = new AdminModel();
        $this->tags_model = new TagsModel();
		
	}

	
	public function index(){ //
		
        $result = $this->tags_model->getTags();

		$data = ['title' => 'Danh sách nhãn', 'result' => $result, 'view' => 'admin/tags/tags'];
		return $this->view('template/admin', $data);
	}

	public function addTags(){

		$data = ['title' => 'Thêm nhãn', 'view' => 'admin/tags/addTags'];
		return $this->view('template/admin', $data);
	}

	public function updateTags(){

		$id = $this->request->getGet("id");

		if(empty($id)){

			return redirect()->to("/tags");
		}

		$result = $this->tags_model->getTag($id);

		$data = ['title' => 'Cập nhật nhãn', "result" => $result, 'view' => 'admin/tags/updateTags'];
		return $this->view('template/admin', $data);
	}


	public function ajaxAddTags(){

		$tag_name  = $this->request->getPost("tag_name");
		$tag_image = $this->request->getFile("tag_image");

		$rules =  [
			'tag_name' => [
				'label'  => 'Tên nhãn',
				'rules'  => 'required|is_unique[tags.tag_name]',
				'errors' => [
					'required' => 'Tên nhãn là cần thiết',
					'is_unique' => "Nhãn đã tồn tại",
				]
			],
			"tag_image" => [
				"label" => "Hình ảnh nhãn",
				"rules" => 'uploaded[tag_image]|max_size[tag_image, 1024]|is_image[tag_image]',
				'errors' => [
					'uploaded' => 'Hình ảnh nhãn là cần thiết',
					'max_size' => 'Hình ảnh nhãn cần nhỏ hơn 1024 kb',
					'is_image' => 'File tải lên phải là hình ảnh'
				]
			],
		];
		
		if($this->validate($rules)){

			$tag = array(
				"tag_name" => $tag_name,
			);

			if ($tag_image->isValid() && !$tag_image->hasMoved())
			{
				$filename = md5($tag_name) . ".". $tag_image->getClientExtension(); // tuỳ xem đặt tên ở đây

				$tag_image->move(ROOTPATH.'public/images/tags', $filename);

				$filepath = '/images/tags/'. $filename;
				$tag["tag_image"] = $filepath;
			}


			$result = $this->tags_model->addTags($tag);

			if($result){
				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Thêm nhãn thành công",
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
 
	public function ajaxUpdateTags(){

		$tag_name  = $this->request->getPost("tag_name");
		$tag_image = $this->request->getFile("tag_image");

		$rules =  [
			"tag_image" => [
				"label" => "Hình ảnh nhãn",
				"rules" => 'max_size[tag_image, 1024]|is_image[tag_image]',
				'errors' => [
					'max_size' => 'Hình ảnh nhãn cần nhỏ hơn 1024 kb',
					'is_image' => 'File tải lên phải là hình ảnh'
				]
			],
		];
		
		if($this->validate($rules)){

			$tag = array();
			if ($tag_image->isValid() && !$tag_image->hasMoved())
			{
				$filename = md5($tag_name) . ".". $tag_image->getClientExtension(); // tuỳ xem đặt tên ở đây
				$filepath = ROOTPATH.'public/images/tags/'. $filename;
				if (file_exists($filepath)) {   
					unlink($filepath);
				}
				$tag_image->move(ROOTPATH.'public/images/tags', $filename);

			}


			response(array(
				"st"   => "success",
				"label" => "Thông Báo !",
				"txt" => "cập nhật thành công",
			));
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

	public function ajaxDeleteTags(){

		$id = $this->request->getPost("id");
		if(empty($id)){

			response(array(
				"st"   => "error",
				"label" => "Thông Báo !",
				"txt" => "có lỗi trong quá trình thực hiện",
			));
		}

		$oldTags = $this->tags_model->getTag($id);
		if (file_exists(".".$oldTags->tag_image)) {   
			unlink(".".$oldTags->tag_image);
		}

		$result = $this->tags_model->deleteTags($id);
		if($result){
			response(array(
				"st"   => "success",
				"label" => "Thông Báo !",
				"txt" => "Xoá thành công thành công",
			));
		}
		else{
			response(array(
				"st"   => "error",
				"label" => "Thông Báo !",
				"txt" => "có lỗi trong quá trình thực hiện",
			));
		}
	}

	public function ajaxActionTags(){

		$ids = $this->request->getPost("id");
		if(empty($ids)){
			response(array(
				"st"    => "error",
				"label" => "Thông Báo !",
				"txt"   => 'Có lỗi trong quá trình thực hiện !',
				
			));
		}

		foreach($ids as $id){

			if(!empty($id)){ // Khác empty thì xoá

				$oldTags = $this->tags_model->getTag($id);
				if (file_exists(".".$oldTags->tag_image)) {   
					unlink(".".$oldTags->tag_image);
				}

				$result = $this->tags_model->deleteTags($id);
			}

		}

		response(array(
			"st"   => "success",
			"label" => "Thông Báo !",
			"txt" => "Thành công !",
		));
	}

	// -----------

}
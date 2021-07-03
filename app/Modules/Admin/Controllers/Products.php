<?php 

namespace Modules\Admin\Controllers;

use Modules\Admin\Models\AdminModel;
use Modules\Admin\Models\ProductsModel;

class Products extends BaseController
{
	private $admin_model ;
    private $products_model ;
	public function __construct(){

		$this->admin_model = new AdminModel();
        $this->products_model = new ProductsModel();
		
	}

	
	public function index(){ //
		
        $result = $this->products_model->getProducts();

		$data = ['title' => 'Danh sách sản phẩm', 'result' => $result, 'view' => 'admin/products/products'];
		return $this->view('template/admin', $data);
	}

    public function addProducts(){

        $categories = $this->products_model->getCategories();
        $units      = $this->products_model->getUnits();
        $tags       = $this->products_model->getTags();

		$data = [
            'title'      => 'Thêm sản phẩm', 
            'categories' => $categories,
            'units'      => $units,
            'tags'       => $tags,
            'view'       => 'admin/products/addProducts'
        ];

		return $this->view('template/admin', $data);
	}

    public function updateProducts(){

        $id = $this->request->getGet("id");

		if(empty($id)){

			return redirect()->to("/products");
		}

        $categories = $this->products_model->getCategories();
        $units      = $this->products_model->getUnits();
        $tags       = $this->products_model->getTags();

        $product    = $this->products_model->getProduct($id);

		$data = [
            'title'      => 'Cập nhật sản phẩm', 
            'categories' => $categories,
            'units'      => $units,
            'tags'       => $tags,
            'result'     => $product,
            'view'       => 'admin/products/updateProducts'
        ];

		return $this->view('template/admin', $data);
	}


    public function ajaxAddProducts(){

		$product_name   = $this->request->getPost("product_name");
		$product_slug   = $this->request->getPost("product_slug");
        $price          = $this->request->getPost("price");
        $purchase_price = $this->request->getPost("purchase_price");
        $discount       = $this->request->getPost("discount");
        $description    = $this->request->getPost("description");
        $category_id    = $this->request->getPost("category_id");
        $unit_id        = $this->request->getPost("unit_id");
        $keyword        = $this->request->getPost("keyword");
        $tag_id         = $this->request->getPost("tag_id");

        $image          = $this->request->getFile("image");

		$rules =  [
			'product_name' => [
				'label'  => 'Tên sản phẩm',
				'rules'  => 'required|is_unique[products.product_name]',
				'errors' => [
					'required' => 'Tên sản phẩm là cần thiết',
					'is_unique' => "Sản phẩm đã tồn tại",
				]
			],
            'product_slug' => [
				'label'  => 'Slug',
				'rules'  => 'required|is_unique[products.product_slug]',
				'errors' => [
					'required' => 'Slug là cần thiết',
					'is_unique' => "Slug đã tồn tại",
				]
			],
            'price' => [
				'label'  => 'Giá bán',
				'rules'  => 'required|is_natural_no_zero',
				'errors' => [
					'required' => 'Giá bán là cần thiết',
                    'is_natural_no_zero' => 'Giá bán phải lớn hơn 0',
				]
			],
            'purchase_price' => [
				'label'  => 'Giá mua',
				'rules'  => 'required|is_natural_no_zero',
				'errors' => [
					'required' => 'Giá mua là cần thiết',
                    'is_natural_no_zero' => 'Giá mua phải lớn hơn 0',
				]
			],
            'discount' => [
				'label'  => 'Giảm giá',
				'rules'  => 'required|is_natural|less_than[100]',
				'errors' => [
					'required' => 'Giảm giá là cần thiết',
                    'is_natural' => 'Giảm giá phải lơn hơn hoặc bằng 0%',
                    'less_than'  => 'Giảm giá phải nhỏ hơn 100%'
				]
			],
            'category_id' => [
				'label'  => 'Danh mục',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Danh mục sản phẩm là cần thiết',
				]
			],
            'unit_id' => [
				'label'  => 'Đơn vị',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Đơn vị là cần thiết',
				]
			],
            'keyword' => [
				'label'  => 'Từ khoá',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Từ khoá là cần thiết',
				]
			],
            'tag_id' => [
				'label'  => 'Nhãn',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Nhãn là cần thiết',
				]
			],
			"image" => [
				"label" => "Hình ảnh sản phẩm",
				"rules" => 'uploaded[image]|max_size[image, 1024]|is_image[image]',
				'errors' => [
					'uploaded' => 'Hình ảnh sản phẩm là cần thiết',
					'max_size' => 'Hình ảnh sản phẩm nhỏ hơn 1024 kb',
					'is_image' => 'File tải lên phải là hình ảnh'
				]
			],
		];
		
		if($this->validate($rules)){

            if ($purchase_price >= $price)
			{
				response(array(
					"st"   => "error",
					"label" => "Thông Báo !",
					"txt" => "Giá nhập cần nhỏ hơn giá bán !",
				));
			}

			$products = array(
				"product_name"   => $product_name,
                "product_slug"   => $product_slug.".html",
                "price"          => $price,
                "purchase_price" => $purchase_price,
                "discount"       => $discount,
                "description"    => $description,
                "category_id"    => $category_id,
                "unit_id"        => $unit_id,
                "keyword"        => $keyword,
                "tag_id"         => $tag_id,
			);

			if ($image->isValid() && !$image->hasMoved())
			{
				$filename = md5($product_name) . ".". $image->getClientExtension(); // tuỳ xem đặt tên ở đây

				$image->move(ROOTPATH.'public/images/products', $filename);

				$filepath = '/images/products/'. $filename;
				$products["image"] = $filepath;
			}


			$result = $this->products_model->addProducts($products);
            
			if($result){ // insert id

                $warehouse = $this->admin_model->getWarehouse(); // danh sách nhà kho

                foreach($warehouse as $value){

                    $inventory = array(
                        "stock"        => 0,
                        "product_id"   => $result,
                        "warehouse_id" => $value->warehouse_id,
                        "create_time"  => date("y-m-d"),
                    );

                    $insert = $this->admin_model->addInventory($inventory); // thêm tồn kho cho từng nhà kho
                }

				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Thêm sản phẩm thành công",
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

    public function ajaxUpdateProducts(){

        $product_id     = $this->request->getPost("product_id");
		// $product_name   = $this->request->getPost("product_name");
		// $product_slug   = $this->request->getPost("product_slug");
        $price          = $this->request->getPost("price");
        $purchase_price = $this->request->getPost("purchase_price");
        $discount       = $this->request->getPost("discount");
        $description    = $this->request->getPost("description");
        $category_id    = $this->request->getPost("category_id");
        $unit_id        = $this->request->getPost("unit_id");
        $keyword        = $this->request->getPost("keyword");
        $tag_id         = $this->request->getPost("tag_id");

        $image          = $this->request->getFile("image");

		$rules =  [
            'product_id' => [
				'label'  => 'ID sản phẩm',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Có lỗi trong quá trình thực hiện',
				]
			],
            'price' => [
				'label'  => 'Giá bán',
				'rules'  => 'required|is_natural_no_zero',
				'errors' => [
					'required' => 'Giá bán là cần thiết',
                    'is_natural_no_zero' => 'Giá bán phải lớn hơn 0',
				]
			],
            'purchase_price' => [
				'label'  => 'Giá mua',
				'rules'  => 'required|is_natural_no_zero',
				'errors' => [
					'required' => 'Giá mua là cần thiết',
                    'is_natural_no_zero' => 'Giá mua phải lớn hơn 0',
				]
			],
            'discount' => [
				'label'  => 'Giảm giá',
				'rules'  => 'required|is_natural|less_than[100]',
				'errors' => [
					'required' => 'Giảm giá là cần thiết',
                    'is_natural' => 'Giảm giá phải lơn hơn hoặc bằng 0%',
                    'less_than'  => 'Giảm giá phải nhỏ hơn 100%'
				]
			],
            'category_id' => [
				'label'  => 'Danh mục',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Danh mục sản phẩm là cần thiết',
				]
			],
            'unit_id' => [
				'label'  => 'Đơn vị',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Đơn vị là cần thiết',
				]
			],
            'keyword' => [
				'label'  => 'Từ khoá',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Từ khoá là cần thiết',
				]
			],
            'tag_id' => [
				'label'  => 'Nhãn',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Nhãn là cần thiết',
				]
			]
		];
		
		if($this->validate($rules)){

            if ($purchase_price >= $price)
			{
				response(array(
					"st"   => "error",
					"label" => "Thông Báo !",
					"txt" => "Giá nhập cần nhỏ hơn giá bán !",
				));
			}

            $old_product = $this->products_model->getProduct($product_id);

            if(empty((array)$old_product)){

                response(array(
					"st"   => "error",
					"label" => "Thông Báo !",
					"txt" => "Sản phẩm không tồn tại !",
				));
            }

			$products = array(
                "price"          => $price,
                "purchase_price" => $purchase_price,
                "discount"       => $discount,
                "description"    => $description,
                "category_id"    => $category_id,
                "unit_id"        => $unit_id,
                "keyword"        => $keyword,
                "tag_id"         => $tag_id,
			);

			if ($image->isValid() && !$image->hasMoved())
			{

                $filepath = ROOTPATH.'public'. $old_product->image;
				if (file_exists($filepath)) {   
					unlink($filepath);
				}

                $filename = substr($filepath, strrpos($filepath, '/') + 1);

				$image->move(ROOTPATH.'public/images/products', $filename);

			}


			$result = $this->products_model->updateProducts($products, $product_id);

			if($result){
				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Cập nhật sản phẩm thành công",
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

    public function ajaxChangeStatusProducts(){ // thay đổi trạng thái

        $id   = $this->request->getPost("id");
        $type = $this->request->getPost("type");
		if(empty($id)){

			response(array(
				"st"   => "error",
				"label" => "Thông Báo !",
				"txt" => "có lỗi trong quá trình thực hiện",
			));
		}

		$update_data = [
            "status" => $type, // status theo type luôn
        ];

		$result = $this->products_model->updateProducts($update_data, $id);
		if($result){
			response(array(
				"st"   => "success",
				"label" => "Thông Báo !",
				"txt" => "Cập nhật sản phẩm thành công",
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

    public function ajaxActionProducts(){ // thay đổi trạng thái hàng loạt

		$ids = $this->request->getPost("id");
        $type = $this->request->getPost("type");

		if(empty($ids)){
			response(array(
				"st"    => "error",
				"label" => "Thông Báo !",
				"txt"   => 'Có lỗi trong quá trình thực hiện !',
				
			));
		}

        $update_data = [
            "status" => $type, // status theo type luôn
        ];

		foreach($ids as $id){

            $result = $this->products_model->updateProducts($update_data, $id);

		}

		response(array(
			"st"   => "success",
			"label" => "Thông Báo !",
			"txt" => "Thành công !",
		));
	}

	// -----------

}
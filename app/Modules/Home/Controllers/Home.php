<?php 

namespace Modules\Home\Controllers;

use Modules\Home\Models\HomeModel;

class Home extends BaseController
{
	public $model ;
	public function __construct(){

		$this->model = new HomeModel();
		$this->data = array(
			"categories" => $this->model->getCategories(),
			// "cart" => $this->model->getCart($cart_session),
		);

	}

	
	public function index(){ //

		$cart = array();
		if(!empty($this->cart)){
			$cart = $this->model->getCart($this->cart);
		}

		$data = [
			'sale_products' => $this->model->getSaleProducts(),
			'new_products'  => $this->model->getNewProducts(),
			'tag_products'  => $this->model->getProductsByTags(6),
			'title' 	    => 'Index',
			'cart' 			=> $cart,
			'view' 			=> 'home/index'
		];
		return $this->view('template/home', $data);
	}
	

	public function categories($seg){

		$cart = array();
		if(!empty($this->cart)){
			$cart = $this->model->getCart($this->cart);
		}

		$category = $this->model->getCategory($seg);
		$data = [
			'category' => $category,
			'products' => $this->model->getProductsByCategories($category->category_id),
			'title'    => 'Danh mục',
			'cart' 	   => $cart,
			'view'     => 'home/categories'
		];
		return $this->view('template/home', $data);
	}

	public function search(){

		$cart = array();
		if(!empty($this->cart)){
			$cart = $this->model->getCart($this->cart);
		}

		$keyword = $this->request->getGet("k");

		$product = $this->model->getProductsByKeyword($keyword);
		$data = [
			'category' => (object)array(
				"category_name" => "Tìm kiếm sản phẩm: " . $keyword,
			),
			'products' => $product,
			'title'    => 'Danh mục',
			'cart' 	   => $cart,
			'view'     => 'home/categories'
		];
		return $this->view('template/home', $data);
	}

	public function product($seg){

		$cart = array();
		if(!empty($this->cart)){
			$cart = $this->model->getCart($this->cart);
		}

		$data = [
			'product' => $this->model->getProductBySlug($seg),
			'title'   => 'Sản phẩm',
			'cart' 	  => $cart,
			'view'    => 'home/product'
		];
		return $this->view('template/home', $data);
	}

	public function cart(){

		$cart = array();
		if(!empty($this->cart)){
			$cart = $this->model->getCart($this->cart);
		}

		$data = [
			'title'   => 'Giỏ hàng',
			'cart' 	  => $cart,
			'view'    => 'home/cart'
		];
		return $this->view('template/Cart', $data);
	}

	public function checkout(){

		$cart = array();
		if(!empty($this->cart)){
			$cart = $this->model->getCart($this->cart);
		}

		$data = [
			'title'   => 'Thanh toán',
			'cart' 	  => $cart,
			'view'    => 'home/checkout'
		];
		return $this->view('template/Cart', $data);
	}

	public function remove_cart(){

		$product_id = $this->request->getGet("pid");
		$this->removeCart($product_id);

		return redirect()->to('/cart'); 

	}
	

	public function ajaxAddToCart()
	{
		$product_id = $this->request->getPost("product_id");
		$quantity    = $this->request->getPost("quantity");

		$product = (object)array(
			"product_id" => $product_id,
			"quantity"	 => $quantity,
		);

		$count = $this->addToCart($product);

		$cart = array();
		if(!empty($this->cart)){
			$cart = $this->model->getCart($this->cart);
		}
		print_r(json_encode(array(
			"st"    => "success",
			"cart"  => $cart,
			"count" => $count,
		)));
	}

	public function ajaxDeleteCart(){

		$product_id = $this->request->getPost("product_id");

		$this->removeCart($product_id);

		$cart = array();
		if(!empty($this->cart)){
			$cart = $this->model->getCart($this->cart);
		}

		print(json_encode(array(
			"st"    => "success",
			"cart"  => $cart,
			"count" => (!empty($cart)) ? count($cart["data"]) : 0 
		)));
	}

	public function ajaxUpdateCart(){

		$product_id = $this->request->getGet("pid");
		$quantity   = $this->request->getGet("qty");
		$product = (object)array(
			"product_id" => $product_id,
			"quantity"   => $quantity,
		);
		$this->updateToCart($product);

		$cart = array();
		if(!empty($this->cart)){
			$cart = $this->model->getCart($this->cart);
		}

		$cart["data"][$product_id]->amount = number_format($cart["data"][$product_id]->amount, 0, ",", ".")."đ";
		print(json_encode(array(
			"st"    => "success",
			"cart"  => $cart["data"][$product_id],
			"total" => number_format($cart["total"], 0, ",", ".")."đ"
		)));
	}

	public function ajaxOrder(){

		$customer_name    = $this->request->getGet("name");
		$customer_phone   = $this->request->getGet("tel");
		$customer_address = $this->request->getGet("address");
		$note  			  = $this->request->getGet("note");

		$cart = array();
		if(!empty($this->cart)){
			$cart = $this->model->getCart($this->cart);
		}
		else {
			
			response(array(
				"st"   => "error",
				"message" => "Bạn chưa sản phẩm nào trong giỏ hàng",
			));
		}

		$products = $cart["data"];

		$bill = array(
			"customer_name"  => $customer_name,
			"customer_phone"  => $customer_phone,
			"customer_address"  => $customer_address,
			"status" => 2, // trạng thái chờ duyệt
			"user_id" => 1,
			"notes" => $note,
			"create_time"  => date("Y-m-d"),
		);

		$result = $this->model->addBill($bill);
		
		if($result){ // insert id

			foreach($products as $value){

				$order = array(
					"product_id" => $value->product_id,
					"quantity"   => $value->quantity,
					"status"     => 2,
					"total"      => $value->amount,
					"bill_id"    => $result,
				);

				$insert = $this->model->addOrder($order); // thêm đơn hàng
			}

			$this->removeAllCart();

			response(array(
				"st"   => "success",
				"message" => "Đặt hàng thành công, chúng tôi sẽ sớm liên hệ với bạn theo thông tin chúng tôi nhận được !",
			));
		}
	}
	
	// -----------

}

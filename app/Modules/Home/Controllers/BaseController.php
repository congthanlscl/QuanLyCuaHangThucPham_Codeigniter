<?php
namespace Modules\Home\Controllers;
/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ["common", "cookie", "form"];
	protected $session ;
	// protected $userdata;
	protected $cart;
	protected $data;
	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		$this->session = \Config\Services::session();
		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();

		// $this->userdata = $this->getUserSession();

		$this->cart = $this->getCartSession();
	}

	// protected function setUserSession($user){

	// 	$data = [
	// 		"user_id" => $user->user_id,
	// 		"username" => $user->username,
	// 		"email" => $user->email,
	// 		"type" => $user->type,
	// 		"isLoggedIn" => true, 
	// 	];

	// 	setcookie('user_id', $user->user_id, time() + 86400, '/', '');
	// 	setcookie('username', $user->username, time() + 86400, '/', '');
	// 	$this->session->set("userdata", $data);
	// }

	// protected function getUserSession(){

	// 	$userdata = $this->session->get("userdata");

	// 	return (object)$userdata;
	// }
	protected function getCartSession(){

		$cart = $this->session->get("cart");

		return $cart;
	}

	public function addToCart($product){ // product object (product_id, quantity)

		// thêm giỏ hàng
		$cart = $this->session->get("cart");
		if($cart[$product->product_id] != null){ // có sản phẩm rồi

			$cart[$product->product_id]->quantity +=  $product->quantity;
		}
		else{

			$cart[$product->product_id] =  $product;
		}

		$this->session->set("cart", $cart);

		$this->cart = $this->getCartSession();

		return count($cart);
	}

	public function updateToCart($product){  // cập nhật theo số lượng post lên

		$cart = $this->session->get("cart");

		$cart[$product->product_id]->quantity =  $product->quantity;

		$this->session->set("cart", $cart);

		$this->cart = $this->getCartSession();
	}

	public function removeCart($product_id){

		$cart = $this->session->get("cart");

		unset($cart[$product_id]);

		$this->session->set("cart", $cart);

		$this->cart = $this->getCartSession();
	}

	public function removeAllCart(){

		$this->session->remove('cart');
		$this->cart = $this->getCartSession();
	}

	protected function view($template, $data){

		if(!empty($this->data))
			$data = array_merge($this->data, $data);

		return view($template, $data);
	}

}

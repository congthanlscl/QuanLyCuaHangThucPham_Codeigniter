<?php 

namespace Modules\Admin\Controllers;

use Modules\Admin\Models\AdminModel;
use Modules\Admin\Models\InventoryModel;

class Inventory extends BaseController
{
	private $admin_model ;
    private $inventory_model ;
	public function __construct(){

		$this->admin_model = new AdminModel();
        $this->inventory_model = new InventoryModel();
		
	}

	
	public function index(){ //
		
		// xem xét để chuyển nó về client side rendering
		$warehouse_id = $this->request->getGet("warehouse");
        $result = $this->inventory_model->getInventory($warehouse_id);
		$warehouse = $this->admin_model->getWarehouse();
		$quantity = 0;
		$amount = 0;
		$purchase_amount = 0;
		foreach($result as $value){

			$quantity += $value->stock;
			$amount += ((int)$value->stock * (int)$value->price);
			$purchase_amount += ((int)$value->stock * (int)$value->purchase_price);


		}

		$data = [
			'title'     	  => 'Danh sách tồn kho', 
			'quantity'  	  => $quantity,
			'result'          => $result, 
			'amount'    	  => $amount,
			'warehouse'		  => $warehouse,
			'purchase_amount' => $purchase_amount,
			'view' 			  => 'admin/inventory/inventory'
		];
		return $this->view('template/admin', $data);
	}

	
	// -----------

}
<?php 

namespace Modules\Admin\Controllers;

use Modules\Admin\Models\AdminModel;
use Modules\Admin\Models\PurchaseModel;

class Purchase extends BaseController
{
	private $admin_model ;
    private $purchase_model ;
	public function __construct(){

		$this->admin_model = new AdminModel();
        $this->purchase_model = new PurchaseModel();
		
	}

	
	public function index(){ //
		
        $result = $this->purchase_model->getPurchase();

		$data = ['title' => 'Danh sách nhập hàng', 'result' => $result, 'view' => 'admin/purchase/purchase'];
		return $this->view('template/admin', $data);
	}

    public function addPurchase(){

        $provider  = $this->purchase_model->getProvider();
        $warehouse = $this->admin_model->getWarehouse();
        $data = [
            'provider'  => $provider,
            'warehouse' => $warehouse,
            'title'     => 'Nhập hàng',
            'view'      => 'admin/purchase/AddPurchase'
        ];
		return $this->view('template/admin', $data);
    }

    public function updatePurchase(){

        $id = $this->request->getGet("id");
        $provider  = $this->purchase_model->getProvider();
        $warehouse = $this->admin_model->getWarehouse();
        $purchase = $this->purchase_model->getPurchaseByID($id);
        $data = [
            'provider'  => $provider,
            'warehouse' => $warehouse,
            'purchase'  => $purchase,
            'title'     => 'Nhập hàng',
            'view'      => 'admin/purchase/UpdatePurchase'
        ];
		return $this->view('template/admin', $data);
    }

    public function getPurchaseDetail(){

        $id = $this->request->getGet("id");

        $purchase = $this->purchase_model->getPurchaseDetail($id);

        response(array(
            "st"   => "success",
            "data" => $purchase,
        ));
    }

    public function ajaxAddPurchase(){

        $products    = $this->request->getPost("prd");

        $provider    = $this->request->getPost("provider");
        $warehouse   = $this->request->getPost("warehouse");
        $create_time = $this->request->getPost("create_time");


        $rules =  [
			'prd' => [
				'label'  => 'Sản phẩm',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Cần chọn ít nhất 1 sản phẩm',
				]
			],
            'provider' => [
				'label'  => 'Nhà cung cấp',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Nhà cung cấp là cần thiết',
				]
			],
            'warehouse' => [
				'label'  => 'Nhà kho',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Nhà kho là cần thiết',
				]
			],
            'create_time' => [
				'label'  => 'Ngày nhập',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Ngày nhập là cần thiết',
				]
			],
		];
		
		if($this->validate($rules)){


			$input = array(
                "provider_id"  => $provider,
                "warehouse_id" => $warehouse,
                "create_time"  => date("Y-m-d", strtotime(str_replace("/", "-", $create_time))),
			);


			$result = $this->purchase_model->addInput($input);
            
			if($result){ // insert id


                foreach($products as $value){

                    $value = (object)$value;
                    $product = $this->admin_model->getProduct($value->prd_id);
                    $purchase = array(
                        "product_id" => $value->prd_id,
                        "quantity"   => $value->prd_quantity,
                        "total"      => (float)$value->prd_quantity * (int)$product->purchase_price,
                        "input_id"   => $result,
                    );

                    $insert = $this->purchase_model->addPurchase($purchase); // thêm nhập kho
                    
                    // cập nhật lại hàng tồn kho
                    $inventory = $this->admin_model->getInventory($value->prd_id, $warehouse);

                    $update_data = array(
                        "stock" => (int)$inventory->stock + (float)$value->prd_quantity
                    );

                    $update = $this->admin_model->updateInventory($update_data, $value->prd_id, $warehouse);
                }

				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Nhập hàng thành công",
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

    public function ajaxUpdatePurchase(){

        $input_id    = $this->request->getPost("input_id");
        $provider    = $this->request->getPost("provider");
        $warehouse   = $this->request->getPost("warehouse");
        $create_time = $this->request->getPost("create_time");

        $rules =  [
            'input_id' => [
				'label'  => 'Mã nhập hàng',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Có lỗi trong quá trình thực hiện',
				]
			],
            'provider' => [
				'label'  => 'Nhà cung cấp',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Nhà cung cấp là cần thiết',
				]
			],
            'warehouse' => [
				'label'  => 'Nhà kho',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Nhà kho là cần thiết',
				]
			],
            'create_time' => [
				'label'  => 'Ngày nhập',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Ngày nhập là cần thiết',
				]
			],
		];

        if($this->validate($rules)){


			$input = array(
                "provider_id"  => $provider,
                "warehouse_id" => $warehouse,
                "create_time"  => date("Y-m-d", strtotime(str_replace("/", "-", $create_time))),
			);


			$result = $this->purchase_model->updateInput($input, $input_id);
            
			if($result){ // insert id

				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Cập nhật nhập hàng thành công",
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

    public function ajaxDeletePurchase(){

		$id = $this->request->getPost("id");

		if(empty($id)){
			response(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => 'Có lỗi trong quá trình thực hiện'
			));
		}

        $old_input = $this->purchase_model->getPurchaseByID($id);

        if(empty((array)$old_input)){
			response(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => 'Có lỗi trong quá trình thực hiện'
			));
		}

        $purchase = $this->purchase_model->getPurchaseDetail($id);
        foreach($purchase as $value){

            // cập nhật lại hàng tồn kho
            $inventory = $this->admin_model->getInventory($value->product_id, $old_input->warehouse_id);
 
            // xoá nhập kho thì trừ đi hàng tồn kho => bằng 0 nếu hàng tồn kho ít hơn số nhập kho mới xoá
            $stock = ((int)$inventory->stock >= (float)$value->quantity) ? (int)$inventory->stock - (float)$value->quantity : 0;
            $update_data = array(
                "stock" =>  $stock
            );

            $update = $this->admin_model->updateInventory($update_data, $value->product_id, $old_input->warehouse_id);
        }

        $delete_purchase = $this->purchase_model->deletePurchase($id); // xoá chi tiết nhập hàng

		$result = $this->purchase_model->deleteInput($id);

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
				"txt"   => 'Có lỗi trong quá trình thực hiện !'
			));
		}
	}

    public function printBill(){

        $id = $this->request->getGet("id");

        $settings = $this->admin_model->getSettings();

        $bill_template = $settings->purchase_bill;

        $bill_template = str_replace("{Ten_cong_ty}", $settings->company_name, $bill_template);
        $bill_template = str_replace("{Dia_chi_cong_ty}", $settings->company_addr, $bill_template);
        $bill_template = str_replace("{So_dien_thoai_cong_ty}", $settings->company_phone, $bill_template);
        $bill_template = str_replace("{Email}", $settings->company_email, $bill_template);
        $bill_template = str_replace("{Ma_so_thue}", $settings->tax_code, $bill_template);
        $bill_template = str_replace("{Tieu_de}", "PHIẾU NHẬP HÀNG", $bill_template);
        $bill_template = str_replace("{Doi_tuong}", "Nhà cung cấp", $bill_template);

        $bill_template = str_replace("{Ngay}", " ". date('d'), $bill_template);
        $bill_template = str_replace("{Thang}", " ".date('m'), $bill_template);
        $bill_template = str_replace("{Nam}", " ".date('Y'), $bill_template);

        $purchase = $this->purchase_model->getPurchaseByID($id);

        $bill_template = str_replace('{NO}', " ".$purchase->input_id, $bill_template);
        $bill_template = str_replace("{Khach_hang}", " ".$purchase->provider_name, $bill_template);
        $bill_template = str_replace("{Dia_chi_khach_hang}", " ".$purchase->provider_address, $bill_template);
        $bill_template = str_replace("{So_dien_thoai_khach_hang}", " ".$purchase->provider_phone, $bill_template);

        $th = "<th>STT</th>";
        $th .= "<th>Mã sản phẩm</th>";
        $th .= "<th>Tên sản phẩm</th>";
        $th .= "<th>Số lượng</th>";
        $th .= "<th>Giá (VND)</th>";
        $th .= "<th>Đơn vị</th>";
        $th .= "<th>Thành tiền (VND)</th>";

        $purchase_detail = $this->purchase_model->getPurchaseDetail($id);
        
        $tr_data = '';
        $total = 0;
        foreach($purchase_detail as $index => $value){

            $i = $index + 1;
            $tr_data .= '<tr>';
            $tr_data .= '<td>'.$i.'</td>';
            $tr_data .= '<td>'.$value->product_id.'</td>';
            $tr_data .= '<td>'.$value->product_name.'</td>';
            $tr_data .= '<td>'.$value->quantity.'</td>';
            $tr_data .= '<td>'.number_format($value->purchase_price).'</td>';
            $tr_data .= '<td>'.$value->unit_name.'</td>';
            $tr_data .= '<td>'.number_format($value->total).'</td>';

            $tr_data .= '</tr>';

            $total += (int)$value->total;
        }

        $tr_data .= '<tr style="text-align:center;font-weight: 600;">';
        $tr_data .= '<td colspan="6" >Tổng tiền (VND)</td>';
        $tr_data .= '<td >'.number_format($total).'</td>';
        $tr_data .= '</tr>';

        $tr = "";
        $tr .= "<tr>";
        $tr .= $th;
        $tr .= "</tr>";
        $tr .= $tr_data;

        $bill_template = str_replace('<tr><td colspan="7">{Danh_sach_don_hang}</td></tr>', $tr, $bill_template);

        echo $bill_template;
    }

	// -----------

}


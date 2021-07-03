<?php 

namespace Modules\Admin\Controllers;

use Modules\Admin\Models\AdminModel;
use Modules\Admin\Models\OrderModel;

class Order extends BaseController
{
	private $admin_model ;
    private $order_model ;
    private $status;
	public function __construct(){

		$this->admin_model = new AdminModel();
        $this->order_model = new OrderModel();
        $this->status = array(
            0 => "Tất cả trạng thái",
            1 => "Hoàn thành",
            2 => "Chờ duyệt"
        );
	}

    // chuyển về client side rendering sau (cả nhập kho)

	
	public function index(){ //
		
        $status = $this->request->getGet("status");

        $selected_status = 2;
        if($status != null){

            $selected_status = $status;
        }

        $result = $this->order_model->getOrder($selected_status);
        $warehouse = $this->admin_model->getWarehouse();
		$data = [
            'title' => 'Danh sách đơn hàng', 
            'result' => $result, 
            'status' => $this->status,
            'warehouse' => $warehouse,
            'selected_status' => $selected_status,
            'view' => 'admin/order/order'
        ];
		return $this->view('template/admin', $data);
	}

    public function addOrder(){

        $customer  = $this->order_model->getCustomer();
        $warehouse = $this->admin_model->getWarehouse();
        $data = [
            'customer'  => $customer,
            'warehouse' => $warehouse,
            'title'     => 'Tạo đơn hàng',
            'view'      => 'admin/order/AddOrder'
        ];
		return $this->view('template/admin', $data);
    }

    public function getOrderDetail(){

        $id = $this->request->getGet("id");

        $order = $this->order_model->getOrderDetail($id);

        response(array(
            "st"   => "success",
            "data" => $order,
        ));
    }

    public function ajaxAddOrder(){

        $products    = $this->request->getPost("prd");

        $customer_id    = $this->request->getPost("customer");
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
            'customer' => [
				'label'  => 'Khách hàng',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Khách hàng là cần thiết',
				]
			],
            'warehouse' => [
				'label'  => 'Kho xuất',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Kho xuất là cần thiết',
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

            $customer = $this->order_model->getCustomerByID($customer_id);

			$bill = array(
                "customer_name"  => $customer->customer_name,
                "customer_phone"  => $customer->customer_phone,
                "customer_address"  => $customer->customer_address,
                "status" => 1,
                "user_id" => 1,
                "notes" => "",
                "create_time"  => date("Y-m-d", strtotime(str_replace("/", "-", $create_time))),
			);

			$result = $this->order_model->addBill($bill);
            
			if($result){ // insert id


                foreach($products as $value){

                    $value = (object)$value;
                    $product = $this->admin_model->getProduct($value->prd_id);
                    $order = array(
                        "product_id" => $value->prd_id,
                        "quantity"   => $value->prd_quantity,
                        "status"     => 1,
                        "total"      => (float)$value->prd_quantity * (int)$product->price,
                        "bill_id"    => $result,
                    );

                    $insert = $this->order_model->addOrder($order); // thêm đơn hàng
                    
                    // cập nhật lại hàng tồn kho
                    $inventory = $this->admin_model->getInventory($value->prd_id, $warehouse); // 
                    $stock = ((int)$inventory->stock >= (float)$value->prd_quantity) ? (int)$inventory->stock - (float)$value->prd_quantity : 0;
                    $update_data = array(
                        "stock" => $stock
                    );

                    $update = $this->admin_model->updateInventory($update_data, $value->prd_id, $warehouse);
                }

				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Tạo đơn hàng thành công",
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

    public function ajaxUpdateStatus(){

        $bill_id = $this->request->getPost("bill_id");
        $status = $this->request->getPost("status");
        $warehouse = $this->request->getPost("warehouse");

        $rules =  [
			'bill_id' => [
				'label'  => 'Mã đơn hàng',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Có lỗi trong quá trình cập nhật',
				]
			],
            'status' => [
				'label'  => 'Trạng thái',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Có lỗi trong quá trình cập nhật',
				]
			],
            'warehouse' => [
				'label'  => 'Kho xuất',
				'rules'  => 'required',
				'errors' => [
					'required' => 'Kho xuất là cần thiết',
				]
			],
		];

        if($this->validate($rules)){

			$bill = array(

                "status" => $status,
			);

			$result = $this->order_model->updateBill($bill, $bill_id);
            
			if($result){ // 

                $update_order = $this->order_model->updateOrder(array(
                    "status" => $status,
                ), null, $bill_id);

                if($status == 1){ // duyệt đơn hàng

                    $order = $this->order_model->getOrderDetail($bill_id);
                    foreach($order as $value){
            
                        // cập nhật lại hàng tồn kho
                        $inventory = $this->admin_model->getInventory($value->product_id, $warehouse);
             
                        // xoá nhập kho thì trừ đi hàng tồn kho => bằng 0 nếu hàng tồn kho ít hơn số nhập kho mới xoá
                        $stock = ((int)$inventory->stock >= (float)$value->quantity) ? (int)$inventory->stock - (float)$value->quantity : 0;
                        $update_data = array(
                            "stock" =>  $stock
                        );
            
                        $update = $this->admin_model->updateInventory($update_data, $value->product_id, $warehouse);
                    }
                }

				response(array(
					"st"   => "success",
					"label" => "Thông Báo !",
					"txt" => "Cập nhật đơn hàng thành công",
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

    public function ajaxDeleteOrder(){

		$id = $this->request->getPost("id");

		if(empty($id)){
			response(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => 'Có lỗi trong quá trình thực hiện'
			));
		}

        $old_bill = $this->order_model->getOrderByID($id);

        if(empty((array)$old_bill)){
			response(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => 'Có lỗi trong quá trình thực hiện'
			));
		}

        // $order = $this->order_model->getOrderDetail($id);
        // foreach($order as $value){

        //     // cập nhật lại hàng tồn kho
        //     $inventory = $this->admin_model->getInventory($value->product_id, $old_input->warehouse_id);
 
        //     // xoá nhập kho thì trừ đi hàng tồn kho => bằng 0 nếu hàng tồn kho ít hơn số nhập kho mới xoá
        //     $stock = ((int)$inventory->stock >= (int)$value->quantity) ? (int)$inventory->stock - (int)$value->quantity : 0;
        //     $update_data = array(
        //         "stock" =>  $stock
        //     );

        //     $update = $this->admin_model->updateInventory($update_data, $value->product_id, $old_input->warehouse_id);
        // }

        $delete_order = $this->order_model->deleteOrder($id); // xoá chi tiết đơn hàng

		$result = $this->order_model->deleteBill($id);

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

    public function printBill(){

        $id = $this->request->getGet("id");

        $settings = $this->admin_model->getSettings();

        $bill_template = $settings->purchase_bill;

        $bill_template = str_replace("{Ten_cong_ty}", $settings->company_name, $bill_template);
        $bill_template = str_replace("{Dia_chi_cong_ty}", $settings->company_addr, $bill_template);
        $bill_template = str_replace("{So_dien_thoai_cong_ty}", $settings->company_phone, $bill_template);
        $bill_template = str_replace("{Email}", $settings->company_email, $bill_template);
        $bill_template = str_replace("{Ma_so_thue}", $settings->tax_code, $bill_template);
        $bill_template = str_replace("{Tieu_de}", "HOÁ ĐƠN BÁN HÀNG", $bill_template);
        $bill_template = str_replace("{Doi_tuong}", "Khách hàng", $bill_template);

        $bill_template = str_replace("{Ngay}", " ". date('d'), $bill_template);
        $bill_template = str_replace("{Thang}", " ".date('m'), $bill_template);
        $bill_template = str_replace("{Nam}", " ".date('Y'), $bill_template);

        $purchase = $this->order_model->getOrderByID($id);

        $bill_template = str_replace('{NO}', " ".$purchase->bill_id, $bill_template);
        $bill_template = str_replace("{Khach_hang}", " ".$purchase->customer_name, $bill_template);
        $bill_template = str_replace("{Dia_chi_khach_hang}", " ".$purchase->customer_address, $bill_template);
        $bill_template = str_replace("{So_dien_thoai_khach_hang}", " ".$purchase->customer_phone, $bill_template);

        $th = "<th>STT</th>";
        $th .= "<th>Mã sản phẩm</th>";
        $th .= "<th>Tên sản phẩm</th>";
        $th .= "<th>Số lượng</th>";
        $th .= "<th>Giá (VND)</th>";
        $th .= "<th>Đơn vị</th>";
        $th .= "<th>Thành tiền (VND)</th>";

        $order_detail = $this->order_model->getOrderDetail($id);
        
        $tr_data = '';
        $total = 0;
        foreach($order_detail as $index => $value){

            $i = $index + 1;
            $tr_data .= '<tr>';
            $tr_data .= '<td>'.$i.'</td>';
            $tr_data .= '<td>'.$value->product_id.'</td>';
            $tr_data .= '<td>'.$value->product_name.'</td>';
            $tr_data .= '<td>'.$value->quantity.'</td>';
            $tr_data .= '<td>'.number_format($value->price).'</td>';
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
}
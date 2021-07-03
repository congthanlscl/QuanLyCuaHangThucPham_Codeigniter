<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class OrderModel extends Model{

    public function __construct(){
        parent::__construct();

    }

    public function getOrder($status = 0, $from_date = null, $to_date = null){

        $builder = $this->db->table("bill");
        if(!empty($status)){

            $builder->where("status", $status);
        }

        if(!empty($from_date)){

            $builder->where("create_time >=" , $from_date);
        }

        if(!empty($to_date)){

            $builder->where("create_time <=" , $to_date);
        }
        $builder->join('users', 'bill.user_id = users.user_id');
        $builder->orderBy("create_time", "DESC");
        $query = $builder->get();

        return $query->getResult();
    }

    public function getOrderByID($bill_id){

        $builder = $this->db->table("bill");
        $builder->where("bill_id", $bill_id);
        $builder->join('users', 'bill.user_id = users.user_id');
        $query = $builder->get();

        return $query->getRow();
    }

    public function getOrderDetail($bill_id){

        $builder = $this->db->table("order");
        $builder->where('bill_id', $bill_id);
        $builder->join('products', 'products.product_id = order.product_id');
        $builder->join('unit', 'unit.unit_id  = products.unit_id');
        $query = $builder->get();

        return $query->getResult();
    }

    public function getCustomer(){

        $builder = $this->db->table("customer");
        $query = $builder->get();

        return $query->getResult();
    }

    public function getCustomerByID($customer_id){

        $builder = $this->db->table("customer");
        $builder->where("customer_id", $customer_id);
        $query = $builder->get();

        return $query->getRow();
    }

    public function addBill($bill){

        $builder = $this->db->table("bill");
        $builder->orderBy("bill_id", "DESC");
        $query1 = $builder->get();
        $last_row = $query1->getRow();

        $last_id = str_replace("ORD-", "", $last_row->bill_id);
        $last_id = intval($last_id);
        $last_id += 1;

        $lenght = strlen($last_id);
        $zero_lenght = 7 - $lenght;
        $bill_id = "ORD-";
        for($i = 0; $i< $zero_lenght; $i++){

            $bill_id .= "0";
        }

        $bill_id .= $last_id;
        $bill["bill_id"] = $bill_id;

        $query2 = $builder->insert($bill);
        if($query2){

            return $bill_id;
        }
        else{
            return false;
        }
    }

    public function addOrder($order){

        $builder = $this->db->table("order");
        $query = $builder->insert($order);
        return $query->resultID;
    }

    public function updateBill($bill, $bill_id){

        $builder = $this->db->table("bill");
        $builder->where("bill_id", $bill_id);
        $query = $builder->update($bill);
        return $query;
    }

    public function updateOrder($order, $order_id = null, $bill_id = null){

        $builder = $this->db->table("order");
        if(!empty($order_id)){
            $builder->where("order_id", $order_id);
        } 
        if(!empty($bill_id)){
            $builder->where("bill_id", $bill_id);
        }   
        $query = $builder->update($order);
        return $query;
    }

    public function deleteOrder($bill_id){

        $builder = $this->db->table("order");
        $builder->where("bill_id", $bill_id);
        $query = $builder->delete();
        return $query->resultID;
    }

    public function deleteBill($bill_id){

        $builder = $this->db->table("bill");
        $builder->where("bill_id", $bill_id);
        $query = $builder->delete();
        return $query->resultID;
    }
}
<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class AdminModel extends Model{

    public function __construct(){
        parent::__construct();

    }

    public function getWarehouse(){

        $builder = $this->db->table("warehouse");
        $query = $builder->get();

        return $query->getResult();
    }

    public function addInventory($inventory){

        $builder = $this->db->table("inventory");
        $query = $builder->insert($inventory);
        return $query->resultID;
    }

    public function getProducts($keyword){

        $builder = $this->db->table("products");
        $builder->where("product_id", $keyword);
        $builder->orLike('product_name', $keyword);
        $builder->join("unit", "unit.unit_id = products.unit_id");
        $query = $builder->get();
        
        return $query->getResult();
    }

    public function getProduct($product_id){

        $builder = $this->db->table("products");
        $builder->where("product_id", $product_id);
        $builder->join("unit", "unit.unit_id = products.unit_id");
        $query = $builder->get();
        
        return $query->getRow();
    }

    public function getInventory($product_id, $warehouse_id = null){

        $builder = $this->db->table("inventory");
        $builder->where("product_id", $product_id);
        if(!empty($warehouse_id)){

            $builder->where("warehouse_id", $warehouse_id);
        }
        $query = $builder->get();

        if(!empty($warehouse_id)){ // trả về một hàng vì search theo cả nhà kho

            return $query->getRow();
        }
        else{ // trả về danh sách vì không có select theo nhà kho

            return $query->getResult();
        }
    }

    public function updateInventory($inventory, $product_id, $warehouse_id){

        $builder = $this->db->table("inventory");
        $builder->where("product_id", $product_id);
        $builder->where("warehouse_id", $warehouse_id);
        $query = $builder->update($inventory);
        return $query;
    }

    public function getSettings(){

        $builder = $this->db->table("settings");
        $query = $builder->get();
        
        return $query->getRow();
    }

    // cho phần accounts

    public function getUserByEmail($email){

        $builder = $this->db->table("users");
        $builder->where("email", $email);
        $query = $builder->get();

        return $query->getRow();
    }

    // xử lý tài khoản website

    public function getLogin($email, $password){

        $builder = $this->db->table("users");
        $builder->where('email',$email); 
        $builder->where('password',md5($password)); 
        $query   = $builder->get();

        return $query->getRow();
    }
}
<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class PurchaseModel extends Model{

    public function __construct(){
        parent::__construct();

    }

    public function getPurchase(){

        $builder = $this->db->table("input");
        $builder->join('provider', 'provider.provider_id = input.provider_id');
        $builder->join('warehouse', 'warehouse.warehouse_id = input.warehouse_id');
        $builder->orderBy("create_time", "DESC");
        $query = $builder->get();

        return $query->getResult();
    }

    public function getPurchaseByID($input_id){

        $builder = $this->db->table("input");
        $builder->where('input_id', $input_id);
        $builder->join('provider', 'provider.provider_id = input.provider_id');
        $builder->join('warehouse', 'warehouse.warehouse_id = input.warehouse_id');
        $query = $builder->get();

        return $query->getRow();
    }

    public function getPurchaseDetail($input_id){

        $builder = $this->db->table("purchase");
        $builder->where('input_id', $input_id);
        $builder->join('products', 'products.product_id = purchase.product_id');
        $builder->join('unit', 'unit.unit_id  = products.unit_id');
        $query = $builder->get();

        return $query->getResult();
    }

    public function getProvider(){

        $builder = $this->db->table("provider");
        $query = $builder->get();

        return $query->getResult();
    }

    public function addInput($input){

        $builder = $this->db->table("input");
        $builder->orderBy("input_id", "DESC");
        $query1 = $builder->get();
        $last_row = $query1->getRow();

        $last_id = str_replace("PC-", "", $last_row->input_id);
        $last_id = intval($last_id);
        $last_id += 1;

        $lenght = strlen($last_id);
        $zero_lenght = 5 - $lenght;
        $input_id = "PC-";
        for($i = 0; $i< $zero_lenght; $i++){

            $input_id .= "0";
        }

        $input_id .= $last_id;
        $input["input_id"] = $input_id;

        $query2 = $builder->insert($input);
        if($query2){

            return $input_id;
        }
        else{
            return false;
        }
    }

    public function addPurchase($purchase){

        $builder = $this->db->table("purchase");
        $query = $builder->insert($purchase);
        return $query->resultID;
    }

    public function updateInput($input, $input_id){

        $builder = $this->db->table("input");
        $builder->where("input_id", $input_id);
        $query = $builder->update($input);
        return $query;
    }

    public function deleteInput($input_id){

        $builder = $this->db->table("input");
        $builder->where("input_id", $input_id);
        $query = $builder->delete();
        return $query->resultID;
    }

    public function deletePurchase($input_id){

        $builder = $this->db->table("purchase");
        $builder->where("input_id", $input_id);
        $query = $builder->delete();
        return $query->resultID;
    }

}
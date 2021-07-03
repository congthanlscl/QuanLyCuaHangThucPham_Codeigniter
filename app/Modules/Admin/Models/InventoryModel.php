<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class InventoryModel extends Model{

    public function __construct(){
        parent::__construct();

    }

    public function getInventory($warehouse_id = 0){

        $builder = $this->db->table("inventory");
        if(!empty($warehouse_id)){

            $builder->where("inventory.warehouse_id", $warehouse_id);
        }
        $builder->join("products", "products.product_id = inventory.product_id");
        $builder->join("warehouse", "warehouse.warehouse_id = inventory.warehouse_id");
        $query = $builder->get();

        return $query->getResult();
    }

}
<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class WarehouseModel extends Model{

    public function __construct(){
        parent::__construct();

    }

    public function getWarehouseById($warehouse_id){

        $builder = $this->db->table("warehouse");
        $builder->where("warehouse_id", $warehouse_id);
        $query = $builder->get();

        return $query->getRow();
    }

    public function addWarehouse($warehouse){

        $builder = $this->db->table("warehouse");
        $query = $builder->insert($warehouse);

        return $query->resultID;
    }

    public function updateWarehouse($warehouse, $warehouse_id){

        $builder = $this->db->table("warehouse");
        $builder->where("warehouse_id", $warehouse_id);
        $query = $builder->update($warehouse);

        return $query;
    }

    public function deleteWarehouse($warehouse_id){

        $builder = $this->db->table("warehouse");
        $builder->where("warehouse_id", $warehouse_id);
        $query = $builder->delete();

        return $query->resultID;
    }
    
}
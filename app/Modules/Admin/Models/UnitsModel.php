<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class UnitsModel extends Model{

    public function __construct(){
        parent::__construct();

    }

    public function getUnits(){

        $builder = $this->db->table("unit");
        $query = $builder->get();

        return $query->getResult();
    }

    public function getUnit($unit_id){

        $builder = $this->db->table("unit");
        $builder->where("unit_id", $unit_id);
        $query = $builder->get();

        return $query->getRow();
    }

    public function addUnit($unit){

        $builder = $this->db->table("unit");
        $query = $builder->insert($unit);

        return $query->resultID;
    }

    public function updateUnit($unit, $unit_id){

        $builder = $this->db->table("unit");
        $builder->where("unit_id", $unit_id);
        $query = $builder->update($unit);

        return $query;
    }

    public function deleteUnit($unit_id){

        $builder = $this->db->table("unit");
        $builder->where("unit_id", $unit_id);
        $query = $builder->delete();

        return $query->resultID;
    }
    
}
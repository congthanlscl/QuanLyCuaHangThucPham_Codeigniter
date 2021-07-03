<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class ProviderModel extends Model{

    public function __construct(){
        parent::__construct();

    }

    public function getProviders(){

        $builder = $this->db->table("provider");
        $query = $builder->get();

        return $query->getResult();
    }

    public function getProvider($provider_id){

        $builder = $this->db->table("provider");
        $builder->where("provider_id", $provider_id);
        $query = $builder->get();

        return $query->getRow();
    }
    
    public function addProvider($provider){

        $builder = $this->db->table("provider");
        $query = $builder->insert($provider);

        return $query->resultID;
    }

    public function updateProvider($provider_id, $provider){

        $builder = $this->db->table("provider");
        $builder->where("provider_id", $provider_id);
        $query = $builder->update($provider);

        return $query;
    }

    public function deleteProvider($provider_id){

        $builder = $this->db->table("provider");
        $builder->where("provider_id", $provider_id);
        $query = $builder->delete();

        return $query->resultID;
    }
    
}
<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class CustomerModel extends Model{

    public function __construct(){
        parent::__construct();

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

    public function addCustomer($customer){

        $builder = $this->db->table("customer");
        $query = $builder->insert($customer);

        return $this->db->insertID();
    }

    public function updateCustomer($customer, $customer_id){

        $builder = $this->db->table("customer");
        $builder->where("customer_id", $customer_id);
        $query = $builder->update($customer);

        return $query;
    }

    public function deleteCustomer($customer_id){

        $builder = $this->db->table("customer");
        $builder->where("customer_id", $customer_id);
        $query = $builder->delete();

        return $query->resultID;
    }

}
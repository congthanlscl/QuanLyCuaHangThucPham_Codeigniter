<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class CategoriesModel extends Model{

    public function __construct(){
        parent::__construct();

    }

    public function getCategories(){

        $builder = $this->db->table("categories");
        $query = $builder->get();

        return $query->getResult();
    }
    

    public function getCategoryByID($category_id){

        $builder = $this->db->table("categories");
        $builder->where("category_id", $category_id);
        $query = $builder->get();

        return $query->getRow();
    }

    public function addCategory($data){

        $builder = $this->db->table("categories");
        $query = $builder->insert($data);

        return $query->resultID;
    }

    public function updateCategory($id, $data){

        $builder = $this->db->table("categories");
        $builder->where("category_id", $id);
        $query = $builder->update($data);

        return $query;
    }

    public function deleteCategory($id){

        $builder = $this->db->table("categories");
        $builder->where("category_id", $id);
        $query = $builder->delete();

        return $query->resultID;
    }
}
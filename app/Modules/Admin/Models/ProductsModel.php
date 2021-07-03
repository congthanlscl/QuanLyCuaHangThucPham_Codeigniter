<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class ProductsModel extends Model{

    public function __construct(){
        parent::__construct();

    }

    public function getProducts(){

        $builder = $this->db->table("products");
        $builder->join('categories', 'categories.category_id = products.category_id');
        $builder->join('unit', 'unit.unit_id = products.unit_id');
        $builder->join('tags', 'tags.tag_id = products.tag_id');
        $query = $builder->get();

        return $query->getResult();
    }

    public function getCategories(){

        $builder = $this->db->table("categories");
        $query = $builder->get();

        return $query->getResult();
    }

    public function getUnits(){

        $builder = $this->db->table("unit");
        $query = $builder->get();

        return $query->getResult();
    }

    public function getTags(){

        $builder = $this->db->table("tags");
        $query = $builder->get();

        return $query->getResult();
    }

    public function getProduct($product_id){

        $builder = $this->db->table("products");
        $builder->where('product_id', $product_id);
        $builder->join('categories', 'categories.category_id = products.category_id');
        $builder->join('unit', 'unit.unit_id = products.unit_id');
        $builder->join('tags', 'tags.tag_id = products.tag_id');
        $query = $builder->get();

        return $query->getRow();
    }

    public function addProducts($products){

        $builder = $this->db->table("products");
        $query = $builder->insert($products);

        return $this->db->insertID();
    }

    public function updateProducts($products, $product_id){

        $builder = $this->db->table("products");
        $builder->where('product_id', $product_id);
        $result = $builder->update($products);

        return $result;
    }

    public function deleteProducts($product_id){

        $builder = $this->db->table("products");
        $builder->where('product_id', $product_id);
        $query = $builder->delete();

        return $query->resultID;
    }

}
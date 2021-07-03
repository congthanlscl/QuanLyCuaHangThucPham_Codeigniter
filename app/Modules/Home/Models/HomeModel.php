<?php

namespace Modules\Home\Models;

use CodeIgniter\Model;

class HomeModel extends Model{

    public function __construct(){
        parent::__construct();

    }

    public function getCategories(){

        $builder = $this->db->table("categories");
        $query = $builder->get();

        return $query->getResult();
    }

    public function getCategory($slug){

        $builder = $this->db->table("categories");
        $builder->where("category_slug", $slug);
        $query = $builder->get();

        return $query->getRow();
    }

    public function getSaleProducts(){

        $builder = $this->db->table("products");
        $builder->where("discount >", 0);
        $builder->where("products.status", 1); // trạng thái đang kinh doanh
        $builder->join("unit", "unit.unit_id = products.unit_id");
        $builder->join("tags", "tags.tag_id = products.tag_id");
        $builder->orderBy("create_time", "DESC");
        $query = $builder->get(0, 5);

        return $query->getResult();
    }

    public function getNewProducts(){

        $builder = $this->db->table("products");
        $builder->where("products.status", 1); // trạng thái đang kinh doanh
        $builder->join("unit", "unit.unit_id = products.unit_id");
        $builder->join("tags", "tags.tag_id = products.tag_id");
        $builder->orderBy("create_time", "DESC");
        $query = $builder->get(0, 5);

        return $query->getResult();
    }

    public function getProductsByTags($tag){

        $builder = $this->db->table("products");
        $builder->where("products.tag_id",$tag);
        $builder->where("products.status", 1); // trạng thái đang kinh doanh
        $builder->join("unit", "unit.unit_id = products.unit_id");
        $builder->join("tags", "tags.tag_id = products.tag_id");
        $builder->orderBy("create_time", "DESC");
        $query = $builder->get(0, 5);

        return $query->getResult();
    }

    public function getProductsByCategories($categories){

        $builder = $this->db->table("products");
        $builder->where("category_id",$categories);
        $builder->where("products.status", 1); // trạng thái đang kinh doanh
        $builder->join("unit", "unit.unit_id = products.unit_id");
        $builder->join("tags", "tags.tag_id = products.tag_id");
        $builder->orderBy("create_time", "DESC");
        $query = $builder->get();

        return $query->getResult();
    }

    public function getProductsByKeyword($keyword){

        $builder = $this->db->table("products");
        $builder->like("product_name",$keyword);
        $builder->where("products.status", 1); // trạng thái đang kinh doanh
        $builder->join("unit", "unit.unit_id = products.unit_id");
        $builder->join("tags", "tags.tag_id = products.tag_id");
        $builder->orderBy("create_time", "DESC");
        $query = $builder->get();

        return $query->getResult();
    }

    public function getProduct($product_id){

        $builder = $this->db->table("products");
        $builder->where("product_id",$product_id);
        $builder->join("unit", "unit.unit_id = products.unit_id");
        $builder->join("tags", "tags.tag_id = products.tag_id");
        $query = $builder->get();

        return $query->getRow();
    }

    public function getProductBySlug($slug){

        $builder = $this->db->table("products");
        $builder->where("product_slug",$slug);
        $builder->join("unit", "unit.unit_id = products.unit_id");
        $builder->join("tags", "tags.tag_id = products.tag_id");
        $query = $builder->get();

        return $query->getRow();
    }

    public function getCart($cart){

        $result = array();
        $total = 0;
        foreach($cart as $value){

            $builder = $this->db->table("products");
            $builder->where("product_id",$value->product_id);
            $builder->join("unit", "unit.unit_id = products.unit_id");
            $builder->join("tags", "tags.tag_id = products.tag_id");
            $query = $builder->get();
    
            $product = $query->getRow();

            $price  = ((float)$product->price*(100 - (int)$product->discount))/100;

            $amount = (float)$value->quantity * (float)$price;
            $result["data"][$value->product_id] = (object)array(
                "product_id"   => $value->product_id,
                "image"        => $product->image,
                'product_slug' => $product->product_slug,
                "quantity"     => $value->quantity,
                "product_name" => $product->product_name,
                "amount"       => $amount,
                "price"        => $price,
                "unit_name"    => $product->unit_name,
            );

            $total += $amount;

            $query->freeResult();
        }

        $result["total"] = $total;

        return $result;
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
    
}
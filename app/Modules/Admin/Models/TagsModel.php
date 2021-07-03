<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class TagsModel extends Model{

    public function __construct(){
        parent::__construct();

    }

    public function getTags(){

        $builder = $this->db->table("tags");
        $query = $builder->get();

        return $query->getResult();
    }

    public function getTag($id){

        $builder = $this->db->table("tags");
        $builder->where("tag_id", $id);
        $query = $builder->get();

        return $query->getRow();
    }

    public function addTags($tag){

        $builder = $this->db->table("tags");
        $query = $builder->insert($tag);

        return $query->resultID;
    }

    public function deleteTags($id){

        $builder = $this->db->table("tags");
        $builder->where("tag_id", $id);
        $query = $builder->delete();

        return $query->resultID;
    }

}
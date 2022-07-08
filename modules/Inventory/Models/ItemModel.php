<?php namespace Modules\Inventory\Models;

use CodeIgniter\Model;

class ItemModel extends Model {
    protected $table = 'items';
    protected $primaryKey = 'id';
  
    protected $useAutoIncrement = true;
    
    protected $allowedFields = ['role_name', 'item_name', 'date_purchased', 'cost', 'category_id', 'status'];
    protected $useSoftDeletes = true;
  
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function get($conditions = []){
        foreach($conditions as $field => $value){
            $this->where($field, $value);
        }

        return $this->findAll();
    }
}
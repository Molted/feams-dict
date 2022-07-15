<?php namespace Modules\Inventory\Models;

use CodeIgniter\Model;

class ItemModel extends Model {
    protected $table = 'items';
    protected $primaryKey = 'id';
  
    protected $useAutoIncrement = true;
    
    protected $allowedFields = ['item_name', 'date_purchased', 'cost', 'category_id'];
    protected $useSoftDeletes = true;
  
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function viewItems() {
        $this->select('items.id, item_category.category_name, items.item_name, items.date_purchased, items.cost, items.category_id');
        $this->where('items.deleted_at', NULL);
        $this->join('item_category', 'item_category.id = items.category_id');
        return $this->get()->getResultArray();
    }
}
<?php namespace Modules\ItemCategory\Models;

use CodeIgniter\Model;

class CategoryModel extends Model {
    protected $table = 'item_category';
    protected $primaryKey = 'id';
  
    protected $useAutoIncrement = true;
    
    protected $allowedFields = ['category_name'];
    protected $useSoftDeletes = true;
  
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
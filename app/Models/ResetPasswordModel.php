<?php
namespace App\Models;

use CodeIgniter\Model;

class ResetPasswordModel extends Model
{
    protected $table = 'password_reset_tokens';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id',
        'email',
        'expiration_date',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    
}
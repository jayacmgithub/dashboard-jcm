<?php

namespace App\Models;

use CodeIgniter\Model;

class AksesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'buka_akses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];
}

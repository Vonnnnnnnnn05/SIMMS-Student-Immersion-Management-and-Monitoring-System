<?php

namespace App\Models;

use CodeIgniter\Model;

class MoaModel extends Model
{
    protected $table            = 'moa';
    protected $primaryKey       = 'moa_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = false;
}

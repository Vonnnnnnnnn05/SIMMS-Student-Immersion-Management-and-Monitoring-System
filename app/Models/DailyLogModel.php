<?php

namespace App\Models;

use CodeIgniter\Model;

class DailyLogModel extends Model
{
    protected $table            = 'daily_logs';
    protected $primaryKey       = 'log_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = false;
}

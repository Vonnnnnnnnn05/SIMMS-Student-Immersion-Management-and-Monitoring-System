<?php

namespace App\Models;

use CodeIgniter\Model;

class DeploymentModel extends Model
{
    protected $table            = 'deployment';
    protected $primaryKey       = 'deployment_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = false;
}

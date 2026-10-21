<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentAgencyModel extends Model
{
    protected $table            = 'student_agency';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = false;
}

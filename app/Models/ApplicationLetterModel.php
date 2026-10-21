<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationLetterModel extends Model
{
    protected $table            = 'application_letters';
    protected $primaryKey       = 'letter_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = false;
}

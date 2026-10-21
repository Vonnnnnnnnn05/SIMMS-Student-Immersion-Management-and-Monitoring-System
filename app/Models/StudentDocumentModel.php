<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentDocumentModel extends Model
{
    protected $table            = 'student_documents';
    protected $primaryKey       = 'student_doc_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = false;
}

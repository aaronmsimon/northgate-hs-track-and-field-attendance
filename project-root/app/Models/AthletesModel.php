<?php

namespace App\Models;

use CodeIgniter\Model;

class AthletesModel extends Model
{
    protected $table = 'athletes';
    protected $primaryKey = 'studentid';

    public function findAthlete($studentid)
    {
        return $this->find($studentid);
    }
}
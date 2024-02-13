<?php

namespace App\Models;

use CodeIgniter\Model;

class FiltersModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        
        $this->db = \Config\Database::connect();
    }

    public function getGenders()
    {
        $builder = $this->db->table('gender');
        $builder->where('name <>','coach');
        $builder->orderBy('id','ASC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getGradeLevels()
    {
        $builder = $this->db->table('gradelevel');
        $builder->where('name <>','Coach');
        $builder->orderBy('id','ASC');
        $query = $builder->get();

        return $query->getResultArray();
    }
}
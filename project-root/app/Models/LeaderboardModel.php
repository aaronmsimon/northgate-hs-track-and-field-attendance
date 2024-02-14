<?php

namespace App\Models;

use CodeIgniter\Model;

class AthletesModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        
        $this->db = \Config\Database::connect();
    }

    public function checkins()
    {
        $builder = $this->db->table('attendance');
        $builder->select('athletes.firstname,athletes.lastname,COUNT(*) AS checkins');
        $builder->join('athletes', 'attendance.studentid = athletes.studentid');
        $builder->join('gender', 'athletes.genderid = gender.id');
        $builder->join('status', 'athletes.statusid = status.id');
        $builder->where([
            'gender.name <>' => 'coach',
            'status.status' => 'Active',
            'athletes.schoolyear' => date('Y'),
        ]);
        $builder->groupBy('attendance.studentid');
        $builder->orderBy('checkins DESC,athletes.lastname ASC,athletes.firstname ASC');

        $query = $builder->get();

        return $query->getResultArray();
    }

    public function completeweeks()
    {
        $subquery = $this->db->table('attendance');
        $subquery->select('athletes.studentid,athletes.firstname,athletes.lastname,WEEK(checkin,1) AS week,COUNT(*) AS checkins');
        $subquery->join('athletes', 'attendance.studentid = athletes.studentid');
        $subquery->join('gender', 'athletes.genderid = gender.id');
        $subquery->join('status', 'athletes.statusid = status.id');
        $subquery->where([
            'gender.name <>' => 'coach',
            'status.status' => 'Active',
            'athletes.schoolyear' => date('Y'),
        ]);
        $subquery->groupBy('attendance.studentid,week');

        $builder = $this->db->newQuery()->fromSubquery($subquery, 'w');
        $builder->select('firstname,lastname,COUNT(*) AS completeweeks');
        $builder->where('checkins >= 5');
        $builder->groupBy('studentid');
        $builder->orderBy('completeweeks DESC,lastname ASC,firstname ASC');

        $query = $builder->get();

        return $query->getResultArray();
    }
}
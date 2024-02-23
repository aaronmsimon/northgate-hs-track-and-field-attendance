<?php

namespace App\Models;

use CodeIgniter\Model;

class AthletesModel extends Model
{
    protected $table = 'athletes';
    protected $primaryKey = 'studentid';

    protected $db;

    public function __construct()
    {
        parent::__construct();
        
        $this->db = \Config\Database::connect();
    }

    public function findAthlete($studentid)
    {
        return $this->find($studentid);
    }

    public function getAthleteDetails($studentid) {
        $builder = $this->db->table('athletes a');
        $builder->select('a.studentid,a.firstname,a.lastname,gl.name AS grade,g.team,a.dob');
        $builder->join('gender g', 'a.genderid = g.id');
        $builder->join('gradelevel gl', 'a.gradelevelid = gl.id');
        $builder->join('status s', 'a.statusid = s.id');
        $builder->where('a.studentid',$studentid);

        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getEligibilityListByAthlete($studentid) {
        $builder = $this->db->table('athletes');
        $builder->select('eligibilityissues.name AS eligibilityissue');
        $builder->join('eligibility', 'athletes.studentid = eligibility.studentid AND eligibility.active = 1','left');
        $builder->join('eligibilityissues', 'eligibility.eligibilityissueid = eligibilityissues.id','left');
        $builder->where('athletes.studentid',$studentid);

        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getAthletes($gender = false, $gradelevel = false)
    {
        $builder = $this->db->table('athletes');
        $builder->select('athletes.studentid,athletes.firstname,athletes.lastname,gradelevel.name AS grade,gender.team AS gender');
        $builder->join('gender', 'athletes.genderid = gender.id');
        $builder->join('gradelevel', 'athletes.gradelevelid = gradelevel.id');
        $builder->join('status', 'athletes.statusid = status.id');
        if (!$gender === false) {
            $builder->where('athletes.genderid',$gender);
        }
        if (!$gradelevel === false) {
            $builder->where('athletes.gradelevelid',$gradelevel);
        }
        $builder->where([
            'gender.name <>' => 'coach',
            'status.status' => 'Active',
            'schoolyear' => date('Y'),
        ]);
        $builder->orderBy('athletes.lastname ASC, athletes.firstname ASC');

        $query = $builder->get();
        $rows = $query->getResultArray();

        $html = '';
        foreach ($rows as $row) {
            $html .= '<tr><td class="text-start"><a href="athlete/' . $row['studentid'] . '" style="color:#9c1f2e;">' . $row['lastname'] . '</a></td><td class="text-start">' . $row['firstname'] . '</td><td class="text-start">' . $row['grade'] . '</td><td class="text-start">' . $row['gender'] . '</td></tr>';
        }
        
        $data['html'] = $html;
        $data['table'] = $rows;

        return $data;
    }
}
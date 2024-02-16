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

    public function getAthletes($gender = false, $gradelevel = false)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('athletes');
        $builder->select('athletes.firstname,athletes.lastname,gradelevel.name AS grade,gender.team AS gender');
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
            $html .= '<tr><td class="text-start">' . $row['lastname'] . '</td><td class="text-start">' . $row['firstname'] . '</td><td class="text-start">' . $row['grade'] . '</td><td class="text-start">' . $row['gender'] . '</td></tr>';
        }
        
        $data['html'] = $html;
        $data['table'] = $rows;

        return $data;
    }
}
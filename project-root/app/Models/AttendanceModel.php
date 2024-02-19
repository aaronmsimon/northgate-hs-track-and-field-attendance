<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';

    protected $allowedFields = ['studentid', 'checkin'];

    protected $db;

    public function __construct()
    {
        parent::__construct();
        
        $this->db = \Config\Database::connect();
    }

    public function checkIn($studentid)
    {
        // Set date
        date_default_timezone_set('America/Los_Angeles');
        $datecreated = date('Y-m-d H:i:s');

        // Check if already entered today
        $builder = $this->db->table('attendance');
        $builder->where([
            'studentid' => $studentid,
            'DATE(checkin)' => date('Y-m-d')
        ]);
        $checkunique = $builder->get();
        if (!empty($checkunique->getResultArray()))
        {
            return 0;
        }

        $data = [
            'studentid' => $studentid,
            'checkin' => $datecreated,
        ];

        $this->insert($data);
        return $this->getInsertID();
    }

    public function getCheckInsByDate($date)
    {
        $builder = $this->db->table('attendance');
        $builder->select('attendance.studentid,athletes.firstname,athletes.lastname,eligibilityissues.name AS eligibilityissue');
        $builder->join('athletes', 'attendance.studentid = athletes.studentid');
        $builder->join('eligibility', 'attendance.studentid = eligibility.studentid AND eligibility.active = 1','left');
        $builder->join('eligibilityissues', 'eligibility.eligibilityissueid = eligibilityissues.id','left');
        $builder->where([
            'DATE(checkin)' => $date,
            'athletes.firstname <>' => 'coach',
        ]);
        $builder->orderBy('athletes.lastname ASC, athletes.firstname ASC');

        $query = $builder->get();
        $rows = $query->getResultArray();

        $results = array();
        foreach ($rows as $row) {
            if (!array_key_exists($row['studentid'],$results)) {
                $results[$row['studentid']] = array(
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'eligibilityissues' => array($row['eligibilityissue']),
                );
            } else {
                $results[$row['studentid']]['eligibilityissues'][] = $row['eligibilityissue'];
            }
        }

        $html = '';
        foreach ($results as $result) {
            $html .= '<tr><td class="text-start">' . $result['firstname'] . ' ' . $result['lastname'];
            foreach ($result['eligibilityissues'] as $issue) {
                if (!is_null($issue)) {
                    $html .= '<span class="badge text-bg-danger ms-1">' . $issue . '</span>';
                }
            }
            $html .= '</td></tr>';
        }
        
        $data['html'] = $html;
        $data['table'] = $results;

        return $data;
    }

    public function getCheckInsByAthlete($studentid) {
        $builder = $this->db->table('attendance');
        $builder->select('DATE(checkin) AS checkindate');
        $builder->where('studentid',$studentid);
        $builder->orderBy('id ASC');

        $query = $builder->get();

        return $query->getResultArray();
    }
}
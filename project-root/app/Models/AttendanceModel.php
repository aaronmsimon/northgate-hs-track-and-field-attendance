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
        $builder->select('athletes.firstname,athletes.lastname');
        $builder->join('athletes', 'attendance.studentid = athletes.studentid');
        $builder->where([
            'DATE(checkin)' => $date,
            'athletes.firstname <>' => 'coach',
        ]);
        $builder->orderBy('athletes.lastname ASC, athletes.firstname ASC');

        $query = $builder->get();
        $rows = $query->getResultArray();

        $html = '';
        foreach ($rows as $row) {
            $html .= '<tr><td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td></tr>';
        }
        
        $data['html'] = $html;
        $data['table'] = $rows;

        return $data;
    }
}
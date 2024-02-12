<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';

    protected $allowedFields = ['studentid', 'checkin'];

    public function checkIn($studentid)
    {
        // Set date
        date_default_timezone_set('America/Los_Angeles');
        $datecreated = date('Y-m-d H:i:s');

        $data = [
            'studentid' => $studentid,
            'checkin' => $datecreated,
        ];

        $this->insert($data);
        return $this->getInsertID();
    }

    public function getCheckInsByDate($date)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('attendance');
        $builder->select('athletes.firstname,athletes.lastname');
        $builder->join('athletes', 'attendance.studentid = athletes.studentid');
        $builder->where('DATE(checkin)', $date);
        $builder->orderBy('athletes.lastname ASC, athletes.firstname ASC');

        $query = $builder->get();
        $rows = $query->getResultArray();

        $html = '';
        foreach ($rows as $row) {
            $html .= '<tr><td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td></tr>';
        }

        return $html;
    }
}
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
        date_default_timezone_set('UTC');
        $datecreated = date('Y-m-d H:i:s');

        $data = [
            'studentid' => $studentid,
            'checkin' => $datecreated,
        ];

        $this->insert($data);
        return $this->getInsertID();
    }
}
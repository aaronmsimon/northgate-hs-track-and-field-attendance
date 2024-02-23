<?php

namespace App\Controllers;

use App\Models\AttendanceModel;
use App\Models\AthletesModel;

class Athlete extends BaseController
{
    public function index() {
        return view('templates/header', ['title' => "Athlete Profile"])
            . view('pages/profile')
            . view('templates/footer');
    }

    public function show($studentid)
    {
        $attendancemodel = model(AttendanceModel::class);
        $data['attendance'] = json_encode($attendancemodel->getCheckInsByAthlete($studentid));

        $athletesmodel = model(AthletesModel::class);
        $data['athlete'] = $athletesmodel->getAthleteDetails($studentid);
        $data['eligibility'] = $athletesmodel->getEligibilityListByAthlete($studentid);

        return view('templates/header', ['title' => "Athlete Profile"])
            . view('pages/profile',$data)
            . view('templates/footer');
    }
}

<?php

namespace App\Controllers;

use App\Models\AttendanceModel;

class Athlete extends BaseController
{
    public function index() {
        return view('templates/header', ['title' => "Athlete Profile"])
            . view('pages/profile')
            . view('templates/footer');
    }

    public function show($studentid)
    {
        $model = model(AttendanceModel::class);
        $data['attendance'] = json_encode($model->getCheckInsByAthlete($studentid));

        return view('templates/header', ['title' => "Athlete Profile"])
            . view('pages/profile',$data)
            . view('templates/footer');
    }
}

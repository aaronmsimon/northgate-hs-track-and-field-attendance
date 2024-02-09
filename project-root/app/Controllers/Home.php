<?php

namespace App\Controllers;

use App\Models\AthletesModel;
use App\Models\AttendanceModel;

class Home extends BaseController
{
    public function index(): string
    {
        helper('form');
        
        $data['title'] = 'Northgate Highschool Track & Field Attendance';

        return view('templates/header', $data)
            . view('pages/check-in')
            . view('templates/footer');
    }

    public function checkin()
    {
        helper('form');

        $data = $this->request->getPost(['student-id']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'student-id' => 'required|max_length[7]|min_length[7]',
        ])) {
            // The validation fails, so returns the form.
            return $this->index();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        // Find the athlete
        $model = model(AthletesModel::class);

        $athlete = $model->findAthlete($post['student-id']);
        
        // if success then:
        $checkin = model(AttendanceModel::class);
        $checkin->checkIn($athlete['studentid']);

        return view('templates/header', ['title' => 'Check in Complete'])
            . view('pages/success', $athlete)
            . view('templates/footer');
    }
}

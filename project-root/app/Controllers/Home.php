<?php

namespace App\Controllers;

use App\Models\AthletesModel;
use App\Models\AttendanceModel;
use App\Models\MessagesModel;

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

        $student = $this->request->getPost(['student-id']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($student, [
            'student-id' => 'required|numeric|max_length[7]|min_length[7]',
        ])) {
            // The validation fails, so returns the form.
            return $this->index();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        // Find the athlete
        $athletesmodel = model(AthletesModel::class);
        $data['athlete'] = $athletesmodel->findAthlete($post['student-id']);
        
        // if success then:
        $attendancemodel = model(AttendanceModel::class);
        $attendancemodel->checkIn($data['athlete']['studentid']);

        // get a message
        $messages = model(MessagesModel::class);
        $data['message'] = $messages->getMessage();

        return view('templates/header', ['title' => 'Check in Complete'])
            . view('pages/success', $data)
            . view('templates/footer');
    }
}

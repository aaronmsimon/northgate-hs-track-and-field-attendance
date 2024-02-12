<?php

namespace App\Controllers;

use App\Models\AttendanceModel;

class Coaches extends BaseController
{
    public function index(): string
    {
        return view('templates/header', ['title' => "Coaches' Portal"])
            . view('coaches/portal')
            . view('templates/footer');
    }

    public function attendancebyday()
    {
        $request = service('request');
        $postData = $request->getPost();

        // Checks whether the submitted data passed the validation rules.
        // if (! $this->validateData($date, [
        //     'attendancedate' => 'required',
        // ])) {
        //     // The validation fails, so returns the form.
        //     return $this->index();
        // }

        // Gets the validated data.
        // $post = $this->validator->getValidated();

        $model = model(AttendanceModel::class);
        $attendance = $model->getCheckInsByDate($postData['attendancedate']);

        $data = array();

        // Read new token and assign in $data['token']
        $data['token'] = csrf_hash();
        $data['tabledata'] = $attendance;

        return $this->response->setJSON($data);

    }
}

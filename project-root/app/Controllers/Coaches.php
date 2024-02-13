<?php

namespace App\Controllers;

use App\Models\FiltersModel;
use App\Models\AthletesModel;
use App\Models\AttendanceModel;

class Coaches extends BaseController
{
    public function index(): string
    {
        $filters = model(FiltersModel::class);
        $data['genders'] = $filters->getGenders();
        $data['gradelevels'] = $filters->getGradeLevels();

        return view('templates/header', ['title' => "Coaches' Portal"])
            . view('coaches/portal', $data)
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

    public function roster()
    {
        $request = service('request');
        $postData = $request->getPost();

        $athletesmodel = model(AthletesModel::class);
        $athletes = $athletesmodel->getAthletes($postData['gender'],$postData['grade']);

        $data = array();

        // Read new token and assign in $data['token']
        $data['token'] = csrf_hash();
        $data['tabledata'] = $athletes;

        return $this->response->setJSON($data);
    }
}

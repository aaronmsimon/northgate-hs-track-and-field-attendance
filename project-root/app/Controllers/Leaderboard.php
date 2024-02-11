<?php

namespace App\Controllers;

use App\Models\LeaderboardModel;

class Leaderboard extends BaseController
{
    public function index(): string
    {
        $model = model(LeaderboardModel::class);
        $data['attendance'] = $model->checkins();
        $data['completeweeks'] = $model->completeweeks();

        return view('templates/header', ['title' => 'Northgate Highschool Track & Field Attendance'])
            . view('templates/navigation', ['activepage' => 'leaderboard'])
            . view('pages/leaderboard', $data)
            . view('templates/footer');
    }
}

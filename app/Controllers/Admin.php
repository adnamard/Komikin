<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard | Komikin'
        ];
        return view('admin/index', $data);
    }
}

<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Home extends BaseController
{
    protected $komikModel;
    protected $session;
    public function __construct()
    {
        $this->komikModel  = new KomikModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data = [
            'title' => 'Home | Komikin',
            'komik' => $this->komikModel->getKomik(),

        ];
        return view('home', $data);
    }
}

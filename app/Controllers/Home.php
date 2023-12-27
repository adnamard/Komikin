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
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik(),
            'user' => $this->session->get('user'),

        ];
        return view('home', $data);
    }
}

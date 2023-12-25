<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KomikModel;

class Komik extends BaseController
{

    protected $komikModel;

    public function __construct()
    {
        $this->komikModel  = new KomikModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];
        return view('home', $data);
    }
}

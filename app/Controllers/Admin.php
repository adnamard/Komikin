<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KomikModel;
use App\Models\UserModel;
use App\Models\CheckoutModel;
use App\Models\StatusPembelianModel;

class Admin extends BaseController
{
    protected $komikModel;
    protected $userModel;
    protected $checkoutModel;
    protected $statusPembelianModel;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->komikModel  = new KomikModel();
        $this->userModel  = new UserModel();
        $this->checkoutModel = new CheckoutModel();
        $this->statusPembelianModel = new StatusPembelianModel();

        helper(['form']);

        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $userID = $this->session->get('userData');
        $data = [
            'title' => 'Dashboard | Komikin',
            'total_keranjang_client' => $this->checkoutModel->getCheckoutCountAllFindAll(),
            'total_pembayaran_pending' => $this->statusPembelianModel->getStatusPembelianByIdCountAllResults(1),
            'total_pembayaran_diterima' => $this->statusPembelianModel->getStatusPembelianByIdCountAllResults(2),
            'total_pembayaran_ditolak' => $this->statusPembelianModel->getStatusPembelianByIdCountAllResults(3),
            'user' => $userID,
        ];
        // dd($data);
        return view('admin/dashboard', $data);
    }

    public function profile()
    {

        $userID = $this->session->get('userData');
        $data = [
            'title' => 'Profile | Komikin',
            'user' => $userID
        ];

        return view('admin/profile', $data);
    }

    public function listkomik()
    {
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];
        return view('komik/index', $data);
    }

    public function listuser()
    {
        $data = [
            'title' => 'Daftar Komik',
            'user' => $this->userModel->getUser()
        ];
        return view('admin/user', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Komik',
            'validation' => \Config\Services::validation()->listErrors()  // Fetch validation errors from session
        ];
        return view('komik/create', $data);
    }

    public function save()
    {

        $sampulFile = $this->request->getFile('sampul');        //Validasi Input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah tersedia.'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi',
                ]
            ],
            'genre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi',
                ]
            ],
            'sinopsis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi',
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi',
                ]
            ],
            'sampul' => [
                'rules' => 'uploaded[sampul]',
                'errors' => [
                    'uploaded' => '{field} komik harus diunggah.',
                ]
            ],

        ])) {
            $validation = \Config\Services::validation()->listErrors();
            return redirect()->to('Admin/create')->withInput()->with('validation', $validation);
            //Save ngirim semua input, terus kirim validationnya, teru sdiambil di fucntion create Kita bakal redirect ke create page
        }
        //dd($this->request->getVar());//Ambil semuanya, kalo mau satu, masukin parameternya di dalem tand kurunS

        if ($sampulFile->isValid() && !$sampulFile->hasMoved()) {
            $newSampul = $sampulFile->getRandomName();
            $sampulFile->move('img', $newSampul); // Move to the 'public/img' directory

            $this->komikModel->save([
                'judul' => $this->request->getVar('judul'),
                'penulis' => $this->request->getVar('penulis'),
                'genre' => $this->request->getVar('genre'),
                'sinopsis' => $this->request->getVar('sinopsis'),
                'harga' => $this->request->getVar('harga'),
                'sampul' => $newSampul,
            ]);
        }

        session()->setFlashdata('pesan', 'Data berhasill ditambahkan');
        //setelah berhasil kita kembaliin ke halaman index lagi
        return redirect()->to('Admin/listkomik');
    }


    public function detail($judul)
    {
        $komik = $this->komikModel->getKomik($judul);

        //Jika komik tidak ada di tabel
        if (empty($komik)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik ' . $judul . ' Tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Komik',
            'komik' => $komik
        ];

        return view('komik/detail', $data);
    }

    public function edit($judul)
    {
        $data = [
            'title' => 'Form Ubah Data Komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($judul)
        ];
        return view('komik/edit', $data);
    }

    public function update($id)
    {


        //Cek judul, kalau judul dirubah maka cek is_unique, kalau judul tidak diubah maka tak perlu cek is_unique
        // $komik = $this->komikModel->find($id); // Ambil data komik berdasarkan ID

        // // Rules
        // $rule_judul = 'required';
        // if ($komik['judul'] != $this->request->getVar('judul')) {
        //     $rule_judul .= '|is_unique[komik.judul]';
        // }
        //Validasi Input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    // 'is_unique' => '{field} komik sudah tersedia.'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                ]
            ],
            'genre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                ]
            ],
            'sinopsis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                ]
            ],

        ])) {
            $validation = \Config\Services::validation()->listErrors();
            return redirect()->to('Admin/edit/' . $this->request->getVar('judul'))->withInput()->with('validation', $validation);
        }


        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'penulis' => $this->request->getVar('penulis'),
            'genre' => $this->request->getVar('genre'),
            'sinopsis' => $this->request->getVar('sinopsis'),
            'harga' => $this->request->getVar('harga'),
            'sampul' => $this->request->getVar('sampul'),
        ]);


        session()->setFlashdata('pesan', 'Data berhasill ditambahkan');
        //setelah berhasil kita kembaliin ke halaman index lagi
        return redirect()->to('Admin/listkomik');
    }

    public function delete($id)
    {
        $this->komikModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasill dihapus');
        return redirect()->to(base_url('Admin/listkomik'));
    }
}

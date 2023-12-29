<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckoutModel;
use App\Models\KomikModel;
use App\Models\StatusPembelianModel;
use App\Models\UserModel;

class DataCheckout extends BaseController
{

    protected $modelCheckout;
    protected $modelKomik;
    protected $modelStatusPembelian;
    protected $modelUser;
    protected $session;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->modelKomik = new KomikModel();
        $this->modelCheckout = new CheckoutModel();
        $this->modelStatusPembelian = new StatusPembelianModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        if ($this->session->has('userData')) {
            $userID = $this->session->get('userData')['id'];

            // Mengambil semua riwayat transaksi user dari tabel status pembelian
            $riwayatTransaksi = $this->modelStatusPembelian
                ->select('status_pembelian.*, komik.*, user.username, user.email, daftar_status.*, status_pembelian.id')
                ->join('user', 'user.id = status_pembelian.user_id')
                ->join('komik', 'komik.id = status_pembelian.komik_id')
                ->join('daftar_status', 'daftar_status.id = status_pembelian.status_id')
                ->where('status_pembelian.user_id', $userID)
                ->orderBy('status_pembelian.id', 'DESC')
                ->findAll();

            $tanggalPembelian = [];

            foreach ($riwayatTransaksi as $transaksi) {
                $tanggalPembelian[] = $transaksi['tanggal_pembelian'];
            }

            $data = [
                'riwayatTransaksi' => $riwayatTransaksi,
                'tanggalPembelian' => $tanggalPembelian,
                'title' => 'Riwayat Transaksi'
                // Anda bisa menambahkan data lainnya yang ingin ditampilkan di view di sini
            ];
            // dd($data);
            return view('client/riwayat', $data);
        }
    }
}

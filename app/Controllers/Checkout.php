<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckoutModel;
use App\Models\KomikModel;
use App\Models\StatusPembelianModel;

class Checkout extends BaseController
{

    protected $modelCheckout;
    protected $modelKomik;
    protected $modelStatusPembelian;
    protected $session;


    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->modelKomik = new KomikModel();
        $this->modelCheckout = new CheckoutModel();
        $this->modelStatusPembelian = new StatusPembelianModel();
    }

    public function index()
    {
        $userId = $this->session->get('userData.id');
        $checkout = $this->modelCheckout->getCheckoutByID($userId);

        if ($checkout == null) {
            return redirect()->to(base_url('Home/'))->with('error', 'Keranjang kosong, silahkan pilih komik terlebih dahulu');
        }

        // Menghitung total harga komik
        $totalHarga = 0;
        foreach ($checkout as $c) {
            // Ambil harga komik dari database berdasarkan ID komik
            $hargaKomik = $this->modelKomik->find($c['komik_id'])['harga'];

            // Hitung total harga dengan mengakumulasikan harga setiap komik
            $totalHarga += $hargaKomik * $c['jumlah'];
        }
        $data = [
            'title' => 'Keranjang | Komikin',
            'checkout' => $checkout,
            'user' => $userId,
            'totalHarga' => $totalHarga
        ];
        return view('client/checkout', $data);
    }

    public function add($id)
    {
        // Periksa apakah pengguna sudah login
        if ($this->session->has('userData')) {
            // Ambil ID komik dari parameter
            $komikID = $id;

            // Ambil ID user dari session
            $userID = $this->session->get('userData')['id'];

            // Hitung jumlah komik yang sudah ada dalam keranjang
            $existingCheckout = $this->modelCheckout->getCheckoutByID($userID);
            $jumlahKomik = count($existingCheckout);

            foreach ($existingCheckout as $checkoutItem) {
                if ($checkoutItem['komik_id'] == $komikID) {
                    return redirect()->to(base_url('Home/'))->with('error', 'Waduh, komik ini sudah ada dalam keranjang tuh 👀');
                }
            }
            // Jika pengguna sudah memiliki 5 komik dalam keranjang, tampilkan pesan alert
            if ($jumlahKomik >= 1) {
                return redirect()->to(base_url('Home/'))->with('error', 'Eitss, Anda sudah memiliki 1 komik dalam keranjang, cek dulu yuk!');
            }

            // Jika tidak ada komik dalam keranjang, tambahkan komik yang dipilih ke keranjang
            $checkoutData = [
                'user_id' => $userID,
                'komik_id' => $komikID,
                'jumlah' => 1, // Default jumlah 1 jika tidak ditentukan
            ];

            $this->modelCheckout->insertCheckout($checkoutData);

            // Setelah menambahkan komik ke keranjang, tampilkan pesan alert bahwa produk berhasil ditambahkan
            return redirect()->to(base_url('Home/'))->with('success', 'Komik berhasil ditambahkan ke keranjang');
        } else {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->to(base_url('Auth/loginpage'))->with('error', 'Silakan login terlebih dahulu');
        }
    }


    public function bayar()
    {
        if ($this->session->has('userData')) {
            $userID = $this->session->get('userData')['id'];
            $username = $this->session->get('userData')['username'];
            $checkout = $this->modelCheckout->getCheckoutByID($userID);
            $bukti_pembayaran = $this->request->getFile('buktiPembayaran');


            $bayarKeberapasiClient = $this->modelStatusPembelian
                ->select('status_pembelian.*')
                ->where('user_id', $userID)
                ->orderBy('transaksi', 'DESC')
                ->first();

            $bayarKeberapa = 0;
            if ($bayarKeberapasiClient == null) {
                $bayarKeberapa = 1;
            } else {
                $bayarKeberapa = $bayarKeberapasiClient['transaksi'] + 1;
            }


            if ($bukti_pembayaran->isValid() && !$bukti_pembayaran->hasMoved()) {
                $bukti = $bukti_pembayaran->getRandomName();
                $bukti_pembayaran->move('img', $bukti);
            }
            // Mengambil informasi waktu sekarang
            $dataPembelian = [];


            foreach ($checkout as $item) {
                $dataPembelian[] = [
                    'komik_id' => $item['komik_id'],
                    'user_id' => $userID,
                    'jumlah' => $item['jumlah'],
                    'status_id' => 1,
                    'transaksi' => $bayarKeberapa,
                    'bukti_pembayaran' => $bukti,
                ];
            }

            // Simpan setiap data pembelian ke dalam tabel
            foreach ($dataPembelian as $data) {
                $this->modelStatusPembelian->insert($data);
            }

            $this->modelCheckout->where('user_id', $userID)->delete();
            // var_dump($checkout);
            return redirect()->to('/Home')->with('success', 'Pembayaran berhasil dilakukan. Silahkan Menunggu konfirmasi dari admin');
        }
    }

    public function delete($checkoutId)
    {

        // Lakukan penghapusan checkout berdasarkan ID checkout
        $deleted = $this->modelCheckout->deleteCheckout($checkoutId);

        if ($deleted) {
            return redirect()->to(base_url('Checkout'))->with('success', 'Produk berhasil dihapus dari keranjang');
        } else {
            return redirect()->to(base_url('Checkout'))->with('error', 'Gagal menghapus produk dari keranjang');
        }
    }
}

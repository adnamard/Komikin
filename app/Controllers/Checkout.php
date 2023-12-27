<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckoutModel;
use App\Models\KomikModel;

class Checkout extends BaseController
{

    protected $modelCheckout;
    protected $modelKomik;
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->modelKomik = new KomikModel();
        $this->modelCheckout = new CheckoutModel();
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
            if ($jumlahKomik >= 5) {
                return redirect()->to(base_url('Home/'))->with('error', 'Eitss, Anda sudah memiliki 5 komik dalam keranjang, cek dulu yuk!');
            }

            // Jika tidak ada komik dalam keranjang, tambahkan komik yang dipilih ke keranjang
            $checkoutData = [
                'user_id' => $userID,
                'komik_id' => $komikID,
                'jumlah' => 1, // Default jumlah 1 jika tidak ditentukan
            ];

            $this->modelCheckout->insertCheckout($checkoutData);

            // Setelah menambahkan komik ke keranjang, tampilkan pesan alert bahwa produk berhasil ditambahkan
            return redirect()->to(base_url('Home/'))->with('success', 'Komik berhasil ditambahkan ke checkout');
        } else {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->to(base_url('Auth/loginpage'))->with('error', 'Silakan login terlebih dahulu');
        }
    }


    public function bayar()
    {
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

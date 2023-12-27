<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckoutModel extends Model
{
    protected $table            = 'checkout';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['komik_id', 'user_id', 'jumlah'];

    public function getCheckout()
    {
        return $this->findAll();
    }

    public function getCheckoutByID($user_id)
    {
        return $this->select('checkout.*, komik.*, checkout.id')
            ->join('komik', 'komik.id = checkout.komik_id') //Dari tabel komik, kita ambil idnya dan dijoin ke tabel checkout field komik_id
            ->where('checkout.user_id', $user_id)
            ->findAll();
    }

    public function getCheckoutCountAllFindAll()
    {
        return $this->select('checkout.*, komik.*, checkout.id')
            ->join('komik', 'komik.id = checkout.komik_id')
            ->countAllResults();
    }

    public function insertCheckout($data)
    {
        return $this->insert($data);
    }

    public function updateCheckout($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCheckout($id)
    {
        return $this->delete($id);
    }
}

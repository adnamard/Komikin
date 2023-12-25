<?php

namespace App\Models;

use CodeIgniter\Model;

class KomikModel extends Model
{
    protected $table            = 'komik';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['judul', 'penulis', 'genre', 'sinopsis', 'sampul', 'stok', 'harga'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

    public function getKomik($judul = false) #Jika ga ada parameter maka tampilakn semua dengan findall
    {
        if ($judul == false) {
            return $this->findAll();
        }

        return $this->where(['judul' => $judul])->first(); #kalau ada maka tampilakn array pertama
    }
}

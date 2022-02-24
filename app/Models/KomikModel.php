<?php

namespace App\Models;

use CodeIgniter\Model;

class KomikModel extends Model
{
    protected $table = 'komik';
    protected $primaryKey = 'id_komik';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];

    public function getkomik($slug = false)
    {
        if ($slug == false) {
            return $this->findAll(); //Memanggil semua data di dalam databse
        }

        return $this->where(['slug' => $slug])->first(); //Memanggil 1 data di dalam databse berdasarkan slug
    }
}

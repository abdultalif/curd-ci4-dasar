<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }
    public function index()
    {
        $data = [
            'judul' => 'Daftar Komik',
            'komik' => $this->komikModel->getkomik()
        ];

        return view('komik', $data);
    }

    public function detail($slug)
    {

        $data = [
            'judul' => 'Detail Komik',
            'detail' => $this->komikModel->getkomik($slug)
        ];

        if (empty($data['detail'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak di temukan.');
        }
        return view('detail', $data);
    }

    public function create()
    {
        $data = [
            'judul' => 'Tambah Komik'
        ];

        return view('tambah', $data);
    }

    public function save()
    {
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);
        return redirect()->to('/komik');
    }
}

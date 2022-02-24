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
        // session nya bisa di sini atau di baseController
        // session();
        $data = [
            'judul' => 'Tambah Komik',
            'validation' => \config\Services::validation()
        ];

        return view('tambah', $data);
    }

    public function save()
    {
        // validasi
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus di isi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ]
        ])) {
            $validasi = \Config\Services::validation(); //memunculkan pesan kesalahan di validasi
            return redirect()->to('/komik/create')->withInput()->with('validation', $validasi);
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/komik');
    }
}

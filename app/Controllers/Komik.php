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
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus di isi',
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus di isi',
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran {field} terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validasi = \Config\Services::validation(); //memunculkan pesan kesalahan di validasi
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validasi);
            return redirect()->to('/komik/create')->withInput();
        }

        // Ambil gambar
        $file = $this->request->getfile('sampul');
        // jika tidak ada gambar yang di upload
        if ($file->getError() == 4) {
            $namasampul = 'default.png';
        } else {
            // generate nama sampul random
            $namasampul = $file->getRandomName();
            // Pindahkan file ke folder img
            $file->move('img', $namasampul);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        // method save merupakan bawaan dari ci untuk tambah data
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namasampul
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $komik = $this->komikModel->find($id);

        // jika file gambar nya default.png jangan hapus
        if ($komik['sampul'] != 'default.png') {
            // hapus gambar
            unlink('img/' . $komik['sampul']);
        }

        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'judul' => 'Ubah Komik',
            'validation' => \config\Services::validation(),
            'komik' => $this->komikModel->getkomik($slug)
        ];

        return view('ubah', $data);
    }

    public function update($id)
    {
        $komiklama = $this->komikModel->getkomik($this->request->getVar('slug'));
        if ($komiklama['judul'] == $this->request->getVar('judul')) {
            $rulejudul = 'required';
        } else {
            $rulejudul = 'required|is_unique[komik.judul]';
        }
        // validasi
        if (!$this->validate([
            'judul' => [
                'rules' => $rulejudul,
                'errors' => [
                    'required' => '{field} komik harus di isi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus di isi',
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus di isi',
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran {field} terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput();
        }
        $lama = $this->request->getVar('lama');
        $baru = $this->request->getFile('sampul');
        // cek gambar apakah tetap gambar lama
        if ($baru->getError() == 4) {
            $sampul = $lama;
        } else {
            // generate nama file random
            $sampul = $baru->getRandomName();
            // pindahkan gambar
            $baru->move('img', $sampul);
            // hapus gambar lama
            unlink('img/' . $lama);
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        // method save merupakan bawaan dari ci untuk tambah data
        $this->komikModel->save([
            'id_komik' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $sampul
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('/komik');
    }
}

<?php

namespace App\Controllers;

use App\Models\OrangModel;

class Orang extends BaseController
{
    protected $OrangModel;
    public function __construct()
    {
        $this->OrangModel = new OrangModel();
    }
    public function index()
    {
        $keyword = $this->request->getVar('nama');
        if ($keyword) {
            $orang = $this->OrangModel->search($keyword);
        } else {
            $orang = $this->OrangModel;
        }
        $data = [
            'judul' => 'Daftar Orang',
            // 'orang' => $this->OrangModel->findall()
            'orang' => $orang->paginate('6', 'orang'),
            'pager' => $orang->pager,
            'currentpage' => $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1
        ];

        return view('orang', $data);
    }
}

<?php

namespace App\Controllers\Apoteker;

use App\Controllers\BaseController;
use App\Models\Model_kamar;

class Kamar extends BaseController
{
    protected $Model_kamar;
    public function __construct()
    {
        $this->Model_kamar = new Model_kamar();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Apoteker') {
            return redirect()->to('Login/loginPegawai');
        }
        
        $model = new Model_kamar();
        $kamar = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Kamar',
            'kamar' => $kamar
        ];
        return view('Apoteker/viewTKamar', $data);
    }
}

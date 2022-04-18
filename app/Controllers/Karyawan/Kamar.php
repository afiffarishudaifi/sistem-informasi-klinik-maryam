<?php

namespace App\Controllers\Karyawan;

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
        $model = new Model_kamar();
        $kamar = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Kamar',
            'kamar' => $kamar
        ];
        return view('Karyawan/viewTKamar', $data);
    }
}

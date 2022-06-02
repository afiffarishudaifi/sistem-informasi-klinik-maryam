<?php

namespace App\Controllers\Apoteker;

use App\Controllers\BaseController;
use App\Models\Model_dashboard_admin;

class Dashboard extends BaseController
{

    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Apoteker') {
            return redirect()->to('Login');
        }
        

        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        $model = new Model_dashboard_admin();
        
        $kamar_kosong = $model->kamar_kosong()->getResultArray();
        $kamar_terisi = $model->kamar_terisi()->getResultArray();
        $obat = $model->obat()->getResultArray();
        $obat_kosong = $model->obat_kosong()->getResultArray();

        $data = [
            'judul' => 'Tabel Karyawan',
            'kamar_kosong' => count($kamar_kosong),
            'kamar_terisi' => count($kamar_terisi),
            'obat' => count($obat),
            'obat_kosong' => count($obat_kosong)
        ];
        return view('Apoteker/index', $data);
    }
}

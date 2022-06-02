<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\Model_dashboard_admin;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }

        $model = new Model_dashboard_admin();
        
        $kamar_kosong = $model->kamar_kosong()->getResultArray();
        $kamar_terisi = $model->kamar_terisi()->getResultArray();
        $obat = $model->obat()->getResultArray();
        $pasien = $model->pasien()->getResultArray();

        $data = [
            'judul' => 'Tabel Karyawan',
            'kamar_kosong' => count($kamar_kosong),
            'kamar_terisi' => count($kamar_terisi),
            'obat' => count($obat),
            'pasien' => count($pasien)
        ];
        return view('Karyawan/index', $data);
    }

}

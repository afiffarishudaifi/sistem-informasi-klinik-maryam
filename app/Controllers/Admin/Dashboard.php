<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_dashboard_admin;

class Dashboard extends BaseController
{

    public function index()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Admin') {
            return redirect()->to('Login/loginAdmin');
        }

        $model = new Model_dashboard_admin();
        $kamar_kosong = $model->kamar_kosong()->getResultArray();
        $kamar_terisi = $model->kamar_terisi()->getResultArray();
        $dokter = $model->dokter()->getResultArray();
        $pegawai = $model->pegawai()->getResultArray();

        $data = [
            'judul' => 'Tabel Admin',
            'kamar_kosong' => count($kamar_kosong),
            'kamar_terisi' => count($kamar_terisi),
            'dokter' => count($dokter),
            'pegawai' => count($pegawai)
        ];
        return view('Admin/index', $data);
    }
}
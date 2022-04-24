<?php

namespace App\Controllers\Pasien;

use App\Controllers\BaseController;
use App\Models\Model_pasien;

class Dashboard extends BaseController
{

	public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Pasien') {
            return redirect()->to('Login');
        }

        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        $model = new Model_pasien();
        $id = $session->get('nik');

        $cek_data =  $model->cek_data($id)->getRowArray();

        if($cek_data != null) {
            if($cek_data['alamat_pasien'] == '' || $cek_data['no_telp_pasien'] == '' || $cek_data['agama'] == '' || $cek_data['tgl_lahir'] == null) {
                return redirect()->to(base_url('Pasien/Pengaturan'));
            } 
        }

        $data = [
            'judul' => 'Tabel Pasien'
        ];
        return view('Pasien/index', $data);
    }

    public function add_admin()
    {
    }

    public function update_admin()
    {
    }

    public function delete_admin()
    {
    }
}
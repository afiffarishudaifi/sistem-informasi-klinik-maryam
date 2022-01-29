<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{

    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Pasien') {
            return redirect()->to('Login');
        } else if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login');
        }

        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();

        $data = [
            'judul' => 'Tabel Karyawan'
        ];
        return view('Karyawan/index', $data);
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
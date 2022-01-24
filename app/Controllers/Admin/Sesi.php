<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Sesi extends BaseController
{
    protected $Model_sesi;

    public function index()
    {
        $data = [
            'judul' => 'Tabel Sesi'
        ];
        return view('Admin/viewTSesi', $data);
    }

    public function add_pasien()
    {
    }

    public function update_pasien()
    {
    }

    public function delete_pasien()
    {
    }
}
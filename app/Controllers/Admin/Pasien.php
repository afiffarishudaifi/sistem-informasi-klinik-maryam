<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pasien extends BaseController
{
    protected $Model_pasien;

    public function index()
    {
        $data = [
            'judul' => 'Tabel Pasien'
        ];
        return view('Admin/viewTPasien', $data);
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
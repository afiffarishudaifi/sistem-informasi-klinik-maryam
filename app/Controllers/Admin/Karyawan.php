<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Karyawan extends BaseController
{
    protected $Model_karyawan;

    public function index()
    {
        $data = [
            'judul' => 'Tabel Karyawan'
        ];
        return view('Admin/viewTKaryawan', $data);
    }

    public function add_karyawan()
    {
    }

    public function update_karyawan()
    {
    }

    public function delete_karyawan()
    {
    }
}
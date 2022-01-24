<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Jabatan extends BaseController
{

    protected $Model_jabatan;

    public function index()
    {
        $data = [
            'judul' => 'Tabel Jabatan'
        ];
        return view('Admin/viewTJabatan', $data);
    }

    public function add_jabatan()
    {
    }

    public function update_jabatan()
    {
    }

    public function delete_jabatan()
    {
    }
}
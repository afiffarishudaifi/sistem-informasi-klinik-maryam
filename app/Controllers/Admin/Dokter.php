<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dokter extends BaseController
{

    protected $Model_dokter;

    public function index()
    {
        $data = [
            'judul' => 'Tabel Dokter'
        ];
        return view('Admin/viewTDokter', $data);
    }

    public function add_dokter()
    {
    }

    public function update_dokter()
    {
    }

    public function delete_dokter()
    {
    }
}
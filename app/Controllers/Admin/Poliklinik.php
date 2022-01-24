<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Poliklinik extends BaseController
{
    protected $Model_poliklinik;

    public function index()
    {
        $data = [
            'judul' => 'Tabel Poliklinik'
        ];
        return view('Admin/viewTPoliklinik', $data);
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
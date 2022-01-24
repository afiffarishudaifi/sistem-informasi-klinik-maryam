<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Obat extends BaseController
{
    protected $Model_obat;

    public function index()
    {
        $data = [
            'judul' => 'Tabel Obat'
        ];
        return view('Admin/viewTObat', $data);
    }

    public function add_obat()
    {
    }

    public function update_obat()
    {
    }

    public function delete_obat()
    {
    }
}

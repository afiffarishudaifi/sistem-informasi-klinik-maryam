<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Kamar extends BaseController
{
    protected $Model_kamar;

    public function index()
    {
        $data = [
            'judul' => 'Tabel Kamar'
        ];
        return view('Admin/viewTKamar', $data);
    }

    public function add_kamar()
    {
    }

    public function update_kamar()
    {
    }

    public function delete_kamar()
    {
    }
}
<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Hari extends BaseController
{

    protected $Model_hari;

    public function index()
    {
        $data = [
            'judul' => 'Tabel Hari'
        ];
        return view('Admin/viewTHari', $data);
    }

    public function add_hari()
    {
    }

    public function update_hari()
    {
    }

    public function delete_hari()
    {
    }
}
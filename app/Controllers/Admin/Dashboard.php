<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{

    public function index()
    {
        $data = [
            'judul' => 'Tabel Admin'
        ];
        return view('Admin/index', $data);
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
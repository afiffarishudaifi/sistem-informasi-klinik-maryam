<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class JadwalDokter extends BaseController
{
    protected $Model_jadwal;

    public function index()
    {
        $data = [
            'judul' => 'Tabel Jadwal Dokter'
        ];
        return view('Admin/viewTJadwalDokter', $data);
    }

    public function add_jadwal()
    {
    }

    public function update_jadwal()
    {
    }

    public function delete_jadwal()
    {
    }
}
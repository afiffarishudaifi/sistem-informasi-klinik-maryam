<?php

namespace App\Controllers\Admin;
use App\Models\Model_jadwaldokter;

use App\Controllers\BaseController;

class JadwalDokter extends BaseController
{
    protected $Model_jadwal;
    public function __construct()
    {
        $this->Model_jadwalDokter = new Model_jadwalDokter();
        helper(['form', 'url']);
    }
    public function index()
    {
        $session = session();
        $model = new Model_jadwaldokter();
        $jadwal = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Jadwal Dokter',
            'jadwal' => $jadwal
        ];
        return view('Admin/viewTJadwalDokter', $data);
    }

    public function add_jadwal()
    {
        $session = session();
        $data = array(
            'id_hari'     => $this->request->getPost('input_nomor'),
            'id_sesi'     => $this->request->getPost('input_biaya'),
            'id_dokter' => $this->request->getPost('input_status'),
            'status_jadwal' => $this->request->getPost('input_status')
        );
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'input_nomor' => 'required|numeric',
            'biaya_kamar' => 'required|numeric',
            'status_kamar' => 'required',
        ]);
        $model = new Model_jadwaldokter();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Kamar'));
    }

    public function update_jadwal()
    {
    }

    public function delete_jadwal()
    {
    }
}
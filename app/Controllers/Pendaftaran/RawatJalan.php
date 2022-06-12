<?php

namespace App\Controllers\Pendaftaran;

use App\Controllers\BaseController;
use App\Models\Model_rawatjalanpasien;


class RawatJalan extends BaseController
{
    protected $Model_rawatjalanpasien;
    public function __construct()
    {
        $session = session();
        $this->Model_rawatjalanpasien = new Model_rawatjalanpasien();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $model = new Model_rawatjalanpasien();
        $data = [
            'judul' => 'Pendaftaran Rawat Jalan',
        ];
        return view('Pendaftaran/RawatJalan', $data);
    }

    

    public function add_pendaftaran()
    {
        $session = session();
        $model = new Model_rawatjalanpasien();
        $poli = $this->request->getPost('input_poli');
        $tanggal_daftar = $this->request->getPost('input_tanggal');
        $params = [
            'id_poli' => $poli,
            'tanggal_daftar' => $tanggal_daftar
        ];  
        $max = $model->cek_max($params)->getRowArray()['no_antrian'];
        if ($max == null) {
            $max = 1;
        } else {
            $max = $max + 1;
        }

        $data = array(
            'nik'     => $this->request->getPost('input_nik'),
            'id_poli'     => $poli,
            'keluhan'     => $this->request->getPost('input_keluhan'),
            'umur'     => $this->request->getPost('input_umur'),
            'tanggal_daftar'     => $tanggal_daftar,
            'no_antrian' => $max,
            'status_antrian' => 'Menunggu'
        );
        dd($data);

        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Pasien/PasienRawatJalan'));
    }

    public function data_poli()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("poli");

        $poli = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_poli, nama_poli');
            $builder->like('nama_poli', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_poli, nama_poli');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $poli[] = array(
                "id" => $country->id_poli,
                "text" => $country->nama_poli,
            );
        }

        $response['data'] = $poli;

        return $this->response->setJSON($response);
    }

}

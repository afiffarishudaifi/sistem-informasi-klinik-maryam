<?php

namespace App\Controllers\Pasien;

use App\Controllers\BaseController;
use App\Models\Model_rawatjalanpasien;

class PasienRawatJalan extends BaseController
{
    protected $Model_rawatjalanpasien;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Pasien') {
            return redirect()->to('Login');
        }

        $this->Model_rawatjalanpasien = new Model_rawatjalanpasien();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        $model = new Model_rawatjalanpasien();
        $id = $session->get('user_id');
        $data = $model->cek_pasien($id)->getResultArray();
        $jumlah = count($data);
        if($jumlah != 0) {
            $antrian = $model->antrian($id)->getRowArray()['no_antrian'];
        } else {
            $antrian = 0;
        }

        $data = [
            'judul' => 'Pendaftaran Rawat Jalan',
            'data' => count($data),
            'antrian' => $antrian
        ];
        return view('Pasien/viewDaftarJalan', $data);
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
            'nik'     => $session->get('user_id'),
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

    public function data_jadwal()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("jadwal_dokter");

        $pasien = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_jadwal, id_jadwal, hari.nama_hari, sesi.nama_sesi');
            $builder->join('hari','jadwal_dokter.id_hari = hari.id_hari');
            $builder->join('sesi','jadwal_dokter.id_sesi = sesi.id_sesi');
            $builder->where('status_jadwal','Aktif');
            $builder->like('hari.nama_hari', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_jadwal, id_jadwal, hari.nama_hari, sesi.nama_sesi');
            $builder->join('hari','jadwal_dokter.id_hari = hari.id_hari');
            $builder->join('sesi','jadwal_dokter.id_sesi = sesi.id_sesi');
            $builder->where('status_jadwal','Aktif');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $pasien[] = array(
                "id" => $country->id_jadwal,
                "text" => $country->nama_hari . ', ' . $country->nama_sesi,
            );
        }

        $response['data'] = $pasien;

        return $this->response->setJSON($response);
    }
}
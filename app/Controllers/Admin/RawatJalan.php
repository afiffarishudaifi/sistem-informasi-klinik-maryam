<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_rawatjalan;

class RawatJalan extends BaseController
{
    protected $Model_rawatjalan;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Admin') {
            return redirect()->to('Login/loginAdmin');
        }

        $this->Model_rawatjalan = new Model_rawatjalan();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        $model = new Model_rawatjalan();
        $data = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Rawat Jalan',
            'data' => $data
        ];
        return view('Admin/viewDaftarRawatJalan', $data);
    }

    public function add_pendaftaran()
    {
        $session = session();
        $model = new Model_rawatjalan();
        $poli = $this->request->getPost('input_poli');
        $jadwal = $this->request->getPost('input_jadwal');
        $tanggal_daftar = $this->request->getPost('input_tanggal');
        $params = [
            'id_poli' => $poli,
            'id_jadwal' => $jadwal,
            'tanggal_daftar' => $tanggal_daftar
        ];  
        $max = $model->cek_max($params)->getRowArray()['id_pendaftaran'];
        if ($max == null) {
            $max = 1;
        } else {
            $max = $max + 1;
        }

        $data = array(
            'id_pasien'     => $this->request->getPost('input_pasien'),
            'id_poli'     => $poli,
            'id_jadwal'     => $jadwal,
            'keluhan'     => $this->request->getPost('input_keluhan'),
            'umur'     => $this->request->getPost('input_umur'),
            'tanggal_daftar'     => $tanggal_daftar,
            'no_antrian' => $max,
            'status_antrian' => 'Menunggu'
        );

        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/RawatJalan'));
    }

    public function update_pendaftaran()
    {
        $session = session();
        $model = new Model_rawatjalan();
        
        $id = $this->request->getPost('id_pendaftaran');
        $poli = $this->request->getPost('edit_poli');
        $jadwal = $this->request->getPost('edit_jadwal');
        $tanggal_daftar = $this->request->getPost('edit_tanggal');
        $params = [
            'id_poli' => $poli,
            'id_jadwal' => $jadwal,
            'tanggal_daftar' => $tanggal_daftar
        ];  
        $max = $model->cek_max($params)->getRowArray()['id_pendaftaran'];
        if ($max == null) {
            $max = 1;
        } else {
            $max = $max + 1;
        }

        $data = array(
            'id_pasien'     => $this->request->getPost('edit_pasien'),
            'id_poli'     => $poli,
            'id_jadwal'     => $jadwal,
            'keluhan'     => $this->request->getPost('edit_keluhan'),
            'umur'     => $this->request->getPost('edit_umur'),
            'tanggal_daftar'     => $tanggal_daftar,
            'no_antrian' => $max,
            'status_antrian' => 'Menunggu'
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/RawatJalan'));
    }

    public function delete_pendaftaran()
    {
        $session = session();
        $model = new Model_rawatjalan();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Admin/RawatJalan');
    }

    public function data_edit($id_pendaftaran)
    {
        $model = new Model_rawatjalan();
        $datahari = $model->detail_data($id_pendaftaran)->getResultArray();
        $respon = json_decode(json_encode($datahari), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_pendaftaran'] = $value['id_pendaftaran'];
            $isi['id_pasien'] = $value['id_pasien'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['id_poli'] = $value['id_poli'];
            $isi['nama_poli'] = $value['nama_poli'];
            $isi['id_jadwal'] = $value['id_jadwal'];
            $isi['nama_hari'] = $value['nama_hari'];
            $isi['nama_sesi'] = $value['nama_sesi'];
            $isi['nama_dokter'] = $value['nama_dokter'];
            $isi['keluhan'] = $value['keluhan'];
            $isi['umur'] = $value['umur'];
            $isi['status_antrian'] = $value['status_antrian'];
            $isi['tanggal_daftar'] = $value['tanggal_daftar'];
        endforeach;
        echo json_encode($isi);
    }

    public function data_poli()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("poliklinik");

        $poli = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_poli, nama_poli');
            $builder->like('nama_poli', $query, 'both');
            $builder->where('status_poli','Aktif');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_poli, nama_poli');
            $builder->where('status_poli','Aktif');
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

    public function data_pasien()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("pasien");

        $pasien = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_pasien, nama_pasien');
            $builder->like('nama_pasien', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_pasien, nama_pasien');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $pasien[] = array(
                "id" => $country->id_pasien,
                "text" => $country->nama_pasien,
            );
        }

        $response['data'] = $pasien;

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
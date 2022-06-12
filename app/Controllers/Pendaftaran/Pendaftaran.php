<?php

namespace App\Controllers\Pendaftaran;

use App\Controllers\BaseController;
use App\Models\Model_pasien;
use App\Models\Model_rawatinappasien;
use App\Models\Model_rawatjalanpasien;

class Pendaftaran extends BaseController
{

	public function __construct()
    {
        $session = session();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        return view('Pendaftaran/index');
    }

    public function data_kamar()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("kamar");

        $kamar = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_kamar, nama_kamar');
            $builder->where('status_kamar','Kosong');
            $builder->like('nama_kamar', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_kamar, nama_kamar');
            $builder->where('status_kamar','Kosong');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $data_kamar) {
            $kamar[] = array(
                "id" => $data_kamar->id_kamar,
                "text" => $data_kamar->nama_kamar,
            );
        }

        $response['data'] = $kamar;

        return $this->response->setJSON($response);
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

    public function add_pendaftaran_inap()
    {
        $session = session(); 
        if($this->request->getPost('input_status_inap') != '') {
            $data = array(
	            'nik'     => $this->request->getPost('input_nik'),
	            'nama_pasien'     => $this->request->getPost('input_nama'),
	            'alamat_pasien'     => $this->request->getPost('input_alamat'),
	            'no_telp_pasien'     => $this->request->getPost('input_no_telp'),
	            'jenis_kelamin'     => $this->request->getPost('input_kelamin'),
	            'tgl_lahir'     => $this->request->getPost('input_tanggal'),
	            'agama'     => $this->request->getPost('input_agama')
	        );

	        $model = new Model_pasien();
	        $model->add_data($data);
        }

        $nik = $this->request->getPost('input_nik');

        $data = array(
            'nik'     => $nik,
            'id_kamar'     => $this->request->getPost('input_kamar'),
            'waktu_masuk'     => $this->request->getPost('input_masuk'),
            'waktu_keluar'     => null,
            'status_inap'     => 'Belum Selesai',
            'total_tagihan_inap'     => 0
        );

        $kamar = $this->request->getPost('input_kamar');
        $ubah_kamar = array(
            'status_kamar' => 'Terisi'
        );

        $model = new Model_rawatinappasien();
        $cek_pasien = $model->cek_pasien($nik)->getRowArray();
        
        $model->add_data($data);
        $model->update_status_kamar($ubah_kamar, $kamar);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Pendaftaran/Pendaftaran'));
    }

    public function add_pendaftaran_jalan()
    {
        $session = session();
        if($this->request->getPost('input_status_jalan') != '') {
            $data = array(
	            'nik'     => $this->request->getPost('input_nik'),
	            'nama_pasien'     => $this->request->getPost('input_nama'),
	            'alamat_pasien'     => $this->request->getPost('input_alamat'),
	            'no_telp_pasien'     => $this->request->getPost('input_no_telp'),
	            'jenis_kelamin'     => $this->request->getPost('input_kelamin'),
	            'tgl_lahir'     => $this->request->getPost('input_tanggal'),
	            'agama'     => $this->request->getPost('input_agama')
	        );

	        $model = new Model_pasien();
	        $model->add_data($data);
        }

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

        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Pendaftaran/Pendaftaran'));
    }
}

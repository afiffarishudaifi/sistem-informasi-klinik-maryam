<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_laporanrekammedis;

class LaporanRekamJalan extends BaseController
{

    protected $Model_laporanrekammedis;
    public function __construct()
    {
        $this->Model_laporanrekammedis = new Model_laporanrekammedis();
        helper(['form', 'url']);
        $this->db = db_connect();
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
            $builder->select('nik, nama_pasien');
            $builder->like('nama_pasien', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('nik, nama_pasien');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $pasien[] = array(
                "id" => $country->nik,
                "text" => $country->nama_pasien,
            );
        }

        $response['data'] = $pasien;

        return $this->response->setJSON($response);
    }

    public function index()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Admin') {
            return redirect()->to('Login/loginAdmin');
        }
        $model = new Model_laporanrekammedis();

        $data = [
            'judul' => 'Laporan Rekam Medis Rawat Jalan'
        ];
        return view('Admin/viewLaporanRekamJalan', $data);
    }

    public function data($tanggal = null, $pasien = null)
    {
        $session = session();

        if ($tanggal) $tgl = explode(' - ', $tanggal);
        if ($tanggal) { $param['cek_waktu1'] = date("Y-m-d", strtotime($tgl[0])); } else { $param['cek_waktu1'] = date("Y-m-d"); };
        if ($tanggal) { $param['cek_waktu2'] = date("Y-m-d", strtotime($tgl[1])); } else { $param['cek_waktu2'] = date("Y-m-d"); };

        if ($pasien != 'null') {
            $param['nik'] = $pasien;
        } else {
            $param['nik'] = null;
        }

        $model = new Model_laporanrekammedis();
        $laporan = $model->filter_jalan($param)->getResultArray();

        $respon = $laporan;
        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['nama_pasien'] = $value['nama_pasien'];
                $isi['nama_dokter'] = $value['nama_dokter'];
                $isi['hasil_pemeriksaan'] = $value['hasil_pemeriksaan'];
                $isi['saran_dokter'] = $value['saran_dokter'];
                $isi['tanggal_rekam'] = $value['tanggal_rekam'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }
    
    public function data_dokter()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("dokter");

        $dokter = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('dokter.nik_dokter, dokter.nama_dokter');
            $builder->like('nama_dokter', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('dokter.nik_dokter, dokter.nama_dokter');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $dokter[] = array(
                "id" => $country->nik_dokter,
                "text" => $country->nama_dokter,
            );
        }

        $response['data'] = $dokter;

        return $this->response->setJSON($response);
    }

    public function data_cetak($tanggal = null, $pasien = null, $dokter = null)
    {
        $session = session();

        if ($tanggal) $tgl = explode(' - ', $tanggal);
        if ($tanggal) { $param['cek_waktu1'] = date("Y-m-d", strtotime($tgl[0])); } else { $param['cek_waktu1'] = date("Y-m-d"); };
        if ($tanggal) { $param['cek_waktu2'] = date("Y-m-d", strtotime($tgl[1])); } else { $param['cek_waktu2'] = date("Y-m-d"); };

        if ($pasien != 'null') {
            $param['nik'] = $pasien;
        } else {
            $param['nik'] = null;
        }

        if ($dokter != 'null') {
            $param['nik_dokter'] = $dokter;
        } else {
            $param['nik_dokter'] = null;
        }

        $model = new Model_laporanrekammedis();
        $laporan = $model->filter_jalan($param)->getResultArray();

        $respon = $laporan;
        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['nama_pasien'] = $value['nama_pasien'];
                $isi['nama_dokter'] = $value['nama_dokter'];
                $isi['hasil_pemeriksaan'] = $value['hasil_pemeriksaan'];
                $isi['saran_dokter'] = $value['saran_dokter'];
                $isi['tanggal_rekam'] = $value['tanggal_rekam'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }
}

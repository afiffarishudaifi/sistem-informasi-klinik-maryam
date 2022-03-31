<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\Model_laporanrawatjalan;

class LaporanRawatJalan extends BaseController
{

    protected $Model_laporanrawatjalan;
    public function __construct()
    {
        $this->Model_laporanrawatjalan = new Model_laporanrawatjalan();
        helper(['form', 'url']);
        $this->db = db_connect();
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

    public function index()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }

        $model = new Model_laporanrawatjalan();

        $data = [
            'judul' => 'Laporan Rawat Jalan'
        ];
        return view('Karyawan/viewLaporanRawatJalan', $data);
    }

    public function data($tanggal = null, $poli = null)
    {
        $session = session();

        if ($tanggal) $tgl = explode(' - ', $tanggal);
        if ($tanggal) { $param['cek_waktu1'] = date("Y-m-d", strtotime($tgl[0])); } else { $param['cek_waktu1'] = date("Y-m-d"); };
        if ($tanggal) { $param['cek_waktu2'] = date("Y-m-d", strtotime($tgl[1])); } else { $param['cek_waktu2'] = date("Y-m-d"); };

        if ($poli != 'null') {
            $param['id_poli'] = $poli;
        } else {
            $param['id_poli'] = null;
        }

        $model = new Model_laporanrawatjalan();
        $laporan = $model->filter($param)->getResultArray();

        $respon = $laporan;
        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['id_antrian'] = $value['id_antrian'];
                $isi['nama_pasien'] = $value['nama_pasien'];
                $isi['nama_poli'] = $value['nama_poli'];
                $isi['tanggal_daftar'] = $value['tanggal_daftar'];
                $isi['keluhan'] = $value['keluhan'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }

    public function data_cetak($tanggal = null, $poli = null)
    {
        $session = session();

        if ($tanggal) $tgl = explode(' - ', $tanggal);
        if ($tanggal) { $param['cek_waktu1'] = date("Y-m-d", strtotime($tgl[0])); } else { $param['cek_waktu1'] = date("Y-m-d"); };
        if ($tanggal) { $param['cek_waktu2'] = date("Y-m-d", strtotime($tgl[1])); } else { $param['cek_waktu2'] = date("Y-m-d"); };

        if ($poli != 'null') {
            $param['id_poli'] = $poli;
        } else {
            $param['id_poli'] = null;
        }

        $model = new Model_laporanrawatjalan();
        $laporan = $model->filter($param)->getResultArray();

        $respon = $laporan;
        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['id_antrian'] = $value['id_antrian'];
                $isi['nama_pasien'] = $value['nama_pasien'];
                $isi['nama_poli'] = $value['nama_poli'];
                $isi['tanggal_daftar'] = $value['tanggal_daftar'];
                $isi['keluhan'] = $value['keluhan'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }
}

<?php

namespace App\Controllers\Pasien;

use App\Controllers\BaseController;
use App\Models\Model_rekammedispasien;

class RekamMedisInap extends BaseController
{

    protected $Model_rekammedispasien;
    public function __construct()
    {
        $this->Model_rekammedispasien = new Model_rekammedispasien();
        helper(['form', 'url']);
        $this->db = db_connect();
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
            $builder->select('dokter.id_dokter, dokter.nama_dokter');
            $builder->like('nama_dokter', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('dokter.id_dokter, dokter.nama_dokter');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $dokter[] = array(
                "id" => $country->id_dokter,
                "text" => $country->nama_dokter,
            );
        }

        $response['data'] = $dokter;

        return $this->response->setJSON($response);
    }

    public function index()
    {
        $model = new Model_rekammedispasien();

        $data = [
            'judul' => 'Laporan Rekam Medis Rawat Inap'
        ];
        return view('Pasien/viewRekamInap', $data);
    }

    public function data($tanggal = null, $dokter = null)
    {
        $session = session();

        if ($tanggal) $tgl = explode(' - ', $tanggal);
        if ($tanggal) { $param['cek_waktu1'] = date("Y-m-d", strtotime($tgl[0])); } else { $param['cek_waktu1'] = date("Y-m-d"); };
        if ($tanggal) { $param['cek_waktu2'] = date("Y-m-d", strtotime($tgl[1])); } else { $param['cek_waktu2'] = date("Y-m-d"); };

        if ($dokter != 'null') {
            $param['id_dokter'] = $dokter;
        } else {
            $param['id_dokter'] = null;
        }
        $param['id_pasien'] = $session->get('user_id');

        $model = new Model_rekammedispasien();
        $laporan = $model->filter_inap($param)->getResultArray();

        $respon = $laporan;
        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['nama_pasien'] = $value['nama_pasien'];
                $isi['nama_dokter'] = $value['nama_dokter'];
                $isi['hasil_pemeriksaan'] = $value['hasil_pemeriksaan'];
                $isi['saran_dokter'] = $value['saran_dokter'];
                $isi['created_at'] = $value['created_at'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }

    public function data_cetak($tanggal = null, $dokter = null)
    {
        $session = session();

        if ($tanggal) $tgl = explode(' - ', $tanggal);
        if ($tanggal) { $param['cek_waktu1'] = date("Y-m-d", strtotime($tgl[0])); } else { $param['cek_waktu1'] = date("Y-m-d"); };
        if ($tanggal) { $param['cek_waktu2'] = date("Y-m-d", strtotime($tgl[1])); } else { $param['cek_waktu2'] = date("Y-m-d"); };

        if ($dokter != 'null') {
            $param['id_dokter'] = $dokter;
        } else {
            $param['id_dokter'] = null;
        }

        $param['id_pasien'] = $session->get('user_id');

        $model = new Model_rekammedispasien();
        $laporan = $model->filter_inap($param)->getResultArray();

        $respon = $laporan;
        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['nama_pasien'] = $value['nama_pasien'];
                $isi['nama_dokter'] = $value['nama_dokter'];
                $isi['hasil_pemeriksaan'] = $value['hasil_pemeriksaan'];
                $isi['saran_dokter'] = $value['saran_dokter'];
                $isi['created_at'] = $value['created_at'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }
}
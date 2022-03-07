<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_laporanrawatinap;

class LaporanRawatInap extends BaseController
{

    protected $Model_laporanrawatinap;
    public function __construct()
    {
        $this->Model_laporanrawatinap = new Model_laporanrawatinap();
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

    public function index()
    {
        $model = new Model_laporanrawatinap();

        $data = [
            'judul' => 'Laporan Rawat Inap'
        ];
        return view('Admin/viewLaporanRawatInap', $data);
    }

    public function data($tanggal = null, $status = null)
    {
        $session = session();

        if ($tanggal) $tgl = explode(' - ', $tanggal);
        if ($tanggal) { $param['cek_waktu1'] = date("Y-m-d", strtotime($tgl[0])); } else { $param['cek_waktu1'] = date("Y-m-d"); };
        if ($tanggal) { $param['cek_waktu2'] = date("Y-m-d", strtotime($tgl[1])); } else { $param['cek_waktu2'] = date("Y-m-d"); };

        if ($status != 'null') {
            $param['status_inap'] = $status;
        } else {
            $param['status_inap'] = null;
        }

        $model = new Model_laporanrawatinap();
        $laporan = $model->filter($param)->getResultArray();

        $respon = $laporan;
        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['id_inap'] = $value['id_inap'];
                $isi['nama_pasien'] = $value['nama_pasien'];
                $isi['waktu_masuk'] = $value['waktu_masuk'];
                $isi['waktu_keluar'] = $value['waktu_keluar'];
                $isi['total_tagihan_inap'] = $value['total_tagihan_inap'];
                $isi['status_inap'] = $value['status_inap'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }

    public function data_cetak($tanggal = null, $status = null)
    {
        $session = session();

        if ($tanggal) $tgl = explode(' - ', $tanggal);
        if ($tanggal) { $param['cek_waktu1'] = date("Y-m-d", strtotime($tgl[0])); } else { $param['cek_waktu1'] = date("Y-m-d"); };
        if ($tanggal) { $param['cek_waktu2'] = date("Y-m-d", strtotime($tgl[1])); } else { $param['cek_waktu2'] = date("Y-m-d"); };

        if ($status != 'null') {
            $param['status_inap'] = $status;
        } else {
            $param['status_inap'] = null;
        }

        $model = new Model_laporanrawatinap();
        $laporan = $model->filter($param)->getResultArray();

        $respon = $laporan;
        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['id_inap'] = $value['id_inap'];
                $isi['nama_pasien'] = $value['nama_pasien'];
                $isi['waktu_masuk'] = $value['waktu_masuk'];
                $isi['waktu_keluar'] = $value['waktu_keluar'];
                $isi['total_tagihan_inap'] = $value['total_tagihan_inap'];
                $isi['status_inap'] = $value['status_inap'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }
}

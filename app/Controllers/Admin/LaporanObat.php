<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_laporanpenjualanobat;

class LaporanObat extends BaseController
{

    protected $Model_laporanpenjualanobat;
    public function __construct()
    {
        $this->Model_laporanpenjualanobat = new Model_laporanpenjualanobat();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function data_obat()
    {
        $this->db = db_connect();
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("obat");

        $poli = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_obat, nama_obat');
            $builder->like('nama_obat', $query, 'both');
            $builder->where('stok_obat !=',0);
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_obat, nama_obat');
            $builder->where('stok_obat !=',0);
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $poli[] = array(
                "id" => $country->id_obat,
                "text" => $country->nama_obat,
            );
        }

        $response['data'] = $poli;

        return $this->response->setJSON($response);
    }

    public function index()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Admin') {
            return redirect()->to('Login/loginAdmin');
        }
        $model = new Model_laporanpenjualanobat();

        $data = [
            'judul' => 'Laporan Penjualan Obat'
        ];
        return view('Admin/viewLaporanObat', $data);
    }

    public function data($tanggal = null, $obat = null)
    {
        $session = session();

        if ($tanggal) $tgl = explode(' - ', $tanggal);
        if ($tanggal) { $param['cek_waktu1'] = date("Y-m-d", strtotime($tgl[0])); } else { $param['cek_waktu1'] = date("Y-m-d"); };
        if ($tanggal) { $param['cek_waktu2'] = date("Y-m-d", strtotime($tgl[1])); } else { $param['cek_waktu2'] = date("Y-m-d"); };

        if ($obat != 'null') {
            $param['id_obat'] = $obat;
        } else {
            $param['id_obat'] = null;
        }

        $model = new Model_laporanpenjualanobat();
        $laporan = $model->filter($param)->getResultArray();

        $respon = $laporan;
        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['nama_obat'] = $value['nama_obat'];
                $isi['jumlah_obat'] = $value['jumlah_obat'];
                $isi['total_biaya'] = $value['total_biaya'];
                $isi['stok_obat'] = $value['stok_obat'];
                $isi['tanggal_resep'] = $value['tanggal_resep'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }

    public function data_cetak()
    {
        $session = session();

        $tanggal = $this->request->getPost('tanggal');
        $obat = $this->request->getPost('input_obat');

        if ($tanggal) $tgl = explode(' - ', $tanggal);
        if ($tanggal) { $param['cek_waktu1'] = date("Y-m-d", strtotime($tgl[0])); } else { $param['cek_waktu1'] = date("Y-m-d"); };
        if ($tanggal) { $param['cek_waktu2'] = date("Y-m-d", strtotime($tgl[1])); } else { $param['cek_waktu2'] = date("Y-m-d"); };

        if ($obat != 'null') {
            $param['id_obat'] = $obat;
        } else {
            $param['id_obat'] = null;
        }

        $model = new Model_laporanpenjualanobat();
        $laporan = $model->filter($param)->getResultArray();

        $data = [
            'judul' => 'Laporan Penjualan Obat',
            'laporan' => $laporan
        ];
        return view('Admin/cetakLaporanObat', $data);
    }
}

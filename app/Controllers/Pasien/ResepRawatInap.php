<?php

namespace App\Controllers\Pasien;

use App\Controllers\BaseController;
use App\Models\Model_reseppasien;

class ResepRawatInap extends BaseController
{
    protected $Model_reseppasien;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Pasien') {
            return redirect()->to('Login');
        }

        $this->Model_reseppasien = new Model_reseppasien();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Pasien') {
            return redirect()->to('Login');
        }

        $model = new Model_reseppasien();

        $data = [
            'judul' => 'Tabel Resep Rawat Inap'
        ];
        return view('Pasien/viewResepInap', $data);
    }

    public function data($tanggal = null)
    {
        $session = session();

        if ($tanggal) $tgl = explode(' - ', $tanggal);
        if ($tanggal) { $param['cek_waktu1'] = date("Y-m-d", strtotime($tgl[0])); } else { $param['cek_waktu1'] = date("Y-m-d"); };
        if ($tanggal) { $param['cek_waktu2'] = date("Y-m-d", strtotime($tgl[1])); } else { $param['cek_waktu2'] = date("Y-m-d"); };
        $param['nik'] = $session->get('user_id');

        $model = new Model_reseppasien();
        $laporan = $model->filter_inap($param)->getResultArray();

        if ($laporan == null) {
        	$respon = null;
        } else {
        	$respon = $laporan;
        }

        $href = '<a href="';

        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['nama_pasien'] = $value['nama_pasien'];
                $isi['nama_dokter'] = $value['nama_dokter'];
                $isi['tagihan_obat'] = $value['tagihan_obat'];
                $isi['created_at'] = $value['created_at'];
                if ($value['id_resep_inap'] != null) {
                	$isi['aksi'] = $href . base_url('Pasien/ResepRawatInap/detailResep/' . $value['id_resep_inap']) . 'name="btn-edit" class="btn btn-sm btn-edit btn-info">Detail Resep</a>';
                } else {
                	$isi['aksi'] = null;
                }
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }

    public function data_cetak($tanggal = null)
    {
        $session = session();

        if ($tanggal) $tgl = explode(' - ', $tanggal);
        if ($tanggal) { $param['cek_waktu1'] = date("Y-m-d", strtotime($tgl[0])); } else { $param['cek_waktu1'] = date("Y-m-d"); };
        if ($tanggal) { $param['cek_waktu2'] = date("Y-m-d", strtotime($tgl[1])); } else { $param['cek_waktu2'] = date("Y-m-d"); };
        $param['nik'] = $session->get('user_id');

        $model = new Model_reseppasien();
        $laporan = $model->filter_inap($param)->getResultArray();

        if ($laporan == null) {
        	$respon = null;
        } else {
        	$respon = $laporan;
        }

        $href = '<a href="';

        $data = array();

        if ($respon) {
            foreach ($respon as $value) {
                $isi['nama_pasien'] = $value['nama_pasien'];
                $isi['nama_dokter'] = $value['nama_dokter'];
                $isi['tagihan_obat'] = $value['tagihan_obat'];
                $isi['created_at'] = $value['created_at'];
                array_push($data, $isi);
            }
        }

        echo json_encode($data);
    }

    // detail resep
    public function detailResep($id)
    {
        $session = session();
        $model = new Model_reseppasien();
        $data = $model->view_detail_resep_inap($id)->getResultArray();

        $data = [
            'judul' => 'Tabel Detail Resep',
            'data' => $data,
            'id_resep' => $id
        ];
        return view('Pasien/viewDetailResep', $data);
    }
}
<?php

namespace App\Controllers\Pendaftaran;

use App\Controllers\BaseController;
use App\Models\Model_pasien;
use App\Models\Model_poli;
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

    public function add_pendaftaran_jalan()
    {
        $session = session();
        // if($this->request->getPost('lihat')) {
        //     $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        //     return redirect()->to(base_url('Pendaftaran/Pendaftaran'));
        // }
        if($this->request->getPost('lihat') != 0) {
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
        $tanggal_daftar = $this->request->getPost('input_tanggal_hidden');
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
        $params = [
            'id_poli' => $poli,
            'tanggal_daftar' => $tanggal_daftar,
            'max' => $max - 1,
            'nik' => $this->request->getPost('input_nik')
        ];

        $cek_data_sebelumnya = count($model->cek_data_sebelumnya($params)->getResultArray());
        if($cek_data_sebelumnya != 0) {
            $session->setFlashdata('gagal', 'Anda Sudah Terdaftar Pada Poli Hari ini');
            return redirect()->to(base_url('Pendaftaran/Pendaftaran'));
        }
        
        $data = array(
            'nik'     => $this->request->getPost('input_nik'),
            'id_poli'     => $poli,
            'tanggal_daftar'     => $tanggal_daftar,
            'no_antrian' => $max,
            'status_antrian' => 'Menunggu'
        );

        $model->add_data($data);

        $model_pasien = new Model_pasien();
        $data_pasien = $model_pasien->detail_data($this->request->getPost('input_nik'))->getRowArray();

        $model_poli = new Model_poli();
        $data_poli = $model_poli->detail_data($poli)->getRowArray();
        $data = [
            'data_pasien' => $data_pasien,
            'antrian' => $max,
            'tanggal_daftar' => $this->request->getPost('input_tanggal'),
            'poli' => $data_poli['nama_poli']
        ];

        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml(view('pdf-view', $data));
        $dompdf->setPaper('A6', 'portrait');
        $dompdf->render();
        $dompdf->stream("pendaftaran".".pdf");

        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Pendaftaran/Pendaftaran'));

    }

    public function validationName($nik){
        $model = new Model_pasien();
        // $nik = $this->request->getGet('text');
        $cek_nik = $model->cek_nik_nama($nik)->getResultArray();
        $pasien = $model->cek_nik_nama($nik)->getRowArray();

        $respon = json_decode(json_encode($cek_nik), true);
        $data['hasil'] = $model->cek_nik_nama($nik)->getRowArray();
        if(count($respon) > 0 ) {
            $data = [
                'results' => count($respon),
                'nik' => $pasien['nik'],
                'nama_pasien' => $pasien['nama_pasien'],
                'alamat_pasien' => $pasien['alamat_pasien'],
                'no_telp_pasien' => $pasien['no_telp_pasien'],
                'jenis_kelamin' => $pasien['jenis_kelamin'],
                'tgl_lahir' => $pasien['tgl_lahir'],
                'agama' => $pasien['agama']
            ];
        } else {
            $data = [
                'results' => count($respon)
            ];
        }
        echo json_encode($data, true);
    }
}

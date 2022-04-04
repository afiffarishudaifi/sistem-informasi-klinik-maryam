<?php

namespace App\Controllers\Pasien;

use App\Controllers\BaseController;
use App\Models\Model_rawatinappasien;

class PasienRawatInap extends BaseController
{
    protected $Model_rawatinappasien;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Pasien') {
            return redirect()->to('Login');
        }

        $this->Model_rawatinappasien = new Model_rawatinappasien();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        $model = new Model_rawatinappasien();
        $id = $session->get('user_id');
        $data = $model->cek_pasien($id)->getRowArray();

        $data = [
            'judul' => 'Pendaftaran Rawat inap',
            'data' => $data['id_pasien']
        ];
        return view('Pasien/viewDaftarInap', $data);
    }

    public function add_pendaftaran()
    {
        $session = session(); 
        if($this->request->getPost('input_status') == '') {
            $status = 'Belum Selesai';
        } else {
            $status = 'Selesai';
        } 

        $id_pasien = $session->get('user_id');

        $data = array(
            'id_pasien'     => $id_pasien,
            'id_kamar'     => $this->request->getPost('input_kamar'),
            'waktu_masuk'     => $this->request->getPost('input_masuk'),
            'waktu_keluar'     => null,
            'status_inap'     => $status,
            'total_tagihan_inap'     => 0
        );

        $kamar = $this->request->getPost('input_kamar');
        $ubah_kamar = array(
            'status_kamar' => 'Terisi'
        );

        $model = new Model_rawatinappasien();
        $cek_pasien = $model->cek_pasien($id_pasien)->getRowArray();
        
        $model->add_data($data);
        $model->update_status_kamar($ubah_kamar, $kamar);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Pasien/PasienRawatInap'));
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
            $builder->select('id_kamar, no_kamar');
            $builder->where('status_kamar','Kosong');
            $builder->like('no_kamar', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_kamar, no_kamar');
            $builder->where('status_kamar','Kosong');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $kamar[] = array(
                "id" => $country->id_kamar,
                "text" => $country->no_kamar,
            );
        }

        $response['data'] = $kamar;

        return $this->response->setJSON($response);
    }

}
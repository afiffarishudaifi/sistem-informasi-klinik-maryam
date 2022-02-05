<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_rawatinap;

class RawatInap extends BaseController
{
    protected $Model_rawatinap;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Admin') {
            return redirect()->to('Login/loginAdmin');
        }

        $this->Model_rawatinap = new Model_rawatinap();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        $model = new Model_rawatinap();
        $data = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Rawat Inap',
            'data' => $data
        ];
        return view('Admin/viewDaftarRawatInap', $data);
    }

    public function add_pendaftaran()
    {
        $session = session(); 
        if($this->request->getPost('input_status') == '') {
            $status = 'Belum Selesai';
        } else {
            $status = 'Selesai';
        } 

        $data = array(
            'id_pasien'     => $this->request->getPost('input_pasien'),
            'id_kamar'     => $this->request->getPost('input_kamar'),
            'waktu_masuk'     => $this->request->getPost('input_masuk'),
            'waktu_keluar'     => $this->request->getPost('input_keluar'),
            'status_inap'     => $status,
            'total_tagihan_inap'     => $this->request->getPost('input_tagihan')
        );

        $model = new Model_rawatinap();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/RawatInap'));
    }

    public function update_pendaftaran()
    {
        $session = session();
        $model = new Model_rawatinap();
        date_default_timezone_set('Asia/Jakarta');
        
        if($this->request->getPost('edit_status') == '') {
            $status = 'Belum Selesai';
        } else {
            $status = 'Selesai';
        }
        $id = $this->request->getPost('id_inap');

        $data = array(
            'id_pasien'     => $this->request->getPost('edit_pasien'),
            'id_kamar'     => $this->request->getPost('edit_kamar'),
            'waktu_masuk'     => $this->request->getPost('edit_masuk'),
            'waktu_keluar'     => $this->request->getPost('edit_keluar'),
            'status_inap'     => $status,
            'total_tagihan_inap'     => $this->request->getPost('edit_tagihan')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/RawatInap'));
    }

    public function delete_pendaftaran()
    {
        $session = session();
        $model = new Model_rawatinap();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Admin/RawatInap');
    }

    public function data_edit($id_inap)
    {
        $model = new Model_rawatinap();
        $datainap = $model->detail_data($id_inap)->getResultArray();
        $respon = json_decode(json_encode($datainap), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_inap'] = $value['id_inap'];
            $isi['id_pasien'] = $value['id_pasien'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['id_kamar'] = $value['id_kamar'];
            $isi['no_kamar'] = $value['no_kamar'];
            $isi['waktu_masuk'] = $value['waktu_masuk'];
            $isi['waktu_keluar'] = $value['waktu_keluar'];
            $isi['status_inap'] = $value['status_inap'];
            $isi['total_tagihan_inap'] = $value['total_tagihan_inap'];
        endforeach;
        echo json_encode($isi);
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
            $builder->like('no_kamar', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_kamar, no_kamar');
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
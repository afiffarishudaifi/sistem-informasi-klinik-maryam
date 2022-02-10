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
            'total_tagihan_inap'     => $this->request->getPost('edit_tagihan'),
            'status_inap'     => $status,
            'updated_at' => date('Y-m-d H:i:s')
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

    public function rekamInap()
    {
        $session = session();
        $model = new Model_rawatinap();
        $data = $model->view_data_rekam()->getResultArray();

        $data = [
            'judul' => 'Tabel Rekam Medis Rawat Inap',
            'data' => $data
        ];
        return view('Admin/viewRekamMedisInap', $data);
    }

    public function add_rekam()
    {
        $session = session();
        $model = new Model_rawatinap();
        $waktu_rekam = $this->request->getPost('input_tanggal');

        $data = array(
            'id_pasien'     => $this->request->getPost('input_pasien'),
            'id_dokter'     => $this->request->getPost('input_dokter'),
            'hasil_pemeriksaan'     => $this->request->getPost('input_hasil'),
            'saran_dokter'     => $this->request->getPost('input_saran'),
            'tensi'     => $this->request->getPost('input_tensi'),
            'waktu_rekam'     => $waktu_rekam
        );

        $model->add_data_rekam($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/RawatInap/rekamInap'));
    }

    public function update_rekam()
    {
        $session = session();
        $model = new Model_rawatinap();
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->request->getPost('id_rekam_inap');
        $waktu_rekam = $this->request->getPost('edit_tanggal');
        
        $data = array(
            'id_pasien'     => $this->request->getPost('edit_pasien'),
            'id_dokter'     => $this->request->getPost('edit_dokter'),
            'hasil_pemeriksaan'     => $this->request->getPost('edit_hasil'),
            'saran_dokter'     => $this->request->getPost('edit_saran'),
            'tensi'     => $this->request->getPost('edit_tensi'),
            'waktu_rekam'     => $waktu_rekam,
            'updated_at' => date('Y-m-d H:i:s')
        );

        $model->update_data_rekam($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/RawatInap/rekamInap'));
    }

    public function delete_inap()
    {
        $session = session();
        $model = new Model_rawatinap();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data_rekam($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Admin/RawatInap/rekamInap');
    }

    public function data_edit_rekam($id_pemeriksaan)
    {
        $model = new Model_rawatinap();
        $datarekam = $model->detail_data_rekam($id_pemeriksaan)->getResultArray();
        $respon = json_decode(json_encode($datarekam), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_rekam_inap'] = $value['id_rekam_inap'];
            $isi['id_pasien'] = $value['id_pasien'];
            $isi['id_dokter'] = $value['id_dokter'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['nama_dokter'] = $value['nama_dokter'];
            $isi['nama_poli'] = $value['nama_poli'];
            $isi['hasil_pemeriksaan'] = $value['hasil_pemeriksaan'];
            $isi['tensi'] = $value['tensi'];
            $isi['saran_dokter'] = $value['saran_dokter'];
            $isi['waktu_rekam'] = $value['waktu_rekam'];
        endforeach;
        echo json_encode($isi);
    }

    public function data_pendaftaran()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("pendaftaran_inap");

        $pasien = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('pendaftaran_inap.id_pasien, pasien.nama_pasien');
            $builder->join('pasien','pendaftaran_inap.id_pasien = pasien.id_pasien');
            $builder->where('status_inap','Belum Selesai');
            $builder->orderBy('id_inap', 'DESC');
            $builder->like('pasien.nama_pasien', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('pendaftaran_inap.id_pasien, pasien.nama_pasien');
            $builder->join('pasien','pendaftaran_inap.id_pasien = pasien.id_pasien');
            $builder->where('status_inap','Belum Selesai');
            $builder->orderBy('id_inap', 'DESC');
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
            $builder->select('dokter.id_dokter, dokter.nama_dokter, dokter.id_poli, poliklinik.nama_poli');
            $builder->join('poliklinik','poliklinik.id_poli = dokter.id_poli');
            $builder->like('nama_dokter', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('dokter.id_dokter, dokter.nama_dokter, dokter.id_poli, poliklinik.nama_poli');
            $builder->join('poliklinik','poliklinik.id_poli = dokter.id_poli');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $dokter[] = array(
                "id" => $country->id_dokter,
                "text" => $country->nama_dokter. ', poli ' . $country->nama_poli,
            );
        }

        $response['data'] = $dokter;

        return $this->response->setJSON($response);
    }
}
<?php

namespace App\Controllers\Karyawan;
use App\Models\Model_jadwaldokter;

use App\Controllers\BaseController;

class JadwalDokter extends BaseController
{
    protected $Model_jadwal;
    public function __construct()
    {
        $this->Model_jadwaldokter = new Model_jadwaldokter();
        helper(['form', 'url']);
        $this->db = db_connect();
    }
    public function index()
    {
        $session = session();
        $model = new Model_jadwaldokter();
        $jadwal = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Jadwal Dokter',
            'jadwal' => $jadwal
        ];
        return view('Karyawan/viewTJadwalDokter', $data);
    }

    public function add_jadwal()
    {
        $session = session();
        if($this->request->getPost('input_status') == '') {
            $status = 'Tidak Aktif';
        } else {
            $status = 'Aktif';
        }
        
        $data = array(
            'id_hari'     => $this->request->getPost('input_hari'),
            'id_sesi'     => $this->request->getPost('input_sesi'),
            'id_dokter' => $this->request->getPost('input_dokter'),
            'status_jadwal' => $this->request->getPost('input_status')
        );

        $model = new Model_jadwaldokter();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Karyawan/JadwalDokter'));
    }

    public function update_jadwal()
    {
        $session = session();
        $model = new Model_jadwaldokter();
        date_default_timezone_set('Asia/Jakarta');

        if($this->request->getPost('edit_status') == '') {
            $status = 'Tidak Aktif';
        } else {
            $status = 'Aktif';
        }
        
        $id = $this->request->getPost('id_jadwal');
        $data = array(
            'id_hari'     => $this->request->getPost('edit_hari'),
            'id_sesi'     => $this->request->getPost('edit_sesi'),
            'id_dokter'     => $this->request->getPost('edit_dokter'),
            'status_jadwal'     => $status,
            'updated_at' => date('Y-m-d H:i:s')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Karyawan/JadwalDokter'));
    }

    public function delete_jadwal()
    {
        $session = session();
        $model = new Model_jadwaldokter();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Karyawan/JadwalDokter');
    }

    public function data_edit($id_jadwal)
    {
        $model = new Model_jadwaldokter();
        $datajadwal = $model->detail_data($id_jadwal)->getResultArray();
        $respon = json_decode(json_encode($datajadwal), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_jadwal'] = $value['id_jadwal'];
            $isi['id_hari'] = $value['id_hari'];
            $isi['id_sesi'] = $value['id_sesi'];
            $isi['nama_sesi'] = $value['nama_sesi'];
            $isi['nama_sesi'] = $value['nama_sesi'];
            $isi['nama_sesi'] = $value['nama_sesi'];
            $isi['id_dokter'] = $value['id_dokter'];
            $isi['nama_hari'] = $value['nama_hari'];
            $isi['nama_dokter'] = $value['nama_dokter'];
            $isi['status_jadwal'] = $value['status_jadwal'];
        endforeach;
        echo json_encode($isi);
    }

     public function data_hari()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("hari");

        $hari = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_hari, nama_hari');
            $builder->like('nama_hari', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_hari, nama_hari');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $hari[] = array(
                "id" => $country->id_hari,
                "text" => $country->nama_hari,
            );
        }

        $response['data'] = $hari;

        return $this->response->setJSON($response);
    }

     public function data_sesi()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("sesi");

        $sesi = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_sesi, nama_sesi');
            $builder->like('nama_sesi', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_sesi, nama_sesi');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $sesi[] = array(
                "id" => $country->id_sesi,
                "text" => $country->nama_sesi,
            );
        }

        $response['data'] = $sesi;

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
            $builder->select('id_dokter, nama_dokter');
            $builder->like('nama_dokter', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_dokter, nama_dokter');
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
}

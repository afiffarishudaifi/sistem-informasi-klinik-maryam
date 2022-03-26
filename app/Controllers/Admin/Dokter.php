<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_dokter;

class Dokter extends BaseController
{

    protected $Model_dokter;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Admin') {
            return redirect()->to('Login/loginAdmin');
        }
        $this->Model_dokter = new Model_dokter();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        $model = new Model_dokter();
        $dokter = $model->view_data()->getResultArray();
        $poli = $model->view_poli()->getResultArray();

        $data = [
            'judul' => 'Tabel Dokter',
            'dokter' => $dokter,
            'poli' => $poli
        ];

        return view('Admin/viewTDokter', $data);
    }

    public function add_dokter()
    {
        $session = session();

        if($this->request->getPost('input_status') == '') {
            $status = 'Tidak Aktif';
        } else {
            $status = 'Aktif';
        }

        $avatar      = $this->request->getFile('input_foto');
        if ($avatar != '') {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_dokter/', $namabaru);
        } else {
            $namabaru = 'noimage.jpg';
        }

        $data = array(
            // 'id_poli'     => $this->request->getPost('input_poli'),
            'nik_dokter'     => $this->request->getPost('input_nik'),
            'nama_dokter'     => $this->request->getPost('input_nama'),
            'alamat_dokter' => $this->request->getPost('input_alamat'),
            'jenis_kelamin' => $this->request->getPost('input_kelamin'),
            'tanggal_lahir' => $this->request->getPost('input_tanggal'),
            'no_telp_dokter' => $this->request->getPost('input_no_telp'),
            'status_dokter' => $status,
            'foto_dokter'     => "docs/img/img_dokter/" . $namabaru
        );
        
        $model = new Model_dokter();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Dokter'));
    }

    public function update_dokter()
    {
        $session = session();
        $model = new Model_dokter();
        date_default_timezone_set('Asia/Jakarta');

        $avatar      = $this->request->getFile('edit_foto');
        if ($avatar != '') {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_dokter/', $namabaru);
            
        if($this->request->getPost('edit_status') == '') {
            $status = 'Tidak Aktif';
        } else {
            $status = 'Aktif';
        }
        
        $id = $this->request->getPost('edit_nik');

            $data = array(
                // 'id_poli'     => $this->request->getPost('edit_poli'),
                'nik_dokter'     => $this->request->getPost('edit_nik'),
                'nama_dokter'  => $this->request->getPost('edit_nama'),
                'alamat_dokter'   => $this->request->getPost('edit_alamat'),
                'no_telp_dokter'  => $this->request->getPost('edit_no_telp'),
                'jenis_kelamin' => $this->request->getPost('edit_kelamin'),
                'tanggal_lahir' => $this->request->getPost('edit_tanggal'),
                'status_dokter'   => $status,
                'foto_dokter'     => "docs/img/img_dokter/" . $namabaru
            );

            $data_foto = $model->detail_data($id)->getRowArray();

            if ($data_foto != null) {
                if ($data_foto['foto_dokter'] != 'docs/img/img_dokter/noimage.jpg') {
                    if (file_exists($data_foto['foto_dokter'])) {
                        unlink($data_foto['foto_dokter']);
                    }
                }
            }
        } else {
            if($this->request->getPost('edit_status') == '') {
                $status = 'Tidak Aktif';
            } else {
                $status = 'Aktif';
            }

            $id = $this->request->getPost('edit_nik');

            $data = array(
                // 'id_poli'     => $this->request->getPost('edit_poli'),
                'nik_dokter'     => $this->request->getPost('edit_nik'),
                'nama_dokter'  => $this->request->getPost('edit_nama'),
                'alamat_dokter'   => $this->request->getPost('edit_alamat'),
                'no_telp_dokter'  => $this->request->getPost('edit_no_telp'),
                'jenis_kelamin' => $this->request->getPost('edit_kelamin'),
                'tanggal_lahir' => $this->request->getPost('edit_tanggal'),
                'status_dokter'   => $status
            );
        }

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Dokter'));
    }

    public function delete_dokter()
    {
        $session = session();
        $model = new Model_dokter();
        $id = $this->request->getPost('id');
        $data_foto = $model->detail_data($id)->getRowArray();

        if ($data_foto != null) {
            if ($data_foto['foto_dokter'] != 'docs/img/img_dokter/noimage.jpg') {
                if (file_exists($data_foto['foto_dokter'])) {
                    unlink($data_foto['foto_dokter']);
                }
            }
        }
        $model->delete_data($id);
        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/Admin/Dokter');
    }

    public function data_edit($nik_dokter)
    {
        $model = new Model_dokter();
        $datadokter = $model->detail_data($nik_dokter)->getResultArray();
        $respon = json_decode(json_encode($datadokter), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['nik_dokter'] = $value['nik_dokter'];
            $isi['nama_dokter'] = $value['nama_dokter'];
            // $isi['nama_poli'] = $value['nama_poli'];
            // $isi['id_poli'] = $value['id_poli'];
            $isi['alamat_dokter'] = $value['alamat_dokter'];
            $isi['no_telp_dokter'] = $value['no_telp_dokter'];
            $isi['status_dokter'] = $value['status_dokter'];
            $isi['jenis_kelamin'] = $value['jenis_kelamin'];
            $isi['tanggal_lahir'] = $value['tanggal_lahir'];
            $isi['foto_dokter'] = $value['foto_dokter'];
        endforeach;
        echo json_encode($isi);
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
}

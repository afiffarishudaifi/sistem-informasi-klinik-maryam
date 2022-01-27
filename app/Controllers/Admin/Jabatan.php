<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_jabatan;

class Jabatan extends BaseController
{

    protected $Model_jabatan;
    public function __construct()
    {
        $this->Model_jabatan = new Model_jabatan();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        $model = new Model_jabatan();
        $jabatan = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Jabatan',
            'jabatan' => $jabatan
        ];
        return view('Admin/viewTJabatan', $data);
    }

    public function add_jabatan()
    {
        $session = session();
        $data = array(
            'nama_jabatan'     => $this->request->getPost('input_nama')
        );
        $model = new Model_jabatan();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Jabatan'));
    }

    public function update_jabatan()
    {
        $session = session();
        $model = new Model_jabatan();
        date_default_timezone_set('Asia/Jakarta');
        
        $id = $this->request->getPost('id_jabatan');
        $data = array(
            'nama_jabatan'     => $this->request->getPost('edit_nama'),
            'id_jabatan'     => $this->request->getPost('id_jabatan'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Jabatan'));
    }

    public function delete_jabatan()
    {
        $session = session();
        $model = new Model_jabatan();
        $id = $this->request->getPost('id');
        $session = session();
        $foreign = $model->cek_foreign($id);
        if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        } else {
            session()->setFlashdata('sukses', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        }
        return redirect()->to('/Admin/Jabatan');
    }

    public function cek_nama($nama)
    {
        $model = new Model_jabatan();
        $cek_nama = $model->cek_nama($nama)->getResultArray();
        $respon = json_decode(json_encode($cek_nama), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_jabatan)
    {
        $model = new Model_jabatan();
        $datajabatan = $model->detail_data($id_jabatan)->getResultArray();
        $respon = json_decode(json_encode($datajabatan), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_jabatan'] = $value['id_jabatan'];
            $isi['nama_jabatan'] = $value['nama_jabatan'];
        endforeach;
        echo json_encode($isi);
    }
}
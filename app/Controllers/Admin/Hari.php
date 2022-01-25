<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_hari;

class Hari extends BaseController
{

    protected $Model_hari;
    public function __construct()
    {
        $this->Model_hari = new Model_hari();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        $model = new Model_hari();
        $hari = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Hari',
            'hari' => $hari
        ];
        return view('Admin/viewTHari', $data);
    }

    public function add_hari()
    {
        $session = session();
        $data = array(
            'nama_hari'     => $this->request->getPost('input_nama')
        );
        $model = new Model_hari();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Hari'));
    }

    public function update_hari()
    {
        $session = session();
        $model = new Model_hari();
        
        $id = $this->request->getPost('id_hari');
        $data = array(
            'nama_hari'     => $this->request->getPost('edit_nama'),
            'id_hari'     => $this->request->getPost('id_hari')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Hari'));
    }

    public function delete_hari()
    {
        $session = session();
        $model = new Model_hari();
        $id = $this->request->getPost('id');
        $session = session();
        $foreign = $model->cek_foreign($id);
        if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        } else {
            session()->setFlashdata('sukses', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        }
        return redirect()->to('/Admin/Hari');
    }

    public function cek_nama($nama)
    {
        $model = new Model_hari();
        $cek_nama = $model->cek_nama($nama)->getResultArray();
        $respon = json_decode(json_encode($cek_nama), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_hari)
    {
        $model = new Model_hari();
        $datahari = $model->detail_data($id_hari)->getResultArray();
        $respon = json_decode(json_encode($datahari), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_hari'] = $value['id_hari'];
            $isi['nama_hari'] = $value['nama_hari'];
        endforeach;
        echo json_encode($isi);
    }
}
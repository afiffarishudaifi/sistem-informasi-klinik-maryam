<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_sesi;

class Sesi extends BaseController
{
    protected $Model_sesi;
    public function __construct()
    {
        $this->Model_sesi = new Model_sesi();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        $model = new Model_sesi();
        $sesi = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Sesi',
            'sesi' => $sesi
        ];
        return view('Admin/viewTSesi', $data);
    }

    public function add_sesi()
    {
        $session = session();

        $data = array(
            'nama_sesi'     => $this->request->getPost('input_nama'),
            'waktu_mulai'     => $this->request->getPost('input_mulai'),
            'waktu_selesai'     => $this->request->getPost('input_selesai')
        );
        $model = new Model_sesi();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Sesi'));
    }

    public function update_sesi()
    {
        $session = session();
        $model = new Model_sesi();
        date_default_timezone_set('Asia/Jakarta');
        
        $id = $this->request->getPost('id_sesi');
        $data = array(
            'nama_sesi'     => $this->request->getPost('edit_nama'),
            'waktu_mulai'     => $this->request->getPost('edit_mulai'),
            'waktu_selesai'     => $this->request->getPost('edit_selesai'),
            'id_sesi'     => $this->request->getPost('id_sesi'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Sesi'));
    }

    public function delete_sesi()
    {
        $session = session();
        $model = new Model_sesi();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('sukses', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Admin/Sesi');
    }

    public function cek_nama($nama)
    {
        $model = new Model_sesi();
        $cek_nama = $model->cek_nama($nama)->getResultArray();
        $respon = json_decode(json_encode($cek_nama), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_sesi)
    {
        $model = new Model_sesi();
        $datahari = $model->detail_data($id_sesi)->getResultArray();
        $respon = json_decode(json_encode($datahari), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_sesi'] = $value['id_sesi'];
            $isi['nama_sesi'] = $value['nama_sesi'];
            $isi['waktu_mulai'] = $value['waktu_mulai'];
            $isi['waktu_selesai'] = $value['waktu_selesai'];
        endforeach;
        echo json_encode($isi);
    }
}
<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_penyakit;

class Penyakit extends BaseController
{
    protected $Model_penyakit;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Admin') {
            return redirect()->to('Login/loginAdmin');
        }

        $this->Model_penyakit = new Model_penyakit();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        $model = new Model_penyakit();
        $penyakit = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Diagnosis',
            'penyakit' => $penyakit
        ];
        return view('Admin/viewTPenyakit', $data);
    }

    public function add_penyakit()
    {
        $session = session();

        $data = array(
            'nama_penyakit'     => $this->request->getPost('input_nama'),
            'deskripsi'     => $this->request->getPost('input_deskripsi')
        );
        $model = new Model_penyakit();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Penyakit'));
    }

    public function update_penyakit()
    {
        $session = session();
        $model = new Model_penyakit();
        date_default_timezone_set('Asia/Jakarta');
        
        $id = $this->request->getPost('id_penyakit');
        $data = array(
            'nama_penyakit'     => $this->request->getPost('edit_nama'),
            'deskripsi'     => $this->request->getPost('edit_deskripsi')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Penyakit'));
    }

    public function delete_penyakit()
    {
        $session = session();
        $model = new Model_penyakit();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Admin/Penyakit');
    }

    public function cek_nama($nama)
    {
        $model = new Model_penyakit();
        $cek_nama = $model->cek_nama($nama)->getResultArray();
        $respon = json_decode(json_encode($cek_nama), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_penyakit)
    {
        $model = new Model_penyakit();
        $penyakit = $model->detail_data($id_penyakit)->getResultArray();
        $respon = json_decode(json_encode($penyakit), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_penyakit'] = $value['id_penyakit'];
            $isi['nama_penyakit'] = $value['nama_penyakit'];
            $isi['deskripsi'] = $value['deskripsi'];
        endforeach;
        echo json_encode($isi);
    }

}

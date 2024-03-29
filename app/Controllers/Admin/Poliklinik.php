<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_poli;

class Poliklinik extends BaseController
{
    protected $Model_poli;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Admin') {
            return redirect()->to('Login/loginAdmin');
        }

        $this->Model_poli = new Model_poli();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        $model = new Model_poli();
        $poli = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Poliklinik',
            'poli' => $poli
        ];
        return view('Admin/viewTPoliklinik', $data);
    }

    public function add_poliklinik()
    {
        $session = session();

        $data = array(
            'nama_poli'     => $this->request->getPost('input_nama')
        );
        $model = new Model_poli();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Poliklinik'));
    }

    public function update_poliklinik()
    {
        $session = session();
        $model = new Model_poli();
        date_default_timezone_set('Asia/Jakarta');
        
        $id = $this->request->getPost('id_poli');
        $data = array(
            'nama_poli'     => $this->request->getPost('edit_nama')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Poliklinik'));
    }

    public function delete_poliklinik()
    {
        $session = session();
        $model = new Model_poli();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Admin/Poliklinik');
    }

    public function cek_nama($nama)
    {
        $model = new Model_poli();
        $cek_nama = $model->cek_nama($nama)->getResultArray();
        $respon = json_decode(json_encode($cek_nama), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_poli)
    {
        $model = new Model_poli();
        $datahari = $model->detail_data($id_poli)->getResultArray();
        $respon = json_decode(json_encode($datahari), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_poli'] = $value['id_poli'];
            $isi['nama_poli'] = $value['nama_poli'];
        endforeach;
        echo json_encode($isi);
    }

}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_kamar;

class Kamar extends BaseController
{
    protected $Model_kamar;
    public function __construct()
    {
        $this->Model_kamar = new Model_kamar();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        $model = new Model_kamar();
        $kamar = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Kamar',
            'kamar' => $kamar
        ];
        return view('Admin/viewTKamar', $data);
    }

    public function add_kamar()
    {
        $session = session();
        $data = array(
            'no_kamar'     => $this->request->getPost('input_nomor'),
            'biaya_kamar'     => $this->request->getPost('input_biaya'),
            'status_kamar' => $this->request->getPost('input_status')
        );
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'input_nomor' => 'required|numeric',
            'biaya_kamar' => 'required|numeric',
            'status_kamar' => 'required',
        ]);
        $model = new Model_kamar();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Kamar'));
    }

    public function update_kamar()
    {
        $session = session();
        $model = new Model_kamar();
        date_default_timezone_set('Asia/Jakarta');
        
        $id = $this->request->getPost('id_kamar');
        $data = array(
            'id_kamar'     => $this->request->getPost('id_kamar'),
            'no_kamar'     => $this->request->getPost('edit_nomor'),
            'biaya_kamar'  => $this->request->getPost('edit_biaya'),
            'status_kamar'     => $this->request->getPost('edit_status'),
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Kamar'));
    }

    public function delete_kamar()
    {
        $session = session();
        $model = new Model_kamar();
        $id = $this->request->getPost('id');
        $session = session();
        $foreign = $model->cek_foreign($id);
        if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        } else {
            session()->setFlashdata('sukses', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        }
        return redirect()->to('/Admin/Kamar');
    }

    public function cek_nomor($nomor)
    {
        $model = new Model_kamar();
        $cek_nomor = $model->cek_nomor($nomor)->getResultArray();
        $respon = json_decode(json_encode($cek_nomor), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_kamar)
    {
        $model = new Model_kamar();
        $datakamar = $model->detail_data($id_kamar)->getResultArray();
        $respon = json_decode(json_encode($datakamar), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_kamar'] = $value['id_kamar'];
            $isi['no_kamar'] = $value['no_kamar'];
            $isi['biaya_kamar'] = $value['biaya_kamar'];
            $isi['status_kamar'] = $value['status_kamar'];
        endforeach;
        echo json_encode($isi);
    }
}
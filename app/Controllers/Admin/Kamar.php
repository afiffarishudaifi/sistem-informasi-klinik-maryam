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
            'biaya_kamar' => 'required',
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
            'no_kamar'     => $this->request->getPost('edit_nomor'),
            'id_kamar'     => $this->request->getPost('id_kamar'),
            'updated_at' => date('Y-m-d H:i:s')
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
}
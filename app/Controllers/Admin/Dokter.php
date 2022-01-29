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

        $data = array(
            'id_poli'     => $this->request->getPost('input_poli'),
            'nama_dokter'     => $this->request->getPost('input_nama'),
            'alamat_dokter' => $this->request->getPost('input_alamat'),
            'no_telp_dokter' => $this->request->getPost('input_no_telp'),
            'status_dokter' => $status, 
            'foto_dokter' => $this->request->getPost('input_foto'), 
        );
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'input_telp' => 'required|numeric',
        ]);
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

        if($this->request->getPost('edit_status') == '') {
            $status = 'Tidak Aktif';
        } else {
            $status = 'Aktif';
        }
        
        $id = $this->request->getPost('id_dokter');
        $data = array(
            'id_poli'     => $this->request->getPost('id_poli'),
            'nama_dokter'  => $this->request->getPost('edit_nama'),
            'alamat_dokter'   => $this->request->getPost('edit_alamat'),
            'no_telp_dokter'  => $this->request->getPost('edit_no_telp'),
            'status_dokter'   => $status,
            'foto_dokter'     => $this->request->getPost('edit_foto'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Kamar'));
    }

    public function delete_dokter()
    {
        $session = session();
        $model = new Model_dokter();
        $id = $this->request->getPost('id');
        $session = session();
        $foreign = $model->cek_foreign($id);
        if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        } else {
            session()->setFlashdata('sukses', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        }
        return redirect()->to('/Admin/Dokter');
    }
}
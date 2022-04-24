<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_admin;
use App\Models\Model_user;

class Admin extends BaseController
{
    protected $Model_admin;
    public function __construct()
    {
    	$session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Admin') {
            return redirect()->to('Login/loginAdmin');
        }

        $this->Model_admin = new Model_admin();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        $model = new Model_admin();
        $admin = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Admin',
            'admin' => $admin
        ];
        return view('Admin/viewTAdmin', $data);
    }

    public function add_admin()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();

        $data = array(
            'username'     => $this->request->getPost('input_username'),
            'password'     => base64_encode($encrypter->encrypt($this->request->getPost('input_password'))),
            'level'     => 'Admin'
        );

        $modeluser = new Model_user();
        $modeluser->add_data($data);
        $max_id = $modeluser->max_id()->getRowArray(); 

        $data = array(
            'id_user' => $max_id['id_user'],
            'nama_admin'     => $this->request->getPost('input_nama'),
            'alamat_admin'     => $this->request->getPost('input_alamat'),
            'no_telp_admin'     => $this->request->getPost('input_no_telp')
        );

        $model = new Model_admin();
        $model->add_data($data);

        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Admin'));
    }

    public function update_admin()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();
        $model = new Model_admin();
        date_default_timezone_set('Asia/Jakarta');
        
        $id = $this->request->getPost('id_admin');
        $id_user = $this->request->getPost('id_user');
        $password = $this->request->getPost('edit_password');

        $data = array(
            'nama_admin'     => $this->request->getPost('edit_nama'),
            'alamat_admin'     => $this->request->getPost('edit_alamat'),
            'no_telp_admin'     => $this->request->getPost('edit_no_telp'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $model->update_data($data, $id);

        $modeluser = new Model_user();
        if ($password != '') {
            $data = array(
                'username'     => $this->request->getPost('edit_username'),
                'password'     => base64_encode($encrypter->encrypt($this->request->getPost('edit_password')))
            );
        } else {
            $data = array(
                'username'     => $this->request->getPost('edit_username')
            );
        }
        
        $modeluser->update_data($data, $id_user);

        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Admin'));
    }

    public function delete_admin()
    {
        $session = session();
        $model = new Model_admin();
        $id = $this->request->getPost('id');
        $model->delete_data($id);
        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/Admin/Admin');
    }

    public function cek_username($username)
    {
        $model = new Model_user();
        $cek_username = $model->cek_username($username)->getResultArray();
        $respon = json_decode(json_encode($cek_username), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_admin)
    {
        $model = new Model_admin();
        $encrypter = \Config\Services::encrypter();

        $data_pengguna = $model->detail_data($id_admin)->getResultArray();
        $respon = json_decode(json_encode($data_pengguna), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_user'] = $value['id_user'];
            $isi['id_admin'] = $value['id_admin'];
            $isi['username'] = $value['username'];
            $isi['nama_admin'] = $value['nama_admin'];
            $isi['no_telp_admin'] = $value['no_telp_admin'];
            $isi['alamat_admin'] = $value['alamat_admin'];
        endforeach;
        echo json_encode($isi);
    }

}

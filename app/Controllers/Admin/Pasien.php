<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_pasien;

class Pasien extends BaseController
{
    protected $Model_pasien;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Admin') {
            return redirect()->to('Login/loginAdmin');
        }

        $this->Model_pasien = new Model_pasien();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        $model = new Model_pasien();
        $pasien = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Pasien',
            'pasien' => $pasien
        ];
        return view('Admin/viewTPasien', $data);
    }

    public function add_pasien()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();

        $data = array(
            'nik'     => $this->request->getPost('input_nik'),
            'username_pasien'     => $this->request->getPost('input_username'),
            'password_pasien'     => base64_encode($encrypter->encrypt($this->request->getPost('input_password'))),
            'nama_pasien'     => $this->request->getPost('input_nama'),
            'alamat_pasien'     => $this->request->getPost('input_alamat'),
            'no_telp_pasien'     => $this->request->getPost('input_no_telp')
        );

        $model = new Model_pasien();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Pasien'));
    }

    public function update_pasien()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();
        $model = new Model_pasien();
        date_default_timezone_set('Asia/Jakarta');
        
        $id = $this->request->getPost('id_pasien');
        if($this->request->getPost('edit_password') != '') {
            $data = array(
                'nik'     => $this->request->getPost('edit_nik'),
                'username_pasien'     => $this->request->getPost('edit_username'),
                'password_pasien'     => base64_encode($encrypter->encrypt($this->request->getPost('edit_password'))),
                'nama_pasien'     => $this->request->getPost('edit_nama'),
                'alamat_pasien'     => $this->request->getPost('edit_alamat'),
                'no_telp_pasien'     => $this->request->getPost('edit_no_telp'),
                'id_pasien'     => $this->request->getPost('id_pasien'),
                'updated_at' => date('Y-m-d H:i:s')
            );
        } else {
            $data = array(
                'nik'     => $this->request->getPost('edit_nik'),
                'username_pasien'     => $this->request->getPost('edit_username'),
                'nama_pasien'     => $this->request->getPost('edit_nama'),
                'alamat_pasien'     => $this->request->getPost('edit_alamat'),
                'no_telp_pasien'     => $this->request->getPost('edit_no_telp'),
                'id_pasien'     => $this->request->getPost('id_pasien'),
                'updated_at' => date('Y-m-d H:i:s')
            );
        }

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Pasien'));
    }

    public function delete_pasien()
    {
        $session = session();
        $model = new Model_pasien();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Admin/Pasien');
    }

    public function cek_username($username)
    {
        $model = new Model_pasien();
        $cek_username = $model->cek_username($username)->getResultArray();
        $respon = json_decode(json_encode($cek_username), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function cek_nik($nik)
    {
        $model = new Model_pasien();
        $cek_nik = $model->cek_nik($nik)->getResultArray();
        $respon = json_decode(json_encode($cek_nik), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_pasien)
    {
        $model = new Model_pasien();
        $encrypter = \Config\Services::encrypter();

        $data_pengguna = $model->detail_data($id_pasien)->getResultArray();
        $respon = json_decode(json_encode($data_pengguna), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_pasien'] = $value['id_pasien'];
            $isi['nik'] = $value['nik'];
            $isi['username_pasien'] = $value['username_pasien'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['no_telp_pasien'] = $value['no_telp_pasien'];
            $isi['alamat_pasien'] = $value['alamat_pasien'];
        endforeach;
        echo json_encode($isi);
    }

}
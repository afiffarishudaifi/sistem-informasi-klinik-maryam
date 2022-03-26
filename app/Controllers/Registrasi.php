<?php

namespace App\Controllers;
use App\Models\Model_login;
use App\Models\Model_pasien;
use App\Models\Model_user;

class Registrasi extends BaseController
{

    public function index()
    {
        $session = session();
        $model = new Model_login();
        return view('viewRegistrasi');
    }

    public function simpanPasien()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();
        $models = new Model_login();
        $max = $models->cek_max()->getRowArray()['id_user'];
        $max = $max + 1;

        $data = array(
            'id_user'=>$max,
            'email'     => $this->request->getPost('input_email'),
            'password'     => base64_encode($encrypter->encrypt($this->request->getPost('input_password'))),
            'level'     => 'Pasien'
        );

        $modeluser = new Model_user();
        $modeluser->add_data($data);
        $max_id = $modeluser->max_id()->getRowArray(); 

        $data = array(
            'id_user' => $max_id['id_user'],
            'nik'     => $this->request->getPost('input_nik'),
            'nama_pasien'     => $this->request->getPost('input_nama'),
            'alamat_pasien'     => $this->request->getPost('input_alamat'),
            'no_telp_pasien'     => $this->request->getPost('input_no_telp'),
            'nik'     => $this->request->getPost('input_nik'),
            'jenis_kelamin'     => $this->request->getPost('input_kelamin'),
            'tgl_lahir'     => $this->request->getPost('input_tanggal'),
            'agama'     => $this->request->getPost('input_agama')
        );
        
        $model = new Model_pasien();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Registrasi'));
    }
}

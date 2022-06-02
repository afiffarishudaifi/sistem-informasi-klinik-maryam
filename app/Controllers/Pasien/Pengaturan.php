<?php

namespace App\Controllers\Pasien;

use App\Controllers\BaseController;
use App\Models\Model_pasien;
use App\Models\Model_user;

class Pengaturan extends BaseController
{
    protected $Model_pasien;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Pasien') {
            return redirect()->to('Login');
        }

        $this->Model_pasien = new Model_pasien();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Pasien') {
            return redirect()->to('Login');
        }
        
        $model = new Model_pasien();

        $data = [
            'judul' => 'Pengaturan Akun'
        ];
        return view('Pasien/viewPengaturan', $data);
    }

    public function update_pasien()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();
        $model = new Model_pasien();
        date_default_timezone_set('Asia/Jakarta');
        
        $id = $this->request->getPost('nik');
        $id_user = $this->request->getPost('id_user');
        $password = $this->request->getPost('edit_password');

        if($this->request->getPost('edit_password') != '') {
            $data = array(
                'nik'     => $this->request->getPost('edit_nik'),
                'nama_pasien'     => $this->request->getPost('edit_nama'),
                'alamat_pasien'     => $this->request->getPost('edit_alamat'),
                'no_telp_pasien'     => $this->request->getPost('edit_no_telp'),
                'jenis_kelamin'     => $this->request->getPost('edit_kelamin'),
                'tgl_lahir'     => $this->request->getPost('edit_tanggal'),
                'agama'     => $this->request->getPost('edit_agama')
            );
        } else {
            $data = array(
                'nik'     => $this->request->getPost('edit_nik'),
                'nama_pasien'     => $this->request->getPost('edit_nama'),
                'alamat_pasien'     => $this->request->getPost('edit_alamat'),
                'no_telp_pasien'     => $this->request->getPost('edit_no_telp'),
                'jenis_kelamin'     => $this->request->getPost('edit_kelamin'),
                'tgl_lahir'     => $this->request->getPost('edit_tanggal'),
                'agama'     => $this->request->getPost('edit_agama')
            );
        }

        $model->update_data($data, $id);

        $modeluser = new Model_user();
        if ($password != '') {
            $data = array(
                'email'     => $this->request->getPost('edit_email'),
                'password'     => base64_encode($encrypter->encrypt($this->request->getPost('edit_password')))
            );
        } else {
            $data = array(
                'email'     => $this->request->getPost('edit_email')
            );
        }
        
        $modeluser->update_data($data, $id_user);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Login/logout'));
    }

    public function data_edit($nik)
    {
        $model = new Model_pasien();
        $encrypter = \Config\Services::encrypter();

        $data_pengguna = $model->detail_data($nik)->getResultArray();
        $respon = json_decode(json_encode($data_pengguna), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['nik'] = $value['nik'];
            $isi['id_user'] = $value['id_user'];
            $isi['nik'] = $value['nik'];
            $isi['email'] = $value['email'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['no_telp_pasien'] = $value['no_telp_pasien'];
            $isi['alamat_pasien'] = $value['alamat_pasien'];
            $isi['tgl_lahir'] = $value['tgl_lahir'];
            $isi['agama'] = $value['agama'];
            $isi['jenis_kelamin'] = $value['jenis_kelamin'];
        endforeach;
        echo json_encode($isi);
    }
}

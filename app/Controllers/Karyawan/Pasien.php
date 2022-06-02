<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\Model_pasien;
use App\Models\Model_user;

class Pasien extends BaseController
{
    protected $Model_pasien;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }

        $this->Model_pasien = new Model_pasien();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        
        $model = new Model_pasien();
        $pasien = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Pasien',
            'pasien' => $pasien
        ];
        return view('Karyawan/viewTPasien', $data);
    }

    public function add_pasien()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();

        $data = array(
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
            'jenis_kelamin'     => $this->request->getPost('input_kelamin'),
            'tgl_lahir'     => $this->request->getPost('input_tanggal'),
            'agama'     => $this->request->getPost('input_agama')
        );

        $model = new Model_pasien();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Karyawan/Pasien'));
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
        return redirect()->to(base_url('Karyawan/Pasien'));
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
        return redirect()->to('/Karyawan/Pasien');
    }

    public function cek_email($email)
    {
        $model = new Model_pasien();
        $cek_email = $model->cek_email($email)->getResultArray();
        $respon = json_decode(json_encode($cek_email), true);
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

<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\Model_karyawan;

class Pengaturan extends BaseController
{
    protected $Model_karyawan;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login');
        }

        $this->Model_karyawan = new Model_karyawan();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        $model = new Model_karyawan();

        $data = [
            'judul' => 'Pengaturan Akun'
        ];
        return view('Karyawan/viewPengaturan', $data);
    }

    public function update_karyawan()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();
        $model = new Model_karyawan();
        date_default_timezone_set('Asia/Jakarta');

        $id = $this->request->getPost('id_karyawan');
        $avatar      = $this->request->getFile('edit_foto');
        if ($avatar != '') {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_karyawan/', $namabaru);

            if($this->request->getPost('edit_password') != '') {
                $data = array(
                    'password_karyawan'   => base64_encode($encrypter->encrypt($this->request->getPost('edit_password'))),
                    'nama_karyawan'  => $this->request->getPost('edit_nama'),
                    'no_telp_karyawan'   => $this->request->getPost('edit_no_telp'),
                    'alamat_karyawan'   => $this->request->getPost('edit_alamat'),
                    'foto_karyawan'     => "docs/img/img_karyawan/" . $namabaru,
                    'updated_at' => date('Y-m-d H:i:s')
                );
            } else {
                $data = array(
                    'nama_karyawan'  => $this->request->getPost('edit_nama'),
                    'no_telp_karyawan'   => $this->request->getPost('edit_no_telp'),
                    'alamat_karyawan'   => $this->request->getPost('edit_alamat'),
                    'foto_karyawan'     => "docs/img/img_karyawan/" . $namabaru,
                    'updated_at' => date('Y-m-d H:i:s')
                );
            }

            $data_foto = $model->detail_data($id)->getRowArray();

            if ($data_foto != null) {
                if ($data_foto['foto_karyawan'] != 'docs/img/img_karyawan/noimage.jpg') {
                    if (file_exists($data_foto['foto_karyawan'])) {
                        unlink($data_foto['foto_karyawan']);
                    }
                }
            }
        } else {

            if($this->request->getPost('edit_password') != '') {
                $data = array(
                    'password_karyawan'   => base64_encode($encrypter->encrypt($this->request->getPost('edit_password'))),
                    'nama_karyawan'  => $this->request->getPost('edit_nama'),
                    'no_telp_karyawan'   => $this->request->getPost('edit_no_telp'),
                    'alamat_karyawan'   => $this->request->getPost('edit_alamat'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
            } else {
                $data = array(
                    'nama_karyawan'  => $this->request->getPost('edit_nama'),
                    'no_telp_karyawan'   => $this->request->getPost('edit_no_telp'),
                    'alamat_karyawan'   => $this->request->getPost('edit_alamat'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
            }
        }

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Login/logout'));
    }

    public function data_edit($id_karyawan)
    {
        $model = new Model_karyawan();
        $datakaryawan = $model->detail_data($id_karyawan)->getResultArray();
        $respon = json_decode(json_encode($datakaryawan), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_karyawan'] = $value['id_karyawan'];            
            $isi['nama_karyawan'] = $value['nama_karyawan'];
            $isi['no_telp_karyawan'] = $value['no_telp_karyawan'];
            $isi['alamat_karyawan'] = $value['alamat_karyawan'];
            $isi['foto_karyawan'] = $value['foto_karyawan'];
        endforeach;
        echo json_encode($isi);
    }
}

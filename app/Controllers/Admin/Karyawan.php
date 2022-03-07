<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_karyawan;

class Karyawan extends BaseController
{
    protected $Model_karyawan;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Admin') {
            return redirect()->to('Login/loginAdmin');
        }

        $this->Model_karyawan = new Model_karyawan();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        $model = new Model_karyawan();
        $karyawan = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Karyawan',
            'karyawan' => $karyawan
        ];
        return view('Admin/viewTKaryawan', $data);
    }

    public function add_karyawan()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();

        if($this->request->getPost('input_status') == '') {
            $status = 'Tidak Aktif';
        } else {
            $status = 'Aktif';
        }

        $avatar      = $this->request->getFile('input_foto');
        if ($avatar != '') {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_karyawan/', $namabaru);
        } else {
            $namabaru = 'noimage.jpg';
        }

        $data = array(
            'username'     => $this->request->getPost('input_username'),
            'password'     => base64_encode($encrypter->encrypt($this->request->getPost('input_password'))),
            'nama_karyawan'     => $this->request->getPost('input_nama'),
            'no_telp_karyawan'     => $this->request->getPost('input_no_telp'),
            'alamat_karyawan'     => $this->request->getPost('input_alamat'),
            'status_karyawan'     => $status,
            'foto_karyawan'     => "docs/img/img_karyawan/" . $namabaru
            
        );

        $model = new Model_karyawan();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Karyawan'));
    }

    public function update_karyawan()
    {
        $session = session();
        $encrypter = \Config\Services::encrypter();
        $model = new Model_karyawan();
        date_default_timezone_set('Asia/Jakarta');
        if($this->request->getPost('edit_status') == '') {
            $status = 'Tidak Aktif';
        } else {
            $status = 'Aktif';
        }

        $id = $this->request->getPost('id_karyawan');
        $avatar      = $this->request->getFile('edit_foto');
        if ($avatar != '') {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_karyawan/', $namabaru);

            if($this->request->getPost('edit_password') != '') {
                $data = array(
                    'username'  => $this->request->getPost('edit_username'),
                    'password'   => base64_encode($encrypter->encrypt($this->request->getPost('edit_password'))),
                    'nama_karyawan'  => $this->request->getPost('edit_nama'),
                    'no_telp_karyawan'   => $this->request->getPost('edit_no_telp'),
                    'alamat_karyawan'   => $this->request->getPost('edit_alamat'),
                    'status_karyawan'  => $status,
                    'foto_karyawan'     => "docs/img/img_karyawan/" . $namabaru,
                    'updated_at' => date('Y-m-d H:i:s')
                );
            } else {
                $data = array(
                    'username'  => $this->request->getPost('edit_username'),
                    'nama_karyawan'  => $this->request->getPost('edit_nama'),
                    'no_telp_karyawan'   => $this->request->getPost('edit_no_telp'),
                    'alamat_karyawan'   => $this->request->getPost('edit_alamat'),
                    'status_karyawan'  => $status,
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
                    'username'  => $this->request->getPost('edit_username'),
                    'password'   => base64_encode($encrypter->encrypt($this->request->getPost('edit_password'))),
                    'nama_karyawan'  => $this->request->getPost('edit_nama'),
                    'no_telp_karyawan'   => $this->request->getPost('edit_no_telp'),
                    'alamat_karyawan'   => $this->request->getPost('edit_alamat'),
                    'status_karyawan'  => $status,
                    'updated_at' => date('Y-m-d H:i:s')
                );
            } else {
                $data = array(
                    'username'  => $this->request->getPost('edit_username'),
                    'nama_karyawan'  => $this->request->getPost('edit_nama'),
                    'no_telp_karyawan'   => $this->request->getPost('edit_no_telp'),
                    'alamat_karyawan'   => $this->request->getPost('edit_alamat'),
                    'status_karyawan'  => $status,
                    'updated_at' => date('Y-m-d H:i:s')
                );
            }

            
        }

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Karyawan'));
    }

    public function delete_karyawan()
    {
        $session = session();
        $model = new Model_karyawan();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $data_foto = $model->detail_data($id)->getRowArray();

            if ($data_foto != null) {
                if ($data_foto['foto_karyawan'] != 'docs/img/img_karyawan/noimage.jpg') {
                    if (file_exists($data_foto['foto_karyawan'])) {
                        unlink($data_foto['foto_karyawan']);
                    }
                }
            }
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Admin/Karyawan');
    }

    public function data_edit($id_karyawan)
    {
        $model = new Model_karyawan();
        $datakaryawan = $model->detail_data($id_karyawan)->getResultArray();
        $respon = json_decode(json_encode($datakaryawan), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_karyawan'] = $value['id_karyawan'];
            $isi['username'] = $value['username'];
            $isi['nama_karyawan'] = $value['nama_karyawan'];
            $isi['no_telp_karyawan'] = $value['no_telp_karyawan'];
            $isi['alamat_karyawan'] = $value['alamat_karyawan'];
            $isi['status_karyawan'] = $value['status_karyawan'];
            $isi['foto_karyawan'] = $value['foto_karyawan'];
        endforeach;
        echo json_encode($isi);
    }

    public function cek_username($username)
    {
        $model = new Model_karyawan();
        $cek_username = $model->cek_username($username)->getResultArray();
        $respon = json_decode(json_encode($cek_username), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

     public function data_jabatan()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("jabatan");

        $jabatan = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_jabatan, nama_jabatan');
            $builder->like('nama_jabatan', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_jabatan, nama_jabatan');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $jabatan[] = array(
                "id" => $country->id_jabatan,
                "text" => $country->nama_jabatan,
            );
        }

        $response['data'] = $jabatan;

        return $this->response->setJSON($response);
    }
}

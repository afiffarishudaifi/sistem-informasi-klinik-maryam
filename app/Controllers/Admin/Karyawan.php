<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_karyawan;
use App\Models\Model_user;

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
            'nik_karyawan'     => $this->request->getPost('input_nik'),
            'jenis_kelamin'     => $this->request->getPost('input_kelamin'),
            'tgl_lahir'     => $this->request->getPost('input_tanggal'),
            'nama_karyawan'     => $this->request->getPost('input_nama'),
            'no_telp_karyawan'     => $this->request->getPost('input_no_telp'),
            'alamat_karyawan'     => $this->request->getPost('input_alamat'),
            'divisi'     => $this->request->getPost('input_divisi'),
            'id_poli'     => $this->request->getPost('input_poli'),
            'status_karyawan'     => $status,
            'foto_karyawan'     => "docs/img/img_karyawan/" . $namabaru
            
        );

        $model = new Model_karyawan();
        $model->add_data($data);

        // $max_id = $model->detail_data($data['nik_karyawan'])->getRowArray(); 

        $data = array(
            'nik_karyawan' => $data['nik_karyawan'],
            'email'     => $this->request->getPost('input_email'),
            'level'     => 'Karyawan',
            'password'     => base64_encode($encrypter->encrypt($this->request->getPost('input_password')))
        );

        $modeluser = new Model_user();
        $modeluser->add_data($data);

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

        $id = $this->request->getPost('edit_nik');
        $id_user = $this->request->getPost('id_user');
        $password = $this->request->getPost('edit_password');

        $avatar      = $this->request->getFile('edit_foto');
        if ($avatar != '') {
            $namabaru     = $avatar->getRandomName();
            $avatar->move('docs/img/img_karyawan/', $namabaru);

            if($this->request->getPost('edit_password') != '') {
                $data = array(
                    'nik_karyawan'     => $this->request->getPost('edit_nik'),
                    'jenis_kelamin'     => $this->request->getPost('edit_kelamin'),
                    'tgl_lahir'     => $this->request->getPost('edit_tanggal'),
                    'nama_karyawan'  => $this->request->getPost('edit_nama'),
                    'no_telp_karyawan'   => $this->request->getPost('edit_no_telp'),
                    'alamat_karyawan'   => $this->request->getPost('edit_alamat'),
                    'divisi'     => $this->request->getPost('edit_divisi'),
                    'id_poli'     => $this->request->getPost('edit_poli'),
                    'status_karyawan'  => $status,
                    'foto_karyawan'     => "docs/img/img_karyawan/" . $namabaru
                );
            } else {
                $data = array(
                    'nik_karyawan'     => $this->request->getPost('edit_nik'),
                    'jenis_kelamin'     => $this->request->getPost('edit_kelamin'),
                    'tgl_lahir'     => $this->request->getPost('edit_tanggal'),
                    'nama_karyawan'  => $this->request->getPost('edit_nama'),
                    'no_telp_karyawan'   => $this->request->getPost('edit_no_telp'),
                    'alamat_karyawan'   => $this->request->getPost('edit_alamat'),
                    'divisi'     => $this->request->getPost('edit_divisi'),
                    'id_poli'     => $this->request->getPost('edit_poli'),
                    'status_karyawan'  => $status,
                    'foto_karyawan'     => "docs/img/img_karyawan/" . $namabaru
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
                    'nik_karyawan'     => $this->request->getPost('edit_nik'),
                    'jenis_kelamin'     => $this->request->getPost('edit_kelamin'),
                    'tgl_lahir'     => $this->request->getPost('edit_tanggal'),
                    'nama_karyawan'  => $this->request->getPost('edit_nama'),
                    'no_telp_karyawan'   => $this->request->getPost('edit_no_telp'),
                    'divisi'     => $this->request->getPost('edit_divisi'),
                    'id_poli'     => $this->request->getPost('edit_poli'),
                    'alamat_karyawan'   => $this->request->getPost('edit_alamat'),
                    'status_karyawan'  => $status
                );
            } else {
                $data = array(
                    'nik_karyawan'     => $this->request->getPost('edit_nik'),
                    'jenis_kelamin'     => $this->request->getPost('edit_kelamin'),
                    'tgl_lahir'     => $this->request->getPost('edit_tanggal'),
                    'nama_karyawan'  => $this->request->getPost('edit_nama'),
                    'no_telp_karyawan'   => $this->request->getPost('edit_no_telp'),
                    'divisi'     => $this->request->getPost('edit_divisi'),
                    'id_poli'     => $this->request->getPost('edit_poli'),
                    'alamat_karyawan'   => $this->request->getPost('edit_alamat'),
                    'status_karyawan'  => $status
                );
            }

            
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
        return redirect()->to(base_url('Admin/Karyawan'));
    }

    public function delete_karyawan()
    {
        $session = session();
        $model = new Model_karyawan();
        $id = $this->request->getPost('id');
        $id_user = $this->request->getPost('id_user');
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

    public function data_edit($nik_karyawan)
    {
        $model = new Model_karyawan();
        $datakaryawan = $model->detail_data($nik_karyawan)->getResultArray();
        $respon = json_decode(json_encode($datakaryawan), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_user'] = $value['id_user'];
            $isi['email'] = $value['email'];
            $isi['nama_karyawan'] = $value['nama_karyawan'];
            $isi['no_telp_karyawan'] = $value['no_telp_karyawan'];
            $isi['alamat_karyawan'] = $value['alamat_karyawan'];
            $isi['status_karyawan'] = $value['status_karyawan'];
            $isi['foto_karyawan'] = $value['foto_karyawan'];
            $isi['nik_karyawan'] = $value['nik_karyawan'];
            $isi['jenis_kelamin'] = $value['jenis_kelamin'];
            $isi['tgl_lahir'] = $value['tgl_lahir'];
            $isi['divisi'] = $value['divisi'];
            $isi['id_poli'] = $value['id_poli'];
            $isi['nama_poli'] = $value['nama_poli'];
        endforeach;
        echo json_encode($isi);
    }

    public function cek_email($email)
    {
        $model = new Model_karyawan();
        $cek_email = $model->cek_email($email)->getResultArray();
        $respon = json_decode(json_encode($cek_email), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_poli()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("poli");

        $poli = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_poli, nama_poli');
            $builder->like('nama_poli', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_poli, nama_poli');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $poli[] = array(
                "id" => $country->id_poli,
                "text" => $country->nama_poli,
            );
        }

        $response['data'] = $poli;

        return $this->response->setJSON($response);
    }

}

<?php

namespace App\Controllers;
use App\Models\Model_login;

class Login extends BaseController
{
    public function index()
    {
        $session = session();

        if ($session->get('nama_login') || $session->get('status_login') == 'Pasien') {
            return redirect()->to('Pasien/Dashboard');
        } else if ($session->get('nama_login') || $session->get('status_login') == 'Karyawan') {
            return redirect()->to('Karyawan/Dashboard');
        }

        helper(['form']);
        return view('viewLogin');
    }

    public function pengajuanMagang()
    {
        $session = session();

        // if ($session->get('username_login') || $session->get('status_login') == 'Admin') {
        //     return redirect()->to('Admin/Dashboard');
        // } else if ($session->get('username_login') || $session->get('status_login') == 'Customer') {
        //     return redirect()->to('Customer/Dashboard');
        // }

        helper(['form']);
        return view('viewPengajuanMagang');
    }

    public function loginAdmin()
    {
        $session = session();

        if ($session->get('nama_login') || $session->get('status_login') == 'Admin') {
            return redirect()->to('Admin/Dashboard');
        } 

        helper(['form']);
        return view('viewLoginAdmin');
    }

    public function loginSistemAdmin()
    {
        $session = session();

        $model = new Model_login();
        $encrypter = \Config\Services::encrypter();

        $status = $this->request->getPost('status');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = $model->loginAdmin($username)->getRowArray();

        if ($data) {
            $pass = $data['password_admin'];
            $status = 'Admin';
            $verify_pass =  $encrypter->decrypt(base64_decode($pass));
            if ($verify_pass == $password) {
                $ses_data = [
                    'user_id' => $data['id_admin'],
                    'nama_login' => $data['nama_admin'],
                    'foto' => 'no_image.png',
                    'status_login' => $status,
                    'logged_in' => TRUE,
                    'is_admin' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/Admin/Dashboard');
            } else {
                $session->setFlashdata('msg', 'Password Tidak Sesuai');
                return redirect()->to('/Login');
            }
        } else {
            $session->setFlashdata('msg', 'Username Tidak di Temukan');
            return redirect()->to('/Login');
        }
    }


    public function loginSistem()
    {
        $session = session();

        if ($session->get('nama_login') || $session->get('status_login') == 'Pasien') {
            return redirect()->to('Pasien/Dashboard');
        } else if ($session->get('nama_login') || $session->get('status_login') == 'Karyawan') {
            return redirect()->to('Karyawan/Dashboard');
        }
        
        $model = new Model_login();
        $encrypter = \Config\Services::encrypter();

        $status = $this->request->getPost('status');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($status == 'Pasien') {
            $data = $model->loginPasien($username)->getRowArray();

            if ($data) {
                $pass = $data['password_pasien'];
                $status = 'Pasien';
                $verify_pass =  $encrypter->decrypt(base64_decode($pass));
                if ($verify_pass == $password) {
                    $ses_data = [
                        'user_id' => $data['id_pasien'],
                        'nama_login' => $data['nama_pasien'],
                        'foto' => 'no_image.png',
                        'status_login' => $status,
                        'logged_in' => TRUE,
                        'is_admin' => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/Pasien/Dashboard');
                } else {
                    $session->setFlashdata('msg', 'Password Tidak Sesuai');
                    return redirect()->to('/Login');
                }
            } else {
                $session->setFlashdata('msg', 'Username Tidak di Temukan');
                return redirect()->to('/Login');
            }
        } else {
            $data = $model->loginKaryawan($username)->getRowArray();

            if ($data) {
                $pass = $data['password_karyawan'];
                $status = 'Karyawan';
                $verify_pass =  $encrypter->decrypt(base64_decode($pass));
                if ($verify_pass == $password) {
                    $ses_data = [
                        'user_id' => $data['id_karyawan'],
                        'nama_login' => $data['nama_karyawan'],
                        'foto' => $data['foto_karyawan'],
                        'status_login' => $status,
                        'logged_in' => TRUE,
                        'is_admin' => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/Karyawan/Dashboard');
                } else {
                    $session->setFlashdata('msg', 'Password Tidak Sesuai');
                    return redirect()->to('/Login');
                }
            } else {
                $session->setFlashdata('msg', 'Username Tidak di Temukan');
                return redirect()->to('/Login');
            }
        }
    }

    public function registrasiPasien()
    {
        $session = session();
        $model = new Model_login();
        return view('viewRegistrasi');
    }

    public function simpanPasien()
    {
        $session = session();
        $model = new Model_login();
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/Login');
    }
}
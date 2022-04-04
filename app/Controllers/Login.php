<?php

namespace App\Controllers;
use App\Models\Model_login;
use App\Models\Model_pasien;
use App\Models\Model_user;

class Login extends BaseController
{
    // start google

    private $loginModel=NULL;
	private $googleClient=NULL;
	function __construct(){
		require_once APPPATH. "libraries/vendor/autoload.php";
		$this->loginModel = new Model_login();
		$this->googleClient = new \Google_Client();
		$this->googleClient->setClientId("913013352146-6d8ktufmiaobgjj56pcrqrn9m9v871lc.apps.googleusercontent.com");
		$this->googleClient->setClientSecret("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");
		$this->googleClient->setRedirectUri("http://localhost:8080/sistem-informasi-klinik-maryam/Login/loginWithGoogle");
		$this->googleClient->addScope("email");
		$this->googleClient->addScope("profile");

    }

	public function loginWithGoogle()
	{
        $session = session();
        $model = new Model_login();
        $max = $model->cek_max()->getRowArray()['id_user'];
        $max = $max + 1;

		$token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
		if(!isset($token['error'])){
			$this->googleClient->setAccessToken($token['access_token']);
			session()->set("AccessToken", $token['access_token']);

			$googleService = new \Google_Service_Oauth2($this->googleClient);
			$data = $googleService->userinfo->get();
			$currentDateTime = date("Y-m-d H:i:s");
			$userdata=array();
			if($this->loginModel->isAlreadyRegister($data['id'])){
				//User ALready Login and want to Login Again
				$userdata = [
                    'oauth_id'=>$data['id'],
					'email'=>$data['email']
				];
				$this->loginModel->updateUserData($userdata, $data['id']);
			}else{
                //new User want to Login
				$userdata = [
                    'id_user'=>$max,
                    'oauth_id'=>$data['id'],
					'email'=>$data['email'] , 
                    'Level' => 'Pasien'
                ];
				$this->loginModel->insertUserData($userdata);

                $data_pasien = array(
                    'id_user' => $max,
                    'nama_pasien'     => $data['name']
                );

                $model = new Model_pasien();
                $model->add_data($data_pasien);
            }

            $max_login = $model->cek_max_login($data['id'])->getRowArray()['id_user'];
            $max_login = $max_login + 1;
            $ses_data = [
                'nik' => rand(10, 50),
                'user_id' => $max_login,
                'nama_login' => $data['name'],
                'foto' => 'no_image.png',
                'status_login' => 'Pasien',
                'logged_in' => TRUE,
                'is_admin' => TRUE
            ];
			$session->set("LoggedUserData", $ses_data);
			$session->set($ses_data);

            return redirect()->to('/Pasien/Dashboard');

		}else{
			$session->setFlashData("Error", "Something went Wrong");
			return redirect()->to(base_url());
		}
	}
    
    // end google
    public function index()
    {
        $session = session();

        if ($session->get('nama_login') || $session->get('status_login') == 'Pasien') {
            return redirect()->to('Pasien/Dashboard');
        } else if ($session->get('nama_login') || $session->get('status_login') == 'Karyawan') {
            return redirect()->to('Karyawan/Dashboard');
        }

        helper(['form']);

        $data['googleButton'] = $this->googleClient->createAuthUrl();
        return view('viewLogin', $data);
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
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = $model->loginAdmin($email)->getRowArray();

        if ($data) {
            $pass = $data['password'];
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
                return redirect()->to('/Login/loginAdmin');
            }
        } else {
            $session->setFlashdata('msg', 'Email Tidak di Temukan');
            return redirect()->to('/Login/loginAdmin');
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

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = $model->loginPasien($email)->getRowArray();

        if ($data) {
            $pass = $data['password'];
            $status = 'Pasien';
            $verify_pass =  $encrypter->decrypt(base64_decode($pass));
            if ($verify_pass == $password) {
                $ses_data = [
                    'user_id' => $data['nik'],
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
            $session->setFlashdata('msg', 'Email Tidak di Temukan');
            return redirect()->to('/Login');
        }
    }

    public function loginPegawai()
    {
        $session = session();

        if ($session->get('nama_login') || $session->get('status_login') == 'Pasien') {
            return redirect()->to('Pasien/Dashboard');
        } else if ($session->get('nama_login') || $session->get('status_login') == 'Karyawan') {
            return redirect()->to('Karyawan/Dashboard');
        }

        helper(['form']);
        return view('viewLoginPegawai');
    }

    public function loginSistemPegawai()
    {
        $session = session();

        if ($session->get('nama_login') || $session->get('status_login') == 'Pasien') {
            return redirect()->to('Pasien/Dashboard');
        } else if ($session->get('nama_login') || $session->get('status_login') == 'Karyawan') {
            return redirect()->to('Karyawan/Dashboard');
        }
        
        $model = new Model_login();
        $encrypter = \Config\Services::encrypter();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = $model->loginKaryawan($email)->getRowArray();

        if ($data) {
            $pass = $data['password'];
            $status = 'Karyawan';
            $verify_pass =  $encrypter->decrypt(base64_decode($pass));
            if ($verify_pass == $password) {
                $ses_data = [
                    'user_id' => $data['nik_karyawan'],
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
            $data = $model->loginApoteker($email)->getRowArray();

            if ($data) {
                $pass = $data['password'];
                $status = 'Apoteker';
                $verify_pass =  $encrypter->decrypt(base64_decode($pass));
                if ($verify_pass == $password) {
                    $ses_data = [
                        'user_id' => $data['nik_karyawan'],
                        'nama_login' => $data['nama_karyawan'],
                        'foto' => $data['foto_karyawan'],
                        'status_login' => $status,
                        'logged_in' => TRUE,
                        'is_admin' => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/Apoteker/Dashboard');
                } else {
                    $session->setFlashdata('msg', 'Password Tidak Sesuai');
                    return redirect()->to('/Login');
                }
            } else {
                $session->setFlashdata('msg', 'Email Tidak di Temukan');
                return redirect()->to('/Login');
            }
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        
		session()->remove('LoggedUserData');
		session()->remove('AccessToken');
        return redirect()->to('/Login');
    }
}

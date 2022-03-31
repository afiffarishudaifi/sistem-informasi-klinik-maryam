<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_login extends Model
{
    protected $table= 'pasien';
    protected $primaryKey ='id_pasien';
    protected $useTimestamps = true;

    public function loginAdmin($email)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $query = $builder->join('admin', 'admin.id_user = user.id_user');
        $query = $builder->where('email', $email);
        $query = $builder->where('level', 'Admin');
        return $query->get();
    }

    public function loginPasien($email)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $query = $builder->select('id_pasien, user.id_user, nama_pasien, password, email');
        $query = $builder->join('pasien', 'pasien.id_user = user.id_user');
        $query = $builder->where('email', $email);
        $query = $builder->where('level', 'Pasien');
        return $query->get();
    }

    public function loginKaryawan($email)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $query = $builder->select('nik_karyawan, user.id_user, nama_karyawan, foto_karyawan, password, email');
        $query = $builder->join('karyawan', 'karyawan.id_user = user.id_user');
        $query = $builder->where('email', $email);
        $query = $builder->where('level', 'karyawan');
        return $query->get();
    }

    public function loginApoteker($email)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $query = $builder->select('nik_karyawan, user.id_user, nama_karyawan, foto_karyawan, password, email');
        $query = $builder->join('karyawan', 'karyawan.id_user = user.id_user');
        $query = $builder->where('email', $email);
        $query = $builder->where('level', 'Apoteker');
        return $query->get();
    }

    public function addProfile($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        $query =  $builder->insert($data);
        return $query;
    }

    // start google

    public function cek_max()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->selectMax('id_user');
        return $builder->get();
    }
    public function cek_max_login($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('id_user');
        $builder->where('oauth_id',$id);
        return $builder->get();
    }
    public function isAlreadyRegister($authid){
        return $this->db->table('user')->getWhere(['oauth_id'=>$authid])->getRowArray()>0?true:false;
	}
	public function updateUserData($userdata, $authid){
		$this->db->table("user")->where(['oauth_id'=>$authid])->update($userdata);
	}
	public function insertUserData($userdata){
		$this->db->table("user")->insert($userdata);
	}
    // end login
}

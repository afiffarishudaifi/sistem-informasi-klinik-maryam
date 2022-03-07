<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_login extends Model
{
    protected $table= 'pasien';
    protected $primaryKey ='id_pasien';
    protected $useTimestamps = true;

    public function loginAdmin($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $query = $builder->join('admin', 'admin.id_user = user.id_user');
        $query = $builder->where('username', $username);
        $query = $builder->where('level', 'Admin');
        return $query->get();
    }

    public function loginPasien($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $query = $builder->where('username', $username);
        $query = $builder->where('level', 'Pasien');
        return $query->get();
    }

    public function loginKaryawan($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $query = $builder->where('username', $username);
        $query = $builder->where('level', 'karyawan');
        return $query->get();
    }

    public function loginApoteker($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $query = $builder->where('username', $username);
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

}

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
        $builder = $db->table('admin');
        $query = $builder->where('username_admin', $username);
        return $query->get();
    }

    public function loginPasien($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        $query = $builder->where('username_pasien', $username);
        return $query->get();
    }

    public function loginKaryawan($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('karyawan');
        $query = $builder->where('username_karyawan', $username);
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

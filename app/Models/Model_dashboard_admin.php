<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_dashboard_admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    public function kamar_kosong()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('id_kamar');
        $builder->where('status_kamar', 'Kosong');
        return $builder->get();
    }

    public function kamar_terisi()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('id_kamar');
        $builder->where('status_kamar', 'Terisi');
        return $builder->get();
    }

    public function pegawai()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('id_user');
        $builder->where('level', 'Apoteker');
        $builder->orWhere('level', 'Karyawan');
        return $builder->get();
    }

    public function dokter()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('dokter');
        $builder->select('nik_dokter');
        return $builder->get();
    }

}

<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_pasien extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('pasien')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        $builder->where('id_pasien', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        $builder->where('id_pasien', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        $builder->where('id_pasien', $id);
        return $builder->delete();
    }

    public function cek_username($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        $builder->select('id_pasien');
        $builder->where('username_pasien', $username);
        return $builder->get();
    }

    public function cek_nik($nik)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        $builder->select('id_pasien');
        $builder->where('nik', $nik);
        return $builder->get();
    }
}
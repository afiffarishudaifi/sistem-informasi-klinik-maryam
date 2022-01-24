<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_jabatan extends Model
{
    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('jabatan');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('jabatan')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('jabatan');
        $builder->where('id_jabatan', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('jabatan');
        $builder->where('id_jabatan', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('jabatan');
        $builder->where('id_jabatan', $id);
        return $builder->delete();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('jabatan');
        $builder->select('id_jabatan');
        $builder->where('nama_jabatan', $nama);
        return $builder->get();
    }
}
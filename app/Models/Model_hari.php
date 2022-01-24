<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_hari extends Model
{
    protected $table = 'hari';
    protected $primaryKey = 'id_hari';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('hari');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('hari')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('hari');
        $builder->where('id_hari', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('hari');
        $builder->where('id_hari', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('hari');
        $builder->where('id_hari', $id);
        return $builder->delete();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('hari');
        $builder->select('id_hari');
        $builder->where('nama_hari', $nama);
        return $builder->get();
    }
}
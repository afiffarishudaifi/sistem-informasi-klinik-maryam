<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_poliklinik extends Model
{
    protected $table = 'poliklinik';
    protected $primaryKey = 'id_poliklinik';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('poliklinik');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('poliklinik')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('poliklinik');
        $builder->where('id_poliklinik', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('poliklinik');
        $builder->where('id_poliklinik', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('poliklinik');
        $builder->where('id_poliklinik', $id);
        return $builder->delete();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('poliklinik');
        $builder->select('id_poliklinik');
        $builder->where('nama_poliklinik', $nama);
        return $builder->get();
    }
}
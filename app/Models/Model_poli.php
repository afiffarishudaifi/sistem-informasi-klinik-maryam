<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_poli extends Model
{
    protected $table = 'poliklinik';
    protected $primaryKey = 'id_poli';

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
        $builder->where('id_poli', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('poliklinik');
        $builder->where('id_poli', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('poliklinik');
        $builder->where('id_poli', $id);
        return $builder->delete();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('poliklinik');
        $builder->select('id_poli');
        $builder->where('nama_poli', $nama);
        return $builder->get();
    }
}
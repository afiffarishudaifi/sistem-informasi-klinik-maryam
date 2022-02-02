<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_sesi extends Model
{
    protected $table = 'sesi';
    protected $primaryKey = 'id_sesi';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('sesi');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('sesi')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('sesi');
        $builder->where('id_sesi', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('sesi');
        $builder->where('id_sesi', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('sesi');
        $builder->where('id_sesi', $id);
        return $builder->delete();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('sesi');
        $builder->select('id_sesi');
        $builder->where('nama_sesi', $nama);
        return $builder->get();
    }
}
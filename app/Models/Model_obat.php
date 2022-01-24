<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_obat extends Model
{
    protected $table = 'obat';
    protected $primaryKey = 'id_obat';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('obat');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('obat')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('obat');
        $builder->where('id_obat', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('obat');
        $builder->where('id_obat', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('obat');
        $builder->where('id_obat', $id);
        return $builder->delete();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('obat');
        $builder->select('id_obat');
        $builder->where('nama_obat', $nama);
        return $builder->get();
    }
}
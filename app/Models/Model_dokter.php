<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('dokter');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('dokter')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('dokter');
        $builder->where('id_dokter', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('dokter');
        $builder->where('id_dokter', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('dokter');
        $builder->where('id_dokter', $id);
        return $builder->delete();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('dokter');
        $builder->select('id_dokter');
        $builder->where('nama_dokter', $nama);
        return $builder->get();
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_penyakit extends Model
{
    protected $table = 'penyakit';
    protected $primaryKey = 'id_penyakit';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('penyakit');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('penyakit')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('penyakit');
        $builder->where('id_penyakit', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('penyakit');
        $builder->where('id_penyakit', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('penyakit');
        $builder->where('id_penyakit', $id);
        return $builder->delete();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('penyakit');
        $builder->select('id_penyakit');
        $builder->where('nama_penyakit', $nama);
        return $builder->get();
    }
}

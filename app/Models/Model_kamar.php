<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_kamar extends Model
{
    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('kamar')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->where('id_kamar', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->where('id_kamar', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->where('id_kamar', $id);
        return $builder->delete();
    }

    public function cek_nomor($nomor)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->select('id_kamar');
        $builder->where('nomor_kamar', $nomor);
        return $builder->get();
    }

    public function cek_foreign($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->join('pendafataran_inap', 'pendaftaran_inap.id_kamar = kamar.id_kamar');
        $builder->where('kamar.id_kamar', $id);
        return $builder->countAllResults();
    }
}
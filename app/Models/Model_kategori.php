<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_kategori extends Model
{
    protected $table = 'kategori_obat';
    protected $primaryKey = 'id_kategori';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_obat');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('kategori_obat')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_obat');
        $builder->where('id_kategori', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_obat');
        $builder->where('id_kategori', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_obat');
        $builder->where('id_kategori', $id);
        return $builder->delete();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_obat');
        $builder->select('id_kategori');
        $builder->where('nama_kategori', $nama);
        return $builder->get();
    }

    public function cek_foreign($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_obat');
        $builder->join('obat', 'obat.id_kategori = kategori_obat.id_kategori');
        $builder->where('kategori_obat.id_kategori', $id);
        return $builder->countAllResults();
    }
}

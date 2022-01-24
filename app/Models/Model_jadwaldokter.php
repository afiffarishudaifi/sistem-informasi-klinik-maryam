<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_jadwaldokter extends Model
{
    protected $table = 'jadwal_dokter';
    protected $primaryKey = 'id_jadwal';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('jadwal_dokter');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('jadwal_dokter')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('jadwal_dokter');
        $builder->where('id_jadwal', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('jadwal_dokter');
        $builder->where('id_jadwal', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('jadwal_dokter');
        $builder->where('id_jadwal', $id);
        return $builder->delete();
    }

    public function cek_nama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('jadwal_dokter');
        $builder->select('id_jadwal');
        $builder->where('nama_jadwal', $nama);
        return $builder->get();
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'nik_dokter';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('dokter');
        return $builder->get();
    }
    
    public function view_poli()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('poli');
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
        $builder->select('nik_dokter, nama_dokter, alamat_dokter, no_telp_dokter, status_dokter, foto_dokter, jenis_kelamin, tanggal_lahir');
        $builder->where('nik_dokter', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('dokter');
        $builder->where('nik_dokter', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('dokter');
        $builder->where('nik_dokter', $id);
        return $builder->delete();
    }
}

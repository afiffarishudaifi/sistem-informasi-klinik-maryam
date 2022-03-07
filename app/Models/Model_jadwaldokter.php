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
        $builder->select('jadwal_dokter.id_jadwal, jadwal_dokter.id_hari, jadwal_dokter.id_dokter, jadwal_dokter.status_jadwal, hari.nama_hari, dokter.nama_dokter');
        $builder->join('hari', 'jadwal_dokter.id_hari = hari.id_hari');
        $builder->join('dokter', 'jadwal_dokter.id_dokter = dokter.id_dokter');
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
        $builder->select('jadwal_dokter.id_jadwal, jadwal_dokter.id_hari, jadwal_dokter.id_dokter, jadwal_dokter.status_jadwal, hari.nama_hari, dokter.nama_dokter');
        $builder->join('hari', 'jadwal_dokter.id_hari = hari.id_hari');
        $builder->join('dokter', 'jadwal_dokter.id_dokter = dokter.id_dokter');
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

}

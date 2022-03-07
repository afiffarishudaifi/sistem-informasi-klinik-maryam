<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_karyawan extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('karyawan');
        $builder->select('karyawan.id_karyawan, karyawan.nama_karyawan, karyawan.alamat_karyawan, karyawan.no_telp_karyawan, karyawan.status_karyawan');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('karyawan')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('karyawan');
        $builder->select('karyawan.id_karyawan, karyawan.username_karyawan, karyawan.nama_karyawan, karyawan.alamat_karyawan, karyawan.no_telp_karyawan, karyawan.status_karyawan, karyawan.foto_karyawan');
        $builder->where('id_karyawan', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('karyawan');
        $builder->where('id_karyawan', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('karyawan');
        $builder->where('id_karyawan', $id);
        return $builder->delete();
    }

    public function cek_username($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('id_user');
        $builder->where('username', $username);
        return $builder->get();
    }
}

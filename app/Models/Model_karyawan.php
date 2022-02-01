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
        $builder->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan');
        return $builder->get();
    }

     public function view_jabatan()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('jabatan');
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
        $builder->select('karyawan.id_karyawan, karyawan.username_karyawan, karyawan.id_jabatan, karyawan.nama_karyawan, karyawan.alamat_karyawan, karyawan.no_telp_karyawan, karyawan.status_karyawan, karyawan.foto_karyawan, jabatan.nama_jabatan');
        $builder->join('jabatan', 'karyawan.id_jabatan = jabatan.id_jabatan');
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
        $builder = $db->table('karyawan');
        $builder->select('id_karyawan');
        $builder->where('username_karyawan', $username);
        return $builder->get();
    }
}
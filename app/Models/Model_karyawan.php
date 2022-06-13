<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_karyawan extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'nik_karyawan';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('karyawan');
        $builder->select('karyawan.nik_karyawan, nama_karyawan, divisi, nama_poli, id_user, alamat_karyawan, no_telp_karyawan, status_karyawan');
        $builder->join('user','user.nik_karyawan = karyawan.nik_karyawan');
        $builder->join('poli','poli.id_poli = karyawan.id_poli','left');
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
        $builder->select("karyawan.nik_karyawan, email, user.id_user, level, email, jenis_kelamin, tgl_lahir, karyawan.nama_karyawan, karyawan.alamat_karyawan, karyawan.no_telp_karyawan, karyawan.status_karyawan, karyawan.foto_karyawan, karyawan.id_poli, nama_poli, divisi");
        $builder->join('user','user.nik_karyawan = karyawan.nik_karyawan');
        $builder->join('poli','poli.id_poli = karyawan.id_poli','left');
        $builder->where('karyawan.nik_karyawan', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('karyawan');
        $builder->where('nik_karyawan', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('karyawan');
        $builder->where('nik_karyawan', $id);
        return $builder->delete();
    }

    public function cek_email($email)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('id_user');
        $builder->where('email', $email);
        return $builder->get();
    }

    // public function max_id()
    // {
    // 	$db      = \Config\Database::connect();
    //     $builder = $db->table('karyawan');
    //     $builder->selectMax('nik_karyawan');
    //     return $builder->get();
    // }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_rawatjalanpasien extends Model
{
    protected $table = 'antrian';
    protected $primaryKey = 'id_antrian';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('antrian');
        $builder->select('id_antrian, pasien.nama_pasien, poli.nama_poli, antrian.no_antrian, antrian.status_antrian');
        $builder->join('poli','antrian.id_poli = poli.id_poli');
        $builder->join('pasien','antrian.nik = pasien.nik');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('antrian')->insert($data);
        return $query;
    }

    public function cek_max($params)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('antrian');
        $builder->selectMax('no_antrian');
        $builder->join('poli','antrian.id_poli = poli.id_poli');
        $builder->where('poli.id_poli',$params['id_poli']);
        $builder->where('antrian.tanggal_daftar', $params['tanggal_daftar']);
        return $builder->get();
    }

    public function cek_pasien($id)
    {
    	$db      = \Config\Database::connect();
        $builder = $db->table('antrian');
        $builder->select('id_antrian');
        $builder->where('nik', $id);
        $builder->where('status_antrian =', 'Menunggu');
        return $builder->get();
    }

    public function antrian($nik)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('antrian');
        $builder->select('no_antrian');
        $builder->where('nik', $nik);
        $builder->where('status_antrian =', 'Menunggu');
        return $builder->get();
    }
}
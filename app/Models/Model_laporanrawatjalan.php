<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_laporanrawatjalan extends Model
{
    protected $table = 'antrian';
    protected $primaryKey = 'id_antrian';

    public function filter($param)
    {
    	$db      = \Config\Database::connect();
        $builder = $db->table('antrian');
		$builder->select('id_antrian, pasien.nama_pasien, poli.nama_poli, tanggal_daftar, keluhan');
		$builder->join('pasien','pasien.nik = antrian.nik');
		$builder->join('poli','poli.id_poli = antrian.id_poli');
        if ($param['cek_waktu1']) $builder->where('tanggal_daftar >= ', $param['cek_waktu1']);
        if ($param['cek_waktu2']) $builder->where('tanggal_daftar <= ', $param['cek_waktu2']);

        if ($param['id_poli']) $builder->where('antrian.id_poli', $param['id_poli']);
        return $builder->get();
    }
}

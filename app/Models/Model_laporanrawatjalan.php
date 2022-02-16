<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_laporanrawatjalan extends Model
{
    protected $table = 'pendaftaran_rawat_jalan';
    protected $primaryKey = 'id_pendaftaran';

    public function filter($param)
    {
    	$db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_rawat_jalan');
		$builder->select('id_pendaftaran, pasien.nama_pasien, poliklinik.nama_poli, tanggal_daftar, keluhan');
		$builder->join('pasien','pasien.id_pasien = pendaftaran_rawat_jalan.id_pasien');
		$builder->join('poliklinik','poliklinik.id_poli = pendaftaran_rawat_jalan.id_poli');
        if ($param['cek_waktu1']) $builder->where('tanggal_daftar >= ', $param['cek_waktu1']);
        if ($param['cek_waktu2']) $builder->where('tanggal_daftar <= ', $param['cek_waktu2']);

        if ($param['id_poli']) $builder->where('pendaftaran_rawat_jalan.id_poli', $param['id_poli']);
        return $builder->get();
    }
}
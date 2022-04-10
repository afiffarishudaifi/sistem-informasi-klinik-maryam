<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_rekammedispasien extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'id_rekam_inap';

   	public function filter_jalan($param)
    {
    	$db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis');
		$builder->select('pasien.nama_pasien, dokter.nama_dokter, hasil_pemeriksaan, saran_dokter, tensi_darah, DATE_FORMAT(rekam_medis.tanggal_rekam,"%d %M %Y") as tanggal_rekam');
		$builder->join('pasien','pasien.nik = rekam_medis.nik');
		$builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
        if ($param['cek_waktu1']) $builder->where('rekam_medis.tanggal_rekam >= ', $param['cek_waktu1']);
        if ($param['cek_waktu2']) $builder->where('rekam_medis.tanggal_rekam <= ', $param['cek_waktu2']);
        if ($param['nik']) $builder->where('pendaftaran_rawat_jalan.nik', $param['nik']);
        if ($param['nik_dokter']) $builder->where('rekam_medis.nik_dokter', $param['nik_dokter']);
        return $builder->get();
    }

    public function filter_inap($param)
    {
    	$db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis');
		$builder->select('pasien.nama_pasien, dokter.nama_dokter, hasil_pemeriksaan, saran_dokter, DATE_FORMAT(rekam_medis.tanggal_rekam,"%d %M %Y") as tanggal_rekam');
		$builder->join('pasien','pasien.nik = rekam_medis.nik');
		$builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
        if ($param['cek_waktu1']) $builder->where('rekam_medis.tanggal_rekam >= ', $param['cek_waktu1']);
        if ($param['cek_waktu2']) $builder->where('rekam_medis.tanggal_rekam <= ', $param['cek_waktu2']);
        // if ($param['nik']) $builder->where('rekam_medis.nik', $param['nik']);
        if ($param['nik_dokter']) $builder->where('rekam_medis.nik_dokter', $param['nik_dokter']);
        return $builder->get();
    }
}
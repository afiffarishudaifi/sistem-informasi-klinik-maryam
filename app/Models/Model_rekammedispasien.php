<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_rekammedispasien extends Model
{
    protected $table = 'rekam_medis_inap';
    protected $primaryKey = 'id_rekam_inap';

   	public function filter_jalan($param)
    {
    	$db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis_jalan');
		$builder->select('pasien.nama_pasien, dokter.nama_dokter, hasil_pemeriksaan, saran_dokter, tensi_darah, DATE_FORMAT(rekam_medis_jalan.created_at,"%d %M %Y") as created_at');
		$builder->join('pendaftaran_rawat_jalan','pendaftaran_rawat_jalan.id_pendaftaran = rekam_medis_jalan.id_pendaftaran');
		$builder->join('jadwal_dokter','jadwal_dokter.id_jadwal = pendaftaran_rawat_jalan.id_jadwal');
		$builder->join('pasien','pasien.id_pasien = pendaftaran_rawat_jalan.id_pasien');
		$builder->join('dokter','dokter.id_dokter = jadwal_dokter.id_dokter');
        if ($param['cek_waktu1']) $builder->where('rekam_medis_jalan.created_at >= ', $param['cek_waktu1']);
        if ($param['id_pasien']) $builder->where('pendaftaran_rawat_jalan.id_pasien', $param['id_pasien']);
        if ($param['id_dokter']) $builder->where('jadwal_dokter.id_dokter', $param['id_dokter']);
        return $builder->get();
    }

    public function filter_inap($param)
    {
    	$db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis_inap');
		$builder->select('pasien.nama_pasien, dokter.nama_dokter, hasil_pemeriksaan, saran_dokter, DATE_FORMAT(rekam_medis_inap.created_at,"%d %M %Y") as created_at');
		$builder->join('pasien','pasien.id_pasien = rekam_medis_inap.id_pasien');
		$builder->join('dokter','dokter.id_dokter = rekam_medis_inap.id_dokter');
        if ($param['cek_waktu1']) $builder->where('rekam_medis_inap.created_at >= ', $param['cek_waktu1']);
        if ($param['id_pasien']) $builder->where('rekam_medis_inap.id_pasien', $param['id_pasien']);
        if ($param['id_dokter']) $builder->where('rekam_medis_inap.id_dokter', $param['id_dokter']);
        return $builder->get();
    }
}